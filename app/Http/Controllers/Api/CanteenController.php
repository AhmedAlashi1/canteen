<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChildResource;
use App\Models\Child;
use App\Models\Order;
use App\Models\OrderDay;
use App\Models\SchoolProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CanteenController extends Controller
{


    public function canteenHome($child_id)
    {
        $child = Child::with(['school', 'user'])->find($child_id);

        if (!$child) {
            return sendError('الطفل غير موجود');
        }

        //  جلب الطلب المفتوح (pending) من نوع school، مع علاقة schoolProduct → product
        $openOrder = Order::where('child_id', $child_id)
            ->where('type', 'school')
            ->where('status', 'pending')
            ->with(['orderProducts.schoolProduct.product'])
            ->first();

        $basketItems = [];
        $basketTotal = 0;

        if ($openOrder) {
            foreach ($openOrder->orderProducts as $item) {
                $schoolProduct = $item->schoolProduct;
                $product = $schoolProduct?->product;

                if (!$schoolProduct || !$product) {
                    continue; // تجاوز العناصر المفقودة
                }

                $price = $schoolProduct->price;
                $lineTotal = $price * $item->quantity;

                $basketItems[] = [
                    'product_id' => $product->id,
                    'name' => $product->name_en,
                    'image' => url($product->image),
                    'price' => $price,
                    'quantity' => $item->quantity,
                    'total' => round($lineTotal, 3),
                ];

                $basketTotal += $lineTotal;
            }
        }

        //  حساب عدد أيام الشراء لهذا الطفل خلال الأسبوع (الأحد - الخميس)
        $weekStart = now()->startOfWeek(Carbon::SUNDAY);
        $weekEnd = $weekStart->copy()->addDays(4);

        $weekDaysPurchases = Order::where('child_id', $child_id)
            ->where('status', 'completed')
            ->where('type', 'school')
            ->whereBetween('created_at', [$weekStart, $weekEnd])
            ->whereRaw('WEEKDAY(created_at) < 5')
            ->select(DB::raw('COUNT(DISTINCT DATE(created_at)) as days_count'))
            ->value('days_count');

        //  تجهيز معلومات الطفل
        $childInfo = [
            'id' => $child->id,
            'name' => $child->name,
            'grade' => $child->level,
            'school_name' => $child->school?->name,
            'image' => url($child->image),
        ];

        return sendResponse([
            'child' => $childInfo,
            'week_days_purchases' => (int) $weekDaysPurchases,
            'basket' => [
                'total' => round($basketTotal, 3),
                'items' => $basketItems
            ]
        ], 'تم جلب بيانات الكانتين بنجاح');
    }


    public function products(Request $request, $child_id)
    {
        $child = Child::find($child_id);
        if (!$child) {
            return sendError('Child not found');
        }

        // قراءة اللغة من الهيدر
        $lang = strtolower($request->header('lang', 'en'));

        $size = $request->query('size', 10);
        $page = $request->query('page', 1);

        $query = SchoolProduct::where('school_id', $child->school_id)
            ->whereHas('product', function ($q) use ($request) {
                $q->where('status', 'active');

                if ($request->query('category_id')) {
                    $q->where('cat_id', $request->query('category_id'));
                }

                if ($request->query('query')) {
                    $q->where(function ($sub) use ($request) {
                        $sub->where('name_ar', 'like', '%' . $request->query('query') . '%')
                            ->orWhere('name_en', 'like', '%' . $request->query('query') . '%');
                    });
                }
            })
            ->with('product');

        $paginator = $query->paginate($size, ['*'], 'page', $page);

        $products = $paginator->getCollection()->map(function ($schoolProduct) use ($lang) {
            $product = $schoolProduct->product;
            return [
                'product_id'  => $schoolProduct->product_id,
                'name'        => $lang === 'ar' ? $product->name_ar : $product->name_en,
                'description' => $lang === 'ar' ? $product->description_ar : $product->description_en,
                'image'       => url($product->image),
                'price'       => $schoolProduct->price,
                'quantity'    => $schoolProduct->quantity,
            ];
        });

        return sendResponse([
            'current_page' => $paginator->currentPage(),
            'total_pages' => $paginator->lastPage(),
            'total_items' => $paginator->total(),
            'per_page' => $paginator->perPage(),
            'items' => $products
        ], 'Products fetched successfully');
    }

    public function basketDetails($child_id)
    {
        $child = Child::with('school')->find($child_id);

        if (!$child) {
            return sendError('الطفل غير موجود');
        }

        //   السلة من الطلب المفتوح (نوع school)
        $openOrder = Order::where('child_id', $child_id)
            ->where('type', 'school')
            ->where('status', 'pending')
            ->with(['orderProducts.schoolProduct.product'])
            ->first();

        $basketItems = [];
        $basketTotal = 0;

        if ($openOrder) {
            foreach ($openOrder->orderProducts as $item) {
                $schoolProduct = $item->schoolProduct;
                $product = $schoolProduct?->product;

                if (!$schoolProduct || !$product) continue;

                $price = $schoolProduct->price;
                $lineTotal = $price * $item->quantity;

                $basketItems[] = [
                    'product_id' => $product->id,
                    'name' => $product->name_en,
                    'image' => url($product->image),
                    'price' => $price,
                    'quantity' => $item->quantity,
                    'total' => round($lineTotal, 3),
                ];

                $basketTotal += $lineTotal;
            }
        }

        //  الأيام المسموحة فقط: الأحد إلى الخميس
        $availableDays = [];
        $today = now()->startOfDay();
        $startOfWeek = now()->startOfWeek(Carbon::SUNDAY);

        for ($i = 0; $i < 5; $i++) {
            $date = $startOfWeek->copy()->addDays($i);
            $dayName = $date->format('l'); // Sunday, Monday...

            // هل اليوم في الماضي؟
            if ($date->lt($today)) {
                $selectable = false;
                $reason = 'past_day';
            }
            // هل تم تنفيذ طلب بالفعل في هذا اليوم؟
            elseif (
                OrderDay::whereHas('order', function ($q) use ($child_id) {
                    $q->where('child_id', $child_id)->where('status', 'completed');
                })->whereDate('date', $date)->exists()
            ) {
                $selectable = false;
                $reason = 'already_ordered';
            } else {
                $selectable = true;
                $reason = null;
            }

            $availableDays[] = [
                'label' => $dayName,
                'date' => $date->toDateString(),
                'selectable' => $selectable,
                'reason' => $reason,
            ];
        }

        // 🟣 بيانات الطفل
        $childInfo = [
            'id' => $child->id,
            'name' => $child->name,
            'grade' => $child->level,
            'school_name' => $child->school?->name,
            'image' => url($child->image),
        ];

        return sendResponse([
            'child' => $childInfo,
            'basket' => [
                'total' => round($basketTotal, 3),
                'items' => $basketItems
            ],
            'available_days' => $availableDays,
        ], 'تم جلب تفاصيل سلة الكانتين بنجاح');
    }

}

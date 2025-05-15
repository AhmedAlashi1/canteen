<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Basket;
use App\Models\Child;
use App\Models\ProductSize;
use App\Models\SchoolProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BasketController extends Controller
{
    public function storeOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'child_id' => 'required|exists:children,id',
            'type' => 'required|in:school,store',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.product_size_id' => 'required_if:type,store|exists:product_sizes,id',
        ], [
            'items.*.product_id.required' => 'الرجاء تحديد المنتج.',
            'items.*.product_id.exists' => 'أحد المنتجات المحددة غير موجود.',
            'items.*.quantity.required' => 'الرجاء تحديد الكمية.',
            'items.*.quantity.integer' => 'الكمية يجب أن تكون رقمًا صحيحًا.',
            'items.*.product_size_id.required_if' => 'الرجاء تحديد الحجم للمنتج.',
        ]);

        if ($validator->fails()) {
            return sendError($validator->errors()->first());
        }

        $child = Child::with('user')->find($request->child_id);
        if (!$child || !$child->user) {
            return sendError('المستخدم المرتبط بالطفل غير موجود.');
        }

        foreach ($request->items as $item) {
            if ($request->type === 'school') {
                $schoolProduct = SchoolProduct::where('product_id', $item['product_id'])
                    ->where('school_id', $child->school_id)
                    ->first();

                if (!$schoolProduct) {
                    return sendError('المنتج غير متاح في مدرسة الطفل.');
                }

                if ($item['quantity'] > $schoolProduct->quantity) {
                    return sendError('الكمية غير متوفرة للمنتج: ' . $schoolProduct->product?->name_ar);
                }
            }

            if ($request->type === 'store') {
                $productSize = ProductSize::where('id', $item['product_size_id'])
                    ->where('product_id', $item['product_id'])
                    ->first();

                if (!$productSize) {
                    return sendError('الحجم غير تابع للمنتج.');
                }

                if ($item['quantity'] > $productSize->quantity) {
                    return sendError('الكمية غير متوفرة للحجم: ' . $productSize->size);
                }
            }
        }

        Basket::updateOrCreate(
            ['child_id' => $child->id, 'type' => $request->type],
            [
                'user_id' => $child->user_id,
                'items' => $request->items,
            ]
        );

        return sendResponse([
            'success' => true,
            'message' => 'تم حفظ السلة بنجاح.',
        ]);
    }

    public function get(Request $request, $child_id, $type)
    {
        $name = $request->header('lang') === 'ar' ? 'name_ar' : 'name_en';

        $basket = Basket::where('child_id', $child_id)->where('type', $type)->first();
        if (!$basket) return sendError('السلة فارغة.');

        $child = Child::find($child_id);
        if (!$child) return sendError('الطفل غير موجود.');

        $items = [];

        if ($type === 'school') {
            $productIds = collect($basket->items)->pluck('product_id');
            $products = SchoolProduct::with("product:id,$name,image")
                ->where('school_id', $child->school_id)
                ->whereIn('product_id', $productIds)
                ->get()
                ->keyBy('product_id');

            foreach ($basket->items as $item) {
                $schoolProduct = $products[$item['product_id']] ?? null;
                if (!$schoolProduct || !$schoolProduct->product) continue;

                $items[] = [
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $schoolProduct->price,
                    'name' => $schoolProduct->product->$name,
                    'image' => $schoolProduct->product->image,
                ];
            }
        }

        if ($type === 'store') {
            $sizeIds = collect($basket->items)->pluck('product_size_id');
            $sizes = ProductSize::with("product:id,$name,image")
                ->whereIn('id', $sizeIds)
                ->get()
                ->keyBy('id');

            foreach ($basket->items as $item) {
                $size = $sizes[$item['product_size_id']] ?? null;
                if (!$size || !$size->product) continue;

                $items[] = [
                    'product_id' => $item['product_id'],
                    'product_size_id' => $item['product_size_id'],
                    'quantity' => $item['quantity'],
                    'price' => $size->price,
                    'size' => $size->size,
                    'name' => $size->product->$name,
                    'image' => $size->product->image,
                ];
            }
        }

        return sendResponse([
            'success' => true,
            'message' => 'تم جلب السلة بنجاح.',
            'items' => $items,
        ]);
    }
}

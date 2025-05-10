<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Child;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderDay;
use App\Models\OrderProduct;
use App\Models\PaymentMethod;
use App\Models\SchoolProduct;
use App\Services\MyFatoorahService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{

    public function store(Request $request)
    {
        // [1] التحقق من صحة البيانات لإنشاء الطلب
        $orderValidator = Validator::make($request->all(), [
            'child_id' => 'required|exists:children,id',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'payment_id' => 'required|exists:payment_methods,id',
            'days' => 'required|array|min:1',
            'days.*' => 'required|date_format:Y-m-d',
            'coupon' => 'nullable|string',
        ], [
            'items.*.product_id.required' => 'الرجاء تحديد المنتج.',
            'items.*.product_id.exists' => 'أحد المنتجات المحددة غير موجود.',
            'items.*.quantity.required' => 'الرجاء تحديد الكمية.',
            'items.*.quantity.integer' => 'الكمية يجب أن تكون رقمًا صحيحًا.',
        ]);

        if ($orderValidator->fails()) {
            return sendError($orderValidator->errors()->first());
        }

        $childId = $request->child_id;
        $days = $request->days;
        $couponCode = $request->coupon;

        // [2] التحقق من صلاحية الأيام (لا يسمح باليوم الحالي أو الأيام السابقة)
        $today = now()->startOfDay();
        foreach ($days as $day) {
            $dayDate = Carbon::createFromFormat('Y-m-d', $day)->startOfDay();
            if ($dayDate->lte($today)) return sendError("يجب اختيار تاريخ مستقبلي (بعد اليوم الحالي): $day");
            if ($dayDate->dayOfWeek > 4) return sendError("يُسمح فقط بأيام الأحد إلى الخميس: $day");
            $usedBefore = OrderDay::where('date', $day)
                ->whereHas('order', fn($q) => $q->where('child_id', $childId)->where('status', 'completed'))
                ->exists();
            if ($usedBefore) return sendError("تم استخدام التاريخ مسبقًا في طلب مكتمل: $day");
        }

        // [3] جلب الطفل والمستخدم
        $child = Child::with('user')->find($childId);
        $user = $child->user;

        // [4] إنشاء الطلب الجديد مباشرة
        $order = Order::create([
            'child_id' => $child->id,
            'user_id' => $user->id,
            'type' => 'school',
            'status' => 'pending',
            'payment_status' => 'pending',
            'total' => 0,
        ]);

        $total = 0;
        $orderProducts = [];

        foreach ($request->items as $item) {
            // التحقق من توفر المنتج في مدرسة الطفل
            $schoolProduct = SchoolProduct::where('product_id', $item['product_id'])
                ->where('school_id', $child->school_id)
                ->with('product')
                ->first();

            if (!$schoolProduct) {
                $order->delete();
                return sendError('المنتج غير متاح في مدرسة الطفل.');
            }

            if ($item['quantity'] > $schoolProduct->quantity) {
                $order->delete();
                return sendError('الكمية المطلوبة غير متوفرة للمنتج: ' . $schoolProduct->product->name_ar);
            }

            $lineTotal = $schoolProduct->price * $item['quantity'];
            $total += $lineTotal;

            $orderProducts[] = [
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'school_product_id' => $schoolProduct->id,
                'quantity' => $item['quantity'],
                'type' => 'school',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        OrderProduct::insert($orderProducts);

        // إضافة الأيام مباشرة (سيتم التراجع عنها تلقائياً إذا فشلت العملية)
        foreach ($request->days as $day) {
            $dayDate = Carbon::createFromFormat('Y-m-d', $day)->startOfDay();
            OrderDay::create([
                'order_id' => $order->id,
                'date' => $dayDate->toDateString(),
                'day' => $dayDate->englishDayOfWeek,
            ]);
        }

        // [5] احتساب السعر والخصم
        $coupon = null;
        $discount = 0;
        if ($couponCode) {
            $coupon = Coupon::where('code', $couponCode)
                ->where('status', true)
                ->whereDate('end_at', '>=', now())
                ->first();

            if (!$coupon) {
                $order->delete();
                return sendError('الكوبون غير صالح أو منتهي.');
            }

            $usedCount = Order::where('coupon_id', $coupon->id)
                ->where('child_id', $childId)
                ->count();

            if ($coupon->code_limit !== null && $usedCount >= $coupon->code_limit) {
                $order->delete();
                return sendError('تم استخدام الكوبون بالحد الأقصى.');
            }

            $discount = $coupon->type === 'percentage'
                ? $total * ($coupon->value / 100)
                : $coupon->value;
            $discount = min($discount, $total);
        }

        $finalTotal = $total - $discount;

        // [6] تحديث الطلب بالمعلومات النهائية
        $order->update([
            'payment_id' => $request->payment_id,
            'coupon_id' => $coupon?->id,
            'discount' => round($discount, 3),
            'total' => round($finalTotal, 3),
        ]);

        // [7] التحقق إذا كان المبلغ النهائي صفر أو أقل
        if ($finalTotal <= 0) {
            // تنفيذ عملية الدفع الناجحة مباشرة بدون واجهة دفع
            $this->completeOrderWithoutPayment($order, $request->days);

            return sendResponse([
                'success' => true,
                'message' => 'تم إنشاء الطلب بنجاح.',
                'payment_url' => null,
                'order_id' => $order->id,
                'total' => round($total, 3),
                'discount' => round($discount, 3),
                'final_total' => round($finalTotal, 3),
                'free_order' => true,
            ]);
        }

        // [8] إنشاء الفاتورة (للمبالغ أكبر من صفر)
        $phone = preg_replace('/[^0-9]/', '', $user->phone);
        $phone = substr($phone, -11);
        $paymentMethod = PaymentMethod::find($request->payment_id);
        $paymentMethodId = PaymentMethod::ALL_METHODS[$paymentMethod->slug] ?? 1;


        $invoiceData = [
            'InvoiceValue' => round($finalTotal, 3),
            'PaymentMethodId' => $paymentMethodId,
            'CustomerName' => $user->name,
            'CustomerEmail' => $user->email,
            'CustomerMobile' => $phone,
            'CallBackUrl' => route('ordersSuccess', ['order_id' => $order->id]),
            'ErrorUrl' => route('ordersError', ['order_id' => $order->id]),
            'CustomerReference' => $order->id,
            'Language' => app()->getLocale(),
            'DisplayCurrencyIso' => 'KWD',
        ];

        try {
            $paymentUrl = app(MyFatoorahService::class)->executePayment($invoiceData, $order->id);
        } catch (\Throwable $e) {
            $order->delete();
            Log::error('MyFatoorah payment error', [
                'message' => $e->getMessage(),
                'order_id' => $order->id,
                'invoiceData' => $invoiceData,
            ]);
            return sendError('فشل إنشاء الفاتورة. الرجاء المحاولة لاحقًا.');
        }

        // تحديث حالة الدفع
        $order->update([
            'payment_status' => 'pending',
            'transaction_id' => null,
        ]);

        return sendResponse([
            'success' => true,
            'message' => 'تم إنشاء الطلب ورابط الدفع بنجاح.',
            'payment_url' => $paymentUrl,
            'order_id' => $order->id,
            'total' => round($total, 3),
            'discount' => round($discount, 3),
            'final_total' => round($finalTotal, 3),
            'free_order' => false,
        ]);
    }

    protected function completeOrderWithoutPayment(Order $order, array $days)
    {
        DB::transaction(function () use ($order, $days) {
            // تحديث حالة الطلب
            $order->update([
                'status' => 'completed',
                'payment_status' => 'paid',
            ]);

            // خصم الكمية
            foreach ($order->orderProducts as $orderProduct) {
                if ($schoolProduct = $orderProduct->schoolProduct) {
                    $schoolProduct->decrement('quantity', $orderProduct->quantity);
                }
            }
        });
    }

    public function applyCoupon(Request $request)
    {
        //  التحقق من صحة البيانات
        $validator = Validator::make($request->all(), [
            'child_id' => 'required|exists:children,id',
            'coupon' => 'required|string',
        ], [
            'child_id.required' => 'الرجاء تحديد الطفل.',
            'child_id.exists' => 'الطفل غير موجود في قاعدة البيانات.',
            'coupon.required' => 'الرجاء إدخال رمز الكوبون.',
        ]);

        if ($validator->fails()) {
            return sendError($validator->errors()->first());
        }

        //  التحقق من الكوبون
        $coupon = Coupon::where('code', $request->coupon)
            ->where('status', 'active')
            ->whereDate('end_at', '>=', now())
            ->first();

        if (!$coupon) {
            return sendError('رمز الكوبون غير صالح أو منتهي الصلاحية.');
        }

        //  التحقق من عدد مرات الاستخدام
        $usageCount = Order::where('coupon_id', $coupon->id)->count();
        if ($coupon->code_limit !== null && $usageCount >= $coupon->code_limit) {
            return sendError('تم استخدام هذا الكوبون بالحد الأقصى.');
        }

        //  جلب الطلب المفتوح
        $order = Order::where('child_id', $request->child_id)
            ->where('status', 'pending')
            ->where('type', 'school')
            ->with(['orderProducts.schoolProduct'])
            ->first();

        if (!$order || $order->orderProducts->isEmpty()) {
            return sendError('لا يوجد طلب مفتوح لهذا الطفل.');
        }

        //  حساب السعر الكلي
        $total = 0;
        foreach ($order->orderProducts as $item) {
            $price = $item->schoolProduct?->price ?? 0;
            $total += $price * $item->quantity;
        }

        //  حساب الخصم
        $discount = 0;
        if ($coupon->type === 'percentage') {
            $discount = $total * ($coupon->discount / 100);
        } elseif ($coupon->type === 'fixed') {
            $discount = $coupon->discount;
        }

        $discount = min($discount, $total); // منع الخصم من تجاوز الإجمالي
        $totalAfter = round($total - $discount, 3);

        return sendResponse([
            'discount' => round($discount, 3),
            'total_after_discount' => $totalAfter,
            'original_total' => round($total, 3),
        ], 'تم تطبيق الكوبون بنجاح.');
    }


    public function paymentSuccess(Request $request)
    {
        $order = Order::with(['orderProducts.schoolProduct'])->find($request->order_id);
        if (!$order) return 'الطلب غير موجود.';



        DB::transaction(function () use ($order) {
            // تحديث حالة الطلب
            $order->update([
                'status' => 'completed',
                'payment_status' => 'paid',
                'transaction_id' => $request->paymentId ?? null,
            ]);

            // خصم الكمية
            foreach ($order->orderProducts as $orderProduct) {
                if ($schoolProduct = $orderProduct->schoolProduct) {
                    $schoolProduct->decrement('quantity', $orderProduct->quantity);
                }
            }
        });

        echo 'success';
    }

    public function paymentError(Request $request)
    {
        $orderId = $request->order_id;

        info("فشل عملية الدفع للطلب: $orderId", $request->all());

        echo 'error';
    }


}

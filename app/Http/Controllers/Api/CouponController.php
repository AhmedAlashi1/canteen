<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Child;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\ProductSize;
use App\Models\SchoolProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    public function applyCouponOld(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|in:school,store',
            'child_id' => 'required|exists:children,id',
            'coupon' => 'required|string',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.product_size_id' => 'required_if:type,store|exists:product_sizes,id',
            'days' => 'required_if:type,school|array|min:1',
            'days.*' => 'required_if:type,school|date_format:Y-m-d',
        ]);

        if ($validator->fails()) {
            return sendError($validator->errors()->first());
        }

        $type = $request->type;
        $child = Child::find($request->child_id);

        $coupon = Coupon::where('code', $request->coupon)
            ->where('status', true)
            ->whereDate('end_at', '>=', now())
            ->first();

        if (!$coupon) {
            return sendError('رمز الكوبون غير صالح أو منتهي الصلاحية.');
        }

        $usedCount = Order::where('coupon_id', $coupon->id)
            ->where('child_id', $child->id)
            ->count();

        if ($coupon->code_limit !== null && $usedCount >= $coupon->code_limit) {
            return sendError('تم استخدام هذا الكوبون بالحد الأقصى.');
        }

        // حساب السعر الكلي
        $total = 0;
        $daysCount = $type === 'school' ? count($request->days) : 1;

        foreach ($request->items as $item) {
            if ($type === 'school') {
                $schoolProduct = SchoolProduct::where('product_id', $item['product_id'])
                    ->where('school_id', $child->school_id)
                    ->first();

                if (!$schoolProduct) {
                    return sendError("المنتج غير متوفر في مدرسة الطفل.");
                }

                $total += $schoolProduct->price * $item['quantity'] * $daysCount;
            }

            if ($type === 'store') {
                $productSize = ProductSize::where('id', $item['product_size_id'])
                    ->where('product_id', $item['product_id'])
                    ->first();

                if (!$productSize) {
                    return sendError("الحجم المحدد لا يتبع المنتج.");
                }

                $total += $productSize->price * $item['quantity'];
            }
        }

        // حساب الخصم
        $discount = 0;
        if ($coupon->type === 'percentage') {
            $discount = $total * ($coupon->value / 100);
        } elseif ($coupon->type === 'fixed') {
            $discount = $coupon->value;
        }

        $discount = min($discount, $total);
        $totalAfter = round($total - $discount, 3);

        return sendResponse([
            'discount' => round($discount, 3),
            'total_after_discount' => $totalAfter,
            'original_total' => round($total, 3),
        ], 'تم تطبيق الكوبون بنجاح.');
    }

        //applyCoupon
    public function applyCoupon(Request $request){

        $user = auth()->user();
        $copupon = Coupon::where('code', $request->coupon)
            ->where('status', 'active')
            ->where('use_number', '>', 0)
            ->whereDate('end_at', '>=', now())
            ->first();
        if (!$copupon) {
            return sendError('رمز الكوبون غير صالح أو منتهي الصلاحية.');
        }
        return sendResponse([
            'discount' => $copupon->discount,
            'type' => $copupon->type,
            'use_number' => $copupon->use_number,
            'end_at'=> $copupon->end_at
        ], 'تم تطبيق الكوبون بنجاح.');

    }
}

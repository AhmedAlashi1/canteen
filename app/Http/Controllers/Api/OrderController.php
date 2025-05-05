<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    //store
    public function store(Request $request)
    {
//        return $request->all();
        $validator = Validator::make($request->all(), [
            'child_id' => 'required|exists:children,id',
            'payment_id' => 'required|exists:payment_methods,id',
            'address_id' => 'nullable|exists:addresses,id',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'days' => 'required|array|min:1',
            'days.*.day_date' => 'required|date_format:Y-m-d',
        ],
            [
                'items.*.product_id.exists' => 'أحد المنتجات المحددة غير موجود في قاعدة البيانات.',
                'items.*.product_id.required' => 'الرجاء تحديد المنتج.',
                'items.*.quantity.required' => 'الرجاء تحديد الكمية.',
                'items.*.quantity.integer' => 'الكمية يجب أن تكون رقمًا صحيحًا.',
                'days.*.day_date.required' => 'يرجى تحديد التاريخ.',
                'days.*.day_date.date_format' => 'صيغة التاريخ يجب أن تكون على الشكل YYYY-MM-DD.',
            ]);
        //if error
        if ($validator->fails()) {
            return sendError( $validator->errors()->first());
        }

        return $validator;


        return response()->json(['message' => 'Order created successfully', 'order' => $order], 201);
    }
}

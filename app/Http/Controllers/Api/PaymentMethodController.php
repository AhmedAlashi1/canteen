<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    //___invoke
    public function __invoke(Request $request)
    {
        $payment =PaymentMethod::where('status', 'active')->get()
            ->map(function ($payment) use ($request) {
                return [
                    'id' => $payment->id,
                    'name' => $request->header('lang') == 'en' ? $payment->name_en : $payment->name_ar,
                    'image' => $payment->image ? url($payment->image) : null,
                ];
            })->toArray();

        return sendResponse($payment);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentWebhookController extends Controller
{
    public function handle(Request $request)
    {
        \Log::info('MyFatoorah Webhook Triggered', $request->all());

        $data = $request->input('Data');

        if (!$data || !isset($data['InvoiceId'], $data['InvoiceStatus'])) {
            return response()->json(['message' => 'بيانات غير صالحة'], 400);
        }

        $invoiceId = $data['InvoiceId'];
        $status = $data['InvoiceStatus']; // Paid, Failed, Expired...

        // البحث عن الطلب المرتبط بـ InvoiceId
        $order = Order::where('invoice_id', $invoiceId)->first();

        if (!$order) {
            return response()->json(['message' => 'الطلب غير موجود'], 404);
        }

        // تحديث حالة الطلب
        if ($status === 'Paid') {
            $order->update([
                'payment_status' => 'paid',
                'transaction_id' => $data['PaymentId'] ?? null,
            ]);
        } elseif ($status === 'Failed') {
            $order->update([
                'payment_status' => 'failed',
            ]);
        } elseif ($status === 'Expired') {
            $order->update([
                'payment_status' => 'expired',
            ]);
        }

        return response()->json(['message' => 'تمت معالجة Webhook بنجاح']);
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\OrdersDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\FirebaseService;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index(OrdersDataTable $dataTable)
    {
        return $dataTable->render('dashboard.admin.orders.index');
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('dashboard.admin.orders.show', compact('id', 'order'));
    }

    public function edit($id)
    {
        return view('admin.orders.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Update order logic here
        return redirect()->route('admin.orders.index')->with('success', 'Order updated successfully.');
    }
    //delete order
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return response()->json('success');

    }

    public function changeStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:preparing,delivering,completed,cancelled' // حسب الحالات المتاحة عندك
        ]);

        $order->status = $request->status;
        $order->save();

        $user = $order->user;
        $title = 'Order Status Updated';
        $body = "Your order #{$order->id} status has been updated to {$order->status}.";
        $data = [
            'order_id' => $order->id,
        ];
        $token = $user->device_token ?? null;
        if ($token) {
            $firebase = new FirebaseService();
            $sent = $firebase->sendNotificationToToken($token, $title, $body, $data);
            if ($sent) {
                $user->notifications()->create([
                    'order_id' => $order->id,
                    'title' => $title,
                    'body' => $body,
                    'type' => 'order',
                    'data' => json_encode($data),
                ]);
            }
        }



        return response()->json(['success' => true]);
    }
}

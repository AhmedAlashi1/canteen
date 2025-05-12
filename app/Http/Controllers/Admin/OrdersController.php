<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\OrdersDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
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
}

<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\PaymentMethodDataTable;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\PaymentMethod;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentMethodController extends Controller
{
    use ImageTrait;

//    public function __construct()
//    {
//        $this->middleware('permission:display payment methods', ['only' => ['index']]);
//        $this->middleware('permission:create payment methods', ['only' => ['create', 'store']]);
//        $this->middleware('permission:update payment methods', ['only' => ['edit', 'update']]);
//        $this->middleware('permission:delete payment methods', ['only' => ['destroy']]);
//    }

    public function index(PaymentMethodDataTable $dataTable)
    {
        return $dataTable->render('dashboard.admin.payment_methods.index');
    }


    public function create()
    {
        return view('dashboard.admin.payment_methods.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:payment_methods,slug',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',

        ]);
        if ($request->has('image')) {
            $image_path = $this->uploadImage('admin', $request->image);
            $data['image'] = $image_path;
        }
        PaymentMethod::create($data);

        return redirect()->route('admin.payment-methods.index')->with('success', 'Payment method created successfully');

    }

    public function edit($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);
        return view('dashboard.admin.payment_methods.edit', compact('id','paymentMethod'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:payment_methods,slug,' . $id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',
        ]);
        if ($request->has('image')) {
            $image_path = $this->uploadImage('admin', $request->image);
            $data['image'] = $image_path;
        }
        PaymentMethod::findOrFail($id)->update($data);

        return redirect()->route('admin.payment-methods.index')->with('success', 'Payment method updated successfully');
    }

    public function destroy(PaymentMethod $paymentMethod)
    {
        // Delete logic here
        if ($paymentMethod->image) {
            Storage::disk('public')->delete($paymentMethod->image);
        }
        $paymentMethod->delete();
        return response()->json('success');

    }
}

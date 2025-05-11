<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CitiesDataTable;
use App\DataTables\CouponsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponsController extends Controller
{
    //
    public function index(CouponsDataTable $dataTable)
    {
        return $dataTable->render('dashboard.admin.coupons.index');
    }
    public function create()
    {
        return view('dashboard.admin.coupons.create');
    }

    public function store(CouponRequest $request)
    {
        $data = $request->validated();
//        return $data;
        Coupon::create($data);

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon created successfully');
    }
    public function edit(Coupon $coupon)
    {
        return view('dashboard.admin.coupons.edit', compact('coupon'));
    }
    public function update(CouponRequest $request, Coupon $coupon)
    {
        $data = $request->validated();
        $coupon->update($data);

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon updated successfully');
    }

    public function destroy($id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();
        return response()->json('success');
    }

}

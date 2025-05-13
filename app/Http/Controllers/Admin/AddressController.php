<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AddressDataTable;
use App\DataTables\RegionDataTable;
use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index(AddressDataTable $dataTable , $id)
    {
        return $dataTable->render('dashboard.admin.address.index' ,compact('id'));
    }
    //destroy
    public function destroy($id)
    {
        $address = Address::findOrFail($id);
        $address->delete();
        return response()->json('success');
    }


}

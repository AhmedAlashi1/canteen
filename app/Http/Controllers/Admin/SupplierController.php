<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SupplierDataTable;
use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{

    public function index(SupplierDataTable $dataTable)
    {
        return $dataTable->render('dashboard.admin.suppliers.index');
    }

    public function create()
    {
        return view('dashboard.admin.suppliers.create');
    }

    public function store(Request $request)
    {
        // Validate and store supplier logic
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'company_name' => 'required|string|max:255',
            'whatsapp' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',

        ]);

         Supplier::create($data);

        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier created successfully');
    }

    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('dashboard.admin.suppliers.edit', compact('id','supplier'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'company_name' => 'required|string|max:255',
            'whatsapp' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',

        ]);
        $supplier = Supplier::findOrFail($id);
        $supplier->update($data);

        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier updated successfully');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return response()->json('success');
    }

    public function select(Request $request)
    {
        $q = $request->get('q');
        $suppliers = Supplier::where('name', 'like', '%' . $q . '%')
            ->select('id', 'name')
            ->limit(20)
            ->get();
        $suppliers = $suppliers->map(function ($supplier) {
            return [
                'id' => $supplier->id,
                'name' => $supplier->name ,
            ];
        });

        return response()->json($suppliers);
    }

}

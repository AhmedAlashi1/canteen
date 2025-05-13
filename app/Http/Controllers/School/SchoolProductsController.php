<?php

namespace App\Http\Controllers\School;

use App\DataTables\CategoryDataTable;
use App\DataTables\ProductsDataTable;
use App\DataTables\SchoolProductsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\School;
use App\Models\SchoolProduct;
use App\Models\Supplier;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;

class SchoolProductsController extends Controller
{
    use ImageTrait;


    public function index(SchoolProductsDataTable $dataTable)
    {
        return $dataTable->render('dashboard.school.school_products.index');
    }

    public function create()
    {
        return view('dashboard.school.school_products.create');
    }
    //store
    public function store(Request $request)
    {
        $school = auth()->user()->id;
        $request->merge(['school_id' => $school]);
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'school_id' => 'required|exists:schools,id',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'supplier_id' => 'nullable|exists:suppliers,id',
        ]);
        $product = Product::findOrFail($data['product_id']);
        $productData = [
            'product_id' => $data['product_id'],
            'school_id' => $data['school_id'],
            'price' => $data['price'],
            'quantity' => $data['quantity'],
            'supplier_id' => $data['supplier_id'] ?? null,
        ];
        // تحقق مما إذا كان المنتج موجودًا بالفعل في المدرسة
        $existingProduct = $product->schoolProducts()->where('school_id', $data['school_id'])->first();
        if ($existingProduct) {
            // إذا كان موجودًا، قم بتحديثه
            $existingProduct->update($productData);
        } else {
            // إذا لم يكن موجودًا، قم بإنشائه
            $product->schoolProducts()->create($productData);
        }

        return redirect()->route('school.school-products.index')->with('success', __('Product added to school successfully.'));


    }

    public function edit(SchoolProduct $schoolProduct)
    {

        return view('dashboard.school.school_products.edit', compact('schoolProduct'));
    }
    //update
    public function update(Request $request , SchoolProduct $product)
    {
        return $request->all();
        $school = auth()->user()->id;
        $request->merge(['school_id' => $school]);
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'school_id' => 'required|exists:schools,id',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'supplier_id' => 'nullable|exists:suppliers,id',
        ]);
        $product->update($data);
        return redirect()->route('school.school-products.index')->with('success', __('Product updated successfully.'));

    }
    //destroy
    public function destroy(SchoolProduct $product)
    {

        $product->delete();
        return response()->json('success');
    }



}

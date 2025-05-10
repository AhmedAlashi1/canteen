<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CategoryDataTable;
use App\DataTables\ProductsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\School;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductsController extends Controller
{


    public function index(ProductsDataTable $dataTable)
    {
        return $dataTable->render('dashboard.admin.products.index');
    }

    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        $schools = School::all();
        return view('dashboard.admin.products.create',compact('categories','suppliers','schools'));
    }

    public function edit($id)
    {
        return view('admin.products.edit', compact('id'));
    }

}

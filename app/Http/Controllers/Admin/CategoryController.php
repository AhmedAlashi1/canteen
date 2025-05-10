<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    use ImageTrait;

    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('dashboard.admin.categories.index');
    }

    public function create()
    {

        return view('dashboard.admin.categories.create');
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->validated();
        if ($request->has('image')) {
            $image_path = $this->uploadImage('admin', $request->image);
            $data['image'] = $image_path;
        }
        Category::create($data);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully');
    }

    public function edit(Category $category)
    {
        return view('dashboard.admin.categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $data = $request->validated();
        $category->update($data);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        return response()->json('success');
    }
}

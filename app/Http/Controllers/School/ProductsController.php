<?php

namespace App\Http\Controllers\School;

use App\DataTables\CategoryDataTable;
use App\DataTables\ProductsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\School;
use App\Models\Supplier;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    use ImageTrait;


    public function index(ProductsDataTable $dataTable)
    {
        return $dataTable->render('dashboard.school.Products.index');
    }

    public function create()
    {
        $categories = Category::where('type', 'school')->get();
        $suppliers = Supplier::all();
        $schools = School::all();
        return view('dashboard.school.Products.create',compact('categories','suppliers','schools'));
    }
    //store
    public function store(Request $request)
    {
        $data = $request->validate([
            'cat_id' => 'required|exists:categories,id',
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        $productData = [
            'cat_id' => $data['cat_id'],
            'name_ar' => $data['name_ar'],
            'name_en' => $data['name_en'],
            'description_ar' => $data['description_ar'] ?? null,
            'description_en' => $data['description_en'] ?? null,
            'status' => 'pending',
            'type' => 'school',
            'school_id' => auth('school')->user()->id,
        ];


        if ($request->has('image')) {
            $image_path = $this->uploadImage('admin', $request->image);
            $productData['image'] = $image_path;
        }
        $product = Product::create($productData);
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $image_path = $this->uploadImage('admin', $img);
                $product->images()->create(['image' => $image_path]);
            }
        }

        return redirect()->route('school.products.index')->with('success', __('Product created successfully.'));
    }

    public function edit(Product $product)
    {
        $categories = Category::where('type', 'school')->get();
        return view('dashboard.school.Products.edit', compact('product','categories'));
    }
    //update
    public function update(Request $request , Product $product)
    {
        $data = $request->validate([
            'cat_id' => 'required|exists:categories,id',
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
//        return $data;
        $productData = [
            'cat_id' => $data['cat_id'],
            'name_ar' => $data['name_ar'],
            'name_en' => $data['name_en'],
            'description_ar' => $data['description_ar'] ?? null,
            'description_en' => $data['description_en'] ?? null,
            'status' => 'pending',
            'type' => 'school',
            'school_id' => auth('school')->user()->id,
        ];


        // صورة المنتج الرئيسية
        if ($request->hasFile('image')) {
            $image_path = $this->uploadImage('admin', $request->image);
            $productData['image'] = $image_path;
        }

        $product->update($productData);

        // الصور الإضافية الجديدة
        if ($request->hasFile('images')) {
            // 1. حذف الصور القديمة من الملفات وقاعدة البيانات
            foreach ($product->images as $oldImage) {
                if (\File::exists(public_path( $oldImage->image))) {
                    \File::delete(public_path( $oldImage->image));
                }
                $oldImage->delete();
            }

            // 2. رفع الصور الجديدة
            foreach ($request->file('images') as $img) {
                $image_path = $this->uploadImage('admin', $img);
                $product->images()->create(['image' => $image_path]);
            }
        }


        return redirect()->route('school.products.index')->with('success', __('Product updated successfully.'));
    }
    //destroy
    public function destroy(Product $product)
    {
        // حذف الصور القديمة من الملفات وقاعدة البيانات
        foreach ($product->images as $oldImage) {
            if (\File::exists(public_path($oldImage->image))) {
                \File::delete(public_path($oldImage->image));
            }
            $oldImage->delete();
        }
        //delete file image
        if (\File::exists(public_path($product->image))) {
            \File::delete(public_path($product->image));
        }
        //schoolProducts
        $product->schoolProducts()->delete();

        // حذف المنتج
        $product->delete();

        return response()->json('success');
    }
    //select
    public function select(Request $request)
    {
        $q = $request->get('q');
        $products = Product::where(function ($query) use ($q) {
            $query->where('name_ar', 'like', '%' . $q . '%')
                ->orWhere('name_en', 'like', '%' . $q . '%');
        })
            ->where(function ($query) {
                $query->whereNull('school_id')
                    ->orWhere('school_id', auth('school')->user()->id);
            })
            ->where('type','school')
            ->select('id', 'name_ar', 'name_en','image')
            ->limit(20)
            ->get();
        //map name_ar = name
        $products = $products->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name_en ,
                'image' => $product->image ,
            ];
        });

        return response()->json($products);
    }



}

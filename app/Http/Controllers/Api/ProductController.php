<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChildResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\SchoolProductResource;
use App\Http\Resources\SchoolResource;
use App\Models\Child;
use App\Models\Product;
use App\Models\SchoolProduct;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //index
    public function index(Request $request){

        $category_id = $request->category_id;
        $keyword = $request->keyword;
        $child_id = $request->child_id;
        $tyepe = $request->type;

        if ($tyepe == 'school'){
            $child = Child::where('id',$child_id)->first();
            if (!$child) {
                return sendError('Child not found');
            }
            $school_id = $child->school_id;
            $products = SchoolProduct::where('school_id', $school_id)
                ->where('quantity', '>', 0)
                ->whereHas('product', function ($query) use ($category_id, $keyword) {
                    $query->where('type', 'school');
                    if ($category_id) {
                        $query->where('cat_id', $category_id);
                    }
                    if ($keyword) {
                        $query->where(function ($q) use ($keyword) {
                            $q->where('name_ar', 'LIKE', "%$keyword%")
                                ->orWhere('name_en', 'LIKE', "%$keyword%");
                        });
                    }
                })
                ->with('product.category')
                ->orderBy('id', 'desc')
                ->paginate(20);
            $data = SchoolProductResource::collection($products);
        }elseif ($tyepe == 'store'){
            $products = Product::where('cat_id', $category_id)
                ->where('quantity', '>', 0)
                ->where('type', 'store')
                ->where(function ($query) use ($keyword) {
                    if ($keyword) {
                        $query->where('name_ar', 'LIKE', "%$keyword%")
                            ->orWhere('name_en', 'LIKE', "%$keyword%");
                    }
                })
                ->with('category','sizes','images')
                ->orderBy('id', 'desc')
                ->paginate(20);
            $data = ProductResource::collection($products);
        }else{
            return sendError('Type not found');
        }

        return sendResponse([
            'data' => $data,
            'pagination' => [
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'per_page' => $products->perPage(),
                'total' => $products->total(),
                'next_page_url' => $products->nextPageUrl(),
                'prev_page_url' => $products->previousPageUrl(),
            ]
        ], 'Products retrieved successfully');
    }

    public function show(Request $request , $id)
    {

        $type = $request->type;
        if ($type == 'school'){
            $product = SchoolProduct::where('id', $id)->with('product.category')->first();
            if (!$product) {
                return sendError('Product not found');
            }
            return sendResponse(new SchoolProductResource($product), 'Product retrieved successfully');

        }else{
            $product = Product::where('id', $id)->with('category','sizes','images')->first();
            if (!$product) {
                return sendError('Product not found');
            }
            return sendResponse(new ProductResource($product), 'Product retrieved successfully');
        }

    }


}

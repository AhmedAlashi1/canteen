<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductStoreController extends Controller
{
    //index
    public function index(Request $request){
        $category_id = $request->category_id;
        $keyword = $request->keyword;

        $products = Product::where('cat_id', $category_id)
            ->where('quantity', '>', 0)
            ->where('type', 'store')
            ->where(function ($query) use ($keyword) {
                if ($keyword) {
                    $query->where('name_ar', 'LIKE', "%$keyword%")
                        ->orWhere('name_en', 'LIKE', "%$keyword%");
                }
            })
            ->with('category')
            ->get();

        return sendResponse(ProductResource::collection($products), 'Products retrieved successfully');
    }
}

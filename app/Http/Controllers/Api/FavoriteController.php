<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Favorite;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    //index
    public function index(Request $request)
    {
        $user = auth('api')->user();
        //show products in favorites
        $favorites = Favorite::where('user_id', $user->id)->pluck('product_id');
        $products = Product::whereIn('id', $favorites)
            ->where('quantity', '>', 0)
            ->where('type', 'store')
            ->with('category','sizes','images')
            ->orderBy('id', 'desc')
            ->paginate(20);
        $data = ProductResource::collection($products);
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
    //store
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);
        $user = auth('api')->user();
        $productId = $request->product_id;
        $fav = Favorite::where('user_id', $user->id)->where('product_id', $productId)->first();
        if ($fav) {
            return sendError('Product already in favorites');
        }
        $fav = Favorite::create([
            'user_id' => $user->id,
            'product_id' => $productId,
        ]);

       return sendResponse($fav, 'Product added to favorites successfully');
    }

    public function destroy(Request $request, $id)
    {
        $user = auth('api')->user();
        $favorite = Favorite::where('user_id', $user->id)->where('product_id', $id)->first();
        if (!$favorite) {
            return sendError('Product not found in favorites');
        }
        $favorite->delete();
        return sendResponse(null, 'Product removed from favorites successfully');
    }

}

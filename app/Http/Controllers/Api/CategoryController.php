<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //__invoke
    public function __invoke(Request $request)
    {
        $type = $request->get('type') == 1  ? 'school' : 'store';
        $data = Category::where('status', 'active')
            ->where('type', $type)
            ->get()
            ->map(function ($category) use ($request) {
                return [
                    'id' => $category->id,
                    'name' => $request->header('lang') == 'en' ? $category->name_en : $category->name_ar,
                    'image' => $category->image ? url($category->image) : null,
                ];
            })->toArray();
        return sendResponse($data);
    }
}

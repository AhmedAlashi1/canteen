<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Child;
use App\Models\SchoolProduct;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //__invoke
    public function __invoke(Request $request)
    {
        $type = $request->get('type') == 1  ? 'school' : 'store';
        $validator = validator($request->all(), [
            'type' => 'required|in:1,2',
        ]);
        if ($validator->fails()) {
            return sendError($validator->errors()->first());
        }
        if ($request->filled('child_id')) {
            $child = Child::with('school')->find($request->child_id);
            if (!$child || !$child->school) {
                return sendError(__('school not found'));
            }
            $categoryIdsWithProducts = SchoolProduct::with('product')
                ->whereHas('product', function ($query) use ($type) {
                    $query->where('type', $type)->where('status', 'active');
                })
                ->whereHas('product.category', function ($query) {
                    $query->where('status', 'active');
                })
                ->where('school_id', $child->school_id)
                ->get()
                ->pluck('product.cat_id')
                ->unique()
                ->toArray();
            $categories = Category::whereIn('id', $categoryIdsWithProducts)
                ->where('status', 'active')
                ->get();
        }else {
            $categories = Category::where('type', $type)
                ->where('status', 'active')
                ->get();
        }
        $data = $categories->map(function ($category) use ($request) {
            return [
                'id' => $category->id,
                'name' => $request->header('lang') == 'en' ? $category->name_en : $category->name_ar,
                'image' => $category->image ? url($category->image) : null,
            ];
        })->toArray();

        return sendResponse($data);
    }
}

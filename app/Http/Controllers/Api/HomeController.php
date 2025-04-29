<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChildResource;
use App\Models\Ad;
use App\Models\Child;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //home
    public function home(Request $request)
    {
        $ads = Ad::latest()->take(5)->get()
        ->map(function ($ad) {
            return [
                'id' => $ad->id,
                'name' => $ad->name,
                'image' => $ad->image ? url($ad->image) : null,
                'link' => $ad->link,
            ];
        })->toArray();
        $user = auth()->user();
        $children = Child::where('user_id', $user->id)->with('school')->get();
        return sendResponse([
            'ads' => $ads,
            'children' => ChildResource::collection($children),
        ]);


    }
}

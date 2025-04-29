<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = City::where('status', 1)->get()
            ->map(function ($city) use ($request) {
                return [
                    'id' => $city->id,
                    'name' => $request->header('lang') == 'en' ? $city->name_en : $city->name_ar,
                    'code'=> $city->code,
                    'country_code'=> $city->country_code,
                    'image' => $city->image ? url($city->image) : null,
                ];
            })->toArray();
        return sendResponse($data);
    }
}

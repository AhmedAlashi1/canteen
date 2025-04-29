<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function __invoke(Request $request ,$city_id = null)
    {
        if ($city_id == null) {
            return sendError('City id is required');
        }
        $data = Region::where('status', 1)->where('city_id',$city_id)->with('city')->get()
            ->map(function ($region) use ($request) {
                return [
                    'id' => $region->id,
                    'name' => $request->header('lang') == 'en' ? $region->name_en : $region->name_ar,
                    'city_id' => $region->city_id,
                ];
            })->toArray();

        return sendResponse($data);
    }
}

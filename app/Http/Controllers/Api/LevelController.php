<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $data = Level::get()
            ->map(function ($level) use ($request) {
                return [
                    'id' => $level->id,
                    'name' => $request->header('lang') == 'en' ? $level->name_en : $level->name_ar,
                ];
            })->toArray();
        return sendResponse($data);
    }
}

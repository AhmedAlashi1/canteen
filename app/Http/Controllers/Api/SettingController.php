<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Settings;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __invoke(Request $request)
    {
        $privacy_policy=$request->header('lang')=='en'? 'privacy_policy_en':'privacy_policy_ar';
        $rules_conditions=$request->header('lang')=='en'? 'rules_conditions_en':'rules_conditions_ar';

        $data['privacy_policy'] = Setting::where('key_id',$privacy_policy)->first()->value;
        $data['rules_conditions'] = Setting::where('key_id',$rules_conditions)->first()->value;
        $data['phone'] = Setting::where('key_id','phone')->first()->value;
        $data['tiktok'] = Setting::where('key_id','tiktok')->first()->value;
        $data['twitter'] = Setting::where('key_id','twitter')->first()->value;
        $data['instagram'] = Setting::where('key_id','instagram')->first()->value;

        return sendResponse($data);


    }
}

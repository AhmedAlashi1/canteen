<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactUsController extends Controller
{
    public function __invoke(Request $request)
    {

        $validator = Validator::make($request->all(), ContactUs::$rulesApi);
        if ($validator->fails()) {
            $response['response'] = $validator->messages()->first();
            return sendError($response['response']);
        }
        $data =$request->all();
        $data['user_id'] = auth()->user()->id;
        $contact = ContactUs::create($data);

        return sendResponse($contact, 'Contact Us Created Successfully');

    }
}

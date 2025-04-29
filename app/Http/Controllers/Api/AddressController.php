<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AddressResource;
use App\Http\Resources\UserResource;
use App\Models\Address;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $address = $user->address()->with('city','region')->get();

        return sendResponse(AddressResource::collection($address));


    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Address::$rulesApi);
        if ($validator->fails()) {
            $response['response'] = $validator->messages()->first();
            return sendError($response['response']);
        }
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $data['is_default'] = $request->is_default ? 1 : 0;
        $user = auth()->user();
//        $user->address()->where('is_default', 1)->update(['is_default' => 0]);
        $address = $user->address()->create($data);

        return sendResponse($address , 'Address Created Successfully');
    }

    public function show($id)
    {
        return sendResponse('show');
    }

    public function update(Request $request, $id)
    {
//        return $request->all();
        $validator = Validator::make($request->all(), Address::$rulesApi);
        if ($validator->fails()) {
            $response['response'] = $validator->messages()->first();
            return sendError($response['response']);
        }
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $data['is_default'] = $request->is_default ? 1 : 0;
        $user = auth()->user();
//        $user->address()->where('is_default', 1)->update(['is_default' => 0]);
        $address = $user->address()->where('id', $id)->update($data);
        if ($address) {
            $address = $user->address()->where('id', $id)->first();
        }
        if ($address) {
            return sendResponse($address , 'Address Updated Successfully');
        } else {
            return sendError('Address Not Found');
        }
    }

    public function destroy($id)
    {
        $user = auth()->user();
        $address = $user->address()->where('id', $id)->first();
        if ($address) {
            $address->delete();
            return sendResponse($address , 'Address Deleted Successfully');
        } else {
            return sendError('Address Not Found');
        }
    }
}

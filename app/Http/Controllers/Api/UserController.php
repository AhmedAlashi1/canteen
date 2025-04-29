<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Functions;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use ImageTrait;
    public function show($user_id = null)
    {
        if ($user_id) {
            $user = User::findOrFail($user_id);
        } else {
            $user = Auth::user();
        }
        return  sendResponse( new UserResource($user));
    }
    public function update(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();
        $phone = $request->country_code . $request->phone;

        $userPhone = User::where('phone', $phone)->first();
        if ($userPhone && $userPhone->id != $user->id) {
            return sendError('This phone number is already registered');
        }

        if ($request->has('image')) {
            $image_path = $this->uploadImage('admin', $request->image);
            $data['image'] = $image_path;
        }
        $data['phone'] = $phone;
//        return $data;
        $user->update(array_filter($data));

        return sendResponse(new UserResource($user));
    }

}

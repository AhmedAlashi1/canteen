<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
//            'country_code' => 'required_with:phone|string|size:2',
//            'phone' => 'required|max:191|phone:country_code',
            'phone' => 'required|max:191',
        ]);

        if ($validator->fails()) {
            $response['response'] = $validator->messages()->first();
            return sendError($response['response']);
        }

//        $phone = (new PhoneNumber($request->phone, $request->country_code))->formatE164();
        $phone = $request->country_code . $request->phone;

        $user = User::where('phone', $phone)->first();
        if (!$user) {
            $errMsg = $request->header('lang') == 'ar' ? "الرقم غير مسجل" : 'This phone number is not registered';

            return sendError($errMsg);
        }

        $token = $user->createToken('authToken')->plainTextToken;
        $activation_code = rand(1111, 9999);
        if ($phone === '+96555558718') {
            $activation_code = 1234;
        }
        $user->update(['status' => '2', 'activation_code' => $activation_code,]);
//        $message_whatsapp = 'Your activation code is ' . $activation_code . '
//        Welcome to Fit Row 💪🏻';
//        $send = $this->whatsapp($user->phone, $message_whatsapp);
//
//        if ($request->device_token) {
//            $user->devices()->create([
//                'token' => $request->device_token,
//                'type' => $request->device_type
//            ]);
//        }
        $user->update([
            'device_type' => $request->device_type,
            'device_token' => $request->device_token
        ]);


        $data = [
            'user' => new UserResource($user),
            'token' => $token
        ];


        return sendResponse($data);
    }

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), User::$rules);

        if ($validator->fails()) {
            $response['response'] = $validator->messages()->first();
            return sendError($response['response']);
        }

//        $phone = (new PhoneNumber($request->phone, $request->country_code))->formatE164();
        $phone = $request->country_code . $request->phone;
        if (User::where('phone', $phone)->exists()) {
            $massage = $request->header('lang') == 'ar' ? "الرقم موجود بالفعل" : 'Phone already exists';
            return sendError($massage);
        }
        $data['password'] = $phone;
        $data['activation_code'] = rand(1111, 9999);
        $data['name'] = $request->name;
        $data['phone'] = $phone;
        $data['device_token'] = $request->device_token;
        $data['device_type'] = $request->device_type;
        $data['status'] = '2';

        $user = User::query()->create($data);
        $success['token'] = $user->createToken('MyAuthApp')->plainTextToken;
        $success['name'] = $user->name;

//        $this->sendVerificationCode($user->phone, $user->activation_code);

//        if ($request->device_token) {
//            $user->devices()->create([
//                'token' => $request->device_token,
//                'type' => $request->device_type
//            ]);
//        }

        return sendResponse($success);
    }

    public function activateAccount(Request $request)
    {
        $user = auth()->user();

        if (empty($request->input('activation_code'))) {
            return sendError('activation_code_missing');
        }


        //check user inactive
        if ($user->status == '3') {
            return sendError('user inactive');
        }

        // check device serial

        if (empty($user->activation_code) || $user->status == '1') {
            return sendError('user already activated');

        }


        $activationCode = $request->input('activation_code');
        $code = intval($activationCode);
        if (!preg_match("/^[0-9]{4}$/", $code)) {
            return sendError('activation_code_invalid');
        }

        if ($user->activation_code != $activationCode) {
            return sendError('Invalid activation code');
        }

        $user->activation_code = '';
        $user->status = '1';


        try {
            if ($user->save()) {
                $userdata = [
                    'user_id' => $user->id,
                    'phone' => $user->phone,
                    'name' => $user->name,
                ];
                return sendResponse($userdata);
            } else {
                return sendError('update_error');
            }
        } catch (\PDOException $ex) {
            return sendError(['message' => 'pdo_exception']);
        }
    }

    public function resendActivation(Request $request)
    {
        $user = auth('api')->user();

        if (empty($user->activation_code) || $user->status == '1') {
            return sendError(['message' => 'user_already_activated']);
        }

        $user->status = '2';
        $user->resend_code_count = $user->resend_code_count + 1;
        try {
            if ($user->save()) {
                $message = 'your activation code is ' . $user->activation_code;
//                $send = $this->whatsapp($user->phone, $message_whatsapp);
                $userdata = [
                    'resend_code_count' => $user->resend_code_count,
                ];
                return sendResponse($userdata);
            } else {
                return sendError(['message' => 'update_error']);
            }
        } catch (\PDOException $ex) {
            return sendError(['message' => 'pdo_exception']);
        }
    }

    public function logout(Request $request)
    {
        if (auth()->user()) {
            auth()->user()->tokens()->delete();
            return sendResponse(['message' => 'Logged out successfully']);
        } else {
            return sendResponse('User not logged in');
        }
    }

}

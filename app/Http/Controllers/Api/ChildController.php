<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChildResource;
use App\Models\Child;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ChildController extends Controller
{
    use ImageTrait;

    public function index()
    {
        $user = auth()->user();
        $children = Child::where('user_id', $user->id)->with('school')->get();

        return sendResponse(ChildResource::collection($children));
    }

    public function show($id)
    {
        $user = auth()->user();
        $child = Child::where('id', $id)->where('user_id', $user->id)->with('school')->first();
        if (!$child) {
            return sendError('Child not found');
        }
        return sendResponse(new ChildResource($child));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $validator = Validator::make($request->all(), Child::$rulesApi);
        if ($validator->fails()) {
            $response['response'] = $validator->messages()->first();
            return sendError($response['response']);
        }
        $data = $request->all();
        if ($request->has('image')) {
            $image_path = $this->uploadImage('admin', $request->image);
            $data['image'] = $image_path;
        }
        $data['user_id'] = $user->id;
        $data['status'] = 'pending_approval';

       Child::create($data);
        return sendResponse($data, 'Child Created Successfully');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), Child::$rulesApi);
        if ($validator->fails()) {
            $response['response'] = $validator->messages()->first();
            return sendError($response['response']);
        }
        $data = $request->all();
        if ($request->has('image')) {
            $image_path = $this->uploadImage('admin', $request->image);
            $data['image'] = $image_path;
        }
        $user = auth()->user();
        $child = Child::where('id', $id)->where('user_id', $user->id)->first();
        if (!$child) {
            return sendError('Child not found');
        }
        $child->update($data);

        return sendResponse($data, 'Child Updated Successfully');
    }

    public function destroy($id)
    {
        $user = auth()->user();
        $child = Child::where('id', $id)->where('user_id', $user->id)->first();
        if (!$child) {
            return sendError('Child not found');
        }
        $child->delete();

        return sendResponse($child, 'Child Deleted Successfully');
    }
}

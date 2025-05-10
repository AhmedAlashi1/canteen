<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AddressResource;
use App\Http\Resources\SchoolResource;
use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    //index
    public function index(){

        $schools = School::where('status', 1)->with('city','region')
            ->orderBy('id', 'desc')
            ->get();

        return sendResponse(SchoolResource::collection($schools));

    }
    //show
    public function show($id){

        $school = School::where('status', 1)->with('city','region')->find($id);
        if (!$school) {
            return sendError('School not found');
        }
        return sendResponse(new SchoolResource($school));
    }

}

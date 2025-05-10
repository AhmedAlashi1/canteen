<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SchoolsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSchoolRequest;
use App\Models\City;
use App\Models\Region;
use App\Models\School;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use ImageTrait;
    public function index(SchoolsDataTable $dataTable)
    {
        return $dataTable->render('dashboard.admin.schools.index');
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $cities = City::all();

        return view('dashboard.admin.schools.create',compact('cities'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSchoolRequest  $request)
    {
//        return $request->all();
        $data = $request->validated();
        $levels = $request->input('levels'); // سيأخذ القيم كـ array
        $data['levels'] = implode(',', $levels);

        if ($request->has('image')) {
            $image_path = $this->uploadImage('admin', $request->image);
            $data['image'] = $image_path;
        }

        School::create($data);

        return redirect()->route('admin.schools.index')->with('success', __('messages.created successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(School $school)
    {
        $cities = City::all();
        $regions = Region::where('city_id', $school->city_id)->get(); // فقط المناطق الخاصة بالمدينة الحالية
        return view('dashboard.admin.schools.edit', compact('school', 'cities', 'regions'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(StoreSchoolRequest $request, School $school)
    {
        $data = $request->validated();
        $levels = $request->input('levels'); // سيأخذ القيم كـ array
        $data['levels'] = implode(',', $levels);
        if ($request->has('image')) {
            $image_path = $this->uploadImage('admin', $request->image);
            $data['image'] = $image_path;
        }

        $school->update($data);

        return redirect()->route('admin.schools.index')->with('success', __('messages.updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(School $school)
    {

        if ($school->image) {
            Storage::disk('public')->delete($school->image);
        }
        $school->delete();
        return response()->json('success');
    }

    public function getByCity(Request $request)
    {
        $regions = Region::where('city_id', $request->city_id)->select('id', 'name_ar')->get();
        return response()->json($regions);
    }
    //select
    public function select(Request $request)
    {
        $q = $request->get('q');
        $schools = School::where('name_ar', 'like', '%' . $q . '%')
            ->orWhere('name_en', 'like', '%' . $q . '%')
            ->select('id', 'name_ar', 'name_en')
            ->limit(20)
            ->get();
        //map name_ar = name
        $schools = $schools->map(function ($school) {
            return [
                'id' => $school->id,
                'name' => $school->name_ar ,
            ];
        });

        return response()->json($schools);
    }

}

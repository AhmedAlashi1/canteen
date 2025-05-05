<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CitiesDataTable;
use App\DataTables\RegionDataTable;
use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index(RegionDataTable $dataTable , $id)
    {
        return $dataTable->render('dashboard.admin.region.index' ,compact('id'));
    }

    public function create($id)
    {
        return view('dashboard.admin.region.create',compact('id'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|exists:cities,id',
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);
        $data['city_id'] = $request->id;
         Region::create($data);

        return redirect()->route('admin.regions.index', ['id' => $data['city_id']])->with('success', 'Region created successfully');
    }

    public function show($id)
    {
        // Code to display a specific region
    }

    public function edit($id)
    {
        $region = Region::findOrFail($id);
        return view('dashboard.admin.region.edit', compact('region','id'));

    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);


        $region = Region::findOrFail($id);
        $region->update($data);

        return redirect()->route('admin.regions.index', ['id' => $region->city_id])->with('success', 'Region updated successfully');
    }

    public function destroy($id)
    {
        $region = Region::findOrFail($id);
        $region->delete();
        return response()->json('success');

    }
}

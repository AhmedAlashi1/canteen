<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CitiesRequest;
use App\Http\Requests\StoreSchoolRequest;
use App\Models\City;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use App\DataTables\CitiesDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;


class CityController extends Controller
{
    use ImageTrait;

    public function index(CitiesDataTable $dataTable)
    {
        return $dataTable->render('dashboard.admin.cities.index');
    }

    public function create()
    {
        return view('dashboard.admin.cities.create');
    }

    public function store(CitiesRequest $request)
    {

        $data = $request->validated();
        if ($request->has('image')) {
            $image_path = $this->uploadImage('admin', $request->image);
            $data['image'] = $image_path;
        }
        City::create($data);

        return redirect()->route('admin.cities.index')->with('success', 'City created successfully');
    }

    public function edit(City $city)
    {
        return view('dashboard.admin.cities.edit', compact('city'));
    }

    public function update(CitiesRequest $request, City $city)
    {
        $data = $request->validated();
        if ($request->has('image')) {
            $image_path = $this->uploadImage('admin', $request->image);
            $data['image'] = $image_path;
        }
        $city->update($data);

        return redirect()->route('admin.cities.index')->with('success', 'City updated successfully');
    }

    public function destroy(City $city)
    {
        if ($city->image) {
            Storage::disk('public')->delete($city->image);
        }
        $city->delete();
        return response()->json('success');
    }
}

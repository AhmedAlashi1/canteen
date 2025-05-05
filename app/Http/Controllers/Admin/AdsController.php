<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AdsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\City;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdsController extends Controller
{
    use ImageTrait;

    public function index(AdsDataTable $dataTable)
    {
        return $dataTable->render('dashboard.admin.ads.index');
    }


    public function create()
    {
        return view('dashboard.admin.ads.create');
    }

    public function store(Request $request)
    {
        // Validate and store the ad
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'required|url',
        ]);
        // Handle the image upload
        if ($request->has('image')) {
            $image_path = $this->uploadImage('admin', $request->image);
            $data['image'] = $image_path;
        }
        Ad::create($data);
        // Store the ad
        return redirect()->route('admin.ads.index')->with('success', 'Ad created successfully.');
    }

    public function edit($id)
    {
        $ads = Ad::findOrFail($id);
        return view('dashboard.admin.ads.edit', compact('id','ads'));
    }

    public function update(Request $request, $id)
    {
        // Validate and update the ad
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'required|url',
        ]);
        if ($request->has('image')) {
            $image_path = $this->uploadImage('admin', $request->image);
            $data['image'] = $image_path;
        }
        Ad::where('id', $id)->update($data);
        return redirect()->route('admin.ads.index')->with('success', 'Ad updated successfully.');
    }

    public function destroy(Ad $ad)
    {
        // Delete the ad
        if ($ad->image) {
            Storage::disk('public')->delete($ad->image);
        }
        $ad->delete();
        return response()->json('success');
    }
}

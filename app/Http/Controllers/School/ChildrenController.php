<?php

namespace App\Http\Controllers\School;

use App\DataTables\ChildrenDataTable;
use App\DataTables\UsersDataTable;
use App\Http\Controllers\Controller;
use App\Models\Child;
use Illuminate\Http\Request;

class ChildrenController extends Controller
{
    //index
    public function index(ChildrenDataTable $dataTable)
    {
        return $dataTable->render('dashboard.school.children.index');
    }
    //edit
    public function edit($id)
    {
        $child = Child::findOrFail($id);
        return view('dashboard.school.children.edit', compact('child'));
    }
    //update
    public function update(Request $request, $id)
    {

        $child = Child::findOrFail($id);
        $child->update($request->all());
        session()->flash('success', __('messages.updated successfully.'));
        return redirect()->route('school.children.index');
    }
    //destroy
    public function destroy($id)
    {
        $child = Child::findOrFail($id);
        $child->delete();
        return response()->json('success');
    }

}

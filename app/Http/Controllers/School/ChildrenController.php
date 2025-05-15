<?php

namespace App\Http\Controllers\School;

use App\DataTables\ChildrenDataTable;
use App\DataTables\UsersDataTable;
use App\Http\Controllers\Controller;
use App\Models\Child;
use Carbon\Carbon;
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

    public function searchPage()
    {
        return view('dashboard.school.children.search');
    }
    public function search(Request $request)
    {
        $child = null;

        if ($request->has('student_number')) {
            $today = Carbon::today()->toDateString();


            $child = Child::where('student_number', $request->student_number)
                ->where('school_id', auth()->user()->id)
                ->with(['orders' => function ($query) {
                    $query->where('payment_status', 'paid')
                        ->with(['orderDays' => function ($q) {
                            $q->where('date', now()->toDateString());
                        }
                        ,'orderProducts' => function ($q) {
                            $q->with(['product' => function ($q) {
                                $q->select('id', 'name_en', 'name_ar', 'image');
                            }]);
                        }
                        ]);
                },'level'
                ])
                ->first();
//            return $child;
        }

        return view('dashboard.school.children.search', compact('child'));
//        return view('dashboard.students.search', compact('child'));
    }
    public function searchByNumber(Request $request)
    {
        $request->validate([
            'student_number' => 'required|string',
        ]);

//        $child = Child::where('student_number', $request->student_number)->first();
        $today = Carbon::today()->toDateString();

        $child = Child::where('student_number', $request->student_number)
            ->with(['orders.orderDays' => function ($q) use ($today) {
                $q->where('date', $today);
            }])
            ->first();
//        if (!$child) {
//            return back()->with('error', 'الطالب غير موجود');
//        }
//
//        // مثال: الحصول على الطلبات من جدول orders إن وجدت علاقة
//        $todayOrders = $child->orders()
//            ->whereDate('created_at', Carbon::today())
//            ->get();

        return view('dashboard.school.children.search', compact('child'));
    }

}

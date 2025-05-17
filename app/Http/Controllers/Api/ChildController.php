<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChildResource;
use App\Models\Child;
use App\Models\Order;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;


class ChildController extends Controller
{
    use ImageTrait;

    public function index()
    {
        $user = auth()->user();

//        $weekdays =
//            [
//                "2025-05-18",
//                "2025-05-19",
//                "2025-05-20",
//                "2025-05-21",
//                "2025-05-22"
//            ];
        $weekdays = $this->weekdays();

        $children = Child::where('user_id', $user->id)->with('school')->get();

        $orders = Order::whereIn('child_id', $children->pluck('id'))
            ->where('payment_status', 'paid')
            ->with(['orderDays', 'orderProducts']) // نحتاج products فقط من الطلب
            ->whereHas('orderDays', function ($query) use ($weekdays) {
                $query->whereIn('date', $weekdays);
            })
            ->get();
        $orderDaysCountPerChild = $orders->groupBy('child_id')->map(function ($orders) {
            return $orders->sum(function ($order) {
                return $order->orderDays->count();
            });
        });
        // دمج النتائج مع الأطفال
        foreach ($children as $child) {
            $child->total_order_days = $orderDaysCountPerChild[$child->id] ?? 0;
        }
        //عرض تفاصيل الايام
        $ordersPerChild = $orders->groupBy('child_id')->map(function ($orders) {
            return $orders->map(function ($order) {
                return [
                    'id' => $order->id,
                    'days_count' => $order->orderDays->count(),
                    'total_cost' => $order->total,
                    'products_count' => $order->orderProducts->count(),
                    'created_at' => $order->created_at->diffForHumans(), // <-- هنا
                ];
            });
        });

        foreach ($children as $child) {
            $child->orders = $ordersPerChild[$child->id] ?? collect();
        }


        return sendResponse(ChildResource::collection($children));
    }

    public function show($id)
    {
        $user = auth()->user();
        $child = Child::where('id', $id)->where('user_id', $user->id)->with('school')->first();
        if (!$child) {
            return sendError('Child not found');
        }
//        $weekdays =
//            [
//                "2025-05-18",
//                "2025-05-19",
//                "2025-05-20",
//                "2025-05-21",
//                "2025-05-22"
//            ];
        $weekdays = $this->weekdays();
        $orders = Order::where('child_id', $child->id)
            ->where('payment_status', 'paid')
            ->with(['orderDays', 'orderProducts']) // نحتاج products فقط من الطلب
            ->whereHas('orderDays', function ($query) use ($weekdays) {
                $query->whereIn('date', $weekdays);
            })
            ->get();
        $orderDaysCountPerChild = $orders->groupBy('child_id')->map(function ($orders) {
            return $orders->sum(function ($order) {
                return $order->orderDays->count();
            });
        });
        // دمج النتائج مع الأطفال
        $child->total_order_days = $orderDaysCountPerChild[$child->id] ?? 0;

        //عرض تفاصيل الايام
        $ordersPerChild = $orders->groupBy('child_id')->map(function ($orders) {
            return $orders->map(function ($order) {
                return [
                    'id' => $order->id,
                    'days_count' => $order->orderDays->count(),
                    'total_cost' => $order->total,
                    'products_count' => $order->orderProducts->count(),
                    'created_at' => $order->created_at->diffForHumans(), // <-- هنا
                ];
            });
        });
        $child->orders = $ordersPerChild[$child->id] ?? collect();


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
    //weekdays

    public function weekdays()
    {
        $today = Carbon::today();
        $startOfWeek = $today->copy()->startOfWeek(Carbon::SUNDAY);
        $weekdays = collect();
        for ($i = 0; $i <= 4; $i++) {
            $weekdays->push($startOfWeek->copy()->addDays($i)->toDateString());
        }
        return $weekdays;
    }
}

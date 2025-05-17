<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrdersSchoolsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $name = $request->header('lang') == 'ar' ? 'name_ar' : 'name_en';
        return [
            'id' => $this->id,
            'total_order_days' => $this->orderDays->count(),
            'total_cost' => $this->total,
            'created_at' => $this->created_at->diffForHumans(),
            'status' => $this->status,
            'payment_status' => $this->payment_status,
            'products_count' => $this->orderProducts->count(),
            'days_count' => $this->orderDays->count(),
            'discount' => $this->discount,
            'child' => [
                'id' => $this->child->id,
                'name' => $this->child->name,
                'level' => $this->child->level_name,
                'level_id' => $this->child->level_id,
                'student_number' => $this->child->student_number,
                'image' => url($this->child->image),
                'school_name' => $this->child->school?->$name,
            ],
            'products' => $this->orderProducts->map(function ($product) use ($name) {
                return [
                    'id' => $product->id,
                    'name' => $product->product->$name,
                    'image' => url($product->product->image),
                    'quantity' => $product->quantity,
                    'price' => $product->price,
                ];
            }),
            'orderDays' => $this->orderDays->map(function ($orderDay) {
                return [
                    'id' => $orderDay->id,
                    'date' => $orderDay->date,
                    'day_name' => Carbon::parse($orderDay->date)->translatedFormat('l'),
                ];
            }),
            'payment_method' => [
                'id' => $this->payment->id,
                'name' => $this->payment->$name,
                'image' => url($this->payment->image),
            ],




        ];
    }
}

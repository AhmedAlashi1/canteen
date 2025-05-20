<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrdersStoreResource extends JsonResource
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
            'total_cost' => $this->total,
            'created_at' => $this->created_at->diffForHumans(),
            'payment_status' => $this->payment_status,
            'status' => $this->status,
            'products_count' => $this->orderProducts->count(),
            'discount' => $this->discount,
            'shipping_fees' => $this->shipping_fees,

            'products' => $this->orderProducts->map(function ($product) use ($name) {
                return [
                    'id' => $product->id,
                    'name' => $product->product->$name,
                    'image' => url($product->product->image),
                    'quantity' => $product->quantity,
                    'price' => $product->price,
                    'size' => $product->size->size ?? null,
                ];
            }),
            'address' => [
                'city' => $this->address->city->$name,
                'region' => $this->address->region->$name,
            ],
            'payment_method' => [
                'id' => $this->payment->id,
                'name' => $this->payment->$name,
                'image' => url($this->payment->image),
            ],


        ];
    }
}

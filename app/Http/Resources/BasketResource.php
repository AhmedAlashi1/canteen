<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BasketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
//        $name = $request->header('lang') == 'ar' ? 'name_ar' : 'name_en';
//        $description = $request->header('lang') == 'ar' ? 'description_ar' : 'description_en';
//        //favorite
//        $favorite = $this->favorites()->where('user_id', auth()->user()->id)->first();
//        if (auth()->user()) {
//
//        }
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'type' => $this->type,
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'product_size_id' => $this->product_size_id,
            'product' => new ProductResource($this->whenLoaded('product')),
            'product_size' => $this->whenLoaded('productSize'),

        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $name = $request->header('lang') == 'ar' ? 'name_ar' : 'name_en';
        $description = $request->header('lang') == 'ar' ? 'description_ar' : 'description_en';
        //favorite
        $favorite = $this->favorites()->where('user_id', auth()->user()->id)->first();
        if (auth()->user()) {

        }
        return [
            'id' => $this->id,
            'cat_id' => $this->cat_id,
            'category' => $this->category ? $this->category->$name : null,
            'name' => $this->$name,
            //image
            'image' => $this->image ? url($this->image) : null,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'description' => $this->$description,
            'sizes' => $this->sizes ? $this->sizes : null,
            'images' => $this->images ? $this->images->map(function ($image) {
                return url($image->image);
            }) : null,
            'is_favorite' => $favorite ? true : false,



        ];
    }
}

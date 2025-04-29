<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SchoolProductResource extends JsonResource
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
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'school_id' => $this->school_id,
            'cat_id' => $this->product->cat_id,
            'category' => $this->product->category ? $this->product->category->$name : null,
            'name' => $this->product->$name,
            'image' => $this->product->image ? url($this->product->image) : null,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'description' => $this->product->$description,

        ];
    }
}

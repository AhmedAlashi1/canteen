<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            'location' => $this->location,
            'city' => $this->city->$name ?? ' ',
            'region' => $this->region->$name ?? ' ',
            'block' => $this->block,
            'street_name' => $this->street_name,
            'building_no' => $this->building_no,
            'is_default' => $this->is_default,

        ];
    }
}

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
            'city_id' => $this->city_id,
            'region_id' => $this->region_id,
            'city' => $this->city->$name ?? ' ',
            'region' => $this->region->$name ?? ' ',
            'block' => $this->block,
            'street_name' => $this->street_name,
            'building_no' => $this->building_no,
            'is_default' => $this->is_default,
            'title' => $this->title,
            'lat' => $this->lat,
            'lng' => $this->lng,

        ];
    }
}

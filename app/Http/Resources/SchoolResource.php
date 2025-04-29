<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SchoolResource extends JsonResource
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
          'name' => $this->$name,
          'description' => $this->$description,
          'image' => url( $this->image),
           'city' => $this->city->$name,
          'region' => $this->region->$name,
          'address' => $this->address,
          'levels' => $this->levels,
          'phone1' => $this->phone1,
          'phone2' => $this->phone2,
          'email' => $this->email,
          'location' => $this->location,

      ];
    }
}

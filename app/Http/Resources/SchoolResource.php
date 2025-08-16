<?php

namespace App\Http\Resources;

use App\Models\Level;
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
        //levels to array
        $levelIds = explode(',', $this->levels); // مثال: "1,2" => [1,2]
        $levels = Level::whereIn('id', $levelIds)->pluck($name)->toArray(); // أسماء المستويات حسب اللغة
        $levelsString = implode(', ', $levels);
      return [
          'id' => $this->id,
          'name' => $this->$name,
          'description' => $this->$description,
          'image' => url( $this->image),
           'city' => $this->city->$name,
          'region' => $this->region->$name,
          'address' => $this->address,
          'levels_name' => $levelsString,
          'levels' => $this->levels,
          'phone1' => $this->phone1,
          'phone2' => $this->phone2,
          'email' => $this->email,
          'location' => $this->location,
          'website_url' => $this->website_url,
          'instagram_url' => $this->instagram_url,

      ];
    }
}

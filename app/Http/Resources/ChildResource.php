<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChildResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'level' => $this->level,
            'student_number' => $this->student_number,
            'image' => url($this->image),
            'status' => $this->status,
            'school' => new SchoolResource($this->whenLoaded('school')),
            'user' => new UserResource($this->whenLoaded('user')),


        ];
    }
}

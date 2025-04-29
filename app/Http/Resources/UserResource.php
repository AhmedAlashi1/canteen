<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'phone' => $this->phone,
            'email' => $this->email,
            'image' => $this->image ? url($this->image) : null,
            'address' => $this->address,
            'device_type' => $this->device_type,
            'activation_code' => $this->activation_code,
            'resend_code_count' => $this->resend_code_count,
            'status' => $this->status == 1 ? 'active' : ($this->status == '2' ? 'pending activation':'inactive') ,

        ];
    }
}

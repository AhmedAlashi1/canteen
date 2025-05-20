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
            'phone_all'=> $this->phone,
            'phone' => $this->phone_not_code,
            'country_code' => $this->country_code,
            'email' => $this->email,
            'image' => $this->image ? url($this->image) : null,
            'address' => $this->address,
            'device_type' => $this->device_type,
            'notification_switch' => $this->notification_switch ? true : false,
//            'activation_code' => $this->activation_code,
            'resend_code_count' => $this->resend_code_count,
            'status' => $this->status == 1 ? 'active' : ($this->status == '2' ? 'pending activation':'inactive') ,

        ];
    }
}

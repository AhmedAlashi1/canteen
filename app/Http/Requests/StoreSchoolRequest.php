<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSchoolRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'address' => 'nullable|string',
            'levels' => 'nullable',
            'phone1' => 'nullable|string|max:20',
            'phone2' => 'nullable|string|max:20',
            //edit email unique
            'email' => 'nullable|email|max:255|unique:schools,email,' . $this->school->id,
            'location' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean',
            'city_id' => 'required|exists:cities,id',
            'region_id' => 'required|exists:regions,id',
        ];
    }
}

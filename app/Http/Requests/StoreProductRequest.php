<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'cat_id' => 'required|exists:categories,id',
            'status' => 'required|in:active,inactive',
            'type' => 'required|in:school,store',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png',
            'price' => 'nullable|numeric',
            'quantity' => 'nullable|integer',
            'school_id' => 'nullable|exists:schools,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'sizes' => 'nullable|array',
            'sizes.*.name' => 'nullable|string|max:100',
            'sizes.*.price' => 'nullable|numeric',
        ];
    }
}

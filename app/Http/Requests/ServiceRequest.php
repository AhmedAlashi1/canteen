<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'desc' => 'required|string|min:10',
            'desc_ar' => 'required|string|min:10',
            'is_home' => 'nullable',
            'is_home_work' => 'nullable',
            'title_ar' => 'nullable',
            'title_en' => 'nullable',
            'content_ar' => 'nullable',
            'content_en' => 'nullable',
        ];

        if ($this->route()->getName() === 'services.update') {
            $rules['photo'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        } else {
            $rules['photo'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }

    }

    public function messages()
    {
        return [
            'required' => trans('validation.required', ['attribute' => trans('validation.attributes.photo')]),
            'photo.image' => trans('validation.image', ['attribute' => trans('validation.attributes.photo')]),
            'photo.mimes' => trans('validation.mimes', ['attribute' => trans('validation.attributes.photo')]),
            'photo.max' => trans('validation.max', ['attribute' => trans('validation.attributes.photo'), 'max' => 2]),
        ];
    }

}

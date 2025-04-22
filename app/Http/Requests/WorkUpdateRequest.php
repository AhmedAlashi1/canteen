<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkUpdateRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'status' => 'required|in:0,1',
            'is_contact_us' => 'required|in:0,1',
            'service_id' => 'required|exists:services,id',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => trans('validation.required', ['attribute' => trans('validation.attributes.title')]),
            'title.string' => trans('validation.string', ['attribute' => trans('validation.attributes.title')]),
            'title.max' => trans('validation.max', ['attribute' => trans('validation.attributes.title'), 'max' => 255]),
            'title.unique' => trans('validation.unique', ['attribute' => trans('validation.attributes.title')]),

            'title_ar.required' => trans('validation.required', ['attribute' => trans('validation.attributes.title_ar')]),
            'title_ar.string' => trans('validation.string', ['attribute' => trans('validation.attributes.title_ar')]),
            'title_ar.max' => trans('validation.max', ['attribute' => trans('validation.attributes.title_ar'), 'max' => 255]),
            'title_ar.unique' => trans('validation.unique', ['attribute' => trans('validation.attributes.title_ar')]),

            'status.required' => trans('validation.required', ['attribute' => trans('validation.attributes.status')]),
            'status.in' => trans('validation.in', ['attribute' => trans('validation.attributes.status'), 'values' => '0, 1']),

            'is_contact_us.required' => trans('validation.required', ['attribute' => trans('validation.attributes.is_contact_us')]),
            'is_contact_us.in' => trans('validation.in', ['attribute' => trans('validation.attributes.is_contact_us'), 'values' => '0, 1']),

            'service_id.required' => trans('validation.required', ['attribute' => trans('validation.attributes.service_id')]),
            'service_id.exists' => trans('validation.exists', ['attribute' => trans('validation.attributes.service_id')]),

            'photos.*.image' => trans('validation.image', ['attribute' => trans('validation.attributes.photos')]),
            'photos.*.mimes' => trans('validation.mimes', ['attribute' => trans('validation.attributes.photos'), 'values' => 'jpeg, png, jpg, svg, gif']),
            'photos.*.max' => trans('validation.max', ['attribute' => trans('validation.attributes.photos'), 'max' => 2]),
            'photos.required' => trans('validation.required', ['attribute' => trans('validation.attributes.photos')]),
        ];
    }

}

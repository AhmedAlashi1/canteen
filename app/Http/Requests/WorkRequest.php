<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Change to false if you want to restrict access
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255|unique:works,title_en,' . $this->id,
            'title_ar' => 'required|string|max:255|unique:works,title_ar,' . $this->id,
            'status' => 'required|in:0,1',
            'is_contact_us' => 'required|in:0,1',
            'service_id' => 'required|exists:services,id',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'photos' => 'required',
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

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogUpdateRequest extends FormRequest
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
            'title' => 'required|string|max:255|min:4',
            'title_ar' => 'required|string|max:255|min:4',
            'desc' => 'nullable|string|min:10',
            'desc_ar' => 'nullable|string|min:10',
            'date' => 'required|date',
            'by' => 'required|string|max:255',
            'blog_type_id' => 'required|exists:blog__types,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => trans('validation.required', ['attribute' => trans('validation.attributes.title')]),
            'title.string' => trans('validation.string', ['attribute' => trans('validation.attributes.title')]),
            'title.max' => trans('validation.max', ['attribute' => trans('validation.attributes.title'), 'max' => 255]),
            'title.min' => trans('validation.min', ['attribute' => trans('validation.attributes.title'), 'min' => 4]),

            'desc.string' => trans('validation.string', ['attribute' => trans('validation.attributes.desc')]),
            'desc.min' => trans('validation.min', ['attribute' => trans('validation.attributes.desc'), 'min' => 10]),

            'title_ar.required' => trans('validation.required', ['attribute' => trans('validation.attributes.title_ar')]),
            'title_ar.string' => trans('validation.string', ['attribute' => trans('validation.attributes.title_ar')]),
            'title_ar.max' => trans('validation.max', ['attribute' => trans('validation.attributes.title_ar'), 'max' => 255]),
            'title_ar.min' => trans('validation.min', ['attribute' => trans('validation.attributes.title_ar'), 'min' => 4]),

            'desc_ar.string' => trans('validation.string', ['attribute' => trans('validation.attributes.desc_ar')]),
            'desc_ar.min' => trans('validation.min', ['attribute' => trans('validation.attributes.desc_ar'), 'min' => 10]),

            'date.required' => trans('validation.required', ['attribute' => trans('validation.attributes.date')]),
            'date.date' => trans('validation.date', ['attribute' => trans('validation.attributes.date')]),

            'by.required' => trans('validation.required', ['attribute' => trans('validation.attributes.by')]),
            'by.string' => trans('validation.string', ['attribute' => trans('validation.attributes.by')]),
            'by.max' => trans('validation.max', ['attribute' => trans('validation.attributes.by'), 'max' => 255]),

            'blog_type_id.required' => trans('validation.required', ['attribute' => trans('validation.attributes.blog_type_id')]),
            'blog_type_id.exists' => trans('validation.exists', ['attribute' => trans('validation.attributes.blog_type_id')]),

            'photo.image' => trans('validation.image', ['attribute' => trans('validation.attributes.photo')]),
            'photo.mimes' => trans('validation.mimes', ['attribute' => trans('validation.attributes.photo')]),
            'photo.max' => trans('validation.max', ['attribute' => trans('validation.attributes.photo'), 'max' => 2]),
            'photo.required' => trans('validation.required', ['attribute' => trans('validation.attributes.photo')]),
        ];
    }

}

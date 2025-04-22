<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
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
    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'job_name' => 'required|string|max:255',
            'job_name_ar' => 'required|string|max:255',
        ];
    
        if ($this->route()->getName() === 'member.update') {
            $rules['photo'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        } else {
            $rules['photo'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }
    
        return $rules;
    }

    public function messages()
    {
        return [
            'photo.required' => trans('validation.required', ['attribute' => trans('validation.attributes.photo')]),
            'name.required' => trans('validation.required', ['attribute' => trans('validation.attributes.name')]),
            'name_ar.required' => trans('validation.required', ['attribute' => trans('validation.attributes.name_ar')]),
            'job_name.required' => trans('validation.required', ['attribute' => trans('validation.attributes.job_name')]),
            'job_name_ar.required' => trans('validation.required', ['attribute' => trans('validation.attributes.job_name_ar')]),

            'photo.image' => trans('validation.image', ['attribute' => trans('validation.attributes.photo')]),
            'photo.mimes' => trans('validation.mimes', ['attribute' => trans('validation.attributes.photo')]),
            'photo.max' => trans('validation.max', ['attribute' => trans('validation.attributes.photo'), 'max' => 2]),
        ];
    }

}

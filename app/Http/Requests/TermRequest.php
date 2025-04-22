<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TermRequest extends FormRequest
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
        $rules = [
            'desc' => 'required|string|min:20|max:1000' ,
            'desc_ar' => 'required|string|min:20|max:1000' ,
            'service_name' => 'required|string',
//            'service_name_ar' => 'required|string',

        ];

        if (!empty($this->new_service_name)) {
            $rules['service_name'] = 'nullable|string';
//            $rules['service_name_ar'] = 'nullable|string';
            $rules['new_service_name'] = 'required|string|unique:terms,service_name_en|min:4';
        }

        return $rules;
    }


    public function messages()
    {
        return [
            'desc.required' => trans('validation.required', ['attribute' => trans('validation.attributes.desc')]),
            'desc.string' => trans('validation.string', ['attribute' => trans('validation.attributes.desc')]),
            'desc.min' => trans('validation.min', ['attribute' => trans('validation.attributes.desc'), 'min' => 20]),
            'desc.max' => trans('validation.max', ['attribute' => trans('validation.attributes.desc'), 'max' => 1000]),
            'desc.unique' => trans('validation.unique', ['attribute' => trans('validation.attributes.desc')]),

            'service_name.required' => trans('validation.required', ['attribute' => trans('validation.attributes.service_name')]),

            'desc_ar.required' => trans('validation.required', ['attribute' => trans('validation.attributes.desc_ar')]),
            'desc_ar.string' => trans('validation.string', ['attribute' => trans('validation.attributes.desc_ar')]),
            'desc_ar.min' => trans('validation.min', ['attribute' => trans('validation.attributes.desc_ar'), 'min' => 20]),
            'desc_ar.max' => trans('validation.max', ['attribute' => trans('validation.attributes.desc_ar'), 'max' => 1000]),
            'desc_ar.unique' => trans('validation.unique', ['attribute' => trans('validation.attributes.desc_ar')]),

            'service_name_ar.required' => trans('validation.required', ['attribute' => trans('validation.attributes.service_name_ar')]),

            'new_service_name.string' => trans('validation.string', ['attribute' => trans('validation.attributes.new_service_name')]),
            'new_service_name.unique' => trans('validation.unique', ['attribute' => trans('validation.attributes.new_service_name')]),
            'new_service_name.min' => trans('validation.min', ['attribute' => trans('validation.attributes.new_service_name'), 'min' => 4]),
        ];
    }


}

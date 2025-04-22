<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first-name' => 'required|string|max:255',
            'last-name' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
            'phone' => 'required|string|regex:/^\+?[0-9]{7,15}$/',
            'email' => 'required|email|max:255',
            'service' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'first-name.required' => trans('validation.required', ['attribute' => trans('validation.attributes.first_name')]),
            'first-name.string' => trans('validation.string', ['attribute' => trans('validation.attributes.first_name')]),
            'first-name.max' => trans('validation.max', ['attribute' => trans('validation.attributes.first_name'), 'max' => 255]),
            'first-name.min' => trans('validation.min', ['attribute' => trans('validation.attributes.first_name'), 'min' => 3]),

            'last-name.required' => trans('validation.required', ['attribute' => trans('validation.attributes.last_name')]),
            'last-name.string' => trans('validation.string', ['attribute' => trans('validation.attributes.last_name')]),
            'last-name.max' => trans('validation.max', ['attribute' => trans('validation.attributes.last_name'), 'max' => 255]),
            'last-name.min' => trans('validation.min', ['attribute' => trans('validation.attributes.last_name'), 'min' => 3]),

            'message.required' => trans('validation.required', ['attribute' => trans('validation.attributes.message')]),
            'message.string' => trans('validation.string', ['attribute' => trans('validation.attributes.message')]),
            'message.min' => trans('validation.min', ['attribute' => trans('validation.attributes.message'), 'min' => 10]),
            'message.max' => trans('validation.max', ['attribute' => trans('validation.attributes.message'), 'max' => 1000]),

            'phone.required' => trans('validation.required', ['attribute' => trans('validation.attributes.phone')]),
            'phone.string' => trans('validation.string', ['attribute' => trans('validation.attributes.phone')]),
            'phone.regex' => trans('validation.regex', ['attribute' => trans('validation.attributes.phone')]),

            'email.required' => trans('validation.required', ['attribute' => trans('validation.attributes.email')]),
            'email.email' => trans('validation.email'),
            'email.max' => trans('validation.max', ['attribute' => trans('validation.attributes.email'), 'max' => 255]),

//            'service_id.required' => trans('validation.required', ['attribute' => trans('validation.attributes.service_id')]),
//            'service_id.exists' => trans('validation.exists', ['attribute' => trans('validation.attributes.service_id')]),
        ];
    }

}

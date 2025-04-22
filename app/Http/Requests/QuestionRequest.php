<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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
        return [
            'answer' => 'required|string|max:255',
            'answer_ar' => 'required|string|max:255',
            'question' => 'required|string|max:255',
            'question_ar' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'answer.required' => trans('validation.required', ['attribute' => trans('validation.attributes.answer')]),
            'answer_ar.required' => trans('validation.required', ['attribute' => trans('validation.attributes.answer_ar')]),
            'question.required' => trans('validation.required', ['attribute' => trans('validation.attributes.question')]),
            'question_ar.required' => trans('validation.required', ['attribute' => trans('validation.attributes.question_ar')]),
        ];
    }

}

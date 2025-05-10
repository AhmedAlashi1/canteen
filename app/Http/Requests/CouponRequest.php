<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
            'code' => 'required|string|max:255',
            'discount' => 'required|numeric|min:0',
            'end_at' => 'required|date',
            'use_number' => 'required|integer|min:1',
            'code_limit' => 'nullable|integer|min:1', // يفضل ضبط التحقق إذا كان رقماً
            'type' => 'required|in:percentage,fixed', // تم التعديل من amount إلى fixed
            'status' => 'required|in:active,inactive', // إذا كانت enum في الجدول وليس boolean


        ];
    }
}

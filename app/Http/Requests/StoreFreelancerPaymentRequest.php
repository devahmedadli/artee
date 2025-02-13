<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFreelancerPaymentRequest extends FormRequest
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
            'freelancer_id' => 'required|exists:users,id',
            'amount'        => 'required|numeric|min:0',
            'method'        => 'required|string',
            'details'       => 'nullable|string',
            'date'          => 'required|date',
        ];
    }

    public function messages(): array
    {
        return [
            'freelancer_id.required' => 'يجب اختيار المستخدم',
            'freelancer_id.exists'   => 'المستخدم غير موجود',
            'amount.required'        => 'يجب ادخال المبلغ',
            'amount.numeric'         => 'يجب ادخال المبلغ بشكل صحيح',
            'amount.min'             => 'يجب ادخال المبلغ بشكل صحيح',
        ];
    }
}

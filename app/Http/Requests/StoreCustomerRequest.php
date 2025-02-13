<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:customers,email',
            'phone'    => 'nullable|string|max:20',
            'lang'     => 'required|in:ar,en',
            'password' => 'required|string|min:6',
            'address'  => 'nullable|string',
            'company'  => 'nullable|string|max:255',
        ];
    }

    /**
     * Customize the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'     => 'الاسم مطلوب.',
            'email.required'    => 'البريد الالكتروني مطلوب.',
            'email.email'       => 'البريد الالكتروني غير صحيح.',
            'email.unique'      => 'البريد الالكتروني موجود مسبقاً.',
            'phone.max'         => 'رقم الهاتف يجب ألا يتجاوز 20 حرفاً.',
            'lang.required'     => 'اللغة مطلوبة.',
            'password.required' => 'كلمة المرور مطلوبة.',
            'password.min'      => 'كلمة المرور يجب أن تكون على الأقل 6 أحرف.',
            'address.string'    => 'العنوان يجب أن يكون نصاً.',
            'company.max'       => 'اسم الشركة يجب ألا يتجاوز 255 حرفاً.',
        ];
    }
}

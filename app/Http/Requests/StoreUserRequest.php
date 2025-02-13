<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'password'  => 'required|string|min:8',
            'phone'     => 'required|regex:/^([0-9\s\+\-\(\)]*)$/|min:10|max:15',

        ];
    }

    // Arabic messages
    public function messages(): array
    {
        return [
            'name.required'     => 'الاسم مطلوب',
            'name.string'       => 'الاسم يجب ان يكون نص',
            'name.max'          => 'الاسم يجب ان لا يتعدى 255 حرف',
            'email.required'    => 'البريد الالكتروني مطلوب',
            'email.string'      => 'البريد الالكتروني يجب ان يكون نص',
            'email.email'       => 'البريد الالكتروني يجب ان يكون بر',
            'email.max'         => 'البريد الالكتروني يجب ان لا يت',
            'email.unique'      => 'البريد الالكتروني مستخدم',
            'password.required' => 'كلمة المرور مطلوبة',
            'password.string'   => 'كلمة المرور يجب ان تكون نص',
            'password.min'      => 'كلمة المرور يجب ان لا تقل عن 8',
            'phone.required'    => 'رقم الهاتف مطلوب',
            'phone.regex'       => 'رقم الهاتف يجب ان يكون رقم',
            'phone.min'         => 'رقم الهاتف يجب ان لا يقل عن 10',
            'phone.max'         => 'رقم الهاتف يجب ان لا يتعدى 15',

        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterCustomerRequest extends FormRequest
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
            'name'              => 'required|string|max:255',
            'username'          => 'required|string|max:255|unique:users,username',
            'email'             => 'required|email|unique:users,email',
            'password'          => 'required|string|min:8|confirmed',
            'terms_conditions'  => 'required|accepted',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required'     => __('Name is required'),
            'username.required' => __('Username is required'),
            'email.required'    => __('Email is required'),
            'password.required' => __('Password is required'),
            'password.confirmed' => __('Password confirmation is required'),
        ];
    }
}

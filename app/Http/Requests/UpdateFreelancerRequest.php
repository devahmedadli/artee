<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFreelancerRequest extends FormRequest
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
            'name'          => 'required|string|max:255',
            'email'         => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($this->freelancer->id),
            ],
            'password'      => 'nullable|string|min:8',
            'phone'         => 'nullable|string|max:20',
            'bio'           => 'nullable|string',
            'country'       => 'nullable|string|max:255',
            'website'       => 'nullable|url|max:255',
            'specification' => 'nullable|string|max:255',
            'skills'        => 'nullable|string',

        ];
    }

    public function messages(): array
    {
        return [
            'email.unique'      => __('The email has already been taken.'),
            'name.required'     => __('The name field is required.'),
            'name.string'       => __('The name field must be a string.'),
            'name.max'          => __('The name field must be less than :max characters.'),
            'email.required'    => __('The email field is required.'),
            'email.string'      => __('The email field must be a string.'),
            'email.email'       => __('The email field must be a valid email address.'),
            'email.max'         => __('The email field must be less than :max characters.'),
            'password.required' => __('The password field is required.'),
            'password.string'   => __('The password field must be a string.'),
            'password.min'      => __('The password field must be at least :min characters.'),
            'phone.string'      => __('The phone field must be a string.'),
            'phone.max'         => __('The phone field must be less than :max characters.'),
            'bio.string'        => __('The bio field must be a string.'),
            'country.string'    => __('The country field must be a string.'),
            'country.max'       => __('The country field must be less than :max characters.'),
            'website.url'       => __('The website field must be a valid URL.'),
            'website.max'       => __('The website field must be less than :max characters.'),
            'specification.string' => __('The specification field must be a string.'),
            'specification.max' => __('The specification field must be less than :max characters.'),
            'skills.string'     => __('The skills field must be a string.'),

        ];
    }
}

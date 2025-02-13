<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $customerId = $this->route('customer'); // Get the user ID from the route

        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                // Ensure that the email is unique, except for the current user's email
                Rule::unique('users')->ignore($customerId),
            ],
            'password' => [
                'nullable', // Allow password to be null for updates if not changing
                'string',
                'min:8',    // Minimum length of 8 characters
            ],
            'username' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'lang' => 'required|in:ar,en',
        ];
    }
}

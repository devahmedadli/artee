<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
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
            'description'   => 'required|string',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => __('The name field is required.'),
            'name.string'       => __('The name field must be a string.'),
            'name.max'          => __('The name field must be less than :max characters.'),
            'description.required' => __('The description field is required.'),
            'description.string'   => __('The description field must be a string.'),
            'image.image'          => __('The image field must be an image.'),
            'image.mimes'          => __('The image field must be a valid image file.'),
            'image.max'            => __('The image field must be less than :max kilobytes.'),
        ];
    }
}

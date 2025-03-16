<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Allow all authenticated users to place orders
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_id'    => 'required|exists:products,id',
            'options'       => 'sometimes|array',
            'options.*'     => 'exists:option_values,id',
            'requirements'  => 'sometimes|array',
            'requirements.*' => 'sometimes',
            'total_price'   => 'sometimes|numeric|min:0',
            'notes'         => 'nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required'   => __('The product is required.'),
            'product_id.exists'     => __('The selected product is invalid.'),
            'options.exists'        => __('The selected options are invalid.'),
            'requirements.sometimes' => __('The requirements are required.'),
            'total_price.numeric'   => __('The total price must be a number.'),
            'total_price.min'       => __('The total price must be at least 0.'),
            'notes.string'          => __('The notes must be a string.'),
            'notes.max'             => __('The notes must be less than 1000 characters.'),
            'options.*.exists'      => __('The selected options are invalid.'),
        ];
    }
}

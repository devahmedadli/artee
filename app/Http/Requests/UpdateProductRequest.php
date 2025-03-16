<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'ar_name' => 'required|string|max:255',
            'en_name' => 'required|string|max:255',
            'base_price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'ar_description' => 'nullable|string',
            'en_description' => 'nullable|string',
            'active' => 'boolean',
            'options' => 'nullable|array',
            'options.*.ar_name' => 'required_with:options|string|max:255',
            'options.*.en_name' => 'required_with:options|string|max:255',
            'options.*.values' => 'required_with:options|array',
            'options.*.values.*.ar_value' => 'required_with:options|string|max:255',
            'options.*.values.*.en_value' => 'required_with:options|string|max:255',
            'options.*.values.*.price' => 'required_with:options|numeric|min:0',
            'options.*.values.*.requirements' => 'nullable|array',
            'options.*.values.*.requirements.*.ar_name' => 'required_with:options.*.values.*.requirements|string|max:255',
            'options.*.values.*.requirements.*.en_name' => 'required_with:options.*.values.*.requirements|string|max:255',
            'options.*.values.*.requirements.*.type' => 'required_with:options.*.values.*.requirements|string|in:text,number,boolean,file,image,custom_design',
            'options.*.values.*.requirements.*.required' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'ar_name.required' => __('Arabic name is required'),
            'en_name.required' => __('English name is required'),
            'base_price.required' => __('Base price is required'),
            'base_price.min' => __('Base price must be greater than zero'),
            'image.image' => __('The file must be an image'),
            'image.mimes' => __('The image must be a file of type: jpeg, png, jpg, gif, svg'),
            'options.*.ar_name.required_with' => __('Arabic option name is required'),
            'options.*.en_name.required_with' => __('English option name is required'),
            'options.*.values.*.ar_value.required_with' => __('Arabic option value is required'),
            'options.*.values.*.en_value.required_with' => __('English option value is required'),
            'options.*.values.*.price.required_with' => __('Option price is required'),
            'options.*.values.*.price.min' => __('Option price must be greater than zero'),
            'options.*.values.*.requirements.*.ar_name.required_with' => __('Arabic requirement name is required'),
            'options.*.values.*.requirements.*.en_name.required_with' => __('English requirement name is required'),
            'options.*.values.*.requirements.*.type.required_with' => __('Requirement type is required'),
            'options.*.values.*.requirements.*.type.in' => __('Invalid requirement type'),
            'options.*.values.*.requirements.*.required.boolean' => __('Required field must be a boolean'),
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'active' => $this->active === 'on',
            'options' => collect($this->options)->map(function ($option) {
                if (isset($option['values'])) {
                    $option['values'] = collect($option['values'])->map(function ($value) {
                        if (isset($value['requirements'])) {
                            $value['requirements'] = collect($value['requirements'])->map(function ($requirement) {
                                $requirement['required'] = isset($requirement['required']) && $requirement['required'] === 'on';
                                return $requirement;
                            })->toArray();
                        }
                        return $value;
                    })->toArray();
                }
                return $option;
            })->toArray(),
        ]);
    }
}

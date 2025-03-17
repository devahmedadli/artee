<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'service_id'    => 'required|exists:services,id',
            'description'   => 'required|string',
            'attachments'   => 'nullable|array',
            'attachments.*' => 'nullable|file|mimes:pdf,docx,doc,zip,rar,7z,png,jpg,jpeg,gif',
        ];
    }

    public function messages()
    {
        return [
            'service_id.required'    => __('The service field is required.'),
            'service_id.exists'      => __('The selected service is invalid.'),
            'description.required'   => __('The description field is required.'),
            'description.string'     => __('The description must be a string.'),
            'attachments.*.file'     => __('Invalid file/s type.'),
            'attachments.*.mimes'    => __('Invalid file/s type.'),
        ];
    }
}

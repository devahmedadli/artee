<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderFileRequest extends FormRequest
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
            'files'     => 'required|array',
            'files.*'   => 'required|file|mimes:pdf,docx,doc,zip,rar,7z,png,jpg,jpeg,gif,bmp,tiff,svg|max:10240',
        ];
    }
}

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
            'name'        => 'required|string|max:255',
            'service_id'  => 'required|exists:services,id',
            'price'       => 'required|numeric|min:0',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string',
            // 'active'      => 'required|boolean|in:0,1',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required'         => 'اسم المنتج مطلوب',
            'service_id.required'   => 'الخدمة مطلوبة',
            'price.required'        => 'السعر مطلوب',
            'description.nullable'  => 'الوصف مطلوب',
            'image.image'           => 'الصورة يجب ان تكون صورة',
            'image.mimes'           => 'الصورة يجب ان تكون من نوع jpeg,png,jpg,gif,svg',
            'image.max'             => 'الصورة يجب ان لا تكون اكثر من 2048 ميجا بايت',
            // 'active.required'       => 'الحالة مطلوبة',
        ];
    }
}

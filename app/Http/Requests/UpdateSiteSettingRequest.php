<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSiteSettingRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png|max:1024',
            'social_media.facebook' => 'nullable|url',
            'social_media.instagram' => 'nullable|url',
            'social_media.twitter' => 'nullable|url',
            'social_media.linkedin' => 'nullable|url',
            'social_media.youtube' => 'nullable|url',
            'contact.phone' => 'required|string',
            'contact.email' => 'required|email',
            'contact.address' => 'required|string',
            'colors.primary' => 'required|string',
            'colors.primary-dark' => 'required|string',
            'colors.secondary' => 'required|string',
            'colors.secondary-dark' => 'required|string',
            'colors.tertiary' => 'required|string',
            'colors.tertiary-dark' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('The site name is required.'),
            'logo.image' => __('The logo must be an image.'),
            'logo.mimes' => __('The logo must be a file of type: jpeg, png, jpg, gif.'),
            'logo.max' => __('The logo may not be greater than 2MB.'),
            'favicon.image' => __('The favicon must be an image.'),
            'favicon.mimes' => __('The favicon must be a file of type: ico, png.'),
            'favicon.max' => __('The favicon may not be greater than 1MB.'),
            'contact.phone.required' => __('The phone field is required.'),
            'contact.email.required' => __('The email field is required.'),
            'contact.email.email' => __('Please enter a valid email address.'),
            'contact.address.required' => __('The address field is required.'),
            'social_media.facebook.url' => __('The Facebook URL is invalid.'),
            'social_media.instagram.url' => __('The Instagram URL is invalid.'),
            'social_media.twitter.url' => __('The Twitter URL is invalid.'),
            'social_media.linkedin.url' => __('The LinkedIn URL is invalid.'),
            'social_media.youtube.url' => __('The YouTube URL is invalid.'),
            'colors.primary.required' => __('The primary color is required.'),
            'colors.primary-dark.required' => __('The primary dark color is required.'),
            'colors.secondary.required' => __('The secondary color is required.'),
            'colors.secondary-dark.required' => __('The secondary dark color is required.'),
            'colors.tertiary.required' => __('The tertiary color is required.'),
            'colors.tertiary-dark.required' => __('The tertiary dark color is required.'),
        ];
    }
}

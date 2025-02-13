<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHomePageRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            // Page Details
            'name.en' => 'required|string|max:255',
            'name.ar' => 'required|string|max:255',
            'description.en' => 'required|string|max:1000',
            'description.ar' => 'required|string|max:1000',

            // Hero Section
            'hero.title.en' => 'required|string|max:255',
            'hero.title.ar' => 'required|string|max:255',
            'hero.subtitle.en' => 'required|string|max:500',
            'hero.subtitle.ar' => 'required|string|max:500',
            'hero.background' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'hero.button.en' => 'required|string|max:255',
            'hero.button.ar' => 'required|string|max:255',

            // Features Section
            'features.title.en' => 'required|string|max:255',
            'features.title.ar' => 'required|string|max:255',
            'features.subtitle.en' => 'required|string|max:500',
            'features.subtitle.ar' => 'required|string|max:500',
            'features.feature_1.title.en' => 'required|string|max:255',
            'features.feature_1.title.ar' => 'required|string|max:255',
            'features.feature_1.subtitle.en' => 'required|string|max:500',
            'features.feature_1.subtitle.ar' => 'required|string|max:500',
            'features.feature_2.title.en' => 'required|string|max:255',
            'features.feature_2.title.ar' => 'required|string|max:255',
            'features.feature_2.subtitle.en' => 'required|string|max:500',
            'features.feature_2.subtitle.ar' => 'required|string|max:500',
            'features.feature_3.title.en' => 'required|string|max:255',
            'features.feature_3.title.ar' => 'required|string|max:255',
            'features.feature_3.subtitle.en' => 'required|string|max:500',
            'features.feature_3.subtitle.ar' => 'required|string|max:500',
            'features.feature_4.title.en' => 'required|string|max:255',
            'features.feature_4.title.ar' => 'required|string|max:255',
            'features.feature_4.subtitle.en' => 'required|string|max:500',
            'features.feature_4.subtitle.ar' => 'required|string|max:500',

            // Why Us Section
            'why_us.why_us_1.title.en' => 'required|string|max:255',
            'why_us.why_us_1.title.ar' => 'required|string|max:255',
            'why_us.why_us_1.text.en' => 'required|string|max:1000',
            'why_us.why_us_1.text.ar' => 'required|string|max:1000',
            'why_us.why_us_2.title.en' => 'required|string|max:255',
            'why_us.why_us_2.title.ar' => 'required|string|max:255',
            'why_us.why_us_2.text.en' => 'required|string|max:1000',
            'why_us.why_us_2.text.ar' => 'required|string|max:1000',

            // How It Works Section
            'how_it_works.step_1.title.en' => 'required|string|max:255',
            'how_it_works.step_1.title.ar' => 'required|string|max:255',
            'how_it_works.step_1.subtitle.en' => 'required|string|max:500',
            'how_it_works.step_1.subtitle.ar' => 'required|string|max:500',
            'how_it_works.step_2.title.en' => 'required|string|max:255',
            'how_it_works.step_2.title.ar' => 'required|string|max:255',
            'how_it_works.step_2.subtitle.en' => 'required|string|max:500',
            'how_it_works.step_2.subtitle.ar' => 'required|string|max:500',
            'how_it_works.step_3.title.en' => 'required|string|max:255',
            'how_it_works.step_3.title.ar' => 'required|string|max:255',
            'how_it_works.step_3.subtitle.en' => 'required|string|max:500',
            'how_it_works.step_3.subtitle.ar' => 'required|string|max:500',
            'how_it_works.step_4.title.en' => 'required|string|max:255',
            'how_it_works.step_4.title.ar' => 'required|string|max:255',
            'how_it_works.step_4.subtitle.en' => 'required|string|max:500',
            'how_it_works.step_4.subtitle.ar' => 'required|string|max:500',

            // Counter Section
            'counter.counter_1.title.en' => 'required|string|max:255',
            'counter.counter_1.title.ar' => 'required|string|max:255',
            'counter.counter_1.value' => 'required|integer|min:0',
            'counter.counter_2.title.en' => 'required|string|max:255',
            'counter.counter_2.title.ar' => 'required|string|max:255',
            'counter.counter_2.value' => 'required|integer|min:0',
            'counter.counter_3.title.en' => 'required|string|max:255',
            'counter.counter_3.title.ar' => 'required|string|max:255',
            'counter.counter_3.value' => 'required|integer|min:0',
            'counter.counter_4.title.en' => 'required|string|max:255',
            'counter.counter_4.title.ar' => 'required|string|max:255',
            'counter.counter_4.value' => 'required|integer|min:0',

            // FAQs Section
            'faqs.faq_1.title.en' => 'required|string|max:255',
            'faqs.faq_1.title.ar' => 'required|string|max:255',
            'faqs.faq_1.subtitle.en' => 'required|string|max:500',
            'faqs.faq_1.subtitle.ar' => 'required|string|max:500',
            'faqs.faq_2.title.en' => 'required|string|max:255',
            'faqs.faq_2.title.ar' => 'required|string|max:255',
            'faqs.faq_2.subtitle.en' => 'required|string|max:500',
            'faqs.faq_2.subtitle.ar' => 'required|string|max:500',
            'faqs.faq_3.title.en' => 'required|string|max:255',
            'faqs.faq_3.title.ar' => 'required|string|max:255',
            'faqs.faq_3.subtitle.en' => 'required|string|max:500',
            'faqs.faq_3.subtitle.ar' => 'required|string|max:500',
            'faqs.faq_4.title.en' => 'required|string|max:255',
            'faqs.faq_4.title.ar' => 'required|string|max:255',
            'faqs.faq_4.subtitle.en' => 'required|string|max:500',
            'faqs.faq_4.subtitle.ar' => 'required|string|max:500',

            // Testimonials Section
            'testimonials.testimonial_1.title.en' => 'required|string|max:255',
            'testimonials.testimonial_1.title.ar' => 'required|string|max:255',
            'testimonials.testimonial_1.text.en' => 'required|string|max:1000',
            'testimonials.testimonial_1.text.ar' => 'required|string|max:1000',
            'testimonials.testimonial_1.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'testimonials.testimonial_2.title.en' => 'required|string|max:255',
            'testimonials.testimonial_2.title.ar' => 'required|string|max:255',
            'testimonials.testimonial_2.text.en' => 'required|string|max:1000',
            'testimonials.testimonial_2.text.ar' => 'required|string|max:1000',
            'testimonials.testimonial_2.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'testimonials.testimonial_3.title.en' => 'required|string|max:255',
            'testimonials.testimonial_3.title.ar' => 'required|string|max:255',
            'testimonials.testimonial_3.text.en' => 'required|string|max:1000',
            'testimonials.testimonial_3.text.ar' => 'required|string|max:1000',
            'testimonials.testimonial_3.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

            // Get Started Now Section
            'get_started_now.title.en' => 'required|string|max:255',
            'get_started_now.title.ar' => 'required|string|max:255',
            'get_started_now.subtitle.en' => 'required|string|max:500',
            'get_started_now.subtitle.ar' => 'required|string|max:500',
            'get_started_now.button.en' => 'required|string|max:255',
            'get_started_now.button.ar' => 'required|string|max:255',

            // Contact Section
            'contact.title.en' => 'required|string|max:255',
            'contact.title.ar' => 'required|string|max:255',
            'contact.subtitle.en' => 'required|string|max:500',
            'contact.subtitle.ar' => 'required|string|max:500',
            'contact.button.en' => 'required|string|max:255',
            'contact.button.ar' => 'required|string|max:255',
        ];
    }

    /**
     * Get custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            // Page Details
            'name.en.required' => __('The name in English is required'),
            'name.ar.required' => __('The name in Arabic is required'),
            'name.en.max' => __('The name in English must not exceed 255 characters'),
            'name.ar.max' => __('The name in Arabic must not exceed 255 characters'),
            'description.en.required' => __('The description in English is required'),
            'description.ar.required' => __('The description in Arabic is required'),
            'description.en.max' => __('The description in English must not exceed 1000 characters'),
            'description.ar.max' => __('The description in Arabic must not exceed 1000 characters'),

            // Hero Section
            'hero.title.en.required' => __('The hero title in English is required'),
            'hero.title.ar.required' => __('The hero title in Arabic is required'),
            'hero.title.en.max' => __('The hero title in English must not exceed 255 characters'),
            'hero.title.ar.max' => __('The hero title in Arabic must not exceed 255 characters'),
            'hero.subtitle.en.required' => __('The hero subtitle in English is required'),
            'hero.subtitle.ar.required' => __('The hero subtitle in Arabic is required'),
            'hero.subtitle.en.max' => __('The hero subtitle in English must not exceed 500 characters'),
            'hero.subtitle.ar.max' => __('The hero subtitle in Arabic must not exceed 500 characters'),
            'hero.background.image' => __('The hero background must be an image'),
            'hero.background.mimes' => __('The hero background must be a file of type: jpeg, png, jpg, gif'),
            'hero.background.max' => __('The hero background may not be greater than 2048 kilobytes'),
            'hero.button.en.required' => __('The hero button in English is required'),
            'hero.button.ar.required' => __('The hero button in Arabic is required'),
            'hero.button.en.max' => __('The hero button in English must not exceed 255 characters'),
            'hero.button.ar.max' => __('The hero button in Arabic must not exceed 255 characters'),

            // Features Section
            'features.title.en.required' => __('The features title in English is required'),
            'features.title.ar.required' => __('The features title in Arabic is required'),
            'features.title.en.max' => __('The features title in English must not exceed 255 characters'),
            'features.title.ar.max' => __('The features title in Arabic must not exceed 255 characters'),
            'features.subtitle.en.required' => __('The features subtitle in English is required'),
            'features.subtitle.ar.required' => __('The features subtitle in Arabic is required'),
            'features.subtitle.en.max' => __('The features subtitle in English must not exceed 500 characters'),
            'features.*.title.en.required' => __('The feature title in English is required'),
            'features.*.title.ar.required' => __('The feature title in Arabic is required'),
            'features.*.title.en.max' => __('The feature title in English must not exceed 255 characters'),
            'features.*.title.ar.max' => __('The feature title in Arabic must not exceed 255 characters'),
            'features.*.subtitle.en.required' => __('The feature subtitle in English is required'),
            'features.*.subtitle.ar.required' => __('The feature subtitle in Arabic is required'),
            'features.*.subtitle.en.max' => __('The feature subtitle in English must not exceed 500 characters'),
            'features.*.subtitle.ar.max' => __('The feature subtitle in Arabic must not exceed 500 characters'),

            // Why Us Section
            'why_us.*.title.en.required' => __('The why us title in English is required'),
            'why_us.*.title.ar.required' => __('The why us title in Arabic is required'),
            'why_us.*.text.en.required' => __('The why us text in English is required'),
            'why_us.*.text.ar.required' => __('The why us text in Arabic is required'),
            'why_us.*.text.en.max' => __('The why us text in English must not exceed 1000 characters'),
            'why_us.*.text.ar.max' => __('The why us text in Arabic must not exceed 1000 characters'),

            // How It Works Section
            'how_it_works.*.title.en.required' => __('The how it works title in English is required'),
            'how_it_works.*.title.ar.required' => __('The how it works title in Arabic is required'),
            'how_it_works.*.subtitle.en.required' => __('The how it works subtitle in English is required'),
            'how_it_works.*.subtitle.ar.required' => __('The how it works subtitle in Arabic is required'),
            'how_it_works.*.subtitle.en.max' => __('The how it works subtitle in English must not exceed 500 characters'),
            'how_it_works.*.subtitle.ar.max' => __('The how it works subtitle in Arabic must not exceed 500 characters'),

            // Counter Section
            'counter.*.title.en.required' => __('The counter title in English is required'),
            'counter.*.title.ar.required' => __('The counter title in Arabic is required'),
            'counter.*.value.required' => __('The counter value is required'),
            'counter.*.value.integer' => __('The counter value must be an integer'),
            'counter.*.value.min' => __('The counter value must be at least 0'),

            // FAQs Section
            'faqs.*.title.en.required' => __('The faqs title in English is required'),
            'faqs.*.title.ar.required' => __('The faqs title in Arabic is required'),
            'faqs.*.subtitle.en.required' => __('The faqs subtitle in English is required'),
            'faqs.*.subtitle.ar.required' => __('The faqs subtitle in Arabic is required'),
            'faqs.*.subtitle.en.max' => __('The faqs subtitle in English must not exceed 500 characters'),
            'faqs.*.subtitle.ar.max' => __('The faqs subtitle in Arabic must not exceed 500 characters'),

            // Testimonials Section
            'testimonials.*.title.en.required' => __('The testimonials title in English is required'),
            'testimonials.*.title.ar.required' => __('The testimonials title in Arabic is required'),
            'testimonials.*.text.en.required' => __('The testimonials text in English is required'),
            'testimonials.*.text.ar.required' => __('The testimonials text in Arabic is required'),
            'testimonials.*.text.en.max' => __('The testimonials text in English must not exceed 1000 characters'),
            'testimonials.*.text.ar.max' => __('The testimonials text in Arabic must not exceed 1000 characters'),
            'testimonials.*.image.image' => __('The testimonials image must be an image'),
            'testimonials.*.image.mimes' => __('The testimonials image must be a file of type: jpeg, png, jpg, gif'),
            'testimonials.*.image.max' => __('The testimonials image may not be greater than 2048 kilobytes'),

            // Get Started Now Section
            'get_started_now.title.en.required' => __('The get started now title in English is required'),
            'get_started_now.title.ar.required' => __('The get started now title in Arabic is required'),
            'get_started_now.subtitle.en.required' => __('The get started now subtitle in English is required'),
            'get_started_now.subtitle.ar.required' => __('The get started now subtitle in Arabic is required'),
            'get_started_now.subtitle.en.max' => __('The get started now subtitle in English must not exceed 500 characters'),
            'get_started_now.subtitle.ar.max' => __('The get started now subtitle in Arabic must not exceed 500 characters'),
            'get_started_now.button.en.required' => __('The get started now button in English is required'),
            'get_started_now.button.ar.required' => __('The get started now button in Arabic is required'),

            // Contact Section
            'contact.title.en.required' => __('The contact title in English is required'),
            'contact.title.ar.required' => __('The contact title in Arabic is required'),
            'contact.subtitle.en.required' => __('The contact subtitle in English is required'),
            'contact.subtitle.ar.required' => __('The contact subtitle in Arabic is required'),
            'contact.subtitle.en.max' => __('The contact subtitle in English must not exceed 500 characters'),
            'contact.subtitle.ar.max' => __('The contact subtitle in Arabic must not exceed 500 characters'),
            'contact.button.en.required' => __('The contact button in English is required'),
            'contact.button.ar.required' => __('The contact button in Arabic is required'),

            // Generic Messages
            '*.required' => __('This field is required'),
            '*.string' => __('This field must be a string'),
            '*.max' => __('This field must not exceed :max characters'),
            '*.image' => __('This field must be an image'),
            '*.mimes' => __('This field must be a file of type: :values'),
            '*.integer' => __('This field must be an integer'),
            '*.min' => __('This field must be at least :min')
        ];
    }
}

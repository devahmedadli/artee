<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePageRequest extends FormRequest
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
        $baseRules = [
            'name.en' => 'required|string|max:255',
            'name.ar' => 'required|string|max:255',
            'description.en' => 'required|string|max:1000',
            'description.ar' => 'required|string|max:1000',
        ];

        $page = $this->route('page');
        
        switch ($page->slug) {
            case 'services':
            case 'products':
                return array_merge($baseRules, [
                    'sections.hero.title.en' => 'required|string|max:255',
                    'sections.hero.title.ar' => 'required|string|max:255',
                    'sections.hero.subtitle.en' => 'required|string|max:500',
                    'sections.hero.subtitle.ar' => 'required|string|max:500',
                ]);

            case 'privacy-policy':
            case 'terms-of-service':
                return array_merge($baseRules, [
                    'sections.hero.title.en' => 'required|string|max:255',
                    'sections.hero.title.ar' => 'required|string|max:255',
                    'sections.hero.subtitle.en' => 'required|string|max:500',
                    'sections.hero.subtitle.ar' => 'required|string|max:500',
                    'sections.content.en' => 'required|string',
                    'sections.content.ar' => 'required|string',
                ]);

            default:
                return $baseRules;
        }
    }

    public function messages(): array
    {
        return [
            'name.en.required' => __('The name in English is required'),
            'name.ar.required' => __('The name in Arabic is required'),
            'description.en.required' => __('The description in English is required'),
            'description.ar.required' => __('The description in Arabic is required'),
            'sections.hero.title.en.required' => __('The hero title in English is required'),
            'sections.hero.title.ar.required' => __('The hero title in Arabic is required'),
            'sections.hero.subtitle.en.required' => __('The hero subtitle in English is required'),
            'sections.hero.subtitle.ar.required' => __('The hero subtitle in Arabic is required'),
            'sections.content.en.required' => __('The content in English is required'),
            'sections.content.ar.required' => __('The content in Arabic is required'),
        ];
    }
}

<?php

namespace App\Services;

use App\Models\Page;
use Illuminate\Support\Facades\Cache;

class PageService
{
    public function getPageContent(string $slug, string $locale = null): array
    {
        $locale = $locale ?: app()->getLocale();

        return Cache::remember("page_content_{$slug}_{$locale}", 3600, function () use ($slug, $locale) {
            $page = Page::where('slug', $slug)
                ->where('is_active', true)
                ->with(['sections' => function ($query) {
                    $query->where('is_active', true)
                        ->with(['components' => function ($query) {
                            $query->where('is_active', true);
                        }]);
                }])
                ->firstOrFail();

            return $this->formatPageContent($page, $locale);
        });
    }

    /**
     * Format the page content
     *
     * @param Page $page
     * @param string $locale
     * @return array
     */
    protected function formatPageContent(Page $page, string $locale): array
    {
        $formattedSections = [];

        foreach ($page->sections as $section) {
            $components = [];
            foreach ($section->components as $component) {
                $attributes = $component->attributes;
                if (is_array($attributes)) {
                    array_walk_recursive($attributes, function (&$value) use ($component, $locale) {
                        if (is_string($value)) {
                            $translation = $component->translate("attributes.{$value}", $locale);
                            $value = $translation ?? $value;
                        }
                    });
                }

                $value = $component->type === 'image' ? asset('storage/' . $component->value) : ( $component->translate('value', $locale) );
                $components[$component->key] = [
                    'type' => $component->type,
                    'value' => $value,
                    'attributes' => $attributes,
                ];
            }

            $formattedSections[$section->name] = [
                'title' => $section->translate('title', $locale),
                'subtitle' => $section->translate('subtitle', $locale),
                'type' => $section->type,
                'settings' => $section->settings,
                'components' => $components,
            ];
        }

        return [
            'title' => $page->translate('title', $locale),
            'description' => $page->translate('description', $locale),
            'meta' => [
                'title' => $page->translate('meta_title', $locale),
                'description' => $page->translate('meta_description', $locale),
            ],
            'sections' => $formattedSections,
        ];
    }
}

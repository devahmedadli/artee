<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Admin\UpdateHomePageRequest;

class HomePageController extends Controller
{
    public function editHomePage()
    {
        $page = Page::where('slug', 'home')->firstOrFail();
        return view('admin.site.pages.home', compact('page'));
    }

    public function update(UpdateHomePageRequest $request)
    {
        // The request is automatically validated
        $validated = $request->validated();

        $page = Page::where('slug', 'home')->firstOrFail();
        $sections = $page->sections;

        // Process Hero Section
        $sections['hero'] = $this->processHeroSection($request, $sections['hero'] ?? []);

        // Process Services Section
        $sections['services'] = $this->processServicesSection($request, $sections['services'] ?? []);

        // Process Features Section
        $sections['features'] = $this->processFeaturesSection($request, $sections['features'] ?? []);

        // Process Why Us Section
        $sections['why_us'] = $this->processWhyUsSection($request, $sections['why_us'] ?? []);

        // Process How It Works Section
        $sections['how_it_works'] = $this->processHowItWorksSection($request, $sections['how_it_works'] ?? []);

        // Process Counter Section
        $sections['counter'] = $this->processCounterSection($request, $sections['counter'] ?? []);

        // Process FAQs Section
        $sections['faqs'] = $this->processFAQsSection($request, $sections['faqs'] ?? []);

        // Process Testimonials Section
        $sections['testimonials'] = $this->processTestimonialsSection($request, $sections['testimonials'] ?? []);

        // Process Get Started Now Section
        $sections['get_started_now'] = $this->processGetStartedNowSection($request, $sections['get_started_now'] ?? []);

        // Process Contact Section
        $sections['contact'] = $this->processContactSection($request, $sections['contact'] ?? []);

        $page->sections = $sections;
        $page->save();
        \Cache::forget('home_content');

        flash()->success(__('Home Page updated Successfully.'));
        return back();
    }

    /**
     * Process the Hero Section
     *
     * @param Request $request
     * @param array $existingData
     * @return array
     */

    private function processHeroSection(Request $request, array $existingData): array
    {
        $heroData = [
            'title' => [
                'en' => $request->input('hero.title.en'),
                'ar' => $request->input('hero.title.ar')
            ],
            'subtitle' => [
                'en' => $request->input('hero.subtitle.en'),
                'ar' => $request->input('hero.subtitle.ar')
            ],
            'button' => [
                'en' => $request->input('hero.button.en'),
                'ar' => $request->input('hero.button.ar')
            ]
        ];

        // Handle background image upload
        if ($request->hasFile('hero.background')) {
            // Delete old image if exists
            if (!empty($existingData['background'])) {
                Storage::disk('public')->delete($existingData['background']);
            }

            $heroData['background'] = $request->file('hero.background')
                ->store('pages/hero', 'public');
        } else {
            // Keep existing background if no new image uploaded
            $heroData['background'] = $existingData['background'] ?? null;
        }

        return $heroData;
    }

    /**
     * Process the Services Section
     *
     * @param Request $request
     * @param array $existingData
     * @return array
     */
    private function processServicesSection(Request $request, array $existingData): array
    {
        return [
            'title' => [
                'en' => $request->input('services.title.en'),
                'ar' => $request->input('services.title.ar')
            ],
            'subtitle' => [
                'en' => $request->input('services.subtitle.en'),
                'ar' => $request->input('services.subtitle.ar')
            ],
            'order_now' => [
                'en' => $request->input('services.order_now.en'),
                'ar' => $request->input('services.order_now.ar')
            ],
            'all_services' => [
                'en' => $request->input('services.all_services.en'),
                'ar' => $request->input('services.all_services.ar')
            ],
            'get_started' => [
                'en' => $request->input('services.get_started.en'),
                'ar' => $request->input('services.get_started.ar')
            ]
        ];
    }

    /**
     * Process the Features Section
     *
     * @param Request $request
     * @param array $existingData
     * @return array
     */
    private function processFeaturesSection(Request $request, array $existingData): array
    {
        // Initialize base structure with section title/subtitle
        $featuresData = [
            'title' => [
                'en' => $request->input('features.title.en'),
                'ar' => $request->input('features.title.ar')
            ],
            'subtitle' => [
                'en' => $request->input('features.subtitle.en'),
                'ar' => $request->input('features.subtitle.ar')
            ]
        ];

        // Process each feature (feature_1, feature_2, feature_3, feature_4)
        foreach (['feature_1', 'feature_2', 'feature_3', 'feature_4'] as $feature) {
            $featureData = [
                'title' => [
                    'en' => $request->input("features.{$feature}.title.en"),
                    'ar' => $request->input("features.{$feature}.title.ar")
                ],
                'subtitle' => [
                    'en' => $request->input("features.{$feature}.subtitle.en"),
                    'ar' => $request->input("features.{$feature}.subtitle.ar")
                ]
            ];

            // Handle icon upload
            if ($request->hasFile("features.{$feature}.icon")) {
                // Delete old icon if exists
                if (!empty($existingData[$feature]['icon'])) {
                    Storage::disk('public')->delete($existingData[$feature]['icon']);
                }

                $featureData['icon'] = $request->file("features.{$feature}.icon")
                    ->store('pages/features', 'public');
            } else {
                // Keep existing icon if no new icon uploaded
                $featureData['icon'] = $existingData[$feature]['icon'] ?? null;
            }

            $featuresData[$feature] = $featureData;
        }

        return $featuresData;
    }

    /**
     * Process the Why Us Section
     *
     * @param Request $request
     * @param array $existingData
     * @return array
     */
    private function processWhyUsSection(Request $request, array $existingData): array
    {
        $whyUsData = [
            'title' => [
                'en' => $request->input('why_us.title.en'),
                'ar' => $request->input('why_us.title.ar')
            ],
            'subtitle' => [
                'en' => $request->input('why_us.subtitle.en'),
                'ar' => $request->input('why_us.subtitle.ar')
            ]
        ];

        foreach (['why_us_1', 'why_us_2', 'why_us_3'] as $reason) {
            $whyUsData[$reason] = [
                'title' => [
                    'en' => $request->input("why_us.{$reason}.title.en"),
                    'ar' => $request->input("why_us.{$reason}.title.ar")
                ],
                'text' => [
                    'en' => $request->input("why_us.{$reason}.text.en"),
                    'ar' => $request->input("why_us.{$reason}.text.ar")
                ]
            ];
        }

        return $whyUsData;
    }

    /**
     * Process the How It Works Section
     *
     * @param Request $request
     * @param array $existingData
     * @return array
     */
    private function processHowItWorksSection(Request $request, array $existingData): array
    {
        $howItWorksData = [
            'title' => [
                'en' => $request->input('how_it_works.title.en'),
                'ar' => $request->input('how_it_works.title.ar')
            ],
            'subtitle' => [
                'en' => $request->input('how_it_works.subtitle.en'),
                'ar' => $request->input('how_it_works.subtitle.ar')
            ]
        ];

        foreach (['step_1', 'step_2', 'step_3', 'step_4'] as $step) {
            $howItWorksData[$step] = [
                'title' => [
                    'en' => $request->input("how_it_works.{$step}.title.en"),
                    'ar' => $request->input("how_it_works.{$step}.title.ar")
                ],
                'subtitle' => [
                    'en' => $request->input("how_it_works.{$step}.subtitle.en"),
                    'ar' => $request->input("how_it_works.{$step}.subtitle.ar")
                ]
            ];
        }

        return $howItWorksData;
    }

    /**
     * Process the Counter Section
     *
     * @param Request $request
     * @param array $existingData
     * @return array
     */
    private function processCounterSection(Request $request, array $existingData): array
    {
        $counterData = [
            'title' => [
                'en' => $request->input('counter.title.en'),
                'ar' => $request->input('counter.title.ar')
            ],
            'subtitle' => [
                'en' => $request->input('counter.subtitle.en'),
                'ar' => $request->input('counter.subtitle.ar')
            ]
        ];

        foreach (['counter_1', 'counter_2', 'counter_3', 'counter_4'] as $counter) {
            $counterData[$counter] = [
                'title' => [
                    'en' => $request->input("counter.{$counter}.title.en"),
                    'ar' => $request->input("counter.{$counter}.title.ar")
                ],
                'value' => $request->input("counter.{$counter}.value")
            ];
        }

        return $counterData;
    }

    /**
     * Process the FAQs Section
     *
     * @param Request $request
     * @param array $existingData
     * @return array
     */
    private function processFAQsSection(Request $request, array $existingData): array
    {
        $faqsData = [
            'title' => [
                'en' => $request->input('faqs.title.en'),
                'ar' => $request->input('faqs.title.ar')
            ],
            'subtitle' => [
                'en' => $request->input('faqs.subtitle.en'),
                'ar' => $request->input('faqs.subtitle.ar')
            ]
        ];

        foreach (['faq_1', 'faq_2', 'faq_3', 'faq_4'] as $faq) {
            $faqsData[$faq] = [
                'title' => [
                    'en' => $request->input("faqs.{$faq}.title.en"),
                    'ar' => $request->input("faqs.{$faq}.title.ar")
                ],
                'subtitle' => [
                    'en' => $request->input("faqs.{$faq}.subtitle.en"),
                    'ar' => $request->input("faqs.{$faq}.subtitle.ar")
                ]
            ];
        }

        return $faqsData;
    }

    /**
     * Process the Testimonials Section
     *
     * @param Request $request
     * @param array $existingData
     * @return array
     */
    private function processTestimonialsSection(Request $request, array $existingData): array
    {
        $testimonialsData = [
            'title' => [
                'en' => $request->input('testimonials.title.en'),
                'ar' => $request->input('testimonials.title.ar')
            ],
            'subtitle' => [
                'en' => $request->input('testimonials.subtitle.en'),
                'ar' => $request->input('testimonials.subtitle.ar')
            ]
        ];

        foreach (['testimonial_1', 'testimonial_2', 'testimonial_3'] as $testimonial) {
            $testimonialsData[$testimonial] = [
                'title' => [
                    'en' => $request->input("testimonials.{$testimonial}.title.en"),
                    'ar' => $request->input("testimonials.{$testimonial}.title.ar")
                ],
                'text' => [
                    'en' => $request->input("testimonials.{$testimonial}.text.en"),
                    'ar' => $request->input("testimonials.{$testimonial}.text.ar")
                ]
            ];

            // Handle image upload
            if ($request->hasFile("testimonials.{$testimonial}.image")) {
                if (!empty($existingData[$testimonial]['image'])) {
                    Storage::disk('public')->delete($existingData[$testimonial]['image']);
                }
                $testimonialsData[$testimonial]['image'] = $request->file("testimonials.{$testimonial}.image")
                    ->store('pages/testimonials', 'public');
            } else {
                $testimonialsData[$testimonial]['image'] = $existingData[$testimonial]['image'] ?? null;
            }
        }

        return $testimonialsData;
    }

    /**
     * Process the Get Started Now Section
     *
     * @param Request $request
     * @param array $existingData
     * @return array
     */
    private function processGetStartedNowSection(Request $request, array $existingData): array
    {
        return [
            'title' => [
                'en' => $request->input('get_started_now.title.en'),
                'ar' => $request->input('get_started_now.title.ar')
            ],
            'subtitle' => [
                'en' => $request->input('get_started_now.subtitle.en'),
                'ar' => $request->input('get_started_now.subtitle.ar')
            ],
            'button' => [
                'en' => $request->input('get_started_now.button.en'),
                'ar' => $request->input('get_started_now.button.ar')
            ]
        ];
    }

    /**
     * Process the Contact Section
     *
     * @param Request $request
     * @param array $existingData
     * @return array
     */
    private function processContactSection(Request $request, array $existingData): array
    {
        return [
            'title' => [
                'en' => $request->input('contact.title.en'),
                'ar' => $request->input('contact.title.ar')
            ],
            'subtitle' => [
                'en' => $request->input('contact.subtitle.en'),
                'ar' => $request->input('contact.subtitle.ar')
            ],
            'button' => [
                'en' => $request->input('contact.button.en'),
                'ar' => $request->input('contact.button.ar')
            ]
        ];
    }
}

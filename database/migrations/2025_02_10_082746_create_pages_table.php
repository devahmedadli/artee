<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->json('name')->default(json_encode([
                'en' => 'Home',
                'ar' => 'الرئيسية'
            ]));
            $table->string('slug')->unique();
            $table->json('description')->default(json_encode([
                'en' => 'Home Description',
                'ar' => 'وصف الرئيسية'
            ]));
            $table->json('sections')->default(json_encode([
                'hero' => [
                    'title' => [
                        'en' => '',
                        'ar' => ''
                    ],
                    'subtitle' => [
                        'en' => '',
                        'ar' => ''
                    ],
                    'button' => [
                        'en' => '',
                        'ar' => ''
                    ],
                    'background' => '',
                ],
                'how_it_works' => [
                    'title' => [
                        'en' => '',
                        'ar' => ''
                    ],
                    'subtitle' => [
                        'en' => '',
                        'ar' => ''
                    ],
                    'step_1' => [
                        'title' => [
                            'en' => '',
                            'ar' => ''
                        ],
                        'subtitle' => [
                            'en' => '',
                            'ar' => ''
                        ],
                    ],
                    'step_2' => [
                        'title' => [
                            'en' => '',
                            'ar' => ''
                        ],
                        'subtitle' => [
                            'en' => '',
                            'ar' => ''
                        ],
                    ],
                    'step_3' => [
                        'title' => [
                            'en' => '',
                            'ar' => ''
                        ],
                        'subtitle' => [
                            'en' => '',
                            'ar' => ''
                        ],
                    ],
                    'step_4' => [
                        'title' => [
                            'en' => '',
                            'ar' => ''
                        ],
                        'subtitle' => [
                            'en' => '',
                            'ar' => ''
                        ],
                    ]
                ],
                'features' => [
                    'title' => [
                        'en' => '',
                        'ar' => ''
                    ],
                    'subtitle' => [
                        'en' => '',
                        'ar' => ''
                    ],
                    'feature_1' => [
                        'title' => [
                            'en' => '',
                            'ar' => ''
                        ],
                        'subtitle' => [
                            'en' => '',
                            'ar' => ''
                        ],
                    ],
                    'feature_2' => [
                        'title' => [
                            'en' => '',
                            'ar' => ''
                        ],
                        'subtitle' => [
                            'en' => '',
                            'ar' => ''
                        ],
                    ],
                    'feature_3' => [
                        'title' => [
                            'en' => '',
                            'ar' => ''
                        ],
                        'subtitle' => [
                            'en' => '',
                            'ar' => ''
                        ],
                    ],
                    'feature_4' => [
                        'title' => [
                            'en' => '',
                            'ar' => ''
                        ],
                        'subtitle' => [
                            'en' => '',
                            'ar' => ''
                        ],
                    ],
                ],
                'services' => [
                    'title' => [
                        'en' => '',
                        'ar' => ''
                    ],
                    'subtitle' => [
                        'en' => '',
                        'ar' => ''
                    ],
                    'order_now' =>
                    [
                        'en' => '',
                        'ar' => ''
                    ],
                    'all_services' => [
                        'en' => '',
                        'ar' => ''
                    ],
                    'get_started' => [
                        'en' => '',
                        'ar' => ''
                    ],
                ],
                'counter' => [
                    'title' => [
                        'en' => '',
                        'ar' => ''
                    ],
                    'subtitle' => [
                        'en' => '',
                        'ar' => ''
                    ],
                    'counter_1' => [
                        'title' => [
                            'en' => '',
                            'ar' => ''
                        ],
                        'value' => 12,
                    ],
                    'counter_2' => [
                        'title' => [
                            'en' => '',
                            'ar' => ''
                        ],
                        'value' => 0,
                    ],
                    'counter_3' => [
                        'title' => [
                            'en' => '',
                            'ar' => ''
                        ],
                        'value' => 0,
                    ],
                    'counter_4' => [
                        'title' => [
                            'en' => '',
                            'ar' => ''
                        ],
                        'value' => 0,
                    ],
                ],
                'faqs' => [
                    'title' => [
                        'en' => '',
                        'ar' => ''
                    ],
                    'subtitle' => [
                        'en' => '',
                        'ar' => ''
                    ],
                    'faq_1' => [
                        'title' => [
                            'en' => '',
                            'ar' => ''
                        ],
                        'subtitle' => [
                            'en' => '',
                            'ar' => ''
                        ],
                    ],
                    'faq_2' => [
                        'title' => [
                            'en' => '',
                            'ar' => ''
                        ],
                        'subtitle' => [
                            'en' => '',
                            'ar' => ''
                        ],
                    ],
                    'faq_3' => [
                        'title' => [
                            'en' => '',
                            'ar' => ''
                        ],
                        'subtitle' => [
                            'en' => '',
                            'ar' => ''
                        ],
                    ],
                    'faq_4' => [
                        'title' => [
                            'en' => '',
                            'ar' => ''
                        ],
                        'subtitle' => [
                            'en' => '',
                            'ar' => ''
                        ],
                    ],
                ],
                'testimonials' => [
                    'title' => [
                        'en' => '',
                        'ar' => ''
                    ],
                    'subtitle' => [
                        'en' => '',
                        'ar' => ''
                    ],
                    'testimonial_1' => [
                        'title' => [
                            'en' => '',
                            'ar' => ''
                        ],
                        'text' => [
                            'en' => '',
                            'ar' => ''
                        ],
                        'image' => '',
                    ],
                    'testimonial_2' => [
                        'title' => [
                            'en' => '',
                            'ar' => ''
                        ],
                        'text' => [
                            'en' => '',
                            'ar' => ''
                        ],
                        'image' => '',
                    ],
                    'testimonial_3' => [
                        'title' => [
                            'en' => '',
                            'ar' => ''
                        ],
                        'text' => [
                            'en' => '',
                            'ar' => ''
                        ],
                        'image' => '',
                    ],
                ],
                'why_us' => [
                    'title' => [
                        'en' => '',
                        'ar' => ''
                    ],
                    'subtitle' => [
                        'en' => '',
                        'ar' => ''
                    ],
                    'why_us_1' => [
                        'title' => [
                            'en' => '',
                            'ar' => ''
                        ],
                        'text' => [
                            'en' => '',
                            'ar' => ''
                        ],
                    ],
                    'why_us_2' => [
                        'title' => [
                            'en' => '',
                            'ar' => ''
                        ],
                        'text' => [
                            'en' => '',
                            'ar' => ''
                        ],
                    ],
                    'why_us_3' => [
                        'title' => [
                            'en' => '',
                            'ar' => ''
                        ],
                        'text' => [
                            'en' => '',
                            'ar' => ''
                        ],
                    ],
                ],
                'get_started_now' => [
                    'title' => [
                        'en' => '',
                        'ar' => ''
                    ],
                    'subtitle' => [
                        'en' => '',
                        'ar' => ''
                    ],
                    'button' => [
                        'en' => '',
                        'ar' => ''
                    ],
                ],
                'contact' => [
                    'title' => [
                        'en' => '',
                        'ar' => ''
                    ],
                    'subtitle' => [
                        'en' => '',
                        'ar' => ''
                    ],
                    'button' => [
                        'en' => '',
                        'ar' => ''
                    ],
                ]
            ]));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};

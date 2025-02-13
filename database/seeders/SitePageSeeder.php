<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SitePageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'name' => [
                    'en' => 'Services',
                    'ar' => 'الخدمات'
                ],
                'slug' => 'services',
                'description' => [
                    'en' => 'Services Description',
                    'ar' => 'وصف الخدمات'
                ],
                'sections' => [
                    'hero' => [
                        'title' => [
                            'en' => 'Services',
                            'ar' => 'الخدمات'
                        ],
                        'subtitle' => [
                            'en' => 'Services Description',
                            'ar' => 'وصف الخدمات'
                        ],
                    ],
                ],
            ],
            [
                'name' => [
                    'en' => 'Products',
                    'ar' => 'المنتجات'
                ],
                'slug' => 'products',
                'description' => [
                    'en' => 'Products Description',
                    'ar' => 'وصف المنتجات'
                ],
                'sections' => [
                    'hero' => [
                        'title' => [
                            'en' => 'Products',
                            'ar' => 'المنتجات'
                        ],
                        'subtitle' => [
                            'en' => 'Products Description',
                            'ar' => 'وصف المنتجات'
                        ],
                    ],
                ],
            ],
            [
                'name' => [
                    'en' => 'Privacy Policy',
                    'ar' => 'سياسة الخصوصية'
                ],
                'slug' => 'privacy-policy',
                'description' => [
                    'en' => 'Privacy Policy Description',
                    'ar' => 'وصف سياسة الخصوصية'
                ],
                'sections' => [
                    'hero' => [
                        'title' => [
                            'en' => 'Privacy Policy',
                            'ar' => 'سياسة الخصوصية'
                        ],
                        'subtitle' => [
                            'en' => 'Privacy Policy Description',
                            'ar' => 'وصف سياسة الخصوصية'
                        ],
                    ],
                    'content' => [
                        'en' => 'Privacy Policy Content',
                        'ar' => 'محتوى سياسة الخصوصية'
                    ],
                ],
            ],
            [
                'name' => [
                    'en' => 'Terms of Service',
                    'ar' => 'الشروط والأحكام'
                ],
                'slug' => 'terms-of-service',
                'description' => [
                    'en' => 'Terms of Service Description',
                    'ar' => 'وصف الشروط والأحكام'
                ],
                'sections' => [
                    'hero' => [
                        'title' => [
                            'en' => 'Terms of Service',
                            'ar' => 'الشروط والأحكام'
                        ],
                        'subtitle' => [
                            'en' => 'Terms of Service Description',
                            'ar' => 'وصف الشروط والأحكام'
                        ],
                    ],
                    'content' => [
                        'en' => 'Terms of Service content',
                        'ar' => 'الشروط والأحكام '
                    ],
                ],
            ]
        ];

        foreach ($pages as $page) {
            Page::create($page);
        }
    }
}

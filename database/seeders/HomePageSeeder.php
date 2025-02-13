<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class HomePageSeeder extends Seeder
{
    public function run()
    {
        $page = Page::create([
            'name' => [
                'en' => 'Home',
                'ar' => 'الرئيسية'
            ],
            'slug' => 'home',
            'description' => [
                'en' => 'Home Description',
                'ar' => 'وصف الرئيسية'
            ],
            'sections' => [
                'hero' => [
                    'title' => [
                        'en' => 'Convert your dreams into reality with us',
                        'ar' => 'حول أحلامك إلى حقيقة معنا'
                    ],
                    'subtitle' => [
                        'en' => 'Join thousands of satisfied customers',
                        'ar' => 'انضم إلى آلاف العملاء الراضين'
                    ],
                    'button' => [
                        'en' => 'Get Started',
                        'ar' => 'ابدأ الآن'
                    ],
                    'background' => 'assets/imgs/hero.jpg',
                ],
                'how_it_works' => [
                    'title' => [
                        'en' => 'How It Works',
                        'ar' => 'كيف يعمل'
                    ],
                    'subtitle' => [
                        'en' => 'Simple steps to get started',
                        'ar' => 'خطوات بسيطة للبدء'
                    ],
                    'step_1' => [
                        'title' => [
                            'en' => 'Create an Account',
                            'ar' => 'إنشاء حساب'
                        ],
                        'subtitle' => [
                            'en' => 'Sign up for a free account and get access to our platform.',
                            'ar' => 'سجل للحصول على حساب مجاني واحصل على وصول إلى منصتنا.'
                        ],
                    ],
                    'step_2' => [
                        'title' => [
                            'en' => 'Complete Your Profile',
                            'ar' => 'أكمل ملفك الشخصي'
                        ],
                        'subtitle' => [
                            'en' => 'Fill in your details and preferences to personalize your experience.',
                            'ar' => 'املأ بياناتك وتفضيلاتك لتخصيص تجربتك.'
                        ],
                    ],
                    'step_3' => [
                        'title' => [
                            'en' => 'Browse Services',
                            'ar' => 'تصفح الخدمات'
                        ],
                        'subtitle' => [
                            'en' => 'Explore our wide range of services tailored to your needs.',
                            'ar' => 'استكشف مجموعتنا الواسعة من الخدمات المصممة لتلبية احتياجاتك.'
                        ],
                    ],
                    'step_4' => [
                        'title' => [
                            'en' => 'Start Using',
                            'ar' => 'ابدأ الاستخدام'
                        ],
                        'subtitle' => [
                            'en' => 'Begin using our platform and enjoy the benefits.',
                            'ar' => 'ابدأ في استخدام منصتنا واستمتع بالمزايا.'
                        ],
                    ],
                ],
                'services' => [
                    'title' => [
                        'en' => 'Our Services',
                        'ar' => 'خدماتنا'
                    ],
                    'subtitle' => [
                        'en' => 'Explore our range of professional services',
                        'ar' => 'استكشف مجموعة خدماتنا المهنية'
                    ],
                    'order_now' => [
                        'en' => 'Order Now',
                        'ar' => 'اطلب الآن'
                    ],
                    'all_services' => [
                        'en' => 'View All Services',
                        'ar' => 'عرض جميع الخدمات'
                    ],
                    'get_started' => [
                        'en' => 'Get Started',
                        'ar' => 'ابدأ الآن'
                    ],
                ],
                'features' => [
                    'title' => [
                        'en' => 'Why Choose Us',
                        'ar' => 'لماذا تختارنا'
                    ],
                    'subtitle' => [
                        'en' => 'Discover what makes us different',
                        'ar' => 'اكتشف ما يميزنا'
                    ],
                    'feature_1' => [
                        'title' => [
                            'en' => '24/7 Support',
                            'ar' => 'دعم على مدار الساعة'
                        ],
                        'subtitle' => [
                            'en' => 'Round-the-clock customer support to help you.',
                            'ar' => 'دعم العملاء على مدار الساعة لمساعدتك.'
                        ],
                    ],
                    'feature_2' => [
                        'title' => [
                            'en' => 'Secure Platform',
                            'ar' => 'منصة آمنة'
                        ],
                        'subtitle' => [
                            'en' => 'Your data is protected with enterprise-grade security.',
                            'ar' => 'بياناتك محمية بأمان على مستوى المؤسسات.'
                        ],
                    ],
                    'feature_3' => [
                        'title' => [
                            'en' => 'Easy to Use',
                            'ar' => 'سهل الاستخدام'
                        ],
                        'subtitle' => [
                            'en' => 'Intuitive interface designed for the best user experience.',
                            'ar' => 'واجهة بديهية مصممة لأفضل تجربة مستخدم.'
                        ],
                    ],
                    'feature_4' => [
                        'title' => [
                            'en' => 'Regular Updates',
                            'ar' => 'تحديثات منتظمة'
                        ],
                        'subtitle' => [
                            'en' => 'Continuous improvements and new features.',
                            'ar' => 'تحسينات مستمرة وميزات جديدة.'
                        ],
                    ],
                ],
                'counter' => [
                    'title' => [
                        'en' => 'Work in numbers',
                        'ar' => 'العمل بالأرقام'
                    ],
                    'subtitle' => [
                        'en' => 'Our achievements in numbers',
                        'ar' => 'إنجازاتنا بالأرقام'
                    ],
                    'counter_1' => [
                        'title' => [
                            'en' => 'Services',
                            'ar' => 'الخدمات'
                        ],
                        'value' => 12,
                    ],
                    'counter_2' => [
                        'title' => [
                            'en' => 'Orders',
                            'ar' => 'الطلبات'
                        ],
                        'value' => 520,
                    ],
                    'counter_3' => [
                        'title' => [
                            'en' => 'Completed Orders',
                            'ar' => 'الطلبات المكتملة'
                        ],
                        'value' => 500,
                    ],
                    'counter_4' => [
                        'title' => [
                            'en' => 'Clients',
                            'ar' => 'العملاء'
                        ],
                        'value' => 350,
                    ],
                ],
                'faqs' => [
                    'title' => [
                        'en' => 'Frequently Asked Questions',
                        'ar' => 'الأسئلة الشائعة'
                    ],
                    'subtitle' => [
                        'en' => 'Find answers to common questions',
                        'ar' => 'اعثر على إجابات للأسئلة الشائعة'
                    ],
                    'faq_1' => [
                        'title' => [
                            'en' => 'How do I get started?',
                            'ar' => 'كيف أبدأ؟'
                        ],
                        'subtitle' => [
                            'en' => 'Simply create an account and follow our easy setup process.',
                            'ar' => 'ما عليك سوى إنشاء حساب واتباع عملية الإعداد السهلة.'
                        ],
                    ],
                    'faq_2' => [
                        'title' => [
                            'en' => 'What payment methods do you accept?',
                            'ar' => 'ما هي طرق الدفع المقبولة؟'
                        ],
                        'subtitle' => [
                            'en' => 'We accept all major credit cards and online payment methods.',
                            'ar' => 'نقبل جميع بطاقات الائتمان الرئيسية وطرق الدفع عبر الإنترنت.'
                        ],
                    ],
                    'faq_3' => [
                        'title' => [
                            'en' => 'How long does delivery take?',
                            'ar' => 'كم تستغرق عملية التوصيل؟'
                        ],
                        'subtitle' => [
                            'en' => 'Delivery times vary by service, typically 2-5 business days.',
                            'ar' => 'تختلف مواعيد التسليم حسب الخدمة، عادةً من 2-5 أيام عمل.'
                        ],
                    ],
                    'faq_4' => [
                        'title' => [
                            'en' => 'Do you offer refunds?',
                            'ar' => 'هل تقدمون استرداد الأموال؟'
                        ],
                        'subtitle' => [
                            'en' => 'Yes, we offer refunds according to our refund policy.',
                            'ar' => 'نعم، نقدم استرداد الأموال وفقًا لسياسة الاسترداد لدينا.'
                        ],
                    ],
                ],
                'testimonials' => [
                    'title' => [
                        'en' => 'What Our Clients Say',
                        'ar' => 'ماذا يقول عملاؤنا'
                    ],
                    'subtitle' => [
                        'en' => 'Read testimonials from our satisfied customers',
                        'ar' => 'اقرأ شهادات عملائنا الراضين'
                    ],
                    'testimonial_1' => [
                        'title' => [
                            'en' => 'John Smith',
                            'ar' => 'جون سميث'
                        ],
                        'text' => [
                            'en' => 'Excellent service! The team was professional and delivered on time.',
                            'ar' => 'خدمة ممتازة! كان الفريق محترفًا وسلم في الوقت المحدد.'
                        ],
                        'image' => 'assets/imgs/testimonials/1.jpg',
                    ],
                    'testimonial_2' => [
                        'title' => [
                            'en' => 'Sarah Johnson',
                            'ar' => 'سارة جونسون'
                        ],
                        'text' => [
                            'en' => 'Great experience from start to finish. Highly recommended!',
                            'ar' => 'تجربة رائعة من البداية إلى النهاية. أوصي بشدة!'
                        ],
                        'image' => 'assets/imgs/testimonials/2.jpg',
                    ],
                    'testimonial_3' => [
                        'title' => [
                            'en' => 'Michael Brown',
                            'ar' => 'مايكل براون'
                        ],
                        'text' => [
                            'en' => 'Outstanding quality and customer service. Will definitely use again!',
                            'ar' => 'جودة وخدمة عملاء متميزة. سأستخدم الخدمة مرة أخرى بالتأكيد!'
                        ],
                        'image' => 'assets/imgs/testimonials/3.jpg',
                    ],
                ],
                'why_us' => [
                    'title' => [
                        'en' => 'Why Choose Our Services',
                        'ar' => 'لماذا تختار خدماتنا'
                    ],
                    'subtitle' => [
                        'en' => 'Discover the advantages of working with us',
                        'ar' => 'اكتشف مزايا العمل معنا'
                    ],
                    'why_us_1' => [
                        'title' => [
                            'en' => 'Expert Team',
                            'ar' => 'فريق خبير'
                        ],
                        'text' => [
                            'en' => 'Our team consists of industry professionals with years of experience.',
                            'ar' => 'يتكون فريقنا من محترفين في الصناعة لديهم سنوات من الخبرة.'
                        ],
                    ],
                    'why_us_2' => [
                        'title' => [
                            'en' => 'Quality Guaranteed',
                            'ar' => 'جودة مضمونة'
                        ],
                        'text' => [
                            'en' => 'We stand behind our work with a 100% satisfaction guarantee.',
                            'ar' => 'نحن نقف خلف عملنا بضمان رضا 100٪.'
                        ],
                    ],
                    'why_us_3' => [
                        'title' => [
                            'en' => 'Competitive Pricing',
                            'ar' => 'أسعار تنافسية'
                        ],
                        'text' => [
                            'en' => 'Get the best value for your money with our competitive rates.',
                            'ar' => 'احصل على أفضل قيمة مقابل أموالك مع أسعارنا التنافسية.'
                        ],
                    ],
                ],
                'get_started_now' => [
                    'title' => [
                        'en' => 'Get Started Now',
                        'ar' => 'ابدأ الآن'
                    ],
                    'subtitle' => [
                        'en' => 'Start your journey today and discover the power of our platform.',
                        'ar' => 'ابدأ رحلتك اليوم واكتشف قوة منصتنا.'
                    ],
                    'button' => [
                        'en' => 'Get Started',
                        'ar' => 'ابدأ الآن'
                    ],
                ],
                'contact' => [
                    'title' => [
                        'en' => 'Contact Us',
                        'ar' => 'اتصل بنا'
                    ],
                    'subtitle' => [
                        'en' => 'Have a question or need help? We\'re here to assist you.',
                        'ar' => 'هل لديك سؤال أو تحتاج إلى مساعدة؟ نحن هنا لمساعدتك.'
                    ],
                    'button' => [
                        'en' => 'Send Message',
                        'ar' => 'إرسال رسالة'
                    ],
                ],
            ],
        ]);
    }
}

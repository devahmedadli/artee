<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the home page with sample values
        Page::create([
            'name' => [
                'en' => 'Home',
                'ar' => 'الرئيسية'
            ],
            'slug' => 'home',
            'description' => [
                'en' => 'Welcome to our service platform',
                'ar' => 'مرحبًا بكم في منصة خدماتنا'
            ],
            'sections' => [
                'hero' => [
                    'title' => [
                        'en' => 'Your Trusted Service Provider',
                        'ar' => 'مزود الخدمة الموثوق به'
                    ],
                    'subtitle' => [
                        'en' => 'We offer high-quality services tailored to your needs',
                        'ar' => 'نقدم خدمات عالية الجودة مصممة خصيصًا لتلبية احتياجاتك'
                    ],
                    'button' => [
                        'en' => 'Get Started',
                        'ar' => 'ابدأ الآن'
                    ],
                    'background' => '',
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
                        'en' => 'All Services',
                        'ar' => 'جميع الخدمات'
                    ],
                    'get_started' => [
                        'en' => 'Get Started',
                        'ar' => 'ابدأ الآن'
                    ],
                ],
                'how_it_works' => [
                    'title' => [
                        'en' => 'How It Works',
                        'ar' => 'كيف يعمل'
                    ],
                    'subtitle' => [
                        'en' => 'Simple steps to get started with our services',
                        'ar' => 'خطوات بسيطة للبدء بخدماتنا'
                    ],
                    'step_1' => [
                        'title' => [
                            'en' => 'Create an Account',
                            'ar' => 'إنشاء حساب'
                        ],
                        'subtitle' => [
                            'en' => 'Sign up and complete your profile',
                            'ar' => 'قم بالتسجيل وإكمال ملفك الشخصي'
                        ],
                    ],
                    'step_2' => [
                        'title' => [
                            'en' => 'Choose a Service',
                            'ar' => 'اختر خدمة'
                        ],
                        'subtitle' => [
                            'en' => 'Browse our services and select what you need',
                            'ar' => 'تصفح خدماتنا واختر ما تحتاجه'
                        ],
                    ],
                    'step_3' => [
                        'title' => [
                            'en' => 'Place Your Order',
                            'ar' => 'ضع طلبك'
                        ],
                        'subtitle' => [
                            'en' => 'Provide details and confirm your order',
                            'ar' => 'قدم التفاصيل وأكد طلبك'
                        ],
                    ],
                    'step_4' => [
                        'title' => [
                            'en' => 'Receive Your Service',
                            'ar' => 'استلم خدمتك'
                        ],
                        'subtitle' => [
                            'en' => 'We deliver your service on time',
                            'ar' => 'نقدم خدمتك في الوقت المحدد'
                        ],
                    ]
                ],
                'features' => [
                    'title' => [
                        'en' => 'Our Features',
                        'ar' => 'مميزاتنا'
                    ],
                    'subtitle' => [
                        'en' => 'What makes our services stand out',
                        'ar' => 'ما يميز خدماتنا'
                    ],
                    'feature_1' => [
                        'title' => [
                            'en' => 'Quality Assurance',
                            'ar' => 'ضمان الجودة'
                        ],
                        'subtitle' => [
                            'en' => 'We ensure the highest quality standards',
                            'ar' => 'نضمن أعلى معايير الجودة'
                        ],
                    ],
                    'feature_2' => [
                        'title' => [
                            'en' => 'Fast Delivery',
                            'ar' => 'توصيل سريع'
                        ],
                        'subtitle' => [
                            'en' => 'Quick turnaround times for all services',
                            'ar' => 'أوقات إنجاز سريعة لجميع الخدمات'
                        ],
                    ],
                    'feature_3' => [
                        'title' => [
                            'en' => 'Expert Team',
                            'ar' => 'فريق خبير'
                        ],
                        'subtitle' => [
                            'en' => 'Skilled professionals at your service',
                            'ar' => 'محترفون مهرة في خدمتك'
                        ],
                    ],
                    'feature_4' => [
                        'title' => [
                            'en' => 'Customer Support',
                            'ar' => 'دعم العملاء'
                        ],
                        'subtitle' => [
                            'en' => '24/7 assistance for all your queries',
                            'ar' => 'مساعدة على مدار الساعة لجميع استفساراتك'
                        ],
                    ],
                ],
                'counter' => [
                    'title' => [
                        'en' => 'Our Achievements',
                        'ar' => 'إنجازاتنا'
                    ],
                    'subtitle' => [
                        'en' => 'Numbers that speak for themselves',
                        'ar' => 'أرقام تتحدث عن نفسها'
                    ],
                    'counter_1' => [
                        'title' => [
                            'en' => 'Happy Clients',
                            'ar' => 'عملاء سعداء'
                        ],
                        'value' => 1500,
                    ],
                    'counter_2' => [
                        'title' => [
                            'en' => 'Projects Completed',
                            'ar' => 'مشاريع منجزة'
                        ],
                        'value' => 3200,
                    ],
                    'counter_3' => [
                        'title' => [
                            'en' => 'Team Members',
                            'ar' => 'أعضاء الفريق'
                        ],
                        'value' => 50,
                    ],
                    'counter_4' => [
                        'title' => [
                            'en' => 'Awards Won',
                            'ar' => 'جوائز محققة'
                        ],
                        'value' => 25,
                    ],
                ],
                'faqs' => [
                    'title' => [
                        'en' => 'Frequently Asked Questions',
                        'ar' => 'الأسئلة الشائعة'
                    ],
                    'subtitle' => [
                        'en' => 'Find answers to common questions about our services',
                        'ar' => 'اعثر على إجابات للأسئلة الشائعة حول خدماتنا'
                    ],
                    'faq_1' => [
                        'title' => [
                            'en' => 'How do I place an order?',
                            'ar' => 'كيف أقوم بتقديم طلب؟'
                        ],
                        'subtitle' => [
                            'en' => 'You can place an order by creating an account, selecting a service, and following the checkout process.',
                            'ar' => 'يمكنك تقديم طلب عن طريق إنشاء حساب، واختيار خدمة، واتباع عملية الدفع.'
                        ],
                    ],
                    'faq_2' => [
                        'title' => [
                            'en' => 'What payment methods do you accept?',
                            'ar' => 'ما هي طرق الدفع التي تقبلونها؟'
                        ],
                        'subtitle' => [
                            'en' => 'We accept credit cards, debit cards, and bank transfers. All payments are secure and encrypted.',
                            'ar' => 'نقبل بطاقات الائتمان، وبطاقات الخصم، والتحويلات المصرفية. جميع المدفوعات آمنة ومشفرة.'
                        ],
                    ],
                    'faq_3' => [
                        'title' => [
                            'en' => 'How long does delivery take?',
                            'ar' => 'كم من الوقت يستغرق التسليم؟'
                        ],
                        'subtitle' => [
                            'en' => 'Delivery times vary depending on the service. You can find the estimated delivery time on each service page.',
                            'ar' => 'تختلف أوقات التسليم حسب الخدمة. يمكنك العثور على وقت التسليم المقدر على صفحة كل خدمة.'
                        ],
                    ],
                    'faq_4' => [
                        'title' => [
                            'en' => 'Can I request revisions?',
                            'ar' => 'هل يمكنني طلب مراجعات؟'
                        ],
                        'subtitle' => [
                            'en' => 'Yes, we offer revisions to ensure your complete satisfaction with our services.',
                            'ar' => 'نعم، نقدم مراجعات لضمان رضاك التام عن خدماتنا.'
                        ],
                    ],
                ],
                'testimonials' => [
                    'title' => [
                        'en' => 'Client Testimonials',
                        'ar' => 'شهادات العملاء'
                    ],
                    'subtitle' => [
                        'en' => 'What our clients say about us',
                        'ar' => 'ما يقوله عملاؤنا عنا'
                    ],
                    'testimonial_1' => [
                        'title' => [
                            'en' => 'John Smith',
                            'ar' => 'جون سميث'
                        ],
                        'text' => [
                            'en' => 'The service was excellent and delivered on time. I highly recommend this platform.',
                            'ar' => 'كانت الخدمة ممتازة وتم تسليمها في الوقت المحدد. أوصي بشدة بهذه المنصة.'
                        ],
                        'image' => '',
                    ],
                    'testimonial_2' => [
                        'title' => [
                            'en' => 'Sarah Johnson',
                            'ar' => 'سارة جونسون'
                        ],
                        'text' => [
                            'en' => 'Professional team and outstanding quality. Will definitely use their services again.',
                            'ar' => 'فريق محترف وجودة متميزة. سأستخدم خدماتهم مرة أخرى بالتأكيد.'
                        ],
                        'image' => '',
                    ],
                    'testimonial_3' => [
                        'title' => [
                            'en' => 'Mohammed Ali',
                            'ar' => 'محمد علي'
                        ],
                        'text' => [
                            'en' => 'Great communication and exceptional results. The team went above and beyond my expectations.',
                            'ar' => 'تواصل رائع ونتائج استثنائية. تجاوز الفريق توقعاتي.'
                        ],
                        'image' => '',
                    ],
                ],
                'why_us' => [
                    'title' => [
                        'en' => 'Why Choose Us',
                        'ar' => 'لماذا تختارنا'
                    ],
                    'subtitle' => [
                        'en' => 'Reasons to trust our services',
                        'ar' => 'أسباب الثقة بخدماتنا'
                    ],
                    'why_us_1' => [
                        'title' => [
                            'en' => 'Experienced Team',
                            'ar' => 'فريق ذو خبرة'
                        ],
                        'text' => [
                            'en' => 'Our team consists of experienced professionals with years of industry expertise.',
                            'ar' => 'يتكون فريقنا من محترفين ذوي خبرة مع سنوات من الخبرة في المجال.'
                        ],
                    ],
                    'why_us_2' => [
                        'title' => [
                            'en' => 'Quality Guarantee',
                            'ar' => 'ضمان الجودة'
                        ],
                        'text' => [
                            'en' => 'We guarantee the quality of our work and offer revisions until you are satisfied.',
                            'ar' => 'نضمن جودة عملنا ونقدم مراجعات حتى تكون راضيًا.'
                        ],
                    ],
                    'why_us_3' => [
                        'title' => [
                            'en' => 'Competitive Pricing',
                            'ar' => 'أسعار تنافسية'
                        ],
                        'text' => [
                            'en' => 'We offer competitive prices without compromising on quality or service.',
                            'ar' => 'نقدم أسعارًا تنافسية دون المساومة على الجودة أو الخدمة.'
                        ],
                    ],
                ],
                'get_started_now' => [
                    'title' => [
                        'en' => 'Ready to Get Started?',
                        'ar' => 'هل أنت مستعد للبدء؟'
                    ],
                    'subtitle' => [
                        'en' => 'Join thousands of satisfied customers today',
                        'ar' => 'انضم إلى آلاف العملاء الراضين اليوم'
                    ],
                    'button' => [
                        'en' => 'Start Now',
                        'ar' => 'ابدأ الآن'
                    ],
                ],
                'contact' => [
                    'title' => [
                        'en' => 'Contact Us',
                        'ar' => 'اتصل بنا'
                    ],
                    'subtitle' => [
                        'en' => 'Have questions? We\'re here to help',
                        'ar' => 'لديك أسئلة؟ نحن هنا للمساعدة'
                    ],
                    'button' => [
                        'en' => 'Send Message',
                        'ar' => 'إرسال رسالة'
                    ],
                ]
            ]
        ]);
    }
} 
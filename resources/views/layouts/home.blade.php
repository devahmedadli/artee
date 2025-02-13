<!DOCTYPE html>
<html lang="{{ app()->currentLocale() }}" dir="{{ session('locale') == 'en' ? 'ltr' : 'rtl' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artee | @yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    @if (app()->currentLocale() == 'en')
        <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap"
            rel="stylesheet">
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css'
            integrity='sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg=='
            crossorigin='anonymous' />
    @else
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">

        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.rtl.min.css'
            integrity='sha512-VNBisELNHh6+nfDjsFXDA6WgXEZm8cfTEcMtfOZdx0XTRoRbr/6Eqb2BjqxF4sNFzdvGIt+WqxKgn0DSfh2kcA=='
            crossorigin='anonymous' />
    @endif
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">

    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css'
        integrity='sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=='
        crossorigin='anonymous' />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css"
        integrity="sha512-1cK78a1o+ht2JcaW6g8OXYwqpev9+6GqOkz9xmBN9iUUhIndKtxwILGWYOSibOKjLsEdjyjZvYDq/cZwNeak0w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
    <!-- Moyasar Styles -->
    <link rel="stylesheet" href="https://cdn.moyasar.com/mpf/1.14.0/moyasar.css" />

    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    @yield('page-styles')
    <style>
        :root {
            --color-main: {{ $siteSettings->colors['primary'] }};
            --color-main-dark: {{ $siteSettings->colors['primary-dark'] }};
            --color-secondary: {{ $siteSettings->colors['secondary'] }};
            --color-secondary-dark: {{ $siteSettings->colors['secondary-dark'] }};
            --color-tertiary: {{ $siteSettings->colors['tertiary'] }};
            --color-tertiary-dark: {{ $siteSettings->colors['tertiary-dark'] }};
        }
    </style>
</head>

<body>

    <!-- Preloader -->
    <div id="preloader">
        <div class="spinner"></div>
    </div>

    @if (!request()->routeIs('customer.chats') && !request()->is('chat/*'))
        <!-- Navbar -->
        <nav class="fw-semibold w-100 position-fixed start-0 end-0 py-3" style="z-index: 1010;max-height:80px">
            <div class="container d-flex justify-content-between align-items-center">
                <a href="{{ route('index') }}" class="d-inline-block p-md-0 py-1 fs-5">
                    {{-- <span>{{ app()->currentLocale() . session('locale') }}</span> --}}
                    <img src="{{ asset($siteSettings->logo ? 'storage/' . $siteSettings->logo : 'assets/imgs/logo-nav.png') }}"
                        alt="Artee Logo" class="img-fluid" width="60">
                </a>
                <ul
                    class="nav-links nav-underline d-flex justify-content-center align-items-center list-unstyled m-0 d-none d-md-flex">
                    <li class="nav-link mx-md-2"><a href="{{ route('index') }}">{{ __('Home') }}</a></li>
                    @if (auth()->check() && auth()->user()->role == 'customer')
                        <li class="nav-link mx-md-2">
                            <a href="{{ route('customer.orders.index') }}">
                                {{ __('Orders') }}
                            </a>
                        </li>
                        <li class="nav-link mx-md-2">
                            <a href="{{ route('customer.chats') }}">
                                {{ __('Live Chat') }}
                            </a>
                        </li>
                    @endif
                    <li class="nav-link mx-md-2"><a href="{{ route('index') }}#services">{{ __('Services') }}</a></li>
                    <li class="nav-link mx-md-2"><a href="{{ route('products') }}">{{ __('Products') }}</a></li>
                    <li class="nav-link mx-md-2"><a href="{{ route('index') }}#contact-us">{{ __('Contact Us') }}</a>
                    </li>
                </ul>

                <ul
                    class="nav-links d-flex justify-content-center align-items-center list-unstyled m-0 d-none d-md-flex">
                    @if (auth()->check() && auth()->user()->role == 'customer')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle position-relative" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('assets/imgs/avatar.png') }}"
                                    alt="User Avatar" class="rounded-circle bg-white" width="32" height="32">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0"
                                aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('customer.account') }}"><i
                                            class="fas fa-cog me-2"></i>{{ __('Account') }}</a></li>
                                <li>
                                    <a href="{{ route('logout.post') }}" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt me-2"></i>
                                        {{ __('Logout') }}
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-link mx-md-2"><a href="{{ route('login') }}"
                                class="btn btn-main">{{ __('Login') }}</a>
                        </li>
                        <li class="nav-link mx-md-2"><a href="{{ route('register') }}"
                                class="btn btn-warning fw-bold">{{ __('Register') }}</a></li>
                    @endif
                </ul>
                <a class="text-dark fw-semi-bold p-2 d-md-none d-inline-block" href="javascript:void(0)"
                    data-bs-toggle="offcanvas" data-bs-target="#mSidebarCanvas" aria-controls="mSidebarCanvas">
                    <i class="fa-solid fa-bars fs-5"></i>
                </a>
                @include('partials.__m-sidebar')

            </div>
        </nav>
    @endif

    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer py-5 bg-main">
        <div class="container">
            <div class="row mb-4">
                <!-- Company Info -->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <img src="{{ asset($siteSettings->logo ? 'storage/' . $siteSettings->logo : 'assets/imgs/logo-nav.png') }}"
                        alt="Artee Logo" class="img-fluid mb-3" width="100">
                    <p class="text-white mb-3">
                        {{ __('Your trusted partner for innovative solutions and quality services.') }}</p>
                    <div class="social-links">
                        @if (isset($siteSettings->social_media['facebook']))
                            <a href="{{ $siteSettings->social_media['facebook'] }}" target="_blank"
                                class="text-white me-2"><i class="fab fa-facebook-f"></i></a>
                        @endif
                        @if (isset($siteSettings->social_media['twitter']))
                            <a href="{{ $siteSettings->social_media['twitter'] }}" target="_blank"
                                class="text-white me-2"><i class="fab fa-twitter"></i></a>
                        @endif
                        @if (isset($siteSettings->social_media['instagram']))
                            <a href="{{ $siteSettings->social_media['instagram'] }}" target="_blank"
                                class="text-white me-2"><i class="fab fa-instagram"></i></a>
                        @endif
                        @if (isset($siteSettings->social_media['linkedin']))
                            <a href="{{ $siteSettings->social_media['linkedin'] }}" target="_blank"
                                class="text-white"><i class="fab fa-linkedin-in"></i></a>
                        @endif
                        @if (isset($siteSettings->social_media['youtube']))
                            <a href="{{ $siteSettings->social_media['youtube'] }}" target="_blank"
                                class="text-white"><i class="fab fa-youtube"></i></a>
                        @endif
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-white mb-3">{{ __('Quick Links') }}</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('index') }}"
                                class="text-white">{{ __('Home') }}</a></li>
                        <li class="mb-2"><a href="{{ route('products') }}"
                                class="text-white">{{ __('Products') }}</a></li>
                        <li class="mb-2"><a href="{{ route('index') }}#services"
                                class="text-white">{{ __('Services') }}</a></li>
                        <li class="mb-2"><a href="{{ route('index') }}#contact-us"
                                class="text-white">{{ __('Contact Us') }}</a></li>
                    </ul>
                </div>

                <!-- Services -->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-white mb-3">{{ __('Our Services') }}</h5>
                    @php
                        $services = \App\Models\Service::take(4)->get();
                    @endphp
                    <ul class="list-unstyled">
                        @foreach ($services as $service)
                            <li class="mb-2"><a href="{{ route('services', $service->id) }}"
                                    class="text-white">{{ $service->name }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-3">{{ __('Contact Information') }}</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2 text-white"><i class="fas fa-map-marker-alt me-2"></i>
                            {{ $siteSettings->contact['address'] }}</li>
                        <li class="mb-2"><a href="tel:+ {{ $siteSettings->contact['phone'] }}"
                                class="text-white"><i class="fas fa-phone me-2"></i>
                                {{ $siteSettings->contact['phone'] }}</a></li>
                        <li class="mb-2"><a href="mailto:{{ $siteSettings->contact['email'] }}"
                                class="text-white"><i class="fas fa-envelope me-2"></i>
                                {{ $siteSettings->contact['email'] }}</a></li>
                    </ul>
                </div>
            </div>

            <hr class="border-white opacity-25">

            <!-- Bottom Footer -->
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <p class="text-white mb-0">&copy; {{ date('Y') }} {{ __('Artee. All Rights Reserved.') }}</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="{{ route('terms-conditions') }}"
                        class="text-white me-3">{{ __('Terms of Service') }}</a>
                    <a href="{{ route('privacy') }}" class="text-white me-3">{{ __('Privacy Policy') }}</a>
                    <a href="{{ route('index') }}#contact-us" class="text-white">{{ __('Contact Us') }}</a>
                </div>
            </div>
        </div>
    </footer>
    {{-- Language Swapping --}}
    <div class="lang-swap position-fixed end-0 bottom-0" style="z-index: 99999999999">
        <a href="{{ app()->currentLocale() === 'en' ? route('langSwape', 'ar') : route('langSwape', 'en') }}"
            class="btn btn-warning fw-semibold me-3 mb-3">
            {{ app()->currentLocale() === 'en' ? 'عربي' : 'English' }}
        </a>
    </div>
    <!-- Scripts -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js'
        integrity='sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=='
        crossorigin='anonymous'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js'
        integrity='sha512-7Pi/otdlbbCR+LnW+F7PwFcSDJOuUJB3OxtEHbg4vSMvzvJjde4Po1v4BR9Gdc9aXNUNFVUY+SK51wWT8WF0Gg=='
        crossorigin='anonymous'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"
        integrity="sha512-A7AYk1fGKX6S2SsHywmPkrnzTZHrgiVT7GcQkLGDe2ev0aWb8zejytzS8wjo7PGEXKqJOrjQ4oORtnimIRZBtw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            window.addEventListener("load", function() {
                var preloader = document.getElementById("preloader");
                var content = document.querySelector("main");
                var nav = document.querySelector("nav");

                // Hide the preloader
                preloader.style.display = "none";

                // Show the content
                content.style.display = "block";
                nav.style.display = "block";
            });
        });
    </script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    @yield('page-scripts')

</body>

</html>

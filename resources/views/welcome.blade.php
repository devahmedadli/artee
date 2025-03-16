@extends('layouts.home')
@section('title', $pageContent['name'][$locale])

@section('content')
    <header class="overflow-x-hidden">
        <div class="hero 100 bg-light container-fluid p-3"
            style="background-image: url({{ asset('storage/' . $pageContent['sections']['hero']['background']) }}); background-size: cover; background-position: center;">
            <div class="row min-vh-100 justify-content-center align-items-center">
                <div class="col-md-7 col-lg-8 d-flex justify-content-center">
                    <div class="hero-text text-center position-relative">
                        <!-- Radial Gradient Circles -->
                        <h1 class="mb-5 fw-bolder mx-auto" style="font-size: 3.3rem;max-width:800px">
                            {{ $pageContent['sections']['hero']['title'][$locale] }}
                        </h1>
                        <h4 class="mb-5 mx-auto text-muted " style="max-width:600px">
                            {{ $pageContent['sections']['hero']['subtitle'][$locale] }}
                        </h4>
                        <div class="get-started-btn text-center">
                            <a href="{{ route('register') }}"
                                class="btn btn-main rounded-3 fw-semibold px-3 py-2">{{ $pageContent['sections']['hero']['button'][$locale] }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main class="overflow-x-hidden">
        <!-- How It Works Section -->
        <section id="how-it-works" class="how-it-works-section text-center py-5">
            <div class="container">
                <h2>{{ $pageContent['sections']['how_it_works']['title'][$locale] }}</h2>
                <p>{{ $pageContent['sections']['how_it_works']['subtitle'][$locale] }}</p>
                <div class="row">
                    <div class="col-md-6 mb-5">
                        <div class="step-icon mb-4">
                            <img src="{{ asset('assets/imgs/steps/one.png') }}" alt="{{ __('Step 1') }}" class="img-fluid">
                        </div>
                        <h4>{{ $pageContent['sections']['how_it_works']['step_1']['title'][$locale] }}</h4>
                        <p>{{ $pageContent['sections']['how_it_works']['step_1']['subtitle'][$locale] }}</p>
                    </div>
                    <div class="col-md-6 mb-5">
                        <div class="step-icon mb-4">
                            <img src="{{ asset('assets/imgs/steps/two.png') }}" alt="{{ __('Step 2') }}"
                                class="img-fluid">
                        </div>
                        <h4>{{ $pageContent['sections']['how_it_works']['step_2']['title'][$locale] }}</h4>
                        <p>{{ $pageContent['sections']['how_it_works']['step_2']['subtitle'][$locale] }}</p>
                    </div>
                    <div class="col-md-6 mb-5">
                        <div class="step-icon mb-4">
                            <img src="{{ asset('assets/imgs/steps/three.png') }}" alt="{{ __('Step 3') }}"
                                class="img-fluid">
                        </div>
                        <h4>{{ $pageContent['sections']['how_it_works']['step_3']['title'][$locale] }}</h4>
                        <p>{{ $pageContent['sections']['how_it_works']['step_3']['subtitle'][$locale] }}</p>
                    </div>
                    <div class="col-md-6 mb-5">
                        <div class="step-icon mb-4">
                            <img src="{{ asset('assets/imgs/steps/four.png') }}" alt="{{ __('Step 4') }}"
                                class="img-fluid">
                        </div>
                        <h4>{{ $pageContent['sections']['how_it_works']['step_4']['title'][$locale] }}</h4>
                        <p>{{ $pageContent['sections']['how_it_works']['step_4']['subtitle'][$locale] }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="features-section bg-light py-5">
            <div class="container">
                <h2 class="text-center mb-4">{{ $pageContent['sections']['features']['title'][$locale] }}</h2>
                <p>{{ $pageContent['sections']['features']['subtitle'][$locale] }}</p>
                <div class="row text-center">
                    <div class="col-md-6 my-5">
                        <div class="mb-4">
                            <i class="bi bi-box-seam fs-1 mb-5"></i>
                        </div>
                        <h4>{{ $pageContent['sections']['features']['feature_1']['title'][$locale] }}</h4>
                        <p>{{ $pageContent['sections']['features']['feature_1']['subtitle'][$locale] }}</p>
                    </div>
                    <div class="col-md-6 my-5">
                        <div class="mb-4">
                            <i class="bi bi-shield-check fs-1 mb-5"></i>
                        </div>
                        <h4>{{ $pageContent['sections']['features']['feature_2']['title'][$locale] }}</h4>
                        <p>{{ $pageContent['sections']['features']['feature_2']['subtitle'][$locale] }}</p>
                    </div>
                    <div class="col-md-6 my-5">
                        <div class="mb-4">
                            <i class="bi bi-telephone fs-1 mb-5"></i>
                        </div>
                        <h4>{{ $pageContent['sections']['features']['feature_3']['title'][$locale] }}</h4>
                        <p>{{ $pageContent['sections']['features']['feature_3']['subtitle'][$locale] }}</p>
                    </div>
                    <div class="col-md-6 my-5">
                        <div class="mb-4">
                            <i class="bi bi-star fs-1 mb-5"></i>
                        </div>
                        <h4>{{ $pageContent['sections']['features']['feature_4']['title'][$locale] }}</h4>
                        <p>{{ $pageContent['sections']['features']['feature_4']['subtitle'][$locale] }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Counter Section -->
        <section id="counter" class="counter-area bg-main text-white py-5">
            <div class="container py-5">
                <h2 class="text-center mb-4">{{  $pageContent['sections']['counter']['title'][$locale] }}</h2>
                <p>{{ $pageContent['sections']['counter']['subtitle'][$locale] }}</p>
                <div class="row py-5">
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
                        <div class="counter-item text-center">
                            <h2 class="number fs-1 fw-bold">
                                <span class="sm-text">+</span>
                                <span class="count">{{ $pageContent['sections']['counter']['counter_1']['value'] }}</span>
                            </h2>
                            <h6>{{ $pageContent['sections']['counter']['counter_1']['title'][$locale] }}</h6>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
                        <div class="counter-item text-center">
                            <h2 class="number fs-1 fw-bold">
                                <span class="sm-text">+</span>
                                <span class="count">{{ $pageContent['sections']['counter']['counter_2']['value'] }}</span>
                            </h2>
                            <h6>{{ $pageContent['sections']['counter']['counter_2']['title'][$locale] }}</h6>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
                        <div class="counter-item text-center">
                            <h2 class="number fs-1 fw-bold">
                                <span class="sm-text">+</span>
                                <span class="count">{{ $pageContent['sections']['counter']['counter_3']['value']}}</span>
                            </h2>
                            <h6>{{ $pageContent['sections']['counter']['counter_3']['title'][$locale] }}</h6>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
                        <div class="counter-item text-center">
                            <h2 class="number fs-1 fw-bold">
                                <span class="sm-text">+</span>
                                <span class="count">{{ $pageContent['sections']['counter']['counter_4']['value'] }}</span>
                            </h2>
                            <h6>{{ $pageContent['sections']['counter']['counter_4']['title'][$locale] }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section id="testimonials" class="testimonials-section py-5">
            <div class="container">
                {{-- @dd($pageContent['sections']['testimonials']['components']) --}}
                <h2 class="text-center mb-4">{{ $pageContent['sections']['testimonials']['title'][$locale] }}</h2>
                <p>{{ $pageContent['sections']['testimonials']['subtitle'][$locale] }}</p>
                <div id="testimonialsCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="d-flex justify-content-center">
                                <div class="d-flex overflow-auto">
                                    <div class="card border-0 shadow-sm text-center mx-2"
                                        style="flex: 0 0 auto; max-width: 300px;">
                                        <div class="card-body">
                                            <img src="{{ asset('storage/' . $pageContent['sections']['testimonials']['testimonial_1']['image']) }}"
                                            alt="{{ $pageContent['sections']['testimonials']['testimonial_1']['title'][$locale] }}"
                                                class="rounded-circle mb-3"
                                                style="width: 80px; height: 80px; object-fit: cover;">
                                            <h5 class="card-title">{{ $pageContent['sections']['testimonials']['testimonial_1']['title'][$locale] }}</h5>
                                            <p class="card-text">"{{ $pageContent['sections']['testimonials']['testimonial_1']['text'][$locale] }}"</p>
                                        </div>
                                    </div>
                                    <div class="card border-0 shadow-sm text-center mx-2"
                                        style="flex: 0 0 auto; max-width: 300px;">
                                        <div class="card-body">
                                            <img src="{{ asset('storage/' . $pageContent['sections']['testimonials']['testimonial_2']['image']) }}"
                                            alt="{{ $pageContent['sections']['testimonials']['testimonial_2']['title'][$locale] }}"
                                                class="rounded-circle mb-3"
                                                style="width: 80px; height: 80px; object-fit: cover;">
                                            <h5 class="card-title">{{ $pageContent['sections']['testimonials']['testimonial_2']['title'][$locale] }}</h5>
                                            <p class="card-text">"{{ $pageContent['sections']['testimonials']['testimonial_2']['text'][$locale] }}"</p>
                                        </div>
                                    </div>
                                    <div class="card border-0 shadow-sm text-center mx-2"
                                        style="flex: 0 0 auto; max-width: 300px;">
                                        <div class="card-body">
                                            <img src="{{ asset('storage/' . $pageContent['sections']['testimonials']['testimonial_3']['image']) }}"
                                            alt="{{ $pageContent['sections']['testimonials']['testimonial_3']['title'][$locale] }}"
                                                class="rounded-circle mb-3"
                                                style="width: 80px; height: 80px; object-fit: cover;">
                                            <h5 class="card-title">{{ $pageContent['sections']['testimonials']['testimonial_3']['title'][$locale] }}</h5>
                                            <p class="card-text">"{{ $pageContent['sections']['testimonials']['testimonial_3']['text'][$locale] }}"</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Add more carousel-item divs here if you have more content -->
                    </div>
                    </a>

                </div>
            </div>
        </section>
        {{-- Why Choose Us Section --}}
        <section id="why-choose-us" class="why-choose-us-section py-5 bg-light">
            <div class="container">
                <h2 class="text-center mb-5">{{ $pageContent['sections']['why_us']['title'][$locale] }}</h2>
                <p>{{ $pageContent['sections']['why_us']['subtitle'][$locale] }}</p>
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6">
                        <div class="choice-card bg-white rounded-4 p-4 shadow-sm h-100">
                            <div class="d-flex align-items-center mb-4">
                                <div class="icon-wrapper me-3">
                                    <i class="bi bi-shield-check text-primary fs-1"></i>
                                </div>
                                <h4 class="mb-0">{{ $pageContent['sections']['why_us']['why_us_1']['title'][$locale] }}</h4>
                            </div>
                            <p class="text-muted mb-0">
                                {{ $pageContent['sections']['why_us']['why_us_1']['text'][$locale] }}
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="choice-card bg-white rounded-4 p-4 shadow-sm h-100">
                            <div class="d-flex align-items-center mb-4">
                                <div class="icon-wrapper me-3">
                                    <i class="bi bi-lightning-charge text-warning fs-1"></i>
                                </div>
                                <h4 class="mb-0">{{ $pageContent['sections']['why_us']['why_us_2']['title'][$locale] }}</h4>
                            </div>
                            <p class="text-muted mb-0">
                                {{ $pageContent['sections']['why_us']['why_us_2']['text'][$locale] }}
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="choice-card bg-white rounded-4 p-4 shadow-sm h-100">
                            <div class="d-flex align-items-center mb-4">
                                <div class="icon-wrapper me-3">
                                    <i class="bi bi-headset text-success fs-1"></i>
                                </div>
                                <h4 class="mb-0">{{ $pageContent['sections']['why_us']['why_us_3']['title'][$locale] }}</h4>
                            </div>
                            <p class="text-muted mb-0">
                                {{ $pageContent['sections']['why_us']['why_us_3']['text'][$locale] }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Services Section -->
        <section id="services" class="services-section py-5">
            <div class="container">
                <h2 class="text-center mb-4">{{ $pageContent['sections']['services']['title'][$locale] }}</h2>
                <p class="text-center mb-5">
                    {{ $pageContent['sections']['services']['subtitle'][$locale] }}
                </p>
                <div class="row text-center">
                    @foreach ($services as $service)
                        <div class="col-md-4 mb-4">
                            <div class="service-icon mb-3">
                                <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}"
                                    class="img-fluid">
                            </div>
                            <h4 class="mb-3">{{ $service->{app()->getLocale() . '_name'} }}</h4>
                            <p>{{ $service->{app()->getLocale() . '_description'} }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-4">
                    @auth
                        <button type="button" class="btn btn-main" data-bs-toggle="modal" data-bs-target="#orderModal">
                            {{ $pageContent['sections']['services']['get_started'][$locale] }}
                        </button>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-main">
                            {{ $pageContent['sections']['services']['order_now'][$locale] }}
                        </a>
                    @endauth
                    <a href="{{ route('services') }}" class="btn btn-outline-main">
                        {{ $pageContent['sections']['services']['all_services'][$locale] }}
                    </a>
                </div>
            </div>
        </section>

        <!-- Order Modal -->
        <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="orderModalLabel">{{ __('Place an Order') }}</h5>
                        <button type="button" class="btn-close position-absolute top-0 end-0 m-3"
                            data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('customer.orders.store') }}" method="POST" class="needs-validation"
                            novalidate enctype="multipart/form-data">
                            @csrf
                            <div class="px-3">
                                @include('partials.errors')
                            </div>
                            <div class="mb-3">
                                <label for="service" class="form-label">{{ __('Choose a service') }}</label>
                                <select class="form-select" id="service" name="service_id" required>
                                    <option value="">{{ __('Choose a service') }}</option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}" data-price="{{ $service->price }}">
                                            {{ $service->{app()->getLocale() . '_name'} }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    {{ __('Please select a service.') }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">{{ __('Description') }}</label>
                                <textarea class="form-control" id="description" name="description" rows="6" required></textarea>
                                <div class="invalid-feedback">
                                    {{ __('Please enter a description.') }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="attachments" class="form-label">{{ __('Attachments') }}</label>
                                <div class="custom-file-input">
                                    <input type="file" class="file-input-hidden" id="attachments"
                                        name="attachments[]" multiple
                                        accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/zip,application/x-7z-compressed,image/png,image/jpeg,image/gif">
                                    <div class="file-input-wrapper">
                                        <span class="file-input-text">{{ __('Choose files') }}</span>
                                        <button type="button"
                                            class="btn btn-outline-secondary">{{ __('Browse') }}</button>
                                    </div>
                                    <div id="file-list" class="mt-2"></div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success">{{ __('Submit Order') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- FAQs Section -->
        <section id="faqs" class="faqs-section bg-light py-5">
            <div class="container">
                <h2 class="text-center">{{ $pageContent['sections']['faqs']['title'][$locale] }}</h2>
                <p>{{ $pageContent['sections']['faqs']['subtitle'][$locale] }}</p>
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseOne" aria-expanded="false"
                                aria-controls="flush-collapseOne">
                                {{ $pageContent['sections']['faqs']['faq_1']['title'][$locale] }}
                            </button>
                        </h3>
                        <div id="flush-collapseOne" class="accordion-collapse collapse"
                            data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                {{ $pageContent['sections']['faqs']['faq_1']['subtitle'][$locale] }}
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseThree" aria-expanded="false"
                                aria-controls="flush-collapseThree">
                                {{ $pageContent['sections']['faqs']['faq_2']['title'][$locale] }}
                            </button>
                        </h3>
                        <div id="flush-collapseThree" class="accordion-collapse collapse"
                            data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                {{ $pageContent['sections']['faqs']['faq_2']['subtitle'][$locale] }}
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseFourth" aria-expanded="false"
                                aria-controls="flush-collapseFourth">
                                {{ $pageContent['sections']['faqs']['faq_3']['title'][$locale] }}
                            </button>
                        </h3>
                        <div id="flush-collapseFourth" class="accordion-collapse collapse"
                            data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                {{ $pageContent['sections']['faqs']['faq_3']['subtitle'][$locale] }}
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseFifth" aria-expanded="false"
                                aria-controls="flush-collapseFifth">
                                {{ $pageContent['sections']['faqs']['faq_4']['title'][$locale] }}
                            </button>
                        </h3>
                        <div id="flush-collapseFifth" class="accordion-collapse collapse"
                            data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                {{ $pageContent['sections']['faqs']['faq_4']['subtitle'][$locale] }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Get Strted Now --}}
        <section id="get-started-now" class="get-started-now bg-main text-white py-5">
            <div class="container text-center">
                <h2>{{ $pageContent['sections']['get_started_now']['title'][$locale] }}</h2>
                <div class="row">
                    <div class="col-md-12">
                        <div class="get-started-now-content">
                            <p>{{ $pageContent['sections']['get_started_now']['subtitle'][$locale] }}</p>
                            <a href="{{ route('register') }}"
                                class="btn btn-warning fw-semibold">{{ __('Get Started') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- Contact Us Form --}}
        <section id="contact-us" class="contact-us bg-light py-5">
            <div class="container text-center">
                <h2>{{ $pageContent['sections']['contact']['title'][$locale] }}</h2>
                <p>{{ $pageContent['sections']['contact']['subtitle'][$locale] }}</p>
                <div class="row">
                    <div class="col-md-12">
                        <div class="contact-us-content text-start">
                            <form action="{{ route('contact-messages.store') }}" method="POST" class="needs-validation"
                                novalidate>
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-floating">
                                            <input type="text" id="name" name="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="{{ __('Enter your name') }}" value="{{ old('name') }}"
                                                required>
                                            <label for="name">{{ __('Name') }}</label>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="invalid-feedback">
                                                {{ __('Please enter your name.') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-floating">
                                            <input type="email" id="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="{{ __('Enter your email') }}" value="{{ old('email') }}"
                                                required>
                                            <label for="email">{{ __('Email') }}</label>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="invalid-feedback">
                                                {{ __('Please enter a valid email address.') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-floating">
                                            <input type="text" id="phone" name="phone"
                                                class="form-control @error('phone') is-invalid @enderror"
                                                placeholder="{{ __('Enter your phone number') }}"
                                                value="{{ old('phone') }}" required>
                                            <label for="phone">{{ __('Phone') }}</label>
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="invalid-feedback">
                                                {{ __('Please enter your phone number.') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-floating">
                                            <input type="text" id="subject" name="subject"
                                                class="form-control @error('subject') is-invalid @enderror"
                                                placeholder="{{ __('Enter your subject number') }}"
                                                value="{{ old('subject') }}">
                                            <label for="subject">{{ __('Subject') }}</label>
                                            @error('subject')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="invalid-feedback">
                                                {{ __('Please enter your subject number.') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-4">
                                        <div class="form-floating">
                                            <textarea id="message" name="message" class="form-control @error('message') is-invalid @enderror"
                                                placeholder="{{ __('Enter your message') }}" rows="10" style="min-height: 150px" required>{{ old('message') }}</textarea>
                                            <label for="message">{{ __('Message') }}</label>
                                            @error('message')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="invalid-feedback">
                                                {{ __('Please enter your message.') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        @auth
                                            <button type="submit"
                                                class="btn btn-main fw-semibold">{{ __('Send Message') }}</button>
                                        @else
                                            <div class="alert alert-secondary" role="alert">
                                                {{ __('Please') }} <a href="{{ route('login') }}"
                                                    class="alert-link">{{ __('login') }}</a>
                                                {{ __('to send a message.') }}
                                            </div>
                                        @endauth
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@section('page-styles')
    <style>
        .custom-file-input {
            position: relative;
        }

        .file-input-hidden {
            position: absolute;
            left: -9999px;
        }

        .file-input-wrapper {
            display: flex;
            align-items: center;
            background-color: #f8f9fa;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            padding: 0.375rem 0.75rem;
        }

        .file-input-text {
            flex-grow: 1;
            margin-right: 10px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        #file-list {
            font-size: 0.875rem;
        }

        #file-list .file-item {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }

        #file-list .file-name {
            margin-right: 10px;
        }

        #file-list .remove-file {
            cursor: pointer;
            color: #dc3545;
        }

        .stat-card {
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .choice-card {
            transition: all 0.3s ease;
        }

        .choice-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, .175) !important;
        }

        .icon-wrapper {
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
    </style>
@endsection
@section('page-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const serviceSelect = document.getElementById('service');
            const amountInput = document.getElementById('amount');

            serviceSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const price = selectedOption.getAttribute('data-price');
                amountInput.value = price ? parseFloat(price).toFixed(2) : '';
            });

            const fileInput = document.getElementById('attachments');
            const fileInputWrapper = document.querySelector('.file-input-wrapper');
            const fileInputText = document.querySelector('.file-input-text');
            const fileList = document.getElementById('file-list');

            fileInputWrapper.addEventListener('click', function() {
                fileInput.click();
            });

            fileInput.addEventListener('change', function() {
                updateFileList();
            });

            function updateFileList() {
                fileList.innerHTML = '';
                if (fileInput.files.length > 0) {
                    fileInputText.textContent = `${fileInput.files.length} file(s) selected`;
                    Array.from(fileInput.files).forEach((file, index) => {
                        const fileItem = document.createElement('div');
                        fileItem.className = 'file-item';
                        fileItem.innerHTML = `
                        <span class="file-name">${file.name}</span>
                        <span class="remove-file" data-index="${index}"><i class="fa-solid fa-xmark fs-5 ms-2"></i></span>
                    `;
                        fileList.appendChild(fileItem);
                    });
                } else {
                    fileInputText.textContent = '{{ __('Choose files') }}';
                }
            }

            fileList.addEventListener('click', function(e) {
                const removeIcon = e.target.closest('.remove-file');
                if (removeIcon) {
                    const index = parseInt(removeIcon.getAttribute('data-index'));
                    const dt = new DataTransfer();
                    const {
                        files
                    } = fileInput;
                    for (let i = 0; i < files.length; i++) {
                        if (i !== index) dt.items.add(files[i]);
                    }
                    fileInput.files = dt.files;
                    updateFileList();
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Show the order modal if the request has validation errors
            @if ($errors->any() || session('showOrderModal'))
                var orderModal = new bootstrap.Modal(document.getElementById('orderModal'));
                orderModal.show();
            @endif
        });
    </script>
@endsection

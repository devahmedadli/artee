@extends('layouts.home')
@section('title', __('Page Not Found'))

@section('content')
    @include('partials.page-hero', [
        'title' => __('404'),
        'description' => __('Page Not Found'),
    ])

    <div class="container py-5 text-center" style="min-height: 50vh">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="error-content">
                    <h2 class="mb-4 display-1 fw-bold text-main">404</h2>
                    <h3 class="mb-4">{{ __('Oops! Page not found') }}</h3>
                    <p class="mb-4 text-muted">
                        {{ __('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.') }}
                    </p>
                    <a href="{{ route('index') }}" class="btn btn-main">
                        <i class="bi bi-house-door me-2"></i>{{ __('Back to Home') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

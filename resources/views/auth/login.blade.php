@extends('layouts.admin')
@section('title',  __('Login'))
@section('content')
    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                    <div class="d-flex justify-content-center py-4">
                        <a href="index.html" class="logo d-flex align-items-center w-auto">
                            <img src="assets/img/logo.png" alt="">
                            <span class="d-none d-lg-block">{{ env('APP_NAME') }}</span>
                        </a>
                    </div><!-- End Logo -->

                    <div class="card mb-3">

                        <div class="card-body">

                            <div class="pt-4 pb-2">
                                <h5 class="card-title text-center pb-0 fs-4">{{ __('Login to your account') }}</h5>
                                <p class="text-center small">{{ __('Enter your email and password to login') }}</p>
                            </div>
                            @include('partials.errors')
                            <form class="row g-3 needs-validation" novalidate action="{{ route('login.post') }}"
                                method="POST">
                                @csrf

                                <div class="col-12">
                                    <label for="yourUsername" class="form-label">{{ __('Email') }}</label>
                                    <div class="input-group has-validation">
                                        {{-- <span class="input-group-text" id="inputGroupPrepend">@</span> --}}
                                        <input type="email" name="email" class="form-control" id="yourEmail"
                                            value="{{ old('email') }}" required>
                                        <div class="invalid-feedback">{{ __('Please enter your email.') }}</div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="yourPassword" class="form-label">{{ __('Password') }}</label>
                                    <input type="password" name="password" class="form-control" id="yourPassword" required>
                                    <div class="invalid-feedback">{{ __('Please enter your password.') }}</div>
                                </div>

                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" value="true"
                                            id="rememberMe">
                                        <label class="form-check-label" for="rememberMe">{{ __('Remember me') }}</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100" type="submit">{{ __('Login') }}</button>
                                </div>
                            </form>
                            {{-- lang --}}
                            <div class="col-12 text-center mt-3">
                                @if (app()->currentLocale() == 'en')
                                    <a href="{{ route('langSwape', 'ar') }}">عربي</a>
                                @else
                                    <a href="{{ route('langSwape', 'en') }}">{{ __('English') }}</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="credits">
                        <!-- يجب أن تظل جميع الروابط في التذييل كما هي. -->
                        <!-- يمكنك حذف الروابط فقط إذا كنت قد اشتريت النسخة الاحترافية. -->
                        <!-- معلومات الترخيص: https://bootstrapmade.com/license/ -->
                        <!-- اشترِ النسخة الاحترافية مع نموذج اتصال PHP/AJAX العامل: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                        <!-- صممه <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

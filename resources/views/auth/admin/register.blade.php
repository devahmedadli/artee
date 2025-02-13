@extends('layouts.home')
@section('content')
    <div class="container py-5 position-relative overflow-x-hidden">
        <div class="row justify-content-center">
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <div class="wrapper" style="width: 600px;min-width:200px;margin-top:150px">
                    <!-- Radial Gradient Circles -->
                    <div class="radial-circle radial-circle-1"></div>
                    <div class="radial-circle radial-circle-2"></div>

                    <h5 class="mb-3 text-center">{{ __('Create Artee account') }}</h5>
                    <div class="mb-3">
                        @include('partials.errors')
                    </div>
                    <div class="register p-3">
                        <form action="{{ route('register.post') }}" method="post" class="needs-validation" novalidate>
                            @csrf
                            <div class="form-floating position-relative mb-3">
                                <input type="text" id="name" name="name" class="form-control d-inline rounded-3"
                                    placeholder="{{ __('Enter your name') }}" required>
                                <label for="name">{{ __('Enter your name') }}</label>
                            </div>
                            <div class="form-floating position-relative mb-3">
                                <input type="text" id="username" name="username" class="form-control d-inline rounded-3"
                                    placeholder="{{ __('Enter your username') }}" required>
                                <label for="username">{{ __('Enter your username') }}</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" id="email" name="email" class="form-control rounded-3"
                                    placeholder="{{ __('Enter your Email') }}" required>
                                <label for="email">{{ __('Enter your Email') }}</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" id="password" name="password" class="form-control rounded-3"
                                    placeholder="{{ __('Enter your password') }}" required>
                                <label for="password">{{ __('Enter your password') }}</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="form-control rounded-3"
                                    placeholder="{{ __('Enter your password confirmation') }}" required>
                                <label for="password_confirmation">{{ __('Enter your password confirmation') }}</label>
                            </div>
                            <div class="terms mb-4">
                                <input type="checkbox" name="terms_conditions" id="terms-conditions" class="form-input"
                                    required>
                                <label for="terms-conditions"
                                    role="button">{{ __('By creating an account you agree to our') }} <a
                                        href="#" class="fw-bold">{{ __('Terms & Conditions') }}</a></label>
                                <div class="invalid-feedback">
                                    {{ __('You must agree to our terms & conditions to continue') }}
                                </div>
                            </div>
                            <button type="submit" class="btn btn-main w-100 rounded-3 p-3">{{ __('Register') }}</button>
                        </form>
                    </div>
                    <div class="my-4 text-center">
                        <p class="text-muted">{{ __('You have an account?') }} <a href="{{ route('login') }}"
                                class="text-decoration-none fw-semibold">{{ __('Click here') }}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

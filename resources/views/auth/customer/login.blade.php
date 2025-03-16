@extends('layouts.home')
@section('title',  __('Login'))
@section('content')
    <div class="container py-5 position-relative overflow-x-hidden">

        <div class="row justify-content-center">
            <div class="col-md-6 d-flex justify-content-center align-items-center py-5 position-relative">
                <div class="wrapper" style="width: 600px;min-width:200px;margin-top:150px; position: relative;">
                    <!-- Radial Gradient Circles -->
                    {{-- <div class="radial-circle radial-circle-1"></div>
                    <div class="radial-circle radial-circle-2"></div> --}}
                    <h3 class="mb-3 text-center">{{ __('Welcome Back') }}</h3>
                    <p class="text-muted text-center mb-3">{{ __('Enter your credentials below to login') }}</p>
                    <div class="mb-3">
                        @include('partials.errors')
                    </div>
                    <div class="login p-3">
                        <form action="{{ route('login.post') }}" method="post" class="needs-validation" novalidate>
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="text" id="email" name="email" class="form-control rounded-3"
                                    placeholder="{{ __('Enter your email') }}" value="{{ old('email') }}" required>
                                <label for="email">{{ __('Enter your email') }}</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input type="password" id="password" name="password" class="form-control rounded-3"
                                    placeholder="{{ __('Enter your password') }}" required>
                                <label for="password">{{ __('Enter your password') }}</label>
                            </div>
                            <div class="text-end mb-4"><a href="{{route('password.request')}}"
                                    class="text-decoration-none text-dark small">{{ __('Forgot Password?') }}</a></div>
                            <div class="">
                                <button type="submit" class="btn btn-main w-100 rounded-3 p-3">{{ __('Login') }}</button>
                            </div>
                        </form>
                    </div>
                    <div class="my-4 text-center">
                        <p class="text-muted">{{ __('Don\'t have an account?') }} <a href="{{ route('register') }}"
                                class="text-decoration-none fw-semibold">{{ __('Click here') }}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

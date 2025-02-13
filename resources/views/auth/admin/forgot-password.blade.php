@extends('layouts.home')
@section('content')
    <div class="container py-5 position-relative overflow-x-hidden">
        <div class="row justify-content-center">
            <div class="col-md-6 d-flex justify-content-center align-items-center py-5">
                <div class="wrapper" style="width: 600px;min-width:200px;margin-top:260px; position: relative;">
                    <!-- Radial Gradient Circles -->
                    <div class="radial-circle radial-circle-1"></div>
                    <div class="radial-circle radial-circle-2"></div>
                    <h3 class="mb-3 text-center">{{ __('Forgot Password') }}</h3>
                    <p class="text-muted mb-3 text-center">{{ __('Enter your email below to reset your password') }}</p>
                    <div class="mb-3">
                        @if (session('status'))
                            <div class="alert alert-info" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @include('partials.errors')
                    </div>
                    <div class="login">
                        <form action="{{ route('password.email') }}" method="post" class="needs-validation" novalidate>
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="email" id="email" name="email" class="form-control rounded-4"
                                    placeholder="{{ __('Enter your Email') }}" required>
                                <label for="email">{{ __('Enter your Email') }}</label>
                            </div>
                            <div class="">
                                <button type="submit"
                                    class="btn btn-main w-100 rounded-4 p-3">{{ __('Request Password') }}</button>
                            </div>
                        </form>
                    </div>
                    <div class="my-4 text-center">
                        <p class="text-muted">{{ __('Login') }} <a href="{{ route('login') }}"
                                class="text-decoration-none">{{ __('Click here') }}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

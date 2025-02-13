@extends('layouts.home')
@section('content')
<div class="container py-5 position-relative overflow-x-hidden">
    <div class="row justify-content-center">
        <div class="col-md-6 d-flex justify-content-center align-items-center py-5">
            <div class="wrapper" style="width: 600px;min-width:200px;margin-top:260px; position: relative;">
                <!-- Radial Gradient Circles -->
                <div class="radial-circle radial-circle-1"></div>
                <div class="radial-circle radial-circle-2"></div>

                <h3 class="mb-3">{{ __('Reset Password') }}</h3>
                <p class="text-muted mb-3">{{ __('Enter your credentials below to login') }}</p>
                <div class="mb-3">
                    @include('partials.errors')
                </div>
                <div class="login">
                    <form action="{{ route('password.update') }}" method="post" class="needs-validation" novalidate>
                        @csrf
                        <input type="hidden" name="token" value="{{$token}}">
                        <div class="form-floating mb-3">
                            <input type="email" id="email" name="email" class="form-control rounded-4"
                                placeholder="{{ __('Enter your Email') }}" required>
                            <label for="email">{{ __('Enter your Email') }}</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="password" id="password" name="password" class="form-control rounded-4"
                                wire:model="password" placeholder="{{ __('Enter your new password') }}" required>
                            <label for="password">{{ __('Enter your new password') }}</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="form-control rounded-4" wire:model="password_confirmation"
                                placeholder="{{ __('Confirm your new password') }}" required>
                            <label for="password_confirmation">{{ __('Confirm your new password') }}</label>
                        </div>
                        <div class="">
                            <button type="submit"
                                class="btn btn-secondary w-100 rounded-4 p-3">{{ __('Reset Password') }}</button>
                        </div>
                    </form>
                </div>
                <div class="my-4 text-center">
                    <p class="text-muted">{{ __('Don\'t have an account?') }} <a href="{{ route('sign-up') }}"
                            class="text-decoration-none">{{ __('Click here') }}</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

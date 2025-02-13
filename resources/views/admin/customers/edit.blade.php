@extends('layouts.admin')
@section('title', __('Edit Customer'))
@section('content')
    <div class="card p-3">
        <div class="card-body">
            <form action="{{ route('customers.update', $customer->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $customer->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="username" class="form-label">{{ __('Username') }}</label>
                        <input type="text" id="username" name="username" class="form-control @error('username') is-invalid @enderror"
                            value="{{ old('username', $customer->username) }}" required>
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', $customer->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label">{{ __('Phone') }}</label>
                        <input type="tel" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror"
                            value="{{ old('phone', $customer->phone) }}">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lang" class="form-label">{{ __('Language') }}</label>
                        <select id="lang" name="lang" class="form-control @error('lang') is-invalid @enderror" required>
                            <option value="ar" {{ old('lang', $customer->lang) === 'ar' ? 'selected' : '' }}>العربية</option>
                            <option value="en" {{ old('lang', $customer->lang) === 'en' ? 'selected' : '' }}>English</option>
                        </select>
                        @error('lang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror">
                        <small class="form-text text-muted">{{ __('Leave empty if you don\'t want to change the password.') }}</small>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="address" class="form-label">{{ __('Address') }}</label>
                        <textarea id="address" name="address" class="form-control @error('address') is-invalid @enderror">{{ old('address', $customer->customer->address) }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="company" class="form-label">{{ __('Company') }}</label>
                        <input type="text" id="company" name="company" class="form-control @error('company') is-invalid @enderror"
                            value="{{ old('company', $customer->customer->company) }}">
                        @error('company')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

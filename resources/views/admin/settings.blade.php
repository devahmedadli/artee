@extends('layouts.admin')
@section('title', 'بيانات الحساب')
@section('content')
    <form action="{{ route('admin.settings.update') }}" method="post" class="row bg-white p-3 shadow-sm border">
        @csrf
        @include('partials.errors')
        {{-- <div class="form-group col-md-6"> --}}
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">{{ __('Name') }}</label>
                <input type="text" id="name" name="name" class="form-control"
                    value="{{ auth()->user()->name }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <input type="text" id="email" name="email" class="form-control"
                    value="{{ auth()->user()->email }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <input type="password" id="password" name="password" class="form-control">
            </div>
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-success px-5">
                    {{ __('Save') }}
                    <i class="fa fa-save me-2"></i>
                </button>
            </div>
    </form>
@endsection

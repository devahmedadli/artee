@extends('layouts.admin')
@section('title', __('New Service'))
@section('content')
    <form action="{{ route('services.store') }}" method="post" class="row shadow-sm border bg-white p-3"
        enctype="multipart/form-data">
        @csrf
        @include('partials.errors')
        <div class="col-md-6 mb-3">
            <label for="ar_name" class="form-label"> {{ __('Service Name (Arabic)') }}</label>
            <input type="text" id="ar_name" name="ar_name" class="form-control" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="en_name" class="form-label"> {{ __('Service Name (English)') }}</label>
            <input type="text" id="en_name" name="en_name" class="form-control" required>
        </div>
        <div class="col-12 mb-3">
            <label for="ar_description" class="form-label"> {{ __('Description (Arabic)') }}</label>
            <textarea id="ar_description" name="ar_description" class="form-control" rows="4" required></textarea>
        </div>
        <div class="col-12 mb-3">
            <label for="en_description" class="form-label"> {{ __('Description (English)') }}</label>
            <textarea id="en_description" name="en_description" class="form-control" rows="4" required></textarea>
        </div>
        <div class="col-12 mb-3">
            <label for="image" class="form-label"> {{ __('Image') }}</label>
            <input type="file" id="image" name="image" class="form-control" required>
        </div>
        <div class="text-center mt-3">
            <input type="submit" value="{{ __('Save') }}" class="btn btn-success px-5">
        </div>
    </form>
@endsection

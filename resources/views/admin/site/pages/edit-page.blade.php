@extends('layouts.admin')
@section('title', __('Edit Page'))
@section('content')
    @include('partials.errors')

    <div class="container-fluid">
        <form action="{{ route('pages.update', $page->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <!-- Base Page Details -->
            @include('admin.site.pages.partials.base-fields')

            <!-- Dynamic Sections -->
            @switch($page->slug)
                @case('services')
                @case('products')
                    @include('admin.site.pages.partials.hero-section')
                    @break

                @case('privacy-policy')
                @case('terms-of-service')
                    @include('admin.site.pages.partials.hero-section')
                    @include('admin.site.pages.partials.content-section')
                    @break
            @endswitch

            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Save Changes') }}
                    <i class="bi bi-check-lg ms-2"></i>
                </button>
            </div>
        </form>
    </div>
@endsection
@section('page-styles')
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"> --}}
@endsection

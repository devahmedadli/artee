@extends('layouts.home')
@section('title', __('Product Details'))
@section('content')
    @include('partials.page-hero', [
        'title' => __('Product Details'),
        'description' => __('Our Product in more details'),
    ])

    <main class="py-5 min-vh-80">
        <div class="container">
            <div class="row" style="min-height: 500px;">
                <div class="col-md-6 order-md-2 order-1">
                    <div class="">
                        <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid" alt="Product Image">
                    </div>
                </div>
                <div class="col-md-6 order-md-1 order-2">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body">
                            <h5 class="card-title">
                                {{ __('Product Name') }}:
                                {{ $product->name }}
                            </h5>
                            <h5 class="card-title">
                                {{ __('Service Name') }}:
                                {{ $product->service->name }}
                            </h5>
                            <h5 class="card-title">
                                {{ __('Price') }}:
                                {{ $product->price }}
                            </h5>
                            <p class="card-text text-muted">
                                {{ __('Description') }}:
                                <br>
                                {!! nl2br(e($product->description)) !!}
                            </p>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
@endsection

<!-- Custom CSS -->
<style>
    .card-title {
        font-size: 1.75rem;
        font-weight: bold;
    }


    ul,
    ol {
        padding-left: 1.5rem;
    }

    ul li,
    ol li {
        margin-bottom: 0.5rem;
    }
</style>

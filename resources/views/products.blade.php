@extends('layouts.home')
@section('title', __('Products'))
@section('content')
    @include('partials.page-hero', ['title' => __('Products'), 'description' => __('Check our latest products')])
    
    <main class="py-5 min-vh-80">
        <div class="container">
            <div class="row">
                @forelse ($products as $product)

                <!-- Offer Card 1 -->
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-0 rounded-3 overflow-hidden">
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top img-fluid" alt="Offer Image">
                        <div class="card-body">
                            <h5 class="card-title text-dark fw-bold">{{ $product->name }}</h5>
                            <p class="card-text text-muted">{{ $product->description }}</p>
                            <a href="{{ route('products.product-details', ['product' => $product->id]) }}" class="btn btn-warning fw-semibold w-100">
                                {{ __('View Details') }}
                                <i class="fa-solid fa-arrow-{{app()->getLocale() === 'ar' ? 'left' : 'right'}}-long ms-2"></i>
                            </a>
                        </div>
                    </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center fs-5">{{ __('No products found') }}</p>
                    </div>
                @endforelse

            </div>
        </div>
    </main>
@endsection

<!-- Custom CSS -->
<style>
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-8px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    }

    .card img {
        height: 200px;
        object-fit: cover;
    }

    .card-title {
        font-size: 1.25rem;
    }

    .card-text {
        font-size: 0.95rem;
    }

    .btn {
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .btn:hover {
        background-color: #004085;
        color: #fff;
    }

    .container {
        max-width: 1200px;
    }
</style>

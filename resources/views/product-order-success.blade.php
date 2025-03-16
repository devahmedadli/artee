@extends('layouts.home')
@section('title', __('Order Placed Successfully'))
@section('content')
    @include('partials.page-hero', [
        'title' => __('Order Confirmation'),
        'description' => __('Your order has been placed successfully.'),
    ])

    <main class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-body text-center p-5">
                            <div class="mb-4">
                                <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
                            </div>
                            <h2 class="mb-4">{{ __('Thank You for Your Order!') }}</h2>
                            <p class="lead mb-4">{{ __('Your order has been placed successfully.') }}</p>
                            
                            <div class="alert alert-info mb-4">
                                <p class="mb-0">{{ __('Order Number') }}: <strong>{{ $order->order_number }}</strong></p>
                                <p class="mb-0">{{ __('Total Amount') }}: <strong>{{ number_format($order->total, 2) }} USD</strong></p>
                                <p class="mb-0">{{ __('Payment Status') }}: 
                                    @if($order->is_paid)
                                        <span class="badge bg-success">{{ __('Paid') }}</span>
                                    @else
                                        <span class="badge bg-warning">{{ __('Pending Payment') }}</span>
                                    @endif
                                </p>
                            </div>
                            
                            @if(!$order->is_paid && $order->total > 0)
                                <div class="alert alert-warning mb-4">
                                    <p class="mb-2">{{ __('Your order requires payment to be processed.') }}</p>
                                    <a href="{{ route('product.order.payment', $order->id) }}" class="btn btn-primary">
                                        {{ __('Complete Payment') }}
                                    </a>
                                </div>
                            @endif
                            
                            <p>{{ __('We will process your order as soon as possible.') }}</p>
                            <p>{{ __('You will receive updates about your order status.') }}</p>
                            
                            <div class="mt-5">
                                <a href="{{ route('index') }}" class="btn btn-primary me-2">{{ __('Return to Home') }}</a>
                                <a href="{{ route('customer.orders.index') }}" class="btn btn-outline-primary">{{ __('View My Orders') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection 
@extends('layouts.home')
@section('title', __('Payment'))
@section('content')
    @include('partials.page-hero', [
        'title' => __('Complete Your Payment'),
        'description' => __('Secure payment for your order'),
    ])

    <main class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4">
                            <h2 class="card-title mb-4">{{ __('Order Summary') }}</h2>
                            
                            <div class="mb-4">
                                <p><strong>{{ __('Order Number') }}:</strong> {{ $order->order_number }}</p>
                                <p><strong>{{ __('Product') }}:</strong> {{ $order->data['product']['name'] }}</p>
                                <p><strong>{{ __('Total Amount') }}:</strong> {{ number_format($order->total, 2) }} {{ __('USD') }}</p>
                            </div>
                            
                            <div id="payment-loading" class="text-center d-none">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">{{ __('Loading...') }}</span>
                                </div>
                                <p class="mt-2">{{ __('Processing payment, please wait...') }}</p>
                            </div>
                            
                            <div class="moyasar-form"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('page-styles')
    <!-- Moyasar Styles -->
    <link rel="stylesheet" href="https://cdn.moyasar.com/mpf/1.14.0/moyasar.css" />
    
    <style>
        .moyasar-form {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
        }
    </style>
@endsection

@section('page-scripts')
    <!-- Moyasar Scripts -->
    <script src="https://cdnjs.cloudflare.com/polyfill/v3/polyfill.min.js?version=4.8.0&features=fetch"></script>
    <script src="https://cdn.moyasar.com/mpf/1.14.0/moyasar.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Moyasar.init({
                element: '.moyasar-form',
                // Amount in the smallest currency unit (e.g., cents/halalas)
                amount: {{ $order->total * 100 }},
                currency: 'USD',
                description: 'Order #{{ $order->order_number }}',
                publishable_api_key: '{{ $publishable_key }}',
                callback_url: '{{ route('product.order.payment.callback') }}',
                methods: ['creditcard'],
                on_initiating: function() {
                    document.getElementById('payment-loading').classList.remove('d-none');
                }
            });
        });
    </script>
@endsection 
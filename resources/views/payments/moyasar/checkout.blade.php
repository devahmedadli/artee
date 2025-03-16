@extends('layouts.home')
@section('content')
    @include('partials.page-hero', [
        'title' => __('Checkout'),
        'description' => __('Complete your payment'),
    ])
    {{-- @dd($order) --}}
    <main class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title mb-4">{{ __('Order Summary') }}</h2>
                            <p><strong>{{ __('Order Number:') }}</strong> {{ $order->order_number }}</p>
                            <p><strong>{{ __('Total Amount:') }}</strong> {{ number_format($order->total, 2) }}
                                {{ __('USD') }}</p>
                            <div id="payment-loading" style="display: none;">
                                <p class="text-center">{{__('Processing payment, please wait...')}}</p>
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
    <!-- Moyasar Scripts -->
    <script src="https://cdnjs.cloudflare.com/polyfill/v3/polyfill.min.js?version=4.8.0&features=fetch"></script>
    <script src="https://cdn.moyasar.com/mpf/1.14.0/moyasar.js"></script>

    <style>
        .moyasar-form {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
        }
    </style>
@endsection
@section('page-scripts')
    <script>
        Moyasar.init({
            element: '.moyasar-form',
            // Amount in the smallest currency unit.
            // For example:
            // 10 SAR = 10 * 100 Halalas
            // 10 KWD = 10 * 1000 Fils
            // 10 JPY = 10 JPY (Japanese Yen does not have fractions)
            amount: {{ $order->total * 100 }},
            currency: 'USD',
            description: '#{{ $order->order_number }}',
            publishable_api_key: '{{ $publishable_key }}',
            callback_url: '{{ route('payment.callback') }}',
            methods: ['creditcard'],
            metadata: {
                order_id: '{{ $order->id }}',
                order_type: '{{ $order instanceof \App\Models\ProductOrder ? 'product' : 'service' }}'
            }
        })
    </script>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOMContentLoaded event fired');
            Moyasar.init({
                element: '.moyasar-form',
                amount: {{ $order->total * 100 }},
                currency: 'SAR',
                description: 'Order #{{ $order->order_number }}',
                publishable_api_key: '{{ config('services.moyasar.publishable_key') }}',
                callback_url: '{{ route('payment.callback') }}',
                methods: ['creditcard'],
                on_completed: function(payment) {
                    console.log('Payment completed', payment);
                },
                on_failed: function(error) {
                    console.error('Payment failed', error);
                },
                on_initiating: function() {
                    document.getElementById('payment-loading').style.display = 'block';
                    return new Promise(function(resolve, reject) {
                        // Your validation logic here
                        resolve();
                    });
                }
            });
            console.log('Moyasar.init called');
        });
    </script> --}}
@endsection

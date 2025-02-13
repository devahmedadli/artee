@extends('layouts.home')
@section('title', __('Orders'))
@section('content')
    @include('partials.page-hero', [
        'title' => __('Orders'),
        'description' => __('Your Orders'),
    ])

    <div class="container mt-4">
        <h1 class="mb-4">{{ __('Your Orders') }}</h1>

        @php
            // Demo data
            $orders = collect([
                (object) [
                    'id' => 1001,
                    'created_at' => now()->subDays(5),
                    'status' => 'Delivered',
                    'status_color' => 'success',
                    'total' => 129.99,
                ],
                (object) [
                    'id' => 1002,
                    'created_at' => now()->subDays(2),
                    'status' => 'Processing',
                    'status_color' => 'warning',
                    'total' => 79.5,
                ],
                (object) [
                    'id' => 1003,
                    'created_at' => now()->subDay(),
                    'status' => 'Shipped',
                    'status_color' => 'info',
                    'total' => 199.99,
                ],
            ]);
        @endphp

        @if ($orders->isEmpty())
            <div class="alert alert-info" role="alert">
                {{ __('You have no orders yet.') }}
            </div>
        @else
            <div class="row">
                @foreach ($orders as $order)
                    <div class="col-12 mb-4">
                        <div class="card">
                            <div class="card-header bg-main text-white">
                                <h5 class="card-title mb-0">
                                    {{ __('Order') }} #{{ $order->id }}
                                </h5>
                            </div>
                            <div class="card-body">
                                <p><strong>{{ __('Date') }}:</strong> {{ $order->created_at->format('M d, Y') }}</p>
                                <p><strong>{{ __('Status') }}:</strong>
                                    <span class="badge bg-{{ $order->status_color }}">
                                        {{ $order->status }}
                                    </span>
                                </p>
                                <p><strong>{{ __('Total') }}:</strong> ${{ number_format($order->total, 2) }}</p>
                            </div>
                            <div class="card-footer bg-white">
                                <a href="#" class="btn btn-main">
                                    {{ __('View Details') }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination removed for demo data -->
        @endif
    </div>


@endsection

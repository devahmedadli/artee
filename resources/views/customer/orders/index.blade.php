@extends('layouts.home')
@section('title', __('Orders'))
@section('content')
    @include('partials.page-hero', [
        'title' => __('Orders'),
        'description' => __('Your Orders'),
    ])

    <div class="container mt-4" style="min-height: 500px;">
        <h1 class="mb-4">{{ __('Your Orders') }}</h1>

        @if ($orders->isEmpty())
            <div class="alert alert-info text-center" role="alert">
                {{ __('You have no orders yet.') }}
            </div>
        @else
            <div class="row">
                @foreach ($orders as $order)
                    <div class="col-12 mb-4">
                        <div class="card">
                            <div class="card-header bg-main text-white">
                                <h5 class="card-title mb-0">
                                    {{ __('Order') }} #{{ $order->order_number }}
                                </h5>
                            </div>
                            <div class="card-body">
                                <p><strong>{{ __('Date') }}:</strong> {{ $order->created_at->format('M d, Y') }}</p>
                                <p><strong>{{ __('Status') }}:</strong>
                                    @if ($order->status == 'pending')
                                        <span class="badge bg-warning">
                                            {{ __('Pending') }}
                                        </span>
                                    @elseif ($order->status == 'accepted')
                                        <span class="badge bg-success">
                                            {{ __('Accepted') }}
                                        </span>
                                    @elseif ($order->status == 'in_progress')
                                        <span class="badge bg-info">
                                            {{ __('In Progress') }}
                                        </span>
                                    @elseif ($order->status == 'completed')
                                        <span class="badge bg-success">
                                            {{ __('Completed') }}
                                        </span>
                                    @elseif ($order->status == 'needs_approval')
                                        <span class="badge bg-info">
                                            {{ __('Needs Approval') }}
                                        </span>
                                    @endif
                                </p>
                                <p>
                                    <strong>{{ __('Total') }}:</strong>
                                    @if ($order->total && $order->customer_accepted)
                                        ${{ number_format($order->total) }}
                                        <span class="badge bg-{{ $order->is_paid ? 'success' : 'danger' }}">
                                            {{ $order->is_paid ? 'مدفوع' : 'غير مدفوع' }}
                                        </span>

                                    @elseif ($order->total && !$order->customer_accepted)
                                        <span>
                                            ${{ number_format($order->total) }}
                                        </span>
                                        <span class="badge bg-info">
                                            {{ __('Waiting for accept') }}
                                        </span>
                                    @else
                                        <span class="badge bg-warning">
                                            {{ __('Negotiating') }}
                                        </span>
                                    @endif
                                </p>
                            </div>
                            <div class="card-footer bg-white">
                                <a href="{{ route('customer.orders.show', $order) }}" class="btn btn-main">
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

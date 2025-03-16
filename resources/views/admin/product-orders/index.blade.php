@extends('layouts.admin')
@section('title', __('Orders'))
@section('content')

    <div class="card orders-list overflow-auto">
        <!-- Card body -->
        <div class="card-body">
            <h5 class="card-title">{{ __('Orders List') }} <span>| {{ __('All') }}</span></h5>
            <!-- Table with responsive wrapper -->
            <div class="table-responsive">
                <table class="table table-borderless datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Order Number') }}</th>
                            <th>{{ __('Customer') }}</th>
                            <th>{{ __('Amount') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Payment Status') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $order->order_number }}</td>
                                <td>{{ $order->customer?->name }}</td>
                                <td>
                                    {{ $order->total }} $
                                </td>
                                <td>
                                    @if ($order->status == 'needs_approval')
                                        <span class="badge bg-info">
                                            {{ __('Needs Approval') }}
                                        </span>
                                    @elseif ($order->status == 'pending')
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
                                    @elseif ($order->status == 'canceled')
                                        <span class="badge bg-danger">
                                            {{ __('Canceled') }}
                                        </span>
                                    @elseif ($order->status == 'rejected')
                                        <span class="badge bg-danger">
                                            {{ __('Rejected') }}
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-{{ $order->is_paid ? 'success' : 'danger' }}">
                                        {{ $order->is_paid ? __('Paid') : __('Unpaid') }}
                                    </span>
                                </td>
                                <td class="text-nowrap">
                                    <a href="{{ route('product-orders.show', $order->id) }}"
                                        class="btn btn-primary btn-sm">
                                        <i class="bi bi-eye"></i> {{ __('View') }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

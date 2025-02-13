@extends('layouts.admin')
@section('title', __('Orders'))
@section('content')

    <div class="card orders-list overflow-auto">
        <!-- Card body -->
        <div class="card-body">
            <h5 class="card-title">{{ __('Orders') }} <span>| {{ __('All') }}</span></h5>
            <!-- Table with responsive wrapper -->
            <div class="table-responsive">
                <table class="table table-borderless datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Order Number') }}</th>
                            <th>{{ __('Service') }}</th>
                            <th>{{ __('Customer') }}</th>
                            <th>{{ __('Amount') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $order->order_number }}</td>
                                <td>{{ $order->service->name }}</td>
                                <td>{{ $order->customer->name }}</td>
                                <td>
                                    {{-- get order related offer to freelancer --}}
                                    @php
                                        $freelancerOffer = $order->offers
                                            ->where('freelancer_id', auth()->user()->id)
                                            ->first();
                                    @endphp
                                    {{ $freelancerOffer ? $freelancerOffer->admin_price : __('Offer not accepted yet') }} $
                                </td>
                                <td>
                                    <span
                                        class="badge bg-{{ $order->status == 'pending' ? 'warning' : ($order->status == 'negotiating' ? 'info' : ($order->status == 'in_progress' ? 'primary' : ($order->status == 'rejected' ? 'danger' : ($order->status == 'completed' ? 'success' : ($order->status == 'canceled' ? 'danger' : 'info'))))) }} text-capitalize">
                                        @if ($order->status == 'pending')
                                            {{ __('Pending') }}
                                        @elseif ($order->status == 'negotiating')
                                            {{ __('Negotiating') }}
                                        @elseif ($order->status == 'in_progress')
                                            {{ __('In Progress') }}
                                        @elseif ($order->status == 'rejected')
                                            {{ __('Rejected') }}
                                        @elseif ($order->status == 'completed')
                                            {{ __('Completed') }}
                                        @elseif ($order->status == 'needs_approval')
                                            {{ __('Needs Approval') }}
                                        @endif
                                    </span>
                                </td>
                                <td class="text-nowrap">
                                    <a href="{{ route('freelancer.orders.show', $order->id) }}" class="btn btn-primary">
                                        {{ __('View Details') }}
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

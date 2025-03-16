@extends('layouts.admin')
@section('title', __('Order Details') . ' #' . $productOrder->order_number)

@section('content')
    @include('partials.errors')
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header mb-3 d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">{{ __('Order Information') }}</h5>
                    <div class="badge bg-{{ $productOrder->status == 'completed' ? 'success' : ($productOrder->status == 'pending' ? 'warning' : ($productOrder->status == 'rejected' ? 'danger' : 'info')) }}">
                        @if ($productOrder->status == 'needs_approval')
                            {{ __('Needs Approval') }}
                        @elseif ($productOrder->status == 'pending')
                            {{ __('Pending') }}
                        @elseif ($productOrder->status == 'accepted')
                            {{ __('Accepted') }}
                        @elseif ($productOrder->status == 'in_progress')
                            {{ __('In Progress') }}
                        @elseif ($productOrder->status == 'completed')
                            {{ __('Completed') }}
                        @elseif ($productOrder->status == 'canceled')
                            {{ __('Canceled') }}
                        @elseif ($productOrder->status == 'rejected')
                            {{ __('Rejected') }}
                        @else
                            {{ __($productOrder->status) }}
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p><strong>{{ __('Order Number') }}:</strong> {{ $productOrder->order_number }}</p>
                            <p><strong>{{ __('Order Date') }}:</strong> {{ $productOrder->created_at?->format('Y-m-d H:i') }}</p>
                            <p>
                                <strong>{{ __('Payment Status') }}:</strong>
                                @if ($productOrder->is_paid)
                                    <span class="badge bg-success">{{ __('Paid') }}</span>
                                @else
                                    <span class="badge bg-danger">{{ __('Unpaid') }}</span>
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>{{ __('Subtotal') }}:</strong> ${{ number_format($productOrder->subtotal, 2) }}</p>
                            @if(isset($productOrder->discount))
                                <p><strong>{{ __('Discount') }}:</strong> ${{ number_format($productOrder->discount, 2) }}</p>
                            @endif
                            <p><strong>{{ __('Total') }}:</strong> ${{ number_format($productOrder->total, 2) }}</p>
                        </div>
                    </div>

                    <h6 class="fw-bold mb-3">{{ __('Product Information') }}</h6>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p><strong>{{ __('Product Name') }}:</strong> 
                                {{ $productOrder->data['product']['name'] ?? $productOrder->product->{app()->getLocale() . '_name'} }}
                            </p>
                            <p><strong>{{ __('Base Price') }}:</strong> 
                                ${{ number_format($productOrder->data['product']['base_price'] ?? $productOrder->product->base_price, 2) }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            @if(isset($productOrder->data['product']['description']))
                                <p><strong>{{ __('Description') }}:</strong><br>
                                    {!! nl2br(e($productOrder->data['product']['description'])) !!}
                                </p>
                            @endif
                        </div>
                    </div>

                    @if(isset($productOrder->data['selected_options']) && count($productOrder->data['selected_options']) > 0)
                        <h6 class="fw-bold mb-3">{{ __('Selected Options') }}</h6>
                        <div class="table-responsive mb-4">
                            <table class="table table-bordered table-sm">
                                <thead class="table-light">
                                    <tr>
                                        <th>{{ __('Option') }}</th>
                                        <th>{{ __('Value') }}</th>
                                        <th>{{ __('Additional Price') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($productOrder->data['selected_options'] as $option)
                                        <tr>
                                            <td>{{ $option['option_name'] }}</td>
                                            <td>{{ $option['value_name'] }}</td>
                                            <td>${{ number_format($option['price'], 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    @if(isset($productOrder->data['requirements']) && count($productOrder->data['requirements']) > 0)
                        <h6 class="fw-bold mb-3">{{ __('Customer Requirements') }}</h6>
                        <div class="table-responsive mb-4">
                            <table class="table table-bordered table-sm">
                                <thead class="table-light">
                                    <tr>
                                        <th>{{ __('Requirement') }}</th>
                                        <th>{{ __('Value') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($productOrder->data['requirements'] as $reqId => $requirement)
                                        <tr>
                                            <td> {{ __(ucfirst(str_replace('_', ' ', $requirement['type']))) }}</td>
                                            <td>
                                                @if($requirement['type'] == 'file' || $requirement['type'] == 'image' || $requirement['type'] == 'custom_design')
                                                    <a href="{{ asset('storage/' . $requirement['value']) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                        <i class="bi bi-file-earmark"></i> 
                                                        {{ __('View File') }} ({{ $requirement['original_name'] ?? __('Uploaded File') }})
                                                    </a>
                                                @elseif ($requirement['type'] == 'text' && Str::startsWith($requirement['value'], 'http'))
                                                    <p> <a href="{{ $requirement['value'] }}" target="_blank" class="text-decoration-none text-primary">{{ __($requirement['value']) }}</a></p>
                                                @elseif ($requirement['type'] == 'number')
                                                    <p>{{ $requirement['value'] }}</p>
                                                @elseif ($requirement['type'] == 'boolean')
                                                    <p>{{ $requirement['value'] ? __('Yes') : __('No') }}</p>
                                                @else
                                                    {{ $requirement['value'] }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    @if(isset($productOrder->data['notes']) && !empty($productOrder->data['notes']))
                        <h6 class="fw-bold mb-3">{{ __('Customer Notes') }}</h6>
                        <div class="p-3 bg-light rounded mb-4">
                            {!! nl2br(e($productOrder->data['notes'])) !!}
                        </div>
                    @endif
                </div>
            </div>

            @if(isset($productOrder->data['payment']) && !empty($productOrder->data['payment']))
                <div class="card mb-4">
                    <div class="card-header mb-3">
                        <h5 class="card-title mb-0">{{ __('Payment Information') }}</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>{{ __('Payment ID') }}:</strong> {{ $productOrder->data['payment']['id'] }}</p>
                        <p><strong>{{ __('Payment Method') }}:</strong> {{ ucfirst($productOrder->data['payment']['method']) }}</p>
                        <p><strong>{{ __('Amount') }}:</strong> ${{ number_format($productOrder->data['payment']['amount'], 2) }}</p>
                        <p><strong>{{ __('Currency') }}:</strong> {{ strtoupper($productOrder->data['payment']['currency']) }}</p>
                        <p><strong>{{ __('Payment Date') }}:</strong> {{ $productOrder->data['payment']['date'] }}</p>
                    </div>
                </div>
            @endif
        </div>

        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header mb-3">
                    <h5 class="card-title mb-0">{{ __('Customer Information') }}</h5>
                </div>
                <div class="card-body">
                    <p><strong>{{ __('Name') }}:</strong> {{ $productOrder->customer->name }}</p>
                    <p><strong>{{ __('Email') }}:</strong> {{ $productOrder->customer->email }}</p>
                    <p><strong>{{ __('Phone') }}:</strong> {{ $productOrder->customer->phone ?? __('Not provided') }}</p>
                    <a href="{{ route('customers.show', $productOrder->customer_id) }}" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-person"></i> {{ __('View Customer Profile') }}
                    </a>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header mb-3">
                    <h5 class="card-title mb-0">{{ __('Order Actions') }}</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <form action="{{ route('product-orders.update-status', $productOrder->id) }}" method="POST" class="mb-3">
                            @csrf
                            @method('PUT')
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle w-100" type="button" id="statusDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ __(ucwords(str_replace('_', ' ', $productOrder->status))) }}
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="statusDropdown">
                                    <li>
                                        <button type="submit" name="status" value="pending" class="dropdown-item">{{ __('Pending') }}</button>
                                    </li>
                                    <li>
                                        <button type="submit" name="status" value="in_progress" class="dropdown-item">{{ __('In Progress') }}</button>
                                    </li>
                                    <li>
                                        <button type="submit" name="status" value="completed" class="dropdown-item">{{ __('Completed') }}</button>
                                    </li>
                                    <li>
                                        <button type="submit" name="status" value="delivered" class="dropdown-item">{{ __('Delivered') }}</button>
                                    </li>
                                    <li>
                                        <button type="submit" name="status" value="canceled" class="dropdown-item">{{ __('Canceled') }}</button>
                                    </li>
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-styles')
    <style>
        .table-sm td, .table-sm th {
            padding: 0.5rem;
        }
    </style>
@endsection

@section('page-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Any JavaScript functionality can be added here
        });
    </script>
@endsection

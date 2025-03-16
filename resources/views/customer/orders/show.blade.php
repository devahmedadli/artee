@extends('layouts.home')
@section('title', __('Orders'))
@section('content')
    @include('partials.page-hero', [
        'title' => __('Order Details'),
        'description' => __('Your Order Details'),
    ])
    <div class="container my-4">
        <h1 class="mb-4">
            {{ __('Order Details') }} #{{ $order->order_number }}
        </h1>
        {{-- order information --}}
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">
                    {{ __('Order Information') }}
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>
                                {{ __('Order Number') }}:
                            </strong> {{ $order->order_number }}</p>
                        <p><strong>
                                {{ __('Order Date') }}:
                            </strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>
                        <p>
                            <strong>
                                {{ __('Status') }}:
                                <span
                                    class="badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'pending' ? 'warning' : 'info') }}">
                                    @if ($order->status == 'pending')
                                        {{ __('Pending') }}
                                    @elseif ($order->status == 'needs_approval')
                                        {{ __('Needs Approval') }}
                                    @else
                                        {{ __($order->status) }}
                                    @endif
                                </span>
                            </strong>
                        </p>
                        @if ($order->total)
                            <p>
                                <strong>
                                    {{ __('Subtotal') }}:
                                </strong> {{ $order->subtotal }} $
                            </p>
                            {{-- discount --}}
                            <p>
                                <strong>
                                    {{ __('Discount') }}:
                                </strong> {{ $order->discount }} $
                            </p>
                            {{-- total --}}
                            <p>
                                <strong>
                                    {{ __('Total') }}:
                                </strong>
                                @if ($order instanceof \App\Models\Order && !$order->customer_accepted)
                                    {{-- accept the offer for service orders --}}
                                    {{ $order->total }} $
                                    <form action="{{ route('customer.orders.accept-offer', $order->id) }}" method="post"
                                        onsubmit="return confirm('{{ __('Are you sure you want to accept this offer?') }}')">
                                        @csrf
                                        <button type="submit" class="btn btn-success">
                                            {{ __('Accept Offer') }}
                                        </button>
                                    </form>
                                @else
                                    {{ $order->total }} $
                                    @if (!$order->is_paid)
                                        @if ($order instanceof \App\Models\Order)
                                            <a href="{{ route('checkout', $order->id) }}" class="btn btn-primary">
                                                {{ __('Pay Now') }}
                                            </a>
                                        @else
                                            <a href="{{ route('product.order.payment', $order->id) }}"
                                                class="btn btn-primary">
                                                {{ __('Pay Now') }}
                                            </a>
                                        @endif
                                    @else
                                        <span class="badge bg-success">{{ __('Paid') }}</span>
                                    @endif
                                @endif
                            </p>
                        @else
                            <p>
                                <strong>
                                    {{ __('Total') }}:
                                </strong>
                                <span class="badge bg-warning">
                                    {{ __('Negotiating') }}
                                </span>
                            </p>
                        @endif
                        {{-- subtotal --}}
                    </div>
                    <div class="col-md-6">
                        {{-- <p><strong>
                                {{ __('Customer') }}:
                            </strong> {{ $order->customer?->name }}</p>
                        <p><strong>
                                {{ __('Customer Email') }}:
                            </strong> {{ $order->customer?->email }}</p> --}}
                        @if ($order instanceof \App\Models\Order)
                            @if ($order->freelancer)
                                <p><strong>
                                        {{ __('Employee') }}:
                                    </strong> {{ $order->freelancer?->name }}</p>
                            @else
                                <p><strong>{{ __('Employee') }}:</strong> {{ __('Not assigned yet') }}</p>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @if ($order instanceof \App\Models\Order && $order->status == 'completed')
            {{-- Files --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">
                        {{ __('Files') }}
                    </h5>
                </div>
                <div class="card-body">
                    @if ($order->files->where('admin_accepted', true)->count() > 0)
                        <ol>
                            @foreach ($order->files->where('admin_accepted', true) as $file)
                                <li>
                                    <form action="{{ route('file.download') }}" method="GET">
                                        @csrf
                                        <input type="hidden" name="file_path" value="{{ urlencode($file->path) }}">
                                        <button type="submit" class="btn btn-link">
                                            {{ basename($file->name) }}
                                            <i class="bi bi-download mx-2 text-success"></i>
                                        </button>
                                    </form>
                                </li>
                            @endforeach
                        </ol>
                    @else
                        <p>
                            {{ __('No files attached') }}
                        </p>
                    @endif
                </div>
            </div>
        @endif

        {{-- order details --}}
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">
                    {{ __('Order Details') }}
                </h5>
            </div>
            <div class="card-body">
                @if ($order instanceof \App\Models\Order)
                    {{-- Service Order Details --}}
                    <div class="mb-3">
                        <h6>
                            <strong>
                                {{ __('Service') }}:
                            </strong>
                            {{ $order->service?->{app()->getLocale() . '_name'} }}
                        </h6>
                        <p>
                            <strong>
                                {{ __('Description') }}:
                            </strong>
                            <br>
                            {!! nl2br(e($order->service?->{app()->getLocale() . '_description'})) !!}
                        </p>
                    </div>
                @else
                    {{-- Product Order Details --}}
                    <div class="mb-3">
                        <h6>
                            <strong>
                                {{ __('Product') }}:
                            </strong>
                            {{ $order->product?->{app()->getLocale() . '_name'} }}
                        </h6>

                        @if (isset($order->data['product']['description']))
                            <p>
                                <strong>
                                    {{ __('Description') }}:
                                </strong>
                                <br>
                                {!! nl2br(e($order->data['product']['description'])) !!}
                            </p>
                        @endif

                        @if (isset($order->data['selected_options']) && count($order->data['selected_options']) > 0)
                            <div class="mt-4">
                                <h6>{{ __('Selected Options') }}:</h6>
                                <ul class="list-group list-group-flush">
                                    @foreach ($order->data['selected_options'] as $option)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span>{{ __($option['option_name']) }}:
                                                <strong>{{ __($option['value_name']) }}</strong></span>
                                            @if ($option['price'] > 0)
                                                <span class="badge bg-success rounded-pill">+{{ $option['price'] }}</span>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (isset($order->data['notes']) && !empty($order->data['notes']))
                            <div class="mt-4">
                                <h6>{{ __('Additional Notes') }}:</h6>
                                <p>{!! nl2br(e($order->data['notes'])) !!}</p>
                            </div>
                        @endif

                        @if (isset($order->data['requirements']) && count($order->data['requirements']) > 0)
                            <div class="mt-4">
                                <h6>{{ __('Requirements') }}:</h6>
                                <div class="row">
                                    @foreach ($order->data['requirements'] as $reqId => $requirement)
                                        <div class="col-md-6 mb-3">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h6 class="card-subtitle mb-2 text-muted">{{ __('Requirement') }}
                                                        #{{ $reqId }}</h6>
                                                    @if (is_string($requirement) && Str::startsWith($requirement, 'data:image'))
                                                        <img src="{{ $requirement }}" alt="Requirement Image"
                                                            class="img-fluid mb-2">
                                                    @elseif (is_string($requirement))
                                                        <p>{{ __($requirement) }}</p>
                                                    @elseif ($requirement['type'] == 'text' && Str::startsWith($requirement['value'], 'http'))
                                                        <p> <a href="{{ $requirement['value'] }}" target="_blank"
                                                                class="text-decoration-none text-primary">{{ __($requirement['value']) }}</a>
                                                        </p>
                                                    @elseif ($requirement['type'] == 'number')
                                                        <p>{{ __($requirement['value']) }}</p>
                                                    @elseif ($requirement['type'] == 'file')
                                                        <a href="{{ $requirement['value'] }}" target="_blank" download
                                                            class="btn btn-primary">{{ __('Download File') }}</a>
                                                    @elseif ($requirement['type'] == 'boolean')
                                                        <p>{{ __($requirement['value'] ? __('Yes') : __('No')) }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        @if ($order instanceof \App\Models\Order)
            {{-- attachments for service orders --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">
                        {{ __('Attached Files') }}
                    </h5>
                </div>
                <div class="card-body">
                    @if ($order->attachments->count() > 0)
                        <ol>
                            @foreach ($order->attachments as $file)
                                <li>
                                    <form action="{{ route('file.download') }}" method="GET">
                                        @csrf
                                        <input type="hidden" name="file_path" value="{{ urlencode($file->path) }}">
                                        <button type="submit" class="btn btn-link">
                                            {{ basename($file->name) }}
                                            <i class="bi bi-download mx-2 text-success"></i>
                                        </button>
                                    </form>
                                </li>
                            @endforeach
                        </ol>
                    @else
                        <p>
                            {{ __('No files attached') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">
                        {{ __('Order Progress') }}
                    </h5>
                </div>
                <div class="card-body">
                    @if ($order->progress->where('admin_accepted', true)->count() > 0)
                        <ul class="timeline">
                            @foreach ($order->progress->where('admin_accepted', true) as $progress)
                                <li class="timeline-item">
                                    <div class="timeline-marker"></div>
                                    <div class="timeline-content">
                                        <h5 class="timeline-title">{{ __($progress->status) }}</h5>
                                        <p class="timeline-date">{{ $progress->created_at->format('Y-m-d H:i') }}</p>
                                        <p>{{ $progress->note }}</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>{{ __('No progress recorded yet.') }}</p>
                    @endif
                </div>
            </div>
        @endif

        <div class="text-center mt-4">
            <a href="{{ route('customer.orders.index') }}" class="btn btn-main">
                {{ __('Back to Orders') }}
                <i class="bi bi-arrow-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
            </a>
            @if ($order instanceof \App\Models\Order && $order->status == 'pending')
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editOrderModal">
                    {{ __('Edit Order') }}
                </button>
                {{-- @else
                <form action="{{ route('orders.cancel', $order->id) }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        {{ __('Cancel Order') }}
                    </button>
                </form> --}}
            @endif
        </div>
    </div>
    @if ($order instanceof \App\Models\Order && $order->status == 'pending')
        <!-- Edit Order Modal -->
        <div class="modal fade" id="editOrderModal" tabindex="-1" aria-labelledby="editOrderModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editOrderModalLabel">
                            {{ __('Edit Order') }} #{{ $order->order_number }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="bi bi-x-lg"></i>
                        </button>

                    </div>
                    <form action="{{ route('orders.update', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <!-- Add form fields for editing order information -->
                            <div class="mb-3">
                                <label for="description" class="form-label">
                                    {{ __('Description') }}
                                </label>
                                <textarea class="form-control" id="description" name="description" rows="12">{{ $order->description }}</textarea>
                            </div>
                            <!-- Add more form fields as needed -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                {{ __('Cancel') }}
                            </button>
                            <button type="submit" class="btn btn-primary">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection

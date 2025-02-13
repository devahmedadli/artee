@extends('layouts.admin')
@section('title', __('Order Details') . ' #' . $order->order_number)

@section('content')

    @include('partials.errors')
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">{{ __('Order Information') }}</h5>
                </div>
                <div class="card-body p-3">
                    <p><strong>{{ __('Order Number') }}:</strong> {{ $order->order_number }}</p>
                    <p><strong>{{ __('Order Date') }}:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>
                    <div><strong>{{ __('Status') }}:</strong>
                        @if ($order->status == 'needs_approval')
                            <span
                                class="badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'pending' ? 'warning' : 'info') }}">
                                {{ __('Needs to be approved') }}
                            </span>
                            {{-- admin can approve order --}}
                            <form action="{{ route('admin.orders.approve', $order->id) }}" method="POST"
                                style="display:inline;"
                                onsubmit="return confirm('هل أنت متأكد أنك تريد التاكيد بأن هذا الطلب مكتمل؟');">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm btn-primary">{{ __('Approve') }}</button>
                            </form>
                        @else
                            <span>
                                {{ __($order->status) }}
                            </span>
                        @endif
                    </div>
                    <p><strong>{{ __('Service') }}:</strong> {{ $order->service->name }}</p>
                    <p><strong>{{ __('Description') }}:</strong>
                        <br>
                        {!! nl2br(e($order->description)) !!}
                    </p>
                    {{-- <p><strong>{{ __('Deadline') }}:</strong> {{ $order->deadline->format('Y-m-d H:i') }}</p> --}}
                    <div class="mb-3">
                        @if ($order->total === null)
                            <span class="badge bg-warning">{{ __('Negotiating') }}</span>
                        @else
                            <p><strong>{{ __('Subtotal') }}:</strong> ${{ $order->subtotal }}</p>
                            <p><strong>{{ __('Discount') }}:</strong> ${{ $order->discount }}</p>
                            <p>
                                <strong>{{ __('Total') }}:</strong>
                                <span>${{ $order->total }}</span>
                                @if ($order->is_paid)
                                    <span class="badge bg-success">{{ __('Paid') }}</span>
                                @endif
                                @if (!$order->customer_accepted)
                                    <span class="badge bg-info">{{ __('Waiting for customer accept') }}</span>
                                @endif
                            </p>
                        @endif

                        @if ($order->total === null || !$order->customer_accepted)
                            <div class="action-buttons my-2">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#setOrderPriceModal">
                                    {{ __('Set Order Price') }}
                                </button>
                                @include('__modals.orders.set-price')
                            </div>
                        @endif
                        {{-- assign freelancer --}}
                        @if ($order->freelancer == null && $order->customer_accepted)
                            @if (!($offer = $order->offers->where('status', 'pending')->first()))
                                @include('partials.orders.assignFreelancer', ['id' => $order->id])
                            @else
                                <div>
                                    <span>
                                        {{ __('Waiting for freelancer to accept offer') . ' ' . $offer->freelancer->name }}
                                    </span>
                                    {{-- cancel offer --}}
                                    <form action="{{ route('offers.cancel', $offer->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('هل أنت متأكد أنك تريد إلغاء هذا العرض؟');">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            {{ __('Cancel') }}
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @else
                            @if ($order->offers->where('status', 'accepted')->first())
                                {{ $order->freelancer->name }}
                                @include('partials.orders.unassignFreelancer', [
                                    'id' => $order->id,
                                ])
                            @endif
                        @endif
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">{{ __('Customer Information') }}</h5>
                </div>
                <div class="card-body p-3">
                    <p><strong>{{ __('Name') }}:</strong> {{ $order->customer->name }}</p>
                    <p><strong>{{ __('Email') }}:</strong> {{ $order->customer->email }}</p>
                </div>
            </div>

            {{-- Customer Order Attachments --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">{{ __('Customer Order Attachments') }}</h5>
                </div>
                <div class="card-body">
                    @if ($order->attachments->count() > 0)
                        <ul>
                            @foreach ($order->attachments as $attachment)
                                <li>
                                    <a href="{{ asset('storage/' . $attachment->path) }}" target="_blank">
                                        {{ $attachment->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>{{ __('No attachments found.') }}</p>
                    @endif
                </div>
            </div>
            @if ($order->status !== 'pending')
                {{-- Upload Files --}}
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title">{{ __('Upload Files') }}</h5>
                    </div>
                    <div class="card-body p-3">
                        <form action="{{ route('orders.files.store', $order->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="files" class="form-label">{{ __('Select Files') }}</label>
                                <input type="file" class="form-control" id="files" name="files[]" multiple>
                            </div>
                            <button type="submit" class="btn btn-primary">{{ __('Upload') }}</button>
                        </form>
                    </div>
                </div>
            @endif

            {{-- Order Files --}}
            <div class="card mb-4">
                @if ($order->status !== 'pending')
                    <div class="card-header">
                        <h5 class="card-title">{{ __('Order Files') }}</h5>
                    </div>
                    <div class="card-body p-3">
                        @if ($order->files->count() > 0)
                            <ul>
                                @foreach ($order->files as $file)
                                    <li class="mb-2">
                                        <a href="{{ asset('storage/' . $file->path) }}" target="_blank">
                                            {{ $file->name }}
                                        </a>
                                        <form action="{{ route('admin.orders.files.destroy', $file->id) }}" method="POST"
                                            style="display:inline;"
                                            onsubmit="return confirm('هل أنت متأكد أنك تريد حذف هذا الملف؟');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                {{-- bs x icon --}}
                                                {{ __('Delete') }}
                                            </button>
                                        </form>
                                        {{-- admin accept file --}}
                                        @if (!$file->admin_accepted)
                                            <form action="{{ route('admin.orders.files.accept', $file->id) }}"
                                                method="POST" style="display:inline;"
                                                onsubmit="return confirm('هل أنت متأكد أنك تريد قبول هذا الملف؟');">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-success btn-sm">
                                                    {{ __('Accept') }}
                                                </button>
                                            </form>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>{{ __('No files found.') }}</p>
                        @endif
                    </div>
                @endif
            </div>

            @if ($order->status !== 'pending')
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title">{{ __('Update Progress') }}</h5>
                    </div>
                    <div class="card-body p-3">
                        <form action="{{ route('admin.orders.progress.store', $order->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                            <div class="mb-3">
                                <label for="note" class="form-label">{{ __('Progress Note') }}</label>
                                <textarea class="form-control" id="note" name="note" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">{{ __('Update Progress') }}</button>
                        </form>
                    </div>
                </div>
            @endif
        </div>

        <div class="col-md-4">
            {{-- <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title">{{ __('Actions') }}</h5>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('freelancer.chats', $order) }}"
                            class="btn btn-primary btn-block mb-2">{{ __('Access Order Chat') }}</a>
                        @if ($order->status != 'completed')
                            <form action="{{ route('freelancer.orders.request-extension', $order->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="btn btn-warning btn-block mb-2">{{ __('Request Deadline Extension') }}</button>
                            </form>
                        @endif
                        @if ($order->status == 'completed')
                            <a href="{{ route('freelancer.orders.download', $order->id) }}"
                                class="btn btn-success btn-block">{{ __('Download Completed Work') }}</a>
                        @endif
                    </div>
                </div> --}}

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">{{ __('Order Progress') }}</h5>
                </div>
                <div class="card-body p-3">
                    @if ($order->progress->count() > 0)
                        <ul class="timeline">
                            @foreach ($order->progress as $progress)
                                <li class="timeline-item">
                                    <div class="timeline-marker"></div>
                                    <div class="timeline-content mb-2">
                                        <h5 class="timeline-title">{{ __($progress->status) }}</h5>
                                        <p class="timeline-date">{{ $progress->created_at->format('Y-m-d H:i') }}</p>
                                        <p>{{ $progress->note }}</p>
                                    </div>
                                    {{-- accept order progress --}}
                                    @if (!$progress->admin_accepted)
                                        <form action="{{ route('admin.orders.progress.accept', $progress->id) }}"
                                            method="POST" style="display:inline;"
                                            onsubmit="return confirm('هل أنت متأكد أنك تريد قبول هذا التقدم؟');">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-success btn-sm">
                                                {{ __('Accept') }}
                                            </button>
                                        </form>
                                    @endif
                                    {{-- delete order progress --}}
                                    <form action="{{ route('admin.orders.progress.destroy', $progress->id) }}"
                                        method="POST" style="display:inline;"
                                        onsubmit="return confirm('هل أنت متأكد أنك تريد حذف هذا التقدم؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            {{ __('Delete') }}
                                        </button>
                                    </form>
                                    {{-- edit order progress modal button --}}
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#editOrderProgressModal-{{ $progress->id }}">
                                        {{ __('Edit') }}
                                    </button>
                                    @include('__modals.orders.edit-order-progress', [
                                        'progress' => $progress,
                                    ])
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>{{ __('No progress recorded yet.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
@section('page-styles')
    <style>
        .timeline {
            position: relative;
            padding: 0;
            list-style: none;
        }

        .timeline:before {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            left: 20px;
            width: 2px;
            background: #ccc;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 20px;
            padding-left: 40px;
        }

        .timeline-marker {
            position: absolute;
            top: 0;
            left: 15px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #007bff;
            border: 2px solid #fff;
        }

        .timeline-content {
            padding: 10px;
            background: #f8f9fa;
            border-radius: 4px;
        }

        .timeline-title {
            margin: 0;
            font-size: 1.1em;
        }

        .timeline-date {
            margin: 5px 0;
            color: #6c757d;
            font-size: 0.9em;
        }
    </style>
@endsection
@section('page-scripts')
    <script>
        // calculate total when subtotal or discount changes
        document.getElementById('subtotal').addEventListener('input', function() {
            const subtotal = parseFloat(this.value);
            const discount = parseFloat(document.getElementById('discount').value);
            const total = subtotal - discount;
            document.getElementById('total').value = total;
        });
        document.getElementById('discount').addEventListener('input', function() {
            const subtotal = parseFloat(document.getElementById('subtotal').value);
            const discount = parseFloat(this.value);
            const total = subtotal - discount;
            document.getElementById('total').value = total;
        });
    </script>
@endsection

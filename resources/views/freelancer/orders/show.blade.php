@extends('layouts.admin')
@section('title', __('Order Details'))

@section('content')
    <div class=" p-3 my-4">
        <h1 class="mb-4">
            {{ __('Order Details') }} #{{ $order->order_number }}
        </h1>
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
                        <p><strong>{{ __('Status') }}:</strong>
                            <span
                                class="badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'pending' ? 'warning' : 'info') }}">
                                @if ($order->status == 'needs_approval')
                                    {{ __('Needs Approval') }}
                                @else
                                    {{ __($order->status) }}
                                @endif
                            </span>
                        </p>
                        <p><strong>{{ __('Service') }}:</strong> {{ $order->service->name }}</p>
                        <p><strong>{{ __('Description') }}:</strong>
                            <br>
                            {!! nl2br(e($order->description)) !!}
                        </p>
                        {{-- <p><strong>{{ __('Deadline') }}:</strong> {{ $order->deadline->format('Y-m-d H:i') }}</p> --}}
                        <p><strong>{{ __('Price') }}:</strong>
                            @php
                                $freelancerOffer = $order->offers->where('freelancer_id', auth()->user()->id)->first();
                            @endphp
                            {{ $freelancerOffer ? $freelancerOffer->admin_price : '$$' }} $
                        </p>
                        @if ($order->status == 'in_progress')
                            <div class="mb-3">
                                <form action="{{ route('freelancer.orders.mark-completed', $order->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to mark this order as completed?');">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit"
                                        class="btn btn-success btn-block">{{ __('Mark Order as Completed') }}</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title">{{ __('Customer Information') }}</h5>
                    </div>
                    <div class="card-body p-3">
                        <p><strong>{{ __('Name') }}:</strong> {{ $order->customer->name }}</p>
                    </div>
                </div>

                {{-- Customer Order Attachments --}}
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title">{{ __('Customer Order Attachments') }}</h5>
                    </div>
                    <div class="card-body p-3">
                        @if ($order->attachments->count() > 0)
                            <ul>
                                @foreach ($order->attachments as $attachment)
                                    <li>
                                        <form action="{{ route('file.download') }}" method="GET">
                                            @csrf
                                            <input type="hidden" name="file_path" value="{{ urlencode($attachment->path) }}">
                                            <button type="submit" class="btn btn-link">
                                                {{ $attachment->name }}
                                                <i class="bi bi-download mx-2 text-success"></i>
                                            </button>
                                        </form>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>{{ __('No attachments found.') }}</p>
                        @endif
                    </div>
                </div>

                {{-- Upload Files --}}
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title">{{ __('Upload Files') }}</h5>
                    </div>
                    <div class="card-body p-3">
                        <form action="{{ route('freelancer.orders.files.store', $order->id) }}" method="POST"
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
                {{-- Order Files --}}
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title">{{ __('Order Files') }}</h5>
                    </div>
                    <div class="card-body p-3">
                        @if ($order->files->count() > 0)
                            <ul>
                                @foreach ($order->files as $file)
                                    <li class="mb-2">
                                        <form action="{{ route('file.download') }}"
                                            method="GET" class="d-inline text-primary">
                                            @csrf
                                            <input type="hidden" name="file_path" value="{{ urlencode($file->path) }}">
                                            <button type="submit" class="btn btn-link btn-sm">
                                                {{ $file->name }}
                                            </button>
                                        </form>
                                        <form action="{{ route('freelancer.orders.files.destroy', $file->id) }}"
                                            method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                {{-- bs x icon --}}
                                                <i class="bi bi-x"></i>
                                            </button>
                                        </form>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>{{ __('No files found.') }}</p>
                        @endif
                    </div>
                </div>
                @if ($order->status == 'in_progress')
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title">{{ __('Update Progress') }}</h5>
                        </div>
                        <div class="card-body p-3">
                            <form action="{{ route('freelancer.orders.progress.store', $order->id) }}" method="POST">
                                @csrf
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

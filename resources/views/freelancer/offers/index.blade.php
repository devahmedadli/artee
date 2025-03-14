@extends('layouts.admin')
@section('title', __('Offers'))
@section('content')

    <div class="card offers-list overflow-auto">
        <!-- Card body -->
        <div class="card-body">
            <h5 class="card-title">{{ __('Offers') }} <span>| {{ __('All') }}</span></h5>
            <!-- Table with responsive wrapper -->
            <div class="table-responfsive">
                <table class="table table-borderless datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Order Number') }}</th>
                            <th>{{ __('Service') }}</th>
                            <th>{{ __('Offered Price') }}</th>
                            <th>{{ __('Required Price') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($offers as $offer)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    {{ $offer->order->order_number }}
                                </td>
                                <td>{{ $offer->order->service->name }}</td>
                                <td>{{ $offer->admin_price }}</td>
                                <td>{{ $offer->freelancer_price ?? __('Not accepted yet') }}</td>
                                <td>
                                    @if ($offer->status == 'pending')
                                        <span class="badge bg-warning">{{ __('Pending') }}</span>
                                    @elseif ($offer->status == 'rejected')
                                        <span class="badge bg-danger">{{ __('Rejected') }}</span>
                                    @elseif ($offer->status == 'accepted')
                                        <span class="badge bg-success">{{ __('Accepted') }}</span>
                                    @elseif ($offer->status == 'canceled')
                                        <span class="badge bg-danger">{{ __('Canceled') }}</span>
                                    @elseif ($offer->status == 'negotiating')
                                        <span class="badge bg-info">{{ __('Negotiating') }}</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#orderDetails{{ $offer->id }}">
                                        {{ __('Order Details') }}
                                    </button>

                                    {{-- archive offer if is canceld --}}
                                    @if ($offer->status == 'canceled')
                                        <form action="{{ route('offers.freelancer-archive', $offer->id) }}" method="POST"
                                            class="d-inline-block"
                                            onsubmit="return confirm({{ __('Are you sure you want to archive this offer?') }});">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-secondary btn-sm">
                                                {{ __('Archive Offer') }}
                                            </button>
                                        </form>
                                    @endif
                                    @if ($offer->status == 'pending' || $offer->status == 'negotiating')
                                        {{-- Send Price button to open modal --}}
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#sendPrice{{ $offer->id }}">
                                            {{ __('Send Price') }}
                                        </button>
                                        {{-- Accept form --}}
                                        <form action="{{ route('freelancer.offers.accept', $offer->id) }}" method="POST"
                                            class="d-inline-block"
                                            onsubmit="return confirm({{ __('Are you sure you want to accept this offer?') }});">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-success btn-sm">
                                                {{ __('Accept Offer') }}
                                            </button>
                                        </form>
                                        {{-- Reject form --}}
                                        <form action="{{ route('freelancer.offers.reject', $offer->id) }}" method="POST"
                                            class="d-inline-block"
                                            onsubmit="return confirm({{ __('Are you sure you want to reject this offer?') }});">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                {{ __('Reject Offer') }}
                                            </button>
                                        </form>
                                    @endif
                                    {{-- modal to display order details --}}
                                    <div class="modal fade" id="orderDetails{{ $offer->id }}" tabindex="-1"
                                        aria-labelledby="orderDetailsLabel{{ $offer->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="orderDetailsLabel{{ $offer->id }}">
                                                        {{ __('Order Details') }}
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>
                                                        <strong>{{ __('Service') }}:</strong> {{ $offer->order->service->name }}
                                                        <br>
                                                        <strong>{{ __('Description') }}:</strong> {!! nl2br(e($offer->order->description)) !!}
                                                    </p>
                                                    {{-- order attachments --}}
                                                    @if ($offer->order->attachments)
                                                        <strong>{{ __('Attachments') }}:</strong>
                                                        <ol>
                                                            @foreach ($offer->order->attachments as $attachment)
                                                                <li class="d-block">
                                                                    <a href="{{ asset('storage/' . $attachment->path) }}"
                                                                        target="_blank">{{ $attachment->name }}
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ol>
                                                    @else
                                                        <p class="text-muted text-center">{{ __('No attachments') }}</p>
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">{{ __('Close') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Send Price Modal --}}
                                    @include('__modals.offers.send-price', ['offer' => $offer])
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

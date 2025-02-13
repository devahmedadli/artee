@extends('layouts.admin')
@section('title', __('Archived Offers'))
@section('content')

    <div class="card offers-list overflow-auto">
        <!-- Card body -->
        <div class="card-body">
            <h5 class="card-title">{{ __('Archived Offers') }} <span>| {{ __('All') }}</span></h5>
            <!-- Table with responsive wrapper -->
            <div class="table-responfsive">
                <table class="table table-borderless datatable">
                    <thead>
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Email') }}</th>
                            <th>{{ __('Price') }}</th>
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
                                <td>{{ $offer->freelancer->name }}</td>
                                <td>{{ $offer->freelancer->email }}</td>
                                <td>{{ $offer->admin_price }}</td>
                                <td>{{ $offer->freelancer_price ?? __('Not accepted yet') }}</td>
                                <td>
                                    @if ($offer->status == 'pending')
                                        <span class="badge bg-warning">{{ __('Pending') }}</span>
                                    @elseif ($offer->status == 'rejected')
                                        <span class="badge bg-danger">{{ __('Rejected') }}</span>
                                    @elseif ($offer->status == 'accepted')
                                        <span class="badge bg-success">{{ __('Accepted') }}</span>
                                    @elseif ($offer->status == 'negotiating')
                                        <span class="badge bg-info">{{ __('Negotiating') }}</span>
                                    @elseif ($offer->status == 'canceled')
                                        <span class="badge bg-danger">{{ __('Canceled') }}</span>
                                    @endif
                                </td>
                                <td>

                                    {{-- buton to archive offer --}}
                                    <form action="{{ route('offers.admin-unarchive', $offer->id) }}" method="POST"
                                        class="d-inline-block"
                                        onsubmit="return confirm('هل أنت متأكد أنك تريد إلغاء أرشيف هذا العرض؟');">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-warning btn-sm">
                                            {{ __('Unarchive Offer') }}
                                        </button>
                                    </form>
                                    {{-- Edit Modal --}}
                                    @include('__modals.offers.edit-offer', ['offer' => $offer])
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

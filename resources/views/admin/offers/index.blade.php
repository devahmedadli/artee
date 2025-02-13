@extends('layouts.admin')
@section('title', 'العروض')
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
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Email') }}</th>
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
                                <td>{{ $offer->freelancer_price ?? 'لم يقبل المستقل بعد' }}</td>
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
                                    @if ($offer->status == 'pending' || $offer->status == 'negotiating')
                                        {{-- Edit button to open modal --}}
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $offer->id }}">
                                            {{ __('Update') }}
                                        </button>
                                        {{-- Delete form --}}
                                        <form action="{{ route('offers.cancel', $offer->id) }}" method="POST"
                                            class="d-inline-block"
                                            onsubmit="return confirm('هل أنت متأكد أنك تريد إلغاء هذا العرض؟');">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                {{ __('Cancel') }}
                                            </button>
                                        </form>
                                    @else
                                        {{-- buton to archive offer --}}
                                        <form action="{{ route('offers.admin-archive', $offer->id) }}" method="POST"
                                            class="d-inline-block"
                                            onsubmit="return confirm('هل أنت متأكد أنك تريد أرشيف هذا العرض؟');">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-warning btn-sm">
                                                {{ __('Archive') }}
                                            </button>
                                        </form>
                                    @endif

                                    {{-- Edit Modal --}}
                                    <div class="modal fade" id="editModal{{ $offer->id }}" tabindex="-1"
                                        aria-labelledby="editModalLabel{{ $offer->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel{{ $offer->id }}">
                                                        {{ __('Update Price') }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('offers.update', $offer->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="admin_price" class="form-label">
                                                                {{ __('Offered Price') }}
                                                            </label>
                                                            <input type="number" class="form-control" id="admin_price"
                                                                name="admin_price" value="{{ $offer->admin_price }}"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">
                                                            {{ __('Cancel') }}
                                                        </button>
                                                        <button type="submit" class="btn btn-primary">
                                                            {{ __('Save') }}
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

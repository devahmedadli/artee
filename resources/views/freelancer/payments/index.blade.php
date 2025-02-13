@extends('layouts.admin')
@section('title', __('Payments'))
@section('content')

    <div class="card freelancers-list overflow-auto">
        <!-- Card body -->
        <div class="card-body">
            <h5 class="card-title">{{ __('Payments List') }} <span>| {{ __('All') }}</span></h5>
            <!-- Table with responsive wrapper -->
            <div class="table-responfsive">
                <table class="table table-borderless datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Amount') }}</th>
                            <th>{{ __('Date') }}</th>
                            <th>{{ __('Method') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $payment)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $payment->amount }} $</td>
                                <td>{{ $payment->date }}</td>
                                <td>{{ $payment->method }}</td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#showPaymentModal-{{ $payment->id }}">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @foreach ($payments as $payment)
        {{-- show payment modal --}}
        <div class="modal fade" id="showPaymentModal-{{ $payment->id }}" tabindex="-1"
            aria-labelledby="showPaymentModalLabel-{{ $payment->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="showPaymentModalLabel-{{ $payment->id }}">{{ __('Payment Details') }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>{{ __('Amount') }}: {{ $payment->amount }} $ </p>
                        <p>{{ __('Date') }}: {{ $payment->date }}</p>
                        <p>{{ __('Method') }}: {{ $payment->method }}</p>
                        <p>{{ __('Details') }}: {{ $payment->details }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

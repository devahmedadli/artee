@extends('layouts.admin')
@section('title', 'المدفوعات')
@section('content')

    <div class="card freelancers-list overflow-auto">
        <!-- Card body -->
        <div class="card-body">
            <h5 class="card-title">قائمة المدفوعات <span>| الكل</span></h5>
            <div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPaymentModal">
                    تسجيل عملية دفع جديدة
                </button>

            </div>
            <!-- Table with responsive wrapper -->
            <div class="table-responfsive">
                <table class="table table-borderless datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الاسم</th>
                            <th>البريد الالكتروني</th>
                            <th>المبلغ</th>
                            <th>الاجراء</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $payment)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $payment->freelancer->name }}</td>
                                <td>{{ $payment->freelancer->email }}</td>
                                <td>{{ $payment->amount }} $</td>
                                <td>
                                    {{-- show --}}
                                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#showPaymentModal-{{ $payment->id }}">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#editPaymentModal-{{ $payment->id }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <form action="{{ route('payments.destroy', $payment->id) }}" method="POST"
                                        class="d-inline-block"
                                        onsubmit="return confirm('هل أنت متأكد أنك تريد حذف هذا الدفع؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @foreach ($payments as $payment)
        @include('__modals.payments.edit-payment', ['freelancers' => $freelancers, 'payment' => $payment])
        @include('__modals.payments.show', ['payment' => $payment])
    @endforeach
    {{-- add payment button modal --}}
    @include('__modals.payments.add-payment', ['freelancers' => $freelancers])
@endsection

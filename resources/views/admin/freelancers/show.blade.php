@extends('layouts.admin')
@section('title', 'بيانات المستقل')
@section('content')
    <div class="card p-3">
        <div class="card-body">
            <div class="action-btns mb-4">
                <a href="{{ route('freelancers.index') }}" class="btn btn-main me-2">
                    <i class="bi bi-arrow-right"></i>
                </a>
                <a href="{{ route('freelancers.edit', $freelancer) }}" class="btn btn-primary me-2">
                    <i class="bi bi-pencil-square"></i>
                </a>
                <form action="{{ route('freelancers.destroy', $freelancer) }}" method="POST" class="d-inline-block"
                    onsubmit="return confirm('Are you sure you want to delete this freelancer?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">الاسم</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $freelancer->name }}"
                        readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="username" class="form-label">اسم المستخدم</label>
                    <input type="text" id="username" name="username" class="form-control"
                        value="{{ $freelancer->username }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">البريد الالكتروني</label>
                    <input type="text" id="email" name="email" class="form-control"
                        value="{{ $freelancer->email }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="phone" class="form-label">رقم الهاتف</label>
                    <input type="text" id="phone" name="phone" class="form-control"
                        value="{{ $freelancer->phone }}" readonly>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="bio" class="form-label">نبذة</label>
                    <textarea id="bio" name="bio" class="form-control" rows="3" readonly>{{ $freelancer->freelancer->bio }}</textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="country" class="form-label">الدولة</label>
                    <input type="text" id="country" name="country" class="form-control"
                        value="{{ $freelancer->freelancer->country }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="website" class="form-label">الموقع الالكتروني</label>
                    <input type="text" id="website" name="website" class="form-control"
                        value="{{ $freelancer->freelancer->website }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="specification" class="form-label">التخصص</label>
                    <input type="text" id="specification" name="specification" class="form-control"
                        value="{{ $freelancer->freelancer->specification }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="skills" class="form-label">المهارات</label>
                    <input type="text" id="skills" name="skills" class="form-control"
                        value="{{ $freelancer->freelancer->skills }}" readonly>
                </div>
            </div>
        </div>
    </div>
    <div class="card p-3 mt-4">
        <div class="card-body">
            <h3>الطلبات المسندة</h3>
            <table class="table table-borderless datatable">
                <thead>
                    <tr>
                        <th>رقم الطلب</th>
                        <th>الخدمة</th>
                        <th>تاريخ الاسناد</th>
                        <th>الحالة</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($freelancer->assignedOrders as $assignment)
                        <tr>
                            <td>{{ $assignment->order->order_number }}</td>
                            <td>{{ $assignment->order->service->name }}</td>
                            <td>{{ $assignment->created_at->format('Y-m-d') }}</td>
                            <td>
                                <span
                                    class="badge bg-{{ $assignment->order->status == 'completed' ? 'success' : 'info' }}">
                                    {{ __($assignment->order->status) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card p-3 mt-4">
        <div class="card-body">
            <h3>المدفوعات</h3>
            <table class="table table-borderless datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>المبلغ</th>
                        <th>التاريخ</th>
                        <th>عرض</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($freelancer->freelancerPayments as $payment)
                        <tr>
                            <td>{{ $payment->id }}</td>
                            <td>{{ $payment->amount }} $</td>
                            <td>{{ $payment->created_at->format('Y-m-d') }}</td>
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
    @foreach ($freelancer->freelancerPayments as $payment)  
        @include('__modals.payments.show', ['payment' => $payment])
        
    @endforeach
@endsection

@extends('layouts.admin')
@section('title', 'بيانات الزبون')
@section('content')
    <div class="card p-3">
        <div class="card-body">
            <div class="action-btns mb-4">
                {{-- edit --}}
                <a href="{{ route('customers.index') }}" class="btn btn-main me-2">
                    <i class="bi bi-arrow-right"></i>
                </a>
                <a href="{{ route('customers.edit', $customer) }}" class="btn btn-primary me-2">
                    <i class="bi bi-pencil-square"></i>
                </a>
                <form action="{{ route('customers.destroy', $customer) }}" method="POST" class="d-inline-block"
                    onsubmit="return confirm('Are you want to delete this customer?');">
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
                    <input type="text" id="name" name="name" class="form-control" value="{{ $customer->name }}"
                        readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="username" class="form-label">اسم المستخدم</label>
                    <input type="text" id="username" name="username" class="form-control"
                        value="{{ $customer->username }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">البريد الالكتروني</label>
                    <input type="text" id="email" name="email" class="form-control" value="{{ $customer->email }}"
                        readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="phone" class="form-label">رقم الهاتف</label>
                    <input type="text" id="phone" name="phone" class="form-control" value="{{ $customer->phone }}"
                        readonly>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="address" class="form-label">العنوان</label>
                    <textarea id="address" name="address" class="form-control" rows="3" readonly>{{ $customer->customer?->address }}</textarea>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="company" class="form-label">الشركة</label>
                    <input type="text" id="company" name="company" class="form-control"
                        value="{{ $customer->customer?->company }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="lang" class="form-label">اللغة</label>
                    <select id="lang" name="lang" class="form-control" disabled>
                        <option value="ar" {{ $customer->lang === 'ar' ? 'selected' : '' }}>العربية</option>
                        <option value="en" {{ $customer->lang === 'en' ? 'selected' : '' }}>English</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>
            </div>

        </div>
    </div>
    <div class="card p-3">
        <div class="card-body">
            <h3>الاوردرات</h3>
            <table class="table table-borderless datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>رقم الطلب</th>
                        <th>الخدمة</th>
                        <th>تاريخ الطلب</th>
                        <th>المبلغ الفرعي</th>
                        <th>الخصم</th>
                        <th>المبلغ الكلي</th>
                        <th>الحالة</th>
                        <th>الاجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ $order->service?->name ?? '' }}</td>
                            <td>{{ $order->created_at }}</td>
                            <td>{{ $order->subtotal }}$</td>
                            <td>{{ $order->discount }} $</td>
                            <td>{{ $order->total }}$</td>
                            <td>
                                <span
                                    class="badge bg-{{ $order->status == 'approved' ? 'success' : ($order->status == 'rejected' ? 'danger' : ($order->status == 'completed' ? 'info' : 'warning')) }} text-capitalize">
                                    {{ __($order->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('orders.show', $order) }}" class="btn btn-primary btn-sm">
                                    {{ __('View') }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

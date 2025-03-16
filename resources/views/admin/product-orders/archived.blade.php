@extends('layouts.admin')
@section('title', 'الطلبات من الأرشيف')
@section('content')

    <div class="card orders-list overflow-auto">
        <!-- Card body -->
        <div class="card-body">
            <h5 class="card-title">قائمة الطلبات من الأرشيف <span>| الكل</span></h5>
            <!-- Table with responsive wrapper -->
            <div class="table-responsive">
                <table class="table table-borderless datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>رقم الطلب</th>
                            <th>الزبون</th>
                            <th>المستقل</th>
                            <th>المبلغ</th>
                            <th>الحالة</th>
                            <th>الاجراء</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $order->order_number }}</td>
                                <td>{{ $order->customer->name }}</td>
                                <td>
                                    {{ $order->freelancer ?? 'لم يتم تعيين مستقل' }}
                                </td>
                                <td>{{ $order->total }} $</td>
                                <td>
                                    <span
                                        class="badge bg-{{ $order->status == 'delivered' ? 'primary' : ($order->status == 'completed' ? 'success' : ($order->status == 'canceled' ? 'danger' : ($order->status == 'pending' ? 'warning' : 'info'))) }} text-capitalize">
                                        {{ __($order->status) }}
                                    </span>
                                </td>
                                <td class="text-nowrap">
                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary">
                                        عرض الطلب
                                    </a>
                                    {{-- unarchive --}}
                                    <form action="{{ route('orders.admin-unarchive', $order->id) }}" method="POST"
                                        class="d-inline-block"
                                        onsubmit="return confirm('هل أنت متأكد أنك تريد إلغاء أرشيف هذا الطلب؟');">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-warning">
                                            إلغاء أرشيف الطلب
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

@endsection

@extends('layouts.admin')
@section('title', 'الطلبات')
@section('content')

    <div class="card orders-list overflow-auto">
        <!-- Card body -->
        <div class="card-body">
            <h5 class="card-title">قائمة الطلبات <span>| الكل</span></h5>
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
                            <th>حالة الدفع</th>
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
                                    @if ($order->freelancer == null)
                                        @include('partials.orders.assignFreelancer', ['id' => $order->id])
                                    @else
                                        {{ $order->freelancer->name }}
                                        @include('partials.orders.unassignFreelancer', [
                                            'id' => $order->id,
                                        ])
                                    @endif
                                </td>
                                <td>
                                    @if ($order->total && $order->customer_accepted)
                                        {{ $order->total }} $
                                    @else
                                        <span class="badge bg-warning">
                                            {{ __('Negotiating') }}
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <span
                                        class="badge bg-{{ $order->status == 'delivered' ? 'primary' : ($order->status == 'completed' ? 'success' : ($order->status == 'canceled' || $order->status == 'rejected' ? 'danger' : ($order->status == 'pending' ? 'warning' : 'info'))) }} text-capitalize">
                                        @if ($order->status == 'needs_approval')
                                            <span class="badge bg-info">
                                                {{ __('Needs Approval') }}
                                            </span>
                                        @elseif ($order->status == 'pending')
                                            <span class="badge bg-warning">
                                                {{ __('Pending') }}
                                            </span>
                                        @elseif ($order->status == 'accepted')
                                            <span class="badge bg-success">
                                                {{ __('Accepted') }}
                                            </span>
                                        @elseif ($order->status == 'in_progress')
                                            <span class="badge bg-info">
                                                {{ __('In Progress') }}
                                            </span>
                                        @elseif ($order->status == 'completed')
                                            <span class="badge bg-success">
                                                {{ __('Completed') }}
                                            </span>
                                        @elseif ($order->status == 'canceled')
                                            <span class="badge bg-danger">
                                                {{ __('Canceled') }}
                                            </span>
                                        @elseif ($order->status == 'rejected')
                                            <span class="badge bg-danger">
                                                {{ __('Rejected') }}
                                            </span>
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="badge bg-{{ $order->is_paid ? 'success' : 'danger' }}">
                                        {{ $order->is_paid ? 'مدفوع' : 'غير مدفوع' }}
                                    </span>
                                </td>
                                <td class="text-nowrap">
                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary">
                                        عرض
                                    </a>
                                    {{-- archive order --}}
                                    <form action="{{ route('orders.admin-archive', $order->id) }}" method="POST"
                                        class="d-inline-block"
                                        onsubmit="return confirm('هل أنت متأكد من أرشفة هذا الطلب؟');">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-secondary">
                                            أرشيف
                                        </button>
                                    </form>
                                    @if ($order->status == 'pending')
                                        {{-- reject order --}}
                                        <form action="{{ route('orders.reject', $order->id) }}" method="POST"
                                            class="d-inline-block"
                                            onsubmit="return confirm('هل أنت متأكد من رفض هذا الطلب؟');">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-warning">
                                                رفض
                                            </button>
                                        </form>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@extends('layouts.admin')
@section('title', 'الزبائن')
@section('content')

    <div class="card customers-list overflow-auto">
        <!-- Card body -->
        <div class="card-body">
            <h5 class="card-title">قائمة الزبائن <span>| الكل</span></h5>
            {{-- Add customer button --}}
            {{-- <div>
                <a href="{{ route('customers.create') }}" class="btn btn-primary">
                    إضافة زبون جديد
                </a>
            </div> --}}
            <!-- Table with responsive wrapper -->
            <div class="table-responsive">
                <table class="table table-borderless datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الاسم</th>
                            <th>البريد الالكتروني</th>
                            <th>الطلبات</th>
                            <th>قيمة الطلبات</th>
                            <th>الاجراء</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->customerOrders->count() }}</td>
                                <td>{{ $customer->customerOrders->sum('amount') }} $</td>
                                <td class="text-nowrap">
                                    {{-- <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning btn-sm">Edit</a> --}}
                                    {{-- show --}}
                                    <a href="{{ route('customers.show', $customer->id) }}" class="btn btn-primary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('customers.edit', $customer->id) }}"
                                        class="btn btn-info">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('customers.destroy', $customer->id) }}" method="POST"
                                        class="d-inline-block"
                                        onsubmit="return confirm('Are you want to delete this customer?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
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

@endsection

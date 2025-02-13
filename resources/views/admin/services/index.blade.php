@extends('layouts.admin')
@section('title', 'الخدمات')
@section('content')

    <div class="card services-list overflow-auto">
        <!-- Card body -->
        <div class="card-body">
            <h5 class="card-title">قائمة الخدمات <span>| الكل</span></h5>
            {{-- Add service button --}}
            <div>
                <a href="{{ route('services.create') }}" class="btn btn-primary">
                    إضافة خدمة جديدة
                </a>
            </div>
            <!-- Table with responsive wrapper -->
            <div class="table-responfsive">
                <table class="table table-borderless datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الخدمة</th>
                            <th>السعر</th>
                            <th>الوصف</th>
                            <th>عدد المنتجات</th>
                            <th>الاجراء</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $service)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $service->name }}</td>
                                <td>{{ $service->price }}</td>
                                <td>{{ $service->description }}</td>
                                <td>{{ $service->products->count() }}</td>
                                <td>
                                    {{-- <a href="{{ route('services.edit', $service->id) }}" class="btn btn-warning btn-sm">Edit</a> --}}
                                    {{-- show --}}
                                    <a href="{{ route('services.edit', $service->id) }}" class="btn btn-info btn-sm">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('services.destroy', $service->id) }}" method="POST"
                                        class="d-inline-block"
                                        onsubmit="return confirm('Are you want to delete this service?');">
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

@endsection

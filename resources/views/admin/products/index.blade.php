@extends('layouts.admin')
@section('title', 'المنتجات')
@section('content')

    <div class="card products-list overflow-auto">
        <!-- Card body -->
        <div class="card-body">
            <h5 class="card-title">قائمة المنتجات <span>| الكل</span></h5>
            {{-- Add product button --}}
            <div>
                <a href="{{ route('products.create') }}" class="btn btn-primary">
                    إضافة منتج جديد
                </a>
            </div>
            <!-- Table with responsive wrapper -->
            <div class="table-responsive">
                <table class="table table-borderless datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الاسم</th>
                            <th>الخدمة</th>
                            <th>السعر</th>
                            <th>الاجراء</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->service->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-info btn-sm">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                        class="d-inline-block"
                                        onsubmit="return confirm('هل أنت متأكد من حذف هذا المنتج؟');">
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

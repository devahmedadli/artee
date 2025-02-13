@extends('layouts.admin')
@section('content')
    <form action="{{ route('products.store') }}" method="post" class="row shadow-sm border bg-white p-3" enctype="multipart/form-data">
        @csrf
        <h2 class="mb-5 fw-bold text-muted">إضافة منتج جديد</h2>
        @include('partials.errors')
        <div class="col-md-6 mb-3">
            <label for="name" class="form-label">اسم المنتج</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="service_id" class="form-label">الخدمة</label>
            <select id="service_id" name="service_id" class="form-control" required>
                @foreach($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label for="price" class="form-label">السعر</label>
            <input type="number" id="price" name="price" class="form-control" step="0.01" required>
        </div>
        {{-- <div class="col-md-6 mb-3">
            <label for="active" class="form-label">الحالة</label>
            <select id="active" name="active" class="form-control" required>
                <option value="1">مفعل</option>
                <option value="0">معطل</option>
            </select>
        </div> --}}
        <div class="col-md-6 mb-3">
            <label for="image" class="form-label">الصورة</label>
            <input type="file" id="image" name="image" class="form-control" required>
        </div>
        <div class="col-12 mb-3">
            <label for="description" class="form-label">الوصف</label>
            <textarea id="description" name="description" class="form-control" rows="10"></textarea>
        </div>
        <div class="text-center mt-3">
            <input type="submit" value="حفظ" class="btn btn-success px-5">
        </div>
    </form>
@endsection

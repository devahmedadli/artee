@extends('layouts.admin')
@section('title', 'إدخال بيانات الخدمة')
@section('content')
    <form action="{{ route('services.store') }}" method="post" class="row shadow-sm border bg-white p-3"
        enctype="multipart/form-data">
        @csrf
        @include('partials.errors')
        <div class="col-md-6 mb-3">
            <label for="name" class="form-label">اسم الخدمة</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="price" class="form-label">السعر</label>
            <input type="number" id="price" name="price" class="form-control" step="0.01" required>
        </div>
        <div class="col-12 mb-3">
            <label for="description" class="form-label">الوصف</label>
            <textarea id="description" name="description" class="form-control" rows="4" required></textarea>
        </div>
        <div class="col-md-6 mb-3">
            <label for="image" class="form-label">الصورة</label>
            <input type="file" id="image" name="image" class="form-control" required>
        </div>
        <div class="text-center mt-3">
            <input type="submit" value="حفظ" class="btn btn-success px-5">
        </div>
    </form>
@endsection

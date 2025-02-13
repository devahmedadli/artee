@extends('layouts.admin')

@section('content')
    <form action="{{ route('services.update', $service->id) }}" method="post" class="row bg-white border p-3"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <h2 class="mb-5 fw-bold text-muted">تعديل بيانات الخدمة</h2>
        @include('partials.errors')

        <div class="col-md-6 mb-3">
            <label for="name" class="form-label">اسم الخدمة</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $service->name) }}"
                required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="price" class="form-label">السعر</label>
            <input type="number" id="price" name="price" class="form-control" step="0.01"
                value="{{ old('price', $service->price) }}" required>
        </div>
        <div class="col-12 mb-3">
            <label for="description" class="form-label">الوصف</label>
            <textarea id="description" name="description" class="form-control" rows="4" required>{{ old('description', $service->description) }}</textarea>
        </div>
        <div class="col-md-6 mb-3">
            <label for="image" class="form-label">الصورة</label>
            <input type="file" id="image" name="image" class="form-control">
            @if($service->image)
                <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}" class="mt-2" style="max-width: 200px;">
            @endif
        </div>
        <div class="text-center mt-3">
            <input type="submit" value="حفظ" class="btn btn-success px-5">
        </div>
    </form>
@endsection

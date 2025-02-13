@extends('layouts.admin')

@section('content')
    <form action="{{ route('products.update', $product->id) }}" method="post" class="row bg-white border p-3"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <h2 class="mb-5 fw-bold text-muted">تعديل بيانات المنتج</h2>
        @include('partials.errors')

        <div class="col-md-6 mb-3">
            <label for="name" class="form-label">اسم المنتج</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $product->name) }}"
                required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="price" class="form-label">السعر</label>
            <input type="number" id="price" name="price" class="form-control" step="0.01"
                value="{{ old('price', $product->price) }}" required>
        </div>
        <div class="col-md-12 mb-3">
            <label for="description" class="form-label">الوصف</label>
            <textarea id="description" name="description" class="form-control" rows="10">{{ old('description', $product->description) }}</textarea>
        </div>
        <div class="col-md-6 mb-3">
            <label for="service" class="form-label">الخدمة</label>
            <select id="service" name="service_id" class="form-select" required>
                @foreach ($services as $service)
                    <option value="{{ $service->id }}" {{ $product->service_id == $service->id ? 'selected' : '' }}>
                        {{ $service->name }}
                    </option>
                @endforeach
            </select>
        </div>
        {{-- <div class="col-md-6 mb-3">
            <label for="status" class="form-label">الحالة</label>
            <select id="status" name="status" class="form-select" required>
                <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>نشط</option>
                <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>غير نشط</option>
            </select>
        </div> --}}
        <div class="col-md-6 mb-3">
            <label for="image" class="form-label">صورة المنتج</label>
            <input type="file" id="image" name="image" class="form-control">
            @if ($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="mt-2"
                    style="max-width: 200px;">
            @endif
        </div>
        <div class="text-center mt-3">
            <input type="submit" value="حفظ" class="btn btn-success px-5">
        </div>
    </form>
@endsection

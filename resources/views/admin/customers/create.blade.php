@extends('layouts.admin')
@section('title', 'تسجيل زبون جديد')
@section('content')

    <div class="card p-3">
        <div class="card-body">
            {{-- @include('partials.errors') --}}
            <form action="{{ route('customers.store') }}" method="POST">
                @csrf
                <div class="row">
                    <!-- Name Field -->
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">الاسم</label>
                        <input type="text" id="name" name="name"
                            class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email Field -->
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">البريد الالكتروني</label>
                        <input type="email" id="email" name="email"
                            class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Phone Field -->
                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label">رقم الهاتف</label>
                        <input type="text" id="phone" name="phone"
                            class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Language Field -->
                    <div class="col-md-6 mb-3">
                        <label for="lang" class="form-label">اللغة</label>
                        <select id="lang" name="lang" class="form-select @error('lang') is-invalid @enderror"
                            required>
                            <option value="ar" {{ old('lang') === 'ar' ? 'selected' : '' }}>العربية</option>
                            <option value="en" {{ old('lang') === 'en' ? 'selected' : '' }}>English</option>
                        </select>
                        @error('lang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">كلمة المرور</label>
                        <input type="password" id="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Address Field -->
                    <div class="col-md-12 mb-3">
                        <label for="address" class="form-label">العنوان</label>
                        <textarea id="address" name="address" class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Company Field -->
                    <div class="col-md-12 mb-3">
                        <label for="company" class="form-label">الشركة</label>
                        <input type="text" id="company" name="company"
                            class="form-control @error('company') is-invalid @enderror" value="{{ old('company') }}">
                        @error('company')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">حفظ</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection

@extends('layouts.admin')

@section('content')
    <form action="{{ route('users.update', $user->id) }}" method="post" class="row bg-white border p-3"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <h2 class="mb-5 fw-bold text-muted">تعديل بيانات المستخدم</h2>
        @include('partials.errors')

        <div class="col-md-6 mb-3">
            <label for="name" class="form-label">الاسم</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}"
                required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="email" class="form-label">البريد الالكتروني</label>
            <input type="text" id="email" name="email" class="form-control"
                value="{{ old('username', $user->username) }}" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="password" class="form-label">كلمة المرور</label>
            <input type="password" id="password" name="password" class="form-control">
            <small>اترك الحقل فارغًا إذا كنت لا تريد تغيير كلمة المرور</small>
        </div>
        <div class="text-center mt-3">
            <input type="submit" value="حفظ" class="btn btn-success px-5">
        </div>
    </form>
@endsection

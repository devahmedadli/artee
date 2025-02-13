@extends('layouts.admin')
@section('content')
    <form action="{{ route('users.store') }}" method="post" class="row shadow-sm border bg-white p-3"
        enctype="multipart/form-data">
        @csrf
        <h2 class="mb-5 fw-bold text-muted">إدخال بيانات المستخدم</h2>
        @include('partials.errors')

        <div class="col-md-6 mb-3">
            <label for="name" class="form-label">الاسم</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="email" class="form-label">البريد الالكتروني</label>
            <input type="text" id="email" name="email" class="form-control" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="password" class="form-label">كلمة المرور</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <div class="text-center mt-3">
            <input type="submit" value="حفظ" class="btn btn-success px-5">
        </div>
    </form>


@endsection

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
        <div class="col-12 container mb-3">
            <h3 class="form-label fw-bold">الصلاحيات</h3>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <div class="d-flex justify-content-between flex-row-reverse p-2 mb-2 bg-white">
                        <input class="form-check-input border-2 border-dark-subtle" role="button" type="checkbox"
                            name="is_admin" value="1" id="is_admin" onclick="handleAdminCheckbox()">
                        <label class="form-check-label" for="is_admin">
                            مدير (كافة الصلاحيات)
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <div class="d-flex justify-content-between flex-row-reverse p-2 mb-2 bg-white p-1">
                        <input class="form-check-input border-2 border-dark-subtle" role="button" type="checkbox"
                            name="privileges[users]" id="users_privilege">
                        <label class="form-check-label" for="users_privilege">
                            المستخدمين
                        </label>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="d-flex justify-content-between flex-row-reverse p-2 mb-2 bg-white p-1">
                        <input class="form-check-input border-2 border-dark-subtle" role="button" type="checkbox"
                            name="privileges[offers]" id="offers_privilege">
                        <label class="form-check-label" for="offers_privilege">
                            العروض
                        </label>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="d-flex justify-content-between flex-row-reverse p-2 mb-2 bg-white p-1">
                        <input class="form-check-input border-2 border-dark-subtle" role="button" type="checkbox"
                            name="privileges[requests]" id="requests_privilege">
                        <label class="form-check-label" for="requests_privilege">
                            الطلبات
                        </label>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="d-flex justify-content-between flex-row-reverse p-2 mb-2 bg-white p-1">
                        <input class="form-check-input border-2 border-dark-subtle" role="button" type="checkbox"
                            name="privileges[site_info]" id="site_info_privilege">
                        <label class="form-check-label" for="site_info_privilege">
                            معلومات الموقع
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-3">
            <input type="submit" value="حفظ" class="btn btn-success px-5">
        </div>
    </form>


@endsection

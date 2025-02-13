@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2 class="mb-5 fw-bold text-muted">عرض بيانات المستخدم</h2>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">الاسم</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}" readonly>
            </div>
            <div class="col-md-6 mb-3">
                <label for="email" class="form-label">البريد الالكتروني</label>
                <input type="text" id="email" name="email" class="form-control" value="{{ $user->username }}"
                    readonly>
            </div>
            <div class="col-md-6 mb-3">
                <label for="is_admin" class="form-label">مدير</label>
                <input type="checkbox" id="is_admin" name="is_admin" class="form-check-input"
                    {{ $user->is_admin ? 'checked' : '' }} disabled>
            </div>
        </div>
        <div class="col-12 container mb-3">
            <h3 class="form-label fw-bold">الصلاحيات</h3>
            <div class="row">
                @php
                    $privileges = $user->privileges ? json_decode($user->privileges->privileges, true) : [];
                @endphp
                <div class="col-md-3 mb-3">
                    <label class="form-label">المستخدمين</label>
                    <div class="d-flex justify-content-between flex-row-reverse p-2 mb-2 bg-white p-1">
                        <input class="form-check-input border-2 border-dark-subtle" role="button" type="checkbox"
                            name="privileges[users]" value="true" id="users_privilege"
                            {{ isset($privileges['users']) ? 'checked' : '' }} disabled>
                        <label class="form-check-label" for="users_privilege">
                            المستخدمين
                        </label>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">العروض</label>
                    <div class="d-flex justify-content-between flex-row-reverse p-2 mb-2 bg-white p-1">
                        <input class="form-check-input border-2 border-dark-subtle" role="button" type="checkbox"
                            name="privileges[offers]" value="true" id="offers_privilege"
                            {{ isset($privileges['offers']) ? 'checked' : '' }} disabled>
                        <label class="form-check-label" for="offers_privilege">
                            العروض
                        </label>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">الطلبات</label>
                    <div class="d-flex justify-content-between flex-row-reverse p-2 mb-2 bg-white p-1">
                        <input class="form-check-input border-2 border-dark-subtle" role="button" type="checkbox"
                            name="privileges[requests]" value="true" id="requests_privilege"
                            {{ isset($privileges['requests']) ? 'checked' : '' }} disabled>
                        <label class="form-check-label" for="requests_privilege">
                            الطلبات
                        </label>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">معلومات الموقع</label>
                    <div class="d-flex justify-content-between flex-row-reverse p-2 mb-2 bg-white p-1">
                        <input class="form-check-input border-2 border-dark-subtle" role="button" type="checkbox"
                            name="privileges[site_info]" value="true" id="site_info_privilege"
                            {{ isset($privileges['site_info']) ? 'checked' : '' }} disabled>
                        <label class="form-check-label" for="site_info_privilege">
                            معلومات الموقع
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('users.index') }}" class="btn btn-primary px-5">رجوع</a>
        </div>
    </div>
@endsection

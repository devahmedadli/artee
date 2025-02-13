@extends('layouts.admin')
@section('title', 'Artee | تسجيل دخول المسؤول')
<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                <div class="d-flex justify-content-center py-4">
                    <a href="index.html" class="logo d-flex align-items-center w-auto">
                        <img src="assets/img/logo.png" alt="">
                        <span class="d-none d-lg-block">Artee</span>
                    </a>
                </div><!-- End Logo -->

                <div class="card mb-3">

                    <div class="card-body">

                        <div class="pt-4 pb-2">
                            <h5 class="card-title text-center pb-0 fs-4">تسجيل الدخول لحسابك</h5>
                            <p class="text-center small">أدخل البريد الالكتروني وكلمة المرور لتسجيل الدخول</p>
                        </div>

                        <form class="row g-3 needs-validation" novalidate action="{{ route('login.post') }}"
                            method="POST">
                            @csrf

                            <div class="col-12">
                                <label for="yourUsername" class="form-label">البريد الالكتروني</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                                    <input type="text" name="username" class="form-control" id="yourUsername"
                                        required>
                                    <div class="invalid-feedback">يرجى إدخال البريد الالكتروني.</div>
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="yourPassword" class="form-label">كلمة المرور</label>
                                <input type="password" name="password" class="form-control" id="yourPassword" required>
                                <div class="invalid-feedback">يرجى إدخال كلمة المرور!</div>
                            </div>

                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" value="true"
                                        id="rememberMe">
                                    <label class="form-check-label" for="rememberMe">تذكرني</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100" type="submit">تسجيل الدخول</button>
                            </div>
                        </form>

                    </div>
                </div>

                <div class="credits">
                    <!-- يجب أن تظل جميع الروابط في التذييل كما هي. -->
                    <!-- يمكنك حذف الروابط فقط إذا كنت قد اشتريت النسخة الاحترافية. -->
                    <!-- معلومات الترخيص: https://bootstrapmade.com/license/ -->
                    <!-- اشترِ النسخة الاحترافية مع نموذج اتصال PHP/AJAX العامل: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                    <!-- صممه <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
                </div>
            </div>
        </div>
    </div>

</section>

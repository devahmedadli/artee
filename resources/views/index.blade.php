@extends('layouts.home')
@section('title', __('Home'))

@section('hero')
    @include('partials.index-hero')
@endsection

@section('content')
    <main>
        <!-- About -->
        <section id="about" class="d-flex align-items-center py-5 min-vh-100">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-5">
                        <div class="about-img text-center h-100 shadow-lg bg-main p-3" data-aos="fade-right">
                            <img src="{{ asset('storage/' . $weAre->we_are_image) }}"
                                class="img-thumbnail rounded-0 border-4 border-light position-relative" alt="صورة بطولية"
                                loading="lazy">
                        </div>
                    </div>
                    <div class="col-lg-7 p-5">
                        <div class="about-content-box ms-lg-5" data-aos="fade-left">
                            <h4 class="sub-title fs-5 text-muted mb-3 text-capitalize">من نحن؟</h4>
                            <h5 class="fw-bold fs-1 mb-2 text-uppercase text-main">{{ $weAre->name }}</h5>
                            <span class="d-inline-block fw-semibold text-muted mb-3">{{ $weAre->sub_name }}</span>
                            <div class="text-secondary lh-lg">
                                {!! $weAre->text !!}
                            </div>
                            <div class="cv-btn d-flex align-items-center">
                                <a href="#contact" class="text-main fs-3 fw-semibold text-capitalize">
                                    {{ $weAre->btn_text }}
                                    <i class="fa-solid fa-arrow-left-long text-main"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ميثاقنا -->
        <section id="our-charter" class="py-md-4">
            <div class="">
                <h2 class="text-center sub-title fs-1 text-muted mb-5">ميثاقنا</h2>
            </div>
            <div class="container py-5">
                <div class="row mb-5 align-items-center">
                    <div class="col-lg-5">
                        <div class="about-img text-center h-100 shadow-lg bg-main p-3">
                            <img src="{{ asset('storage/' . $charter->message_image) }}"
                                class="img-thumbnail rounded-0 border-4 border-light position-relative" alt="">
                        </div>
                    </div>
                    <div class="col-lg-7 p-5">
                        <div class="about-content-box ms-lg-5">
                            <h4 class="sub-title fs-5 text-muted mb-3 text-capitalize">رسالتنا</h4>
                            <p class="text-secondary fw-semibold lh-lg">
                                {{ $charter->message_text }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row mb-5 align-items-center">
                    <div class="col-lg-5 order-0 order-md-1">
                        <div class="about-img text-center h-100 shadow-lg bg-main p-3">
                            <img src="{{ asset('storage/' . $charter->vision_image) }}"
                                class="img-thumbnail rounded-0 border-4 border-light position-relative" alt="">
                        </div>
                    </div>
                    <div class="col-lg-7 order-1 order-md-0 p-5">
                        <div class="about-content-box ms-lg-5">
                            <h4 class="sub-title fs-5 text-muted mb-3 text-capitalize">رؤيتنا</h4>
                            <p class="text-secondary fw-semibold lh-lg">
                                {{ $charter->vision_text }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-lg-5">
                        <div class="about-img text-center h-100 shadow-lg bg-main p-3">
                            <img src="{{ asset('storage/' . $charter->mission_image) }}"
                                class="img-thumbnail rounded-0 border-4 border-light position-relative" alt="">
                        </div>
                    </div>
                    <div class="col-lg-7 p-5">
                        <div class="about-content-box ms-lg-5">
                            <h4 class="sub-title fs-5 text-muted mb-3 text-capitalize">مهمتنا</h4>
                            <p class="text-secondary fw-semibold lh-lg">
                                {{ $charter->mission_text }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- خدمات -->
        <section id="services" class="py-5 d-flex align-items-start position-relative">
            <div class="services-shape"></div>
            <div class="container py-5">
                <div class="row mb-5 text-center">
                    <h4 class="sub-title fs-5 text-muted mb-3">الخدمات</h4>
                    <h5 class="text-muted mb-3 text-capitalize">ما نقدمه</h5>
                </div>
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="service-box border border-opacity-90 p-2 text-center bg-white rounded-4">
                            <div class="img mb-3 rounded-2">
                                <img src="{{ asset('storage/' . $services->architectural_image) }}"
                                    class="img-fluid w-100 rounded-2" alt="التصميم المعماري" loading="lazy">
                            </div>
                            <h6 class="service-title fw-semibold mb-3">التصميم المعماري</h6>
                            <div class="service-info d-flex justify-content-center align-items-center">
                                <p class="text-muted">
                                    {{ $services->architectural_text }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="service-box border border-opacity-100 p-2 text-center bg-white rounded-4">
                            <div class="img mb-3 rounded-2">
                                <img src="{{ asset('storage/' . $services->interior_image) }}"
                                    class="img-fluid w-100 rounded-2" alt="التصميم الداخلي" loading="lazy">
                            </div>
                            <h6 class="service-title fw-semibold mb-3">التصميم الداخلي</h6>
                            <div class="service-info d-flex justify-content-center align-items-center">
                                <p class="text-muted">
                                    {{ $services->interior_text }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="service-box border border-opacity-10 p-2 text-center bg-white rounded-4">
                            <div class="img mb-3 rounded-2">
                                <img src="{{ asset('storage/' . $services->supervision_image) }}"
                                    class="img-fluid w-100 rounded-2" alt="الإشراف على البناء" loading="lazy">
                            </div>
                            <h6 class="service-title fw-semibold mb-3">الإشراف على البناء</h6>
                            <div class="service-info d-flex justify-content-center align-items-center">
                                <p class="text-muted">
                                    {{$services->supervision_text }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="service-box border border-opacity-10 p-2 text-center bg-white rounded-4">
                            <div class="img mb-3 rounded-2">
                                <img src="{{ asset('storage/' . $services->consulting_image) }}"
                                    class="img-fluid w-100 rounded-2" alt="استشارات هندسية" loading="lazy">
                            </div>
                            <h6 class="service-title fw-semibold mb-3">استشارات هندسية</h6>
                            <div class="service-info d-flex justify-content-center align-items-center">
                                <p class="text-muted">
                                    {{  $services->consulting_text }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- أهدافنا -->
        <section id="goals" class="py-5 d-flex align-items-start position-relative">
            <div class="container">
                <div class="row mb-5 text-center">
                    <h4 class="sub-title fs-5 text-muted mb-3">أهدافنا</h4>
                </div>
                <div class="row align-items-center justify-content-center text-center">
                    <!-- تصميم معماري مبتكر -->
                    <div class="col-lg-3 col-md-4 mb-2">
                        <div class="objective" data-aos="fade-up">
                            <div class="flip-card-inner">
                                <div class="flip-card-front">
                                    <span class="d-block mb-3">
                                        <i class="fas fa-lightbulb fs-1"></i>
                                    </span>
                                    {{ $goals->first_goal_title }}
                                </div>
                                <div class="flip-card-back">
                                    {{ $goals->first_goal_text }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- أعلى معايير الجودة -->
                    <div class="col-lg-3 col-md-4 mb-2">
                        <div class="objective" data-aos="fade-up">
                            <div class="flip-card-inner">
                                <div class="flip-card-front">
                                    <span class="d-block mb-3">
                                        <i class="fas fa-star fs-1"></i>
                                    </span>
                                    {{ $goals->second_goal_title }}
                                </div>
                                <div class="flip-card-back">
                                    {{ $goals->second_goal_text }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- الالتزام بالاستدامة -->
                    <div class="col-lg-3 col-md-4 mb-2">
                        <div class="objective" data-aos="fade-up">
                            <div class="flip-card-inner">
                                <div class="flip-card-front">
                                    <span class="d-block mb-3">
                                        <i class="fas fa-leaf fs-1"></i>
                                    </span>
                                    {{ $goals->third_goal_title }}
                                </div>
                                <div class="flip-card-back">
                                    {{ $goals->third_goal_text }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- تحسين تجربة العملاء -->
                    <div class="col-lg-3 col-md-4 mb-2">
                        <div class="objective" data-aos="fade-up">
                            <div class="flip-card-inner">
                                <div class="flip-card-front">
                                    <span class="d-block mb-3">
                                        <i class="fas fa-user-check fs-1"></i>
                                    </span>
                                    {{ $goals->fourth_goal_title }}
                                </div>
                                <div class="flip-card-back">
                                    {{ $goals->fourth_goal_text }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- كفاءة التنفيذ -->
                    <div class="col-lg-3 col-md-4 mb-2">
                        <div class="objective" data-aos="fade-up">
                            <div class="flip-card-inner">
                                <div class="flip-card-front">
                                    <span class="d-block mb-3">
                                        <i class="fas fa-stopwatch fs-1"></i>
                                    </span>
                                    {{ $goals->fifth_goal_title }}
                                </div>
                                <div class="flip-card-back">
                                    {{ $goals->fifth_goal_text }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- الابتكار والتكنولوجيا -->
                    <div class="col-lg-3 col-md-4 mb-2">
                        <div class="objective" data-aos="fade-up">
                            <div class="flip-card-inner">
                                <div class="flip-card-front">
                                    <span class="d-block mb-3">
                                        <i class="fas fa-laptop-code fs-1"></i>
                                    </span>
                                    {{ $goals->sixth_goal_title }}
                                </div>
                                <div class="flip-card-back">
                                    {{ $goals->sixth_goal_text }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- التميز في الإشراف -->
                    <div class="col-lg-3 col-md-4 mb-2">
                        <div class="objective" data-aos="fade-up">
                            <div class="flip-card-inner">
                                <div class="flip-card-front">
                                    <span class="d-block mb-3">
                                        <i class="fas fa-hard-hat fs-1"></i>
                                    </span>
                                    {{ $goals->seventh_goal_title }}
                                </div>
                                <div class="flip-card-back">
                                    {{ $goals->seventh_goal_text }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- إدارة ميزانية المشروع -->
                    <div class="col-lg-3 col-md-4 mb-2">
                        <div class="objective" data-aos="fade-up">
                            <div class="flip-card-inner">
                                <div class="flip-card-front">
                                    <span class="d-block mb-3">
                                        <i class="fas fa-money-bill-wave fs-1"></i>
                                    </span>
                                    {{ $goals->eighth_goal_title }}
                                </div>
                                <div class="flip-card-back">
                                    {{ $goals->eighth_goal_text }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- التواصل -->
                    {{-- <div class="col-lg-3 col-md-4 mb-2">
                        <div class="objective" data-aos="fade-up">
                            <div class="flip-card-inner">
                                <div class="flip-card-front">
                                    <span class="d-block mb-3">
                                        <i class="fas fa-comments fs-1"></i>
                                    </span>
                                    التواصل
                                </div>
                                <div class="flip-card-back">
                                    ضمان التواصل الشفاف والمنتظم لإبقاء العملاء على اطلاع بتقدم المشروع ومعالجة أي مخاوف
                                    بسرعة.
                                </div>
                            </div>
                        </div>
                    </div> --}}

                </div>
            </div>
        </section>

        <!-- قسم العدادات -->
        <section class="counter-area bg-main-light py-5">
            <div class="container py-5">
                <div class="row py-5">
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
                        <div class="counter-item text-center">
                            <h2 class="number fs-1 fw-bold">
                                <span class="sm-text">+</span>
                                <span class="count">{{ $counter->first_counter_value }}</span>
                            </h2>
                            <h6>{{ $counter->first_counter_title }}</h6>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
                        <div class="counter-item text-center">
                            <h2 class="number fs-1 fw-bold">
                                <span class="sm-text">+</span>
                                <span class="count">{{ $counter->second_counter_value }}</span>
                            </h2>
                            <h6>{{ $counter->second_counter_title }}</h6>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
                        <div class="counter-item text-center">
                            <h2 class="number fs-1 fw-bold">
                                <span class="sm-text">+</span>
                                <span class="count">{{ $counter->third_counter_value }}</span>
                            </h2>
                            <h6>{{ $counter->third_counter_title }}</h6>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
                        <div class="counter-item text-center">
                            <h2 class="number fs-1 fw-bold">
                                <span class="sm-text">+</span>
                                <span class="count">{{ $counter->fourth_counter_value }}</span>
                            </h2>
                            <h6>{{ $counter->fourth_counter_title }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- Sectors --}}
        <section id="sectors" class="pt-5 d-flex align-items-start position-relative">
            <div class="container pt-5">
                <div class="row mb-3 text-center">
                    <h4 class="sub-title fs-5 text-muted mb-3">القطاعات</h4>
                    <h5 class="text-muted mb-4 text-capitalize"> مشاريع رويال سيتي تمتد على القطاعات
                        التالية.</h5>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-3 mb-4 sector" data-aos="fade-right">
                        <div class="sector-card d-block overflow-hidden rounded-4 border position-relative">
                            <div
                                class="img overflow-hidden position-relative d-flex justify-content-center align-items-center">
                                <img src="{{ asset('storage/' . $sectors->first_sector_img) }}" class="img-fluid"
                                    alt="{{ $sectors->first_sector_title }}" loading="lazy" />
                                <div
                                    class="img-overlay position-absolute top-50 start-50 translate-middle w-100 h-100 bg-black">
                                </div>
                                <span
                                    class="fs-3 text-white fw-semibold position-absolute top-50 start-50 translate-middle">{{ $sectors->first_sector_title }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4 sector" data-aos="fade-right">
                        <div class="sector-card d-block overflow-hidden rounded-4 border position-relative">
                            <div
                                class="img overflow-hidden position-relative d-flex justify-content-center align-items-center">
                                <img src="{{ asset('storage/' . $sectors->second_sector_img) }}" class="img-fluid"
                                    alt="{{ $sectors->second_sector_title }}" loading="lazy" />
                                <div
                                    class="img-overlay position-absolute top-50 start-50 translate-middle w-100 h-100 bg-black">
                                </div>
                                <span
                                    class="fs-3 text-white text-nowrap fw-semibold position-absolute top-50 start-50 translate-middle">{{ $sectors->second_sector_title }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4 sector" data-aos="fade-up">
                        <div class="sector-card d-block overflow-hidden rounded-4 border position-relative">
                            <div
                                class="img overflow-hidden position-relative d-flex justify-content-center align-items-center">
                                <img src="{{ asset('storage/' . $sectors->third_sector_img) }}" class="img-fluid"
                                    alt="{{ $sectors->third_sector_title }}" loading="lazy" />
                                <div
                                    class="img-overlay position-absolute top-50 start-50 translate-middle w-100 h-100 bg-black">
                                </div>
                                <span
                                    class="fs-3 text-white fw-semibold position-absolute top-50 start-50 translate-middle">{{ $sectors->third_sector_title }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4 sector" data-aos="fade-left">
                        <div class="sector-card d-block overflow-hidden rounded-4 border position-relative">
                            <div
                                class="img overflow-hidden position-relative d-flex justify-content-center align-items-center">
                                <img src="{{ asset('storage/' . $sectors->fourth_sector_img) }}" class="img-fluid"
                                    alt="{{ $sectors->fourth_sector_title }}" loading="lazy" />
                                <div
                                    class="img-overlay position-absolute top-50 start-50 translate-middle w-100 h-100 bg-black">
                                </div>
                                <span
                                    class="fs-3 text-white fw-semibold position-absolute top-50 start-50 translate-middle">{{ $sectors->fourth_sector_title }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Our Portfolio --}}
        <section id="projects" class="py-5 d-flex align-items-start position-relative min-vh-100">
            <div class="container py-5">
                <div class="row mb-3 text-center">
                    <h4 class="sub-title fs-5 text-muted mb-3">المشاريع</h4>
                    <h5 class="text-muted mb-3 text-capitalize">فريقنا من المحترفين لديه تاريخ متميز في إدارة المشاريع
                        العقارية.</h5>
                </div>
                <!-- Filter buttons -->
                <div class="filter-buttons text-center mb-5">
                    <button class="btn bg-main text-white filter-button mb-3" data-filter="all">جميع المشاريع</button>
                    <button class="btn bg-main text-white filter-button mb-3" data-filter="interior-desgin">تصميم
                        داخلي</button>
                    <button class="btn bg-main text-white filter-button mb-3" data-filter="supervision">الاشراف على
                        البناء</button>
                    <button class="btn bg-main text-white filter-button mb-3" data-filter="architectural-desgin">التصميم
                        المعماري</button>
                    <button class="btn bg-main text-white filter-button mb-3" data-filter="engineering-consulting">استشارة
                        هندسية</button>
                </div>
                <div class="row justify-content-center" id="projects-list">
                    @forelse ($projects as $project)
                        <div class="col-md-4 mb-4 project" data-filter="{{ $project->sector }}">
                            <div class="project-card d-block overflow-hidden rounded-2 border position-relative"
                                data-aos="fade-up">
                                <div
                                    class="img overflow-hidden position-relative d-flex justify-content-center align-items-center">
                                    <img src="{{ asset('storage/' . $project->image) }}" class="img-fluid w-100"
                                        alt="{{ $project->name }}" />
                                    <div
                                        class="img-overlay position-absolute top-50 start-50 translate-middle w-100 h-100 bg-black">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-md-4 mb-4 project" data-filter="retail">
                            <div class="project-card d-block overflow-hidden rounded-2 border position-relative"
                                data-aos="fade-up">
                                <div
                                    class="img overflow-hidden position-relative d-flex justify-content-center align-items-center">
                                    <img src="assets/imgs/projects/1.jpg" class="img-fluid w-100" alt="" />
                                    <div
                                        class="img-overlay position-absolute top-50 start-50 translate-middle w-100 h-100 bg-black">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4 project" data-filter="service-buildings">
                            <div class="project-card d-block overflow-hidden rounded-2 border position-relative"
                                data-aos="fade-up">
                                <div
                                    class="img overflow-hidden position-relative d-flex justify-content-center align-items-center">
                                    <img src="assets/imgs/projects/2.jpg" class="img-fluid w-100" alt="" />
                                    <div
                                        class="img-overlay position-absolute top-50 start-50 translate-middle w-100 h-100 bg-black">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4 project" data-filter="retail">
                            <div class="project-card d-block overflow-hidden rounded-2 border position-relative"
                                data-aos="fade-up">
                                <div
                                    class="img overflow-hidden position-relative d-flex justify-content-center align-items-center">
                                    <img src="assets/imgs/projects/3.jpg" class="img-fluid w-100" alt="" />
                                    <div
                                        class="img-overlay position-absolute top-50 start-50 translate-middle w-100 h-100 bg-black">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4 project" data-filter="residential">
                            <div class="project-card d-block overflow-hidden rounded-2 border position-relative"
                                data-aos="fade-up">
                                <div
                                    class="img overflow-hidden position-relative d-flex justify-content-center align-items-center">
                                    <img src="assets/imgs/projects/4.jpg" class="img-fluid w-100" alt="" />
                                    <div
                                        class="img-overlay position-absolute top-50 start-50 translate-middle w-100 h-100 bg-black">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4 project" data-filter="religious">
                            <div class="project-card d-block overflow-hidden rounded-2 border position-relative"
                                data-aos="fade-up">
                                <div
                                    class="img overflow-hidden position-relative d-flex justify-content-center align-items-center">
                                    <img src="assets/imgs/projects/5.jpg" class="img-fluid w-100" alt="" />
                                    <div
                                        class="img-overlay position-absolute top-50 start-50 translate-middle w-100 h-100 bg-black">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4 project" data-filter="residential">
                            <div class="project-card d-block overflow-hidden rounded-2 border position-relative"
                                data-aos="fade-up">
                                <div
                                    class="img overflow-hidden position-relative d-flex justify-content-center align-items-center">
                                    <img src="assets/imgs/projects/6.jpg" class="img-fluid w-100" alt="" />
                                    <div
                                        class="img-overlay position-absolute top-50 start-50 translate-middle w-100 h-100 bg-black">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4 project" data-filter="service-buildings">
                            <div class="project-card d-block overflow-hidden rounded-2 border position-relative"
                                data-aos="fade-up">
                                <div
                                    class="img overflow-hidden position-relative d-flex justify-content-center align-items-center">
                                    <img src="assets/imgs/projects/7.jpg" class="img-fluid w-100" alt="" />
                                    <div
                                        class="img-overlay position-absolute top-50 start-50 translate-middle w-100 h-100 bg-black">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4 project" data-filter="service-buildings">
                            <div class="project-card d-block overflow-hidden rounded-2 border position-relative"
                                data-aos="fade-up">
                                <div
                                    class="img overflow-hidden position-relative d-flex justify-content-center align-items-center">
                                    <img src="assets/imgs/projects/8.jpg" class="img-fluid w-100" alt="" />
                                    <div
                                        class="img-overlay position-absolute top-50 start-50 translate-middle w-100 h-100 bg-black">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4 project" data-filter="religious">
                            <div class="project-card d-block overflow-hidden rounded-2 border position-relative"
                                data-aos="fade-up">
                                <div
                                    class="img overflow-hidden position-relative d-flex justify-content-center align-items-center">
                                    <img src="assets/imgs/projects/9.jpg" class="img-fluid w-100" alt="" />
                                    <div
                                        class="img-overlay position-absolute top-50 start-50 translate-middle w-100 h-100 bg-black">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforelse

                </div>
            </div>
        </section>
        <section id="contact" class="py-5 text-white position-relative">
            <div class="overlay"></div>
            <div class="container py-5 position-relative">
                <div class="row mb-5 text-center">
                    <h4 class="sub-title fs-5 text-muted mb-3">Contact</h4>
                    <h5 class=" mb-5 text-capitalize text-muted">
                        سنكون سعداء للرد على جميع أسئلتك واستفساراتك
                    </h5>
                </div>
                <div class="row text-center mb-4">
                    <div class="col-md-6 mb-5">
                        <a href="tel:{{$about->phone}}" class="contact-box d-block p-5 rounded">
                            <span class="d-block mb-4">
                                <i class="fa-solid fa-phone fa-bounce fs-1"></i>
                            </span>
                            <span class="contact-link w-100 py-3 d-block">Call Us: {{$about->phone}}</span>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="mailto:{{$about->email}}" class="contact-box d-block p-5 rounded">
                            <span class="d-block mb-4">
                                <i class="fa-solid fa-paper-plane fa-beat fs-1"></i>
                            </span>
                            <span class="contact-link w-100 py-3 d-block">Email Us:
                                {{$about->email}}</span>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <h5 class="text-center mb-5 text-capitalize text-muted">
                        أو تواصل معنا من خلال وسائل التواص الاجتماعي
                    </h5>
                    <ul class="socail-icons list-unstyled d-flex justify-content-center">
                        @if ($about->telegram)
                            <li class="mx-2">
                                <a href="tg://resolve?domain={{ $about->telegram }}"
                                    class="d-inline-flex justify-content-center align-items-center rounded-circle bg-main"
                                    style="height: 60px;width:60px">
                                    <i class="fa-brands fa-telegram fs-2 text-white"></i>
                                </a>
                            </li>
                        @endif
                        @if ($about->whatsapp)
                            <li class="mx-2">
                                <a href="https://wa.me/{{ $about->whatsapp }}" target="_blank" rel="noopener noreferrer"
                                    class="d-inline-flex justify-content-center align-items-center rounded-circle bg-main"
                                    style="height: 60px;width:60px">
                                    <i class="fa-brands fa-whatsapp fs-2 text-white"></i>
                                </a>
                            </li>
                        @endif
                        @if ($about->instagram)
                            <li class="mx-2">
                                <a href="{{ $about->instagram }}" target="_blank" rel="noopener noreferrer"
                                    class="d-inline-flex justify-content-center align-items-center rounded-circle bg-main"
                                    style="height: 60px;width:60px">
                                    <i class="fa-brands fa-instagram fs-2 text-white"></i>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>

            </div>
        </section>
    </main>
@endsection

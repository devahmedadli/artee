<div class="d-flex align-items-center justify-content-between">
    <a href="{{ route('admin.dashboard') }}" class="logo d-flex align-items-center">
        {{-- <img src="assets/img/logo.png" alt=""> --}}
        <span class="d-none d-lg-block">Artee</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
</div>
<!-- End Logo -->
{{-- <div class="search-bar">
    <form class="search-form d-flex align-items-center" class="needs-validation" novalidate>
        @csrf
        <input type="text" name="query" placeholder="{{ __('Search') }}" title="{{ __('Enter search keyword') }}"
            required>
        <button type="submit" title="{{ __('Search') }}"><i class="bi bi-search"></i></button>
    </form>
</div> --}}
<!-- End Search Bar -->

<nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
            <a class="nav-link nav-icon search-bar-toggle " href="#">
                <i class="bi bi-search"></i>
            </a>
        </li>
        <!-- End Search Icon-->

        <li class="nav-item dropdown">
            <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                <i class="bi bi-bell"></i>
                {{-- <span class="badge bg-primary badge-number">4</span> --}}
            </a>
            <!-- End Notification Icon -->

            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications-dropdown">
                <p class="text-muted text-center py-4">
                    {{ __('No notifications') }}
                </p>
                {{-- <li class="dropdown-header">
                    You have 4 new notifications
                    <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                </li> --}}
                {{-- <li>
                    <hr class="dropdown-divider">
                </li>

                <li class="notification-item">
                    <i class="bi bi-exclamation-circle text-warning"></i>
                    <div>
                        <h4>Lorem Ipsum</h4>
                        <p>Quae dolorem earum veritatis oditseno</p>
                        <p>30 min. ago</p>
                    </div>
                </li>

                <li>
                    <hr class="dropdown-divider">
                </li>

                <li class="notification-item">
                    <i class="bi bi-x-circle text-danger"></i>
                    <div>
                        <h4>Atque rerum nesciunt</h4>
                        <p>Quae dolorem earum veritatis oditseno</p>
                        <p>1 hr. ago</p>
                    </div>
                </li>

                <li>
                    <hr class="dropdown-divider">
                </li>

                <li class="notification-item">
                    <i class="bi bi-check-circle text-success"></i>
                    <div>
                        <h4>Sit rerum fuga</h4>
                        <p>Quae dolorem earum veritatis oditseno</p>
                        <p>2 hrs. ago</p>
                    </div>
                </li>

                <li>
                    <hr class="dropdown-divider">
                </li>

                <li class="notification-item">
                    <i class="bi bi-info-circle text-primary"></i>
                    <div>
                        <h4>Dicta reprehenderit</h4>
                        <p>Quae dolorem earum veritatis oditseno</p>
                        <p>4 hrs. ago</p>
                    </div>
                </li>

                <li>
                    <hr class="dropdown-divider">
                </li>
                <li class="dropdown-footer">
                    <a href="#">Show all notifications</a>
                </li> --}}

            </ul>
            <!-- End Notification Dropdown Items -->

        </li>
        <!-- End Notification Nav -->

        <li class="nav-item dropdown">

            <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                <i class="bi bi-chat-left-text"></i>
                {{-- <span class="badge bg-success badge-number">3</span> --}}
            </a>
            <!-- End Messages Icon -->

            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages-dropdown">
                <p class="text-muted text-center py-4">
                    {{ __('No messages') }}
                </p>
                {{-- <li class="dropdown-header">
                    You have 3 new messages
                    <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>

                <li class="message-item">
                    <a href="#">
                        <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">
                        <div>
                            <h4>Maria Hudson</h4>
                            <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                            <p>4 hrs. ago</p>
                        </div>
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>

                <li class="message-item">
                    <a href="#">
                        <img src="assets/img/messages-2.jpg" alt="" class="rounded-circle">
                        <div>
                            <h4>Anna Nelson</h4>
                            <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                            <p>6 hrs. ago</p>
                        </div>
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>

                <li class="message-item">
                    <a href="#">
                        <img src="assets/img/messages-3.jpg" alt="" class="rounded-circle">
                        <div>
                            <h4>David Muldon</h4>
                            <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                            <p>8 hrs. ago</p>
                        </div>
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>

                <li class="dropdown-footer">
                    <a href="#">Show all messages</a>
                </li> --}}

            </ul>

            <!-- End Messages Dropdown Items -->

        </li>
        <!-- End Messages Nav -->

        <li class="nav-item dropdown pe-3">

            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                <img src="{{ asset('assets/imgs/logo.png') }}" alt="Profile" class="rounded-circle">
                <span class="d-none d-md-block dropdown-toggle ps-2">
                    @auth
                        {{ auth()->user()?->name }}
                    @endauth
                </span>
            </a>
            <!-- End Profile Iamge Icon -->

            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                <li class="dropdown-header">
                    <h6 class="text-start">

                        @auth
                            {{ auth()->user()?->name }}
                        @endauth
                    </h6>
                    {{-- <span>Web Designer</span> --}}
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>

                {{-- <li>
                    <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                        <i class="bi bi-person"></i>
                        <span>حسابي</span>
                    </a>
                </li> --}}
                <li>
                    <hr class="dropdown-divider">
                </li>

                <li>
                    @auth
                        <a class="dropdown-item d-flex align-items-center"
                            href="{{ auth()->user()->role == 'admin' ? route('admin.settings.view') : route('freelancer.settings.view') }}">
                            <i class="bi bi-gear"></i>
                            <span>{{ __('Settings') }}</span>
                        </a>
                    @endauth
                </li>
                {{-- language --}}
                <li>
                    <a class="dropdown-item d-flex align-items-center"
                        href="{{ app()->currentLocale() === 'ar' ? route('langSwape', 'en') : route('langSwape', 'ar') }}">
                        <i class="bi bi-globe"></i>
                        <span>{{ app()->currentLocale() === 'ar' ? 'English' : 'عربي' }}</span>
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>

                <li>
                    <a class="dropdown-item d-flex align-items-center" href="javascript:void(0)">
                        <i class="bi bi-question-circle"></i>
                        <span>{{ __('Need Help') }}</span>
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>

                <li>
                    <a class="dropdown-item d-flex align-items-center text-danger" href="{{ route('logout.post') }}">
                        <i class="bi bi-box-arrow-{{ app()->currentLocale() == 'en' ? 'right' : 'left' }}"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                    {{-- <form method="POST" action="{{ route('logout.post') }}" class="dropdown-item d-flex align-items-center text-danger>
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="fas fa-sign-out-alt me-2"></i>{{ __('Logout') }}
                        </button>
                    </form> --}}
                </li>

            </ul>
            <!-- End Profile Dropdown Items -->
        </li>
        <!-- End Profile Nav -->

    </ul>
</nav>
<!-- End Icons Navigation -->

<div class="offcanvas offcanvas-start" tabindex="-1" id="mSidebarCanvas" aria-labelledby="mSidebarCanvasLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title fs-1" id="mSidebarCanvasLabel">Artee</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body d-flex align-items-center justify-content-center fs-2">
        <ul class="nav-links d-flex flex-column justify-content-center align-items-center list-unstyled m-0 d-md-none ">
            <li class="nav-link mb-4 mx-md-2"><a href="{{ route('index') }}">{{ __('Home') }}</a></li>
            <li class="nav-link mb-4 mx-md-2"><a href="{{ route('index') }}#services">{{ __('Services') }}</a></li>
            <li class="nav-link mb-4 mx-md-2"><a href="{{ route('products') }}">{{ __('Products') }}</a></li>
            <li class="nav-link mb-4 mx-md-2"><a href="{{ route('index') }}#contact">{{ __('Contact Us') }}</a></li>
            @if (auth()->check() && auth()->user()->role == 'customer')
                <li class="nav-link mb-4 mx-md-2">
                    <a class="dropdown-item" href="{{ route('customer.account') }}">
                        {{ __('Settings') }}
                    </a>
                </li>
                <li class="nav-link mb-4 mx-md-2">
                    <a class="dropdown-item" href="{{ route('customer.orders.index') }}">
                        {{ __('Orders') }}
                    </a>
                </li>
                <li class="nav-link mb-4 mx-md-2">
                    <a class="dropdown-item" href="{{ route('customer.chats') }}">
                        {{ __('Live Chat') }}
                    </a>
                </li>
            @endif
            <li class="nav-link mb-4 mx-md-2">
                <hr class="dropdown-divider">
            </li>
            @if (auth()->check() && auth()->user()->role == 'customer')
                <li class="nav-link mb-4 mx-md-2">

                    <a href="{{ route('logout.post') }}" class="dropdown-item text-danger">
                        <i class="fas fa-sign-out-alt me-2"></i>
                        {{ __('Logout') }}
                    </a>
                </li>
            @else
                <li class="nav-link mb-4 mx-md-2">
                    <a href="{{ route('login') }}" class="btn btn-main">
                        {{ __('Login') }}
                    </a>
                </li>
                <li class="nav-link mb-4 mx-md-2">
                    <a href="{{ route('register') }}" class="btn btn-warning">
                        {{ __('Register') }}
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>

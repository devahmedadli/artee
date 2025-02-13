<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('freelancer.dashboard') ? 'active' : '' }}"
        href="{{ route('freelancer.dashboard') }}">
        <i class="bi bi-house"></i>
        <span>{{ __('Dashboard') }}</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('freelancer.orders.*') ? 'active' : '' }}"
        href="{{ route('freelancer.orders.index') }}">
        <i class="bi bi-box-seam"></i>
        <span>{{ __('Orders') }}</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('freelancer.chats.*') ? 'active' : '' }} position-relative"
        href="{{ route('freelancer.chats') }}">
        <i class="bi bi-chat"></i>
        <span>{{ __('Chat') }}</span>
        {{-- @if(true)
            <span class="badge bg-danger rounded-pill position-absolute top-50 end-0 translate-middle">
                1
            </span>
        @endif --}}
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('freelancer.offers.*') ? 'active' : '' }} position-relative"
        href="{{ route('freelancer.offers.index') }}">
        <i class="bi bi-gift"></i>
        <span>{{ __('Offers') }}</span>
        {{-- @if(true)
            <span class="badge bg-danger rounded-pill position-absolute top-50 end-0 translate-middle">
                1
            </span>
        @endif --}}
    </a>
</li>

<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('freelancer.payments.*') ? 'active' : '' }}"
        href="{{ route('freelancer.payments.index') }}">
        <i class="bi bi-cash-coin"></i>
        <span>{{ __('Payments') }}</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#archives-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-archive"></i><span>{{ __('Archives') }}</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="archives-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
            <a href="{{ route('freelancer.archived-orders') }}">
                <i class="bi bi-circle"></i>
                <span>{{ __('Orders') }}</span>
            </a>
        </li>
        <li>
            <a href="{{ route('freelancer.archived-offers') }}">
                <i class="bi bi-circle"></i>
                <span>{{ __('Offers') }}</span>
            </a>
        </li>
    </ul>
</li>

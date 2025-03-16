<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
        <i class="bi bi-grid"></i>
        <span>{{ __('Dashboard') }}</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('offers.*') ? 'active' : '' }} " href="{{ route('offers.index') }}">
        <i class="bi bi-send"></i>
        <span>{{ __('Offers') }}</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link  {{ request()->routeIs('orders.*') ? 'active' : '' }}  collapsed" data-bs-target="#orders-nav"
        data-bs-toggle="collapse" href="#">
        <i class="bi bi-box-seam"></i><span>{{ __('Orders') }}</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="orders-nav" class="nav-content {{ request()->routeIs('orders.*') || request()->routeIs('product-orders.*') ? 'collapsed' : 'collapse' }}"
        data-bs-parent="#sidebar-nav">
        <li>
            <a href="{{ route('orders.index') }}">
                <i class="bi bi-box-seam"></i>
                <span>{{ __('Service Orders') }}</span>
            </a>
        </li>
        <li>
            <a href="{{ route('product-orders.index') }}">
                <i class="bi bi-box-seam"></i>
                <span>{{ __('Product Orders') }}</span>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('services.*') ? 'active' : '' }} " href="{{ route('services.index') }}">
        <i class="bi bi-gear"></i>
        <span>{{ __('Services') }}</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }} " href="{{ route('products.index') }}">
        <i class="bi bi-cart"></i>
        <span>{{ __('Products') }}</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('chats.*') ? 'active' : '' }} position-relative"
        href="{{ route('chats.index') }}">
        <i class="bi bi-chat"></i>
        <span>{{ __('Chats') }}</span>
        {{-- @if (true)
            <span class="badge bg-danger rounded-pill position-absolute top-50 end-0 translate-middle">
                1
            </span>
        @endif --}}
    </a>
</li>
<li class="nav-item">
    <a class="nav-link  {{ request()->routeIs('users.*') ? 'active' : '' }}  collapsed" data-bs-target="#users-nav"
        data-bs-toggle="collapse" href="#">
        <i class="bi bi-people"></i><span>{{ __('Users') }}</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="users-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

        <li>
            <a href="{{ route('customers.index') }}">
                <i class="bi bi-circle"></i>
                <span>{{ __('Customers') }}</span>
            </a>
        </li>
        <li>
            <a href="{{ route('freelancers.index') }}">
                <i class="bi bi-circle"></i>
                <span>{{ __('Freelancers') }}</span>
            </a>
        </li>
        <li>
            <a href="{{ route('users.index') }}">
                <i class="bi bi-circle"></i>
                <span>{{ __('Owners') }}</span>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('payments.*') ? 'active' : '' }} " href="{{ route('payments.index') }}">
        <i class="bi bi-cash-stack"></i>
        <span>{{ __('Payments') }}</span>
    </a>
</li>
{{-- <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('pages.*') ? 'active' : '' }} " href="{{ route('pages.index') }}">
        <i class="bi bi-cash-stack"></i>
        <span>{{ __('Pages') }}</span>
    </a>
</li> --}}

<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('pages.*') || request()->routeIs('site-settings.*') ? 'active' : '' }} {{ request()->routeIs('pages.*') || request()->routeIs('site-settings.*') ? '' : 'collapsed' }}"
        data-bs-target="#settings-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-archive"></i><span>{{ __('Settings') }}</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="settings-nav" class="nav-content {{ request()->routeIs('pages.*') || request()->routeIs('site-settings.*') ? 'show' : 'collapse' }}"
        data-bs-parent="#sidebar-nav">
        <li>
            <a href="{{ route('pages.index') }}">
                <i class="bi bi-circle"></i>
                <span>{{ __('Pages') }}</span>
            </a>
        </li>
        <li>
            <a href="{{ route('site-settings.index') }}">
                <i class="bi bi-circle"></i>
                <span>{{ __('Site Settings') }}</span>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('contact-messages.*') ? 'active' : '' }} "
        href="{{ route('contact-messages.index') }}">
        <i class="bi bi-envelope"></i>
        <span>{{ __('Contact Messages') }}</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#archives-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-archive"></i><span>{{ __('Archives') }}</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="archives-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

        {{-- <li>
            <a href="{{ route('admin.chats.archived') }}">
                <i class="bi bi-circle"></i>
                <span>{{ __('Chats') }}</span>
            </a>
        </li> --}}
        <li>
            <a href="{{ route('admin.archived-orders') }}">
                <i class="bi bi-circle"></i>
                <span>{{ __('Orders') }}</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.archived-offers') }}">
                <i class="bi bi-circle"></i>
                <span>{{ __('Offers') }}</span>
            </a>
        </li>
    </ul>
</li>

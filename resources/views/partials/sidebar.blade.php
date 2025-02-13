<ul class="sidebar-nav" id="sidebar-nav">
    @auth
        @if (auth()->user()->role == 'admin')
            @include('partials.admin.links')
        @else
            @include('partials.freelancer.links')
        @endif
    @endauth
</ul>

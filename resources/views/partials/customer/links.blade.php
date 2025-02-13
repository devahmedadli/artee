<ul class="links list-unstyled p-0">
    @auth(auth()->user()->role == 'admin')
        <li>
            <a href="{{ route('admin.dashboard') }}" class="d-block {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <span class="ms-2"><i class="fas fa-home fa-fw"></i></span>
                <span>الرئيسية</span>
            </a>
        </li>
    @endauth
    {{-- @endif --}}
    <li>
        <a href="{{ route('users.index') }}" class="d-block {{ request()->routeIs('users.index') ? 'active' : '' }}">
            <span class="ms-2"><i class="fas fa-users-cog fa-fw"></i></span>
            <span>المستخدمين</span>
        </a>
    </li>
    <li>
        <a href="{{ route('users.index') }}" class="d-block {{ request()->routeIs('users.index') ? 'active' : '' }}">
            <span class="ms-2"><i class="fas fa-users-cog fa-fw"></i></span>
            <span>الجهات</span>
        </a>
    </li>
    {{-- @if (auth()->user()->privileges->contains('privilege', 'site_info') || auth()->user()->is_admin) --}}
    <li>
        <a href="#siteInfo" data-bs-toggle="collapse" class="d-block ">
            <span class="ms-2"><i class="fas fa-info-circle fa-fw"></i></span>
            <span>معلومات الموقع</span>
            <span class="float-end"><i class="fas fa-chevron-down"></i></span>
        </a>
        <ul class="sub-links collapse list-unstyled" id="siteInfo">
            <li>
                <a href="" class="d-block {{ request()->routeIs('about_section.edit') ? 'active' : '' }}">
                    <span class="ms-2">حول الموقع</span>
                </a>
            </li>
            <li>
                <a href="" class="d-block {{ request()->routeIs('we_are_section.edit') ? 'active' : '' }}">
                    <span class="ms-2">من نحن</span>
                </a>
            </li>
            <li>
                <a href="" class="d-block {{ request()->routeIs('projects_section.edit') ? 'active' : '' }}">
                    <span class="ms-2">المشاريع</span>
                </a>
            </li>
        </ul>
    </li>
    {{-- @endif --}}
    <li>
        <a href="{{ route('admin.settings.view') }}"
            class="d-block {{ request()->routeIs('settings.view') ? 'active' : '' }}">
            <span class="ms-2"><i class="fas fa-cogs fa-fw"></i></span>
            <span>إدارة الحساب</span>
        </a>
    </li>
</ul>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const siteInfoToggle = document.querySelector('[href="#siteInfo"]');
        const siteInfo = document.getElementById('siteInfo');
        const chevron = siteInfoToggle.querySelector('.fa-chevron-down');

        // Check if any sub-link within #siteInfo is active
        const isAnySubLinkActive = Array.from(siteInfo.querySelectorAll('a')).some(link => link.classList
            .contains('active'));

        // Open the collapse if any sub-link is active
        if (isAnySubLinkActive) {
            new bootstrap.Collapse(siteInfo, {
                toggle: true
            });
            chevron.classList.add('fa-rotate-180'); // Rotate the chevron to indicate the open state
        }

        siteInfoToggle.addEventListener('click', function() {
            // Toggle the chevron rotation
            chevron.classList.toggle('fa-rotate-180');
        });
    });
</script>

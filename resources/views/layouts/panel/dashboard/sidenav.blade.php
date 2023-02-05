<nav class="sidenav shadow-right sidenav-light">
    <div class="sidenav-menu">
        <div class="nav accordion" id="accordionSidenav">
            <a class="nav-link" href="{{ route('panel.shooting.index') }}">
                <div class="nav-link-icon">
                    <i class="fas fa-camera"></i>
                </div>
                {{ __('Shooting') }}
            </a>

            <a class="nav-link" href="{{ route('panel.people.index') }}">
                <div class="nav-link-icon">
                    <i class="fas fa-users"></i>
                </div>
                {{ __('People') }}
            </a>

            <a class="nav-link" href="{{ route('panel.role.index') }}">
                <div class="nav-link-icon">
                    <i class="fas fa-tag"></i>
                </div>
                {{ __('Role') }}
            </a>
        </div>
    </div>

    <div class="sidenav-footer">
        <div class="sidenav-footer-content">
            <div class="sidenav-footer-subtitle">{{ __('Logged in as:') }}</div>
            <div class="sidenav-footer-title">{{ Auth::user()->name }}</div>
        </div>
    </div>
</nav>

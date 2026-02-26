<nav class="navbar navbar-expand navbar-light premium-topbar mb-4 static-top shadow-sm">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Quick Actions -->
    <div class="d-none d-sm-flex align-items-center">
        <a href="{{route('storage.link')}}" class="btn btn-premium-secondary btn-sm mr-2" data-toggle="tooltip" title="Lien de stockage">
            <i class="fas fa-link mr-1"></i> Stockage
        </a>
        <a href="{{route('cache.clear')}}" class="btn btn-premium-danger btn-sm mr-2" data-toggle="tooltip" title="Vider le cache">
            <i class="fas fa-broom mr-1"></i> Cache
        </a>
    </div>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto align-items-center">

        {{-- Home page --}}
        <li class="nav-item mx-1">
            <a class="nav-link premium-nav-link" href="{{route('home')}}" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Voir le site">
                <i class="fas fa-external-link-alt"></i>
            </a>
        </li>

        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
            @include('backend.notification.show')
        </li>

        <!-- Nav Item - Messages -->
        <li class="nav-item dropdown no-arrow mx-1" id="messageT" data-url="{{route('messages.five')}}">
            @include('backend.message.message')
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle user-profile-trigger" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="user-info-text d-none d-lg-flex flex-column text-right mr-3">
                    <span class="user-name">{{Auth()->user()->name}}</span>
                    <span class="user-role">Administrateur</span>
                </div>
                <div class="user-avatar-wrapper">
                    @if(Auth()->user()->photo)
                        <img class="img-profile rounded-circle shadow-sm" src="{{Auth()->user()->photo}}">
                    @else
                        <img class="img-profile rounded-circle shadow-sm" src="{{asset('backend/img/avatar.png')}}">
                    @endif
                    <div class="online-status"></div>
                </div>
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow-lg animated--fade-in premium-user-dropdown" aria-labelledby="userDropdown">
                <div class="dropdown-header d-flex flex-column align-items-center pb-3">
                    <div class="user-avatar-large mb-2">
                        @if(Auth()->user()->photo)
                            <img src="{{Auth()->user()->photo}}" class="rounded-circle">
                        @else
                            <img src="{{asset('backend/img/avatar.png')}}" class="rounded-circle">
                        @endif
                    </div>
                    <span class="dropdown-user-name font-weight-bold">{{Auth()->user()->name}}</span>
                    <span class="dropdown-user-email small text-muted">{{Auth()->user()->email}}</span>
                </div>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{route('admin-profile')}}">
                    <i class="fas fa-user-circle fa-sm fa-fw mr-3 text-primary"></i> Mon Profil
                </a>
                <a class="dropdown-item" href="{{route('change.password.form')}}">
                    <i class="fas fa-shield-alt fa-sm fa-fw mr-3 text-success"></i> Sécurité
                </a>
                <a class="dropdown-item" href="{{route('settings')}}">
                    <i class="fas fa-cog fa-sm fa-fw mr-3 text-info"></i> Paramètres
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item logout-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-power-off fa-sm fa-fw mr-3 text-danger"></i> Déconnexion
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>

    </ul>

</nav>

<style>
/* ============================================================
   PREMIUM TOPBAR STYLING
   ============================================================ */
.premium-topbar {
    background: rgba(255, 255, 255, 0.8) !important;
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    height: 70px;
    position: relative;
    z-index: 1030; /* Ensure it stays above normal content */
}

/* User Profile Trigger */
.user-profile-trigger {
    display: flex !important;
    align-items: center;
    padding: 0 15px !important;
    z-index: 1031;
}
.user-info-text .user-name {
    color: #2d3748;
    font-size: 0.9rem;
    font-weight: 700;
}
.user-info-text .user-role {
    color: #718096;
    font-size: 0.7rem;
    margin-top: -2px;
}
.user-avatar-wrapper {
    position: relative;
}
.user-avatar-wrapper .img-profile {
    width: 42px;
    height: 42px;
    object-fit: cover;
    border: 2px solid #fff;
}
.online-status {
    position: absolute;
    bottom: 2px;
    right: 2px;
    width: 12px;
    height: 12px;
    background: #48bb78;
    border: 2px solid #fff;
    border-radius: 50%;
}

/* Buttons Styling */
.btn-premium-secondary {
    background: #edf2f7;
    color: #4a5568;
    border: none;
    border-radius: 8px;
    transition: all 0.3s ease;
}
.btn-premium-secondary:hover {
    background: #e2e8f0;
    transform: translateY(-2px);
}
.btn-premium-danger {
    background: #fff5f5;
    color: #f56565;
    border: none;
    border-radius: 8px;
    transition: all 0.3s ease;
}
.btn-premium-danger:hover {
    background: #fed7d7;
    transform: translateY(-2px);
}

/* Nav Links */
.premium-nav-link {
    color: #718096 !important;
    font-size: 1.1rem;
    padding: 0 12px !important;
    transition: color 0.3s ease;
}
.premium-nav-link:hover {
    color: #38bdf8 !important;
}

/* User Dropdown */
.premium-user-dropdown {
    border: none;
    border-radius: 12px;
    width: 250px;
    margin-top: 15px !important;
    padding: 0;
    overflow: hidden;
    z-index: 2000 !important; /* Extremely high to beat dashboard cards */
    box-shadow: 0 15px 50px rgba(0,0,0,0.15) !important;
}
.user-avatar-large img {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border: 3px solid #edf2f7;
}
.premium-user-dropdown .dropdown-item {
    padding: 12px 20px;
    font-weight: 500;
    color: #4a5568;
    transition: all 0.2s ease;
}
.premium-user-dropdown .dropdown-item:hover {
    background-color: #f7fafc;
    padding-left: 25px;
}
.logout-link:hover {
    background-color: #fff5f5 !important;
    color: #e53e3e !important;
}

/* Responsive Fixes */
@media (max-width: 768px) {
    .premium-topbar {
        padding: 0 10px;
    }
    .user-info-text {
        display: none !important;
    }
}
</style>

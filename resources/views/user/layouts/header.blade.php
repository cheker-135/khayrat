<nav class="navbar navbar-expand navbar-light premium-topbar mb-4 static-top shadow-sm">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Page Title / Breadcrumb (Optional) -->
    <div class="d-none d-sm-flex align-items-center">
        <span class="badge badge-premium-user ml-2">Espace Client</span>
    </div>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto align-items-center">

        {{-- Home page --}}
        <li class="nav-item mx-1">
            <a class="nav-link premium-nav-link" href="{{route('home')}}" target="_blank" data-toggle="tooltip" data-placement="bottom" title="Voir le site">
                <i class="fas fa-external-link-alt"></i>
            </a>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle user-profile-trigger" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="user-info-text d-none d-lg-flex flex-column text-right mr-3">
                    <span class="user-name">{{Auth()->user()->name}}</span>
                    <span class="user-role">Client</span>
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
                <a class="dropdown-item" href="{{route('user-profile')}}">
                    <i class="fas fa-user-circle fa-sm fa-fw mr-3 text-primary"></i> Mon Profil
                </a>
                <a class="dropdown-item" href="{{route('user.change.password.form')}}">
                    <i class="fas fa-shield-alt fa-sm fa-fw mr-3 text-success"></i> Sécurité
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
   PREMIUM TOPBAR STYLING (SHARED/ADAPTED)
   ============================================================ */
.premium-topbar {
    background: rgba(255, 255, 255, 0.8) !important;
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    height: 70px;
}

.badge-premium-user {
    background: rgba(139, 92, 246, 0.1);
    color: #8b5cf6;
    border: 1px solid rgba(139, 92, 246, 0.2);
    padding: 5px 12px;
    border-radius: 8px;
    font-weight: 700;
    text-transform: uppercase;
    font-size: 0.7rem;
}

/* User Profile Trigger */
.user-profile-trigger {
    display: flex !important;
    align-items: center;
    padding: 0 15px !important;
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

/* Nav Links */
.premium-nav-link {
    color: #718096 !important;
    font-size: 1.1rem;
    padding: 0 12px !important;
    transition: color 0.3s ease;
}
.premium-nav-link:hover {
    color: #8b5cf6 !important;
}

/* User Dropdown */
.premium-user-dropdown {
    border: none;
    border-radius: 12px;
    width: 250px;
    margin-top: 15px !important;
    padding: 0;
    overflow: hidden;
    box-shadow: 0 15px 50px rgba(0,0,0,0.1) !important;
}
.user-avatar-large img {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border: 3px solid #f3f4f6;
}
.premium-user-dropdown .dropdown-item {
    padding: 12px 20px;
    font-weight: 500;
    color: #4a5568;
    transition: all 0.2s ease;
}
.premium-user-dropdown .dropdown-item:hover {
    background-color: #f9fafb;
    padding-left: 25px;
}
.logout-link:hover {
    background-color: #fff5f5 !important;
    color: #e53e3e !important;
}
</style>
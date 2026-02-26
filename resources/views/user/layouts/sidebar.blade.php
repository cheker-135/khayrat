<ul class="navbar-nav sidebar sidebar-dark accordion premium-sidebar-user" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('user')}}">
        <div class="sidebar-brand-icon">
            <i class="fas fa-user-circle"></i>
        </div>
        <div class="sidebar-brand-text mx-3">KHAYRAT <span>Client</span></div>
    </a>

    <div class="sidebar-scroll-container">
        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item {{Request::path()=='user' ? 'active' : ''}}">
            <a class="nav-link" href="{{route('user')}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Tableau de bord</span>
            </a>
        </li>

        <!-- Divider -->
        <div class="sidebar-heading">Ma Boutique</div>

        <!-- Orders -->
        <li class="nav-item {{Request::is('user/order*') ? 'active' : ''}}">
            <a class="nav-link" href="{{route('user.order.index')}}">
                <i class="fas fa-shopping-bag"></i>
                <span>Mes Commandes</span>
            </a>
        </li>

        <!-- Reviews -->
        <li class="nav-item {{Request::is('user/productreview*') ? 'active' : ''}}">
            <a class="nav-link" href="{{route('user.productreview.index')}}">
                <i class="fas fa-star-half-alt"></i>
                <span>Mes Avis</span>
            </a>
        </li>

        <!-- Divider -->
        <div class="sidebar-heading">Communauté</div>

        <!-- Comments -->
        <li class="nav-item {{Request::is('user/post-comment*') ? 'active' : ''}}">
            <a class="nav-link" href="{{route('user.post-comment.index')}}">
                <i class="fas fa-comments"></i>
                <span>Mes Commentaires</span>
            </a>
        </li>

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline mt-4">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </div>

</ul>

<style>
/* ============================================================
   PREMIUM USER SIDEBAR STYLING
   ============================================================ */
.premium-sidebar-user {
    background: linear-gradient(180deg, #2d1b4e 0%, #1a1c23 100%) !important;
    border-right: 1px solid rgba(255, 255, 255, 0.05);
    box-shadow: 10px 0 30px rgba(0, 0, 0, 0.3);
    overflow-x: hidden !important;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
    width: 280px !important;
}

/* Brand Section */
.premium-sidebar-user .sidebar-brand {
    height: 90px;
    background: rgba(255, 255, 255, 0.03);
    margin-bottom: 10px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
}
.premium-sidebar-user .sidebar-brand-icon i {
    font-size: 2rem;
    background: linear-gradient(135deg, #a78bfa, #8b5cf6);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    filter: drop-shadow(0 0 8px rgba(139, 92, 246, 0.4));
}
.premium-sidebar-user .sidebar-brand-text {
    font-size: 1.1rem;
    font-weight: 800;
    letter-spacing: 1px;
    color: #fff;
    text-transform: uppercase;
}
.premium-sidebar-user .sidebar-brand-text span {
    display: block;
    font-size: 0.6rem;
    font-weight: 400;
    opacity: 0.7;
    margin-top: -5px;
}

/* Nav Items */
.premium-sidebar-user .nav-item {
    margin: 4px 12px;
}
.premium-sidebar-user .nav-link {
    border-radius: 12px;
    padding: 12px 16px !important;
    transition: all 0.3s ease !important;
    display: flex;
    align-items: center;
}
.premium-sidebar-user .nav-link i {
    font-size: 1.1rem;
    margin-right: 12px;
    color: rgba(255, 255, 255, 0.5);
    transition: all 0.3s ease;
    width: 24px;
    text-align: center;
}
.premium-sidebar-user .nav-link span {
    font-weight: 500;
    font-size: 0.9rem;
    color: rgba(255, 255, 255, 0.75);
}

/* Hover States */
.premium-sidebar-user .nav-item .nav-link:hover {
    background: rgba(255, 255, 255, 0.08);
    transform: translateX(5px);
}
.premium-sidebar-user .nav-item .nav-link:hover i {
    color: #a78bfa;
    transform: scale(1.15);
}
.premium-sidebar-user .nav-item .nav-link:hover span {
    color: #fff;
}

/* Active State */
.premium-sidebar-user .nav-item.active .nav-link {
    background: linear-gradient(90deg, rgba(167, 139, 250, 0.15) 0%, rgba(167, 139, 250, 0.05) 100%);
    box-shadow: inset 2px 0 0 #a78bfa;
}
.premium-sidebar-user .nav-item.active .nav-link i {
    color: #a78bfa;
    filter: drop-shadow(0 0 5px rgba(167, 139, 250, 0.5));
}
.premium-sidebar-user .nav-item.active .nav-link span {
    color: #fff;
    font-weight: 700;
}

/* Headings */
.premium-sidebar-user .sidebar-heading {
    padding: 20px 24px 8px !important;
    font-size: 0.7rem !important;
    font-weight: 700 !important;
    color: rgba(255, 255, 255, 0.3) !important;
    text-transform: uppercase !important;
    letter-spacing: 2px !important;
}

/* Scroll Container */
.sidebar-scroll-container {
    height: calc(100vh - 100px);
    overflow-y: auto;
    overflow-x: hidden;
}
.sidebar-scroll-container::-webkit-scrollbar {
    width: 4px;
}
.sidebar-scroll-container::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 10px;
}

/* Sidebar Toggler adjustment */
#sidebarToggle {
    background-color: rgba(255, 255, 255, 0.1) !important;
    color: rgba(255, 255, 255, 0.5) !important;
}
#sidebarToggle:hover {
    background-color: rgba(167, 139, 250, 0.2) !important;
    color: #fff !important;
}

/* Staggered entrance animation like admin */
.premium-sidebar-user .nav-item {
    animation: slideInSidebar 0.4s ease forwards;
    opacity: 0;
}
@keyframes slideInSidebar {
    from { opacity: 0; transform: translateX(-20px); }
    to { opacity: 1; transform: translateX(0); }
}
.premium-sidebar-user .nav-item:nth-child(1) { animation-delay: 0.05s; }
.premium-sidebar-user .nav-item:nth-child(2) { animation-delay: 0.1s; }
.premium-sidebar-user .nav-item:nth-child(3) { animation-delay: 0.15s; }
.premium-sidebar-user .nav-item:nth-child(4) { animation-delay: 0.2s; }
.premium-sidebar-user .nav-item:nth-child(5) { animation-delay: 0.25s; }

/* Responsive adjustment for Toggled state */
.sidebar.toggled.premium-sidebar-user {
    width: 0 !important;
    margin: 0 !important;
    padding: 0 !important;
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
}
.sidebar.toggled.premium-sidebar-user ~ #content-wrapper {
    margin-left: 0 !important;
}
</style>
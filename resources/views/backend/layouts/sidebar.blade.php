<ul class="navbar-nav sidebar sidebar-dark accordion premium-sidebar" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin')}}">
        <div class="sidebar-brand-icon">
            <i class="fas fa-crown"></i>
        </div>
        <div class="sidebar-brand-text mx-3">KHAYRAT <span>Admin</span></div>
    </a>

    <div class="sidebar-scroll-container">
        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item {{Request::path()=='admin' ? 'active' : ''}}">
            <a class="nav-link" href="{{route('admin')}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Tableau de bord</span>
            </a>
        </li>

        <!-- Divider -->
        <div class="sidebar-heading">Gestion Contenu</div>

        <!-- Nav Item - Files -->
        <li class="nav-item {{Request::path()=='admin/file-manager' ? 'active' : ''}}">
            <a class="nav-link" href="{{route('file-manager')}}">
                <i class="fas fa-fw fa-folder-open"></i>
                <span>Gestionnaire de fichiers</span>
            </a>
        </li>

        <!-- Nav Item - Banners -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-image"></i>
                <span>Bannières</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="collapse-inner">
                    <a class="collapse-item" href="{{route('banner.index')}}">Liste Bannières</a>
                    <a class="collapse-item" href="{{route('banner.create')}}">Ajouter</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <div class="sidebar-heading">Boutique & E-commerce</div>

        <!-- Categories -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#categoryCollapse" aria-expanded="true" aria-controls="categoryCollapse">
                <i class="fas fa-sitemap"></i>
                <span>Catégories</span>
            </a>
            <div id="categoryCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="collapse-inner">
                    <a class="collapse-item" href="{{route('category.index')}}">Liste Catégories</a>
                    <a class="collapse-item" href="{{route('category.create')}}">Ajouter</a>
                </div>
            </div>
        </li>

        <!-- Brands -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#brandCollapse" aria-expanded="true" aria-controls="brandCollapse">
                <i class="fas fa-trademark"></i>
                <span>Marques</span>
            </a>
            <div id="brandCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="collapse-inner">
                    <a class="collapse-item" href="{{route('brand.index')}}">Liste Marques</a>
                    <a class="collapse-item" href="{{route('brand.create')}}">Ajouter</a>
                </div>
            </div>
        </li>

        <!-- Products -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#productCollapse" aria-expanded="true" aria-controls="productCollapse">
                <i class="fas fa-cubes"></i>
                <span>Produits</span>
            </a>
            <div id="productCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="collapse-inner">
                    <a class="collapse-item" href="{{route('product.index')}}">Liste Produits</a>
                    <a class="collapse-item" href="{{route('product.create')}}">Ajouter</a>
                </div>
            </div>
        </li>

        <!-- Shipping -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#shippingCollapse" aria-expanded="true" aria-controls="shippingCollapse">
                <i class="fas fa-truck-moving"></i>
                <span>Livraison</span>
            </a>
            <div id="shippingCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="collapse-inner">
                    <a class="collapse-item" href="{{route('shipping.index')}}">Méthodes</a>
                    <a class="collapse-item" href="{{route('shipping.create')}}">Ajouter</a>
                </div>
            </div>
        </li>

        <!-- Orders -->
        <li class="nav-item {{Request::is('admin/order*') ? 'active' : ''}}">
            <a class="nav-link" href="{{route('order.index')}}">
                <i class="fas fa-shopping-cart"></i>
                <span>Commandes</span>
            </a>
        </li>

        <!-- Reviews -->
        <li class="nav-item {{Request::is('admin/review*') ? 'active' : ''}}">
            <a class="nav-link" href="{{route('review.index')}}">
                <i class="fas fa-star-half-alt"></i>
                <span>Avis Clients</span>
            </a>
        </li>

        <!-- Divider -->
        <div class="sidebar-heading">Blog & Articles</div>

        <!-- Posts -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#postCollapse" aria-expanded="true" aria-controls="postCollapse">
                <i class="fas fa-newspaper"></i>
                <span>Articles</span>
            </a>
            <div id="postCollapse" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="collapse-inner">
                    <a class="collapse-item" href="{{route('post.index')}}">Liste Articles</a>
                    <a class="collapse-item" href="{{route('post.create')}}">Ajouter</a>
                </div>
            </div>
        </li>

        <!-- Post Categories -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#postCategoryCollapse" aria-expanded="true" aria-controls="postCategoryCollapse">
                <i class="fas fa-tags"></i>
                <span>Catégories Blog</span>
            </a>
            <div id="postCategoryCollapse" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="collapse-inner">
                    <a class="collapse-item" href="{{route('post-category.index')}}">Catégories</a>
                    <a class="collapse-item" href="{{route('post-category.create')}}">Ajouter</a>
                </div>
            </div>
        </li>

        <!-- Comments -->
        <li class="nav-item {{Request::is('admin/comment*') ? 'active' : ''}}">
            <a class="nav-link" href="{{route('comment.index')}}">
                <i class="fas fa-comments"></i>
                <span>Commentaires</span>
            </a>
        </li>

        <!-- Divider -->
        <div class="sidebar-heading">Administration</div>

        <!-- Coupons -->
        <li class="nav-item {{Request::is('admin/coupon*') ? 'active' : ''}}">
            <a class="nav-link" href="{{route('coupon.index')}}">
                <i class="fas fa-ticket-alt"></i>
                <span>Coupons</span>
            </a>
        </li>

        <!-- Users -->
        <li class="nav-item {{Request::is('admin/users*') ? 'active' : ''}}">
            <a class="nav-link" href="{{route('users.index')}}">
                <i class="fas fa-user-shield"></i>
                <span>Utilisateurs</span>
            </a>
        </li>

        <!-- Settings -->
        <li class="nav-item {{Request::is('admin/settings*') ? 'active' : ''}}">
            <a class="nav-link" href="{{route('settings')}}">
                <i class="fas fa-sliders-h"></i>
                <span>Paramètres</span>
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
   PREMIUM SIDEBAR STYLING
   ============================================================ */
.premium-sidebar {
    background: linear-gradient(180deg, #1a1c23 0%, #24283b 100%) !important;
    border-right: 1px solid rgba(255, 255, 255, 0.05);
    box-shadow: 10px 0 30px rgba(0, 0, 0, 0.3);
    overflow-x: hidden !important;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
    width: 280px !important;
}

/* Brand Section */
.premium-sidebar .sidebar-brand {
    height: 90px;
    background: rgba(255, 255, 255, 0.03);
    margin-bottom: 10px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
}
.premium-sidebar .sidebar-brand-icon i {
    font-size: 2rem;
    background: linear-gradient(135deg, #FFD700, #FFA500);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    filter: drop-shadow(0 0 8px rgba(255, 215, 0, 0.4));
    transition: transform 0.5s ease;
}
.premium-sidebar .sidebar-brand:hover .sidebar-brand-icon i {
    transform: rotate(15deg) scale(1.1);
}
.premium-sidebar .sidebar-brand-text {
    font-size: 1.1rem;
    font-weight: 800;
    letter-spacing: 1px;
    color: #fff;
    text-transform: uppercase;
}
.premium-sidebar .sidebar-brand-text span {
    display: block;
    font-size: 0.6rem;
    font-weight: 400;
    opacity: 0.7;
    margin-top: -5px;
}

/* Nav Items */
.premium-sidebar .nav-item {
    margin: 4px 12px;
}
.premium-sidebar .nav-link {
    border-radius: 12px;
    padding: 12px 16px !important;
    transition: all 0.3s ease !important;
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
}
.premium-sidebar .nav-link i {
    font-size: 1.1rem;
    margin-right: 12px;
    color: rgba(255, 255, 255, 0.5);
    transition: all 0.3s ease;
    width: 24px;
    text-align: center;
}
.premium-sidebar .nav-link span {
    font-weight: 500;
    font-size: 0.9rem;
    color: rgba(255, 255, 255, 0.75);
}

/* Hover States */
.premium-sidebar .nav-item .nav-link:hover {
    background: rgba(255, 255, 255, 0.08);
    transform: translateX(5px);
}
.premium-sidebar .nav-item .nav-link:hover i {
    color: #38bdf8;
    transform: scale(1.15);
}
.premium-sidebar .nav-item .nav-link:hover span {
    color: #fff;
}

/* Active State */
.premium-sidebar .nav-item.active .nav-link {
    background: linear-gradient(90deg, rgba(56, 189, 248, 0.15) 0%, rgba(56, 189, 248, 0.05) 100%);
    box-shadow: inset 2px 0 0 #38bdf8;
}
.premium-sidebar .nav-item.active .nav-link i {
    color: #38bdf8;
    filter: drop-shadow(0 0 5px rgba(56, 189, 248, 0.5));
}
.premium-sidebar .nav-item.active .nav-link span {
    color: #fff;
    font-weight: 700;
}

/* Headings */
.premium-sidebar .sidebar-heading {
    padding: 20px 24px 8px !important;
    font-size: 0.7rem !important;
    font-weight: 700 !important;
    color: rgba(255, 255, 255, 0.3) !important;
    text-transform: uppercase !important;
    letter-spacing: 2px !important;
}

/* Collapse Inner */
.premium-sidebar .collapse-inner {
    background: rgba(0, 0, 0, 0.2) !important;
    margin: 5px 0 10px 36px !important;
    border-left: 1px solid rgba(255, 255, 255, 0.1);
    padding: 5px 0 !important;
}
.premium-sidebar .collapse-item {
    color: rgba(255, 255, 255, 0.55) !important;
    font-size: 0.85rem !important;
    padding: 8px 15px !important;
    transition: all 0.25s ease !important;
    background: transparent !important;
}
.premium-sidebar .collapse-item:hover {
    color: #38bdf8 !important;
    background: transparent !important;
    padding-left: 20px !important;
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

/* Animations */
@keyframes slideIn {
    from { opacity: 0; transform: translateX(-20px); }
    to { opacity: 1; transform: translateX(0); }
}
@keyframes pulseGlow {
    0% { filter: drop-shadow(0 0 2px rgba(56, 189, 248, 0.4)); }
    50% { filter: drop-shadow(0 0 8px rgba(56, 189, 248, 0.7)); }
    100% { filter: drop-shadow(0 0 2px rgba(56, 189, 248, 0.4)); }
}

.premium-sidebar .nav-item {
    animation: slideIn 0.4s ease forwards;
    opacity: 0; /* Start hidden for animation */
}

/* Staggered entrance for items */
.premium-sidebar .nav-item:nth-child(1) { animation-delay: 0.05s; }
.premium-sidebar .nav-item:nth-child(2) { animation-delay: 0.1s; }
.premium-sidebar .nav-item:nth-child(3) { animation-delay: 0.15s; }
.premium-sidebar .nav-item:nth-child(4) { animation-delay: 0.2s; }
.premium-sidebar .nav-item:nth-child(5) { animation-delay: 0.25s; }
.premium-sidebar .nav-item:nth-child(6) { animation-delay: 0.3s; }
.premium-sidebar .nav-item:nth-child(7) { animation-delay: 0.35s; }
.premium-sidebar .nav-item:nth-child(8) { animation-delay: 0.4s; }
.premium-sidebar .nav-item:nth-child(9) { animation-delay: 0.45s; }
.premium-sidebar .nav-item:nth-child(10) { animation-delay: 0.5s; }
.premium-sidebar .nav-item:nth-child(n+11) { animation-delay: 0.55s; }

.premium-sidebar .nav-item.active .nav-link i {
    animation: pulseGlow 2s infinite ease-in-out;
}

/* Sidebar Toggler adjustment */
#sidebarToggle {
    background-color: rgba(255, 255, 255, 0.1) !important;
    color: rgba(255, 255, 255, 0.5) !important;
}
#sidebarToggle:hover {
    background-color: rgba(56, 189, 248, 0.2) !important;
    color: #fff !important;
}

/* Responsive adjustment for Toggled state - Makes it disappear completely */
.sidebar.toggled.premium-sidebar {
    width: 0 !important;
    margin: 0 !important;
    padding: 0 !important;
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
}
.sidebar.toggled.premium-sidebar .sidebar-brand,
.sidebar.toggled.premium-sidebar .nav-item,
.sidebar.toggled.premium-sidebar .sidebar-heading,
.sidebar.toggled.premium-sidebar .sidebar-divider,
.sidebar.toggled.premium-sidebar .sidebar-scroll-container {
    display: none !important;
}

/* Ensure the content wrapper expands when sidebar is hidden */
.sidebar.toggled.premium-sidebar + #content-wrapper {
    margin-left: 0 !important;
}

/* Animations for collapsing */
.premium-sidebar {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
}
</style>
<script>
    // Collapsed by default on mobile devices
    if (window.innerWidth < 768) {
        document.getElementById('accordionSidebar').classList.add('toggled');
        document.body.classList.add('sidebar-toggled');
    }
</script>
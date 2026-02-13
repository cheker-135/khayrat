@php
use App\Http\Helper;
@endphp


<header class="header shop">
    <!-- Topbar - Hidden on mobile -->
    <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <!-- Top Left -->
                    <div class="top-left">
                        <ul class="list-main">
                            @php
                                $settings=DB::table('settings')->get();
                            @endphp
                            <li><i class="ti-headphone-alt"></i>@foreach($settings as $data) {{$data->phone}} @endforeach</li>
                            <li><i class="ti-email"></i> @foreach($settings as $data) {{$data->email}} @endforeach</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <!-- Top Right -->
                    <div class="right-content">
                        <ul class="list-main">
                            <li><i class="ti-location-pin"></i> <a href="{{route('order.track')}}">Suivi Commande</a></li>
                            @auth 
                                @if(Auth::user()->role=='admin')
                                    <li><i class="ti-user"></i> <a href="{{route('admin')}}" target="_blank">Tableau de bord</a></li>
                                @else 
                                    <li><i class="ti-user"></i> <a href="{{route('user')}}" target="_blank">Tableau de bord</a></li>
                                @endif
                                <li><i class="ti-power-off"></i> <a href="{{route('user.logout')}}">Déconnexion</a></li>
                            @else
                                <li><i class="ti-power-off"></i><a href="{{route('login.form')}}">Connexion /</a> <a href="{{route('register.form')}}">Inscription</a></li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Topbar -->

    <!-- Middle Section -->
    <div class="middle-inner">
        <div class="container">
            <div class="row align-items-center">
                <!-- Logo -->
                <div class="col-lg-2 col-md-3 col-6">
                    <div class="logo">
                        @php
                            $settings=DB::table('settings')->get();
                        @endphp                    
                        <a href="{{route('home')}}"><img src="@foreach($settings as $data) {{$data->logo}} @endforeach" alt="logo" class="img-fluid"></a>
                    </div>
                </div>

                <!-- Search Bar -->
                <div class="col-lg-7 col-md-5 d-none d-md-block">
                    <div class="search-bar-top">
                        <div class="search-bar">
                            <div class="search-select">
                                <select name="category" class="form-control search-category" id="desktopCategory">
                                    <option value="">Toutes Catégories</option>
                                    @foreach(Helper::getAllCategory() as $cat)
                                        <option value="{{$cat->slug}}">{{$cat->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <form method="POST" action="{{route('product.search')}}" class="search-form" id="searchForm">
                                @csrf
                                <input name="search" placeholder="Rechercher des produits..." type="search" class="form-control search-input" required>
                                <button class="btnn search-submit" type="submit">
                                    <i class="ti-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Right Bar - Cart, Wishlist, Toggle -->
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="right-bar">
                        <!-- Mobile Search Toggle -->
                        <a href="#" class="mobile-search-btn d-md-none" aria-label="Recherche mobile">
                            <i class="ti-search"></i>
                        </a>

                        <!-- Wishlist -->
                        <div class="sinlge-bar shopping wishlist-bar">
                            <a href="{{route('wishlist')}}" class="single-icon" aria-label="Liste de souhaits">
                                <i class="fa fa-heart-o"></i> 
                                <span class="total-count wishlist-count">{{Helper::wishlistCount()}}</span>
                            </a>
                            @auth
                                <div class="shopping-item wishlist-dropdown">
                                    <div class="dropdown-cart-header">
                                        <span class="wishlist-item-count">{{count(Helper::getAllProductFromWishlist())}} Articles</span>
                                        <a href="{{route('wishlist')}}">Voir Liste</a>
                                    </div>
                                    <ul class="shopping-list wishlist-items">
                                        @foreach(Helper::getAllProductFromWishlist() as $data)
                                            @php
                                                $photo=explode(',',$data->product['photo']);
                                            @endphp
                                            <li>
                                                <a href="{{route('wishlist-delete',$data->id)}}" class="remove" title="Retirer cet article"><i class="fa fa-remove"></i></a>
                                                <a class="cart-img" href="{{route('product-detail',$data->product['slug'])}}">
                                                    <img src="{{$photo[0]}}" alt="{{$photo[0]}}" loading="lazy">
                                                </a>
                                                <h4><a href="{{route('product-detail',$data->product['slug'])}}">{{$data->product['title']}}</a></h4>
                                                <p class="quantity">{{$data->quantity}} x - <span class="amount">${{number_format($data->price,2)}}</span></p>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="bottom">
                                        <div class="total">
                                            <span>Total</span>
                                            <span class="total-amount">${{number_format(Helper::totalWishlistPrice(),2)}}</span>
                                        </div>
                                        <a href="{{route('cart')}}" class="btn animate">Panier</a>
                                    </div>
                                </div>
                            @endauth
                        </div>

                        <!-- Cart -->
                        <div class="sinlge-bar shopping cart-bar">
                            <a href="{{route('cart')}}" class="single-icon" aria-label="Panier">
                                <i class="ti-bag"></i> 
                                <span class="total-count cart-count">{{Helper::cartCount()}}</span>
                            </a>
                            @auth
                                <div class="shopping-item cart-dropdown">
                                    <div class="dropdown-cart-header">
                                        <span class="cart-item-count">{{count(Helper::getAllProductFromCart())}} Articles</span>
                                        <a href="{{route('cart')}}">Voir Panier</a>
                                    </div>
                                    <ul class="shopping-list cart-items">
                                        @foreach(Helper::getAllProductFromCart() as $data)
                                            @php
                                                $photo=explode(',',$data->product['photo']);
                                            @endphp
                                            <li>
                                                <a href="{{route('cart-delete',$data->id)}}" class="remove" title="Retirer cet article"><i class="fa fa-remove"></i></a>
                                                <a class="cart-img" href="{{route('product-detail',$data->product['slug'])}}">
                                                    <img src="{{$photo[0]}}" alt="{{$photo[0]}}" loading="lazy">
                                                </a>
                                                <h4><a href="{{route('product-detail',$data->product['slug'])}}">{{$data->product['title']}}</a></h4>
                                                <p class="quantity">{{$data->quantity}} x - <span class="amount">${{number_format($data->price,2)}}</span></p>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="bottom">
                                        <div class="total">
                                            <span>Total</span>
                                            <span class="total-amount">${{number_format(Helper::totalCartPrice(),2)}}</span>
                                        </div>
                                        <a href="{{route('checkout')}}" class="btn animate">Payer</a>
                                    </div>
                                </div>
                            @endauth
                        </div>

                        <!-- Mobile Menu Toggle -->
                        <button class="mobile-menu-toggle d-lg-none" type="button" aria-label="Toggle navigation" aria-expanded="false">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <div class="header-inner">
        <div class="container">
            <div class="cat-nav-head">
                <div class="row">
                    <div class="col-12">
                        <div class="menu-area">
                            <!-- Main Menu -->
                            <nav class="navbar navbar-expand-lg">
                                <div class="navbar-collapse" id="navbarMain">
                                    <div class="nav-inner">
                                        <ul class="nav main-menu menu navbar-nav">
                                            <li class="nav-item {{Request::path()=='home' ? 'active' : ''}}">
                                                <a class="nav-link" href="{{route('home')}}">Accueil</a>
                                            </li>
                                            <li class="nav-item {{Request::path()=='about-us' ? 'active' : ''}}">
                                                <a class="nav-link" href="{{route('about-us')}}">À Propos</a>
                                            </li>
                                            <li class="nav-item {{Request::path()=='product-grids' || Request::path()=='product-lists' ? 'active' : ''}}">
                                                <a class="nav-link" href="{{route('product-grids')}}">Produits</a>
                                                <span class="new">Nouveau</span>
                                            </li>
                                            @php
                                                $header_categories = Helper::getHeaderCategory();
                                            @endphp
                                            {!! $header_categories !!}
                                            <li class="nav-item {{Request::path()=='blog' ? 'active' : ''}}">
                                                <a class="nav-link" href="{{route('blog')}}">Blog</a>
                                            </li>
                                            <li class="nav-item {{Request::path()=='contact' ? 'active' : ''}}">
                                                <a class="nav-link" href="{{route('contact')}}">Contact</a>
                                            </li>
                                        </ul>
                                        
                                        <!-- Mobile Only Links -->
                                        <div class="mobile-nav-extras">
                                            <div class="mobile-nav-divider"></div>
                                            <ul class="mobile-extra-links">
                                                <li>
                                                    <a href="{{route('order.track')}}">
                                                        <i class="ti-location-pin"></i>
                                                        <span>Suivi Commande</span>
                                                    </a>
                                                </li>
                                                @auth 
                                                    @if(Auth::user()->role=='admin')
                                                        <li>
                                                            <a href="{{route('admin')}}" target="_blank">
                                                                <i class="ti-user"></i>
                                                                <span>Tableau de bord</span>
                                                            </a>
                                                        </li>
                                                    @else 
                                                        <li>
                                                            <a href="{{route('user')}}" target="_blank">
                                                                <i class="ti-user"></i>
                                                                <span>Tableau de bord</span>
                                                            </a>
                                                        </li>
                                                    @endif
                                                    <li>
                                                        <a href="{{route('user.logout')}}">
                                                            <i class="ti-power-off"></i>
                                                            <span>Déconnexion</span>
                                                        </a>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a href="{{route('login.form')}}">
                                                            <i class="ti-power-off"></i>
                                                            <span>Connexion</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{route('register.form')}}">
                                                            <i class="ti-user"></i>
                                                            <span>Inscription</span>
                                                        </a>
                                                    </li>
                                                @endauth
                                            </ul>
                                            <div class="mobile-contact-info">
                                                @foreach($settings as $data)
                                                    <p><i class="ti-headphone-alt"></i> {{$data->phone}}</p>
                                                    <p><i class="ti-email"></i> {{$data->email}}</p>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Mobile Search Overlay -->
<div class="mobile-search-overlay" id="mobileSearchOverlay">
    <div class="mobile-search-container">
        <button class="close-search" aria-label="Fermer la recherche">
            <i class="ti-close"></i>
        </button>
        <h3 class="search-title">Rechercher</h3>
        <form method="POST" action="{{route('product.search')}}" class="mobile-search-form" id="mobileSearchForm">
            @csrf
            <div class="form-group">
                <select name="category" class="form-control search-category">
                    <option value="">Toutes Catégories</option>
                    @foreach(Helper::getAllCategory() as $cat)
                        <option value="{{$cat->slug}}">{{$cat->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <input name="search" placeholder="Rechercher des produits..." type="search" class="form-control search-input" required>
                <div class="error-message"></div>
            </div>
            <button type="submit" class="btn btn-search">
                <i class="ti-search"></i> Rechercher
            </button>
        </form>
    </div>
</div>

<!-- Mobile Menu Overlay -->
<div class="mobile-menu-overlay" id="mobileMenuOverlay"></div>

<style>
/* =============================================
   RESPONSIVE HEADER STYLES
   ============================================= */

/* CSS Variables for easy customization */
:root {
    --header-primary: #27ae60;
    --header-secondary: #2ecc71;
    --header-accent: #16a085;
    --header-text: #333;
    --header-light: #fff;
    --header-dark: #222;
    --header-gray: #666;
    --header-border: #41c20e;
    --header-shadow: rgba(0, 0, 0, 0.1);
    --header-danger: #e74c3c;
    --header-warning: #f39c12;
    --header-transition: 0.3s ease;
    --header-radius: 8px;
    --header-z-index: 1000;
}

/* =============================================
   HEADER BASE STYLES
   ============================================= */
.header.shop {
    position: relative;
    width: 100%;
    z-index: var(--header-z-index);
    background: var(--header-light);
}

/* =============================================
   TOPBAR STYLES
   ============================================= */
.header.shop .topbar {
    background: var(--header-light);
    padding: 10px 0;
    font-size: 13px;
    color: #ccc;
}

.header.shop .topbar .list-main {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;
    list-style: none;
    margin: 0;
    padding: 0;
}

.header.shop .topbar .list-main li {
    display: flex;
    align-items: center;
    gap: 8px;
}

.header.shop .topbar .list-main li i {
    color: var(--header-primary);
    font-size: 14px;
}

.header.shop .topbar .list-main a {
    color: #0a0000;
    text-decoration: none;
    transition: color var(--header-transition);
}

.header.shop .topbar .list-main a:hover {
    color: var(--header-primary);
}

.header.shop .topbar .right-content .list-main {
    justify-content: flex-end;
}

/* =============================================
   MIDDLE INNER STYLES
   ============================================= */
.header.shop .middle-inner {
    padding: 20px 0;
    background: var(--header-light);
    border-bottom: 1px solid var(--header-border);
}

/* Logo */
.header.shop .logo {
    display: flex;
    align-items: center;
}

.header.shop .logo img {
    max-height: 60px;
    width: auto;
    object-fit: contain;
}

/* Search Bar */
.header.shop .search-bar-top {
    width: 100%;
}

.header.shop .search-bar {
    width:50%;
    background: #f8f9fa;
    border: 0.5px solid var(--header-border);
    border-radius: var(--header-radius);
    overflow: hidden;
    transition: border-color var(--header-transition), box-shadow var(--header-transition);
}


.header.shop .search-bar:focus-within {
    border-color: var(--header-primary);
    box-shadow: 0 0 0 3px rgba(39, 174, 96, 0.1);
    cursor:pointer;
}

.header.shop .search-select {
    border-right: 5px solid var(--header-border);
    background: var(--header-light);
}

.header.shop .search-category {
    border: none;
    padding: 1px 1px;
    min-width: 170px;
    font-size: 15px;
    cursor: pointer;
    background: transparent;
    color: var(--header-text);
}

.header.shop .search-category:focus {
    outline: none;
}

.header.shop .search-form {
    flex: 1;
    display: flex;
    align-items: stretch;
}
.header.shop .search-bar .ti-search  {
    width:50%;
    background: #010b16;
    border: 0.5px solid var(--header-border);
    border-radius: var(--header-radius);
    overflow: hidden;
    transition: border-color var(--header-transition), box-shadow var(--header-transition);
}
.header.shop .search-input {
    flex: 1;
    border: none;
    padding: 12px 15px;
    font-size: 14px;
    background: transparent;
}

.header.shop .search-input:focus {
  border: 2px solid var(--header-border);
}

.header.shop .search-submit {
    background: var(--header-primary);
    color: var(--header-light);
    border: none;
    padding: 12px 20px;
    cursor: pointer;
    transition: background var(--header-transition);
}

.header.shop .search-submit:hover {
    background: #219955;
}

/* Right Bar */
.header.shop .right-bar {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 15px;
}

/* Mobile Search Button */
.header.shop .mobile-search-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 44px;
    height: 44px;
    color: var(--header-text);
    font-size: 20px;
    text-decoration: none;
    border-radius: var(--header-radius);
    transition: all var(--header-transition);
}

.header.shop .mobile-search-btn:hover {
    background: #f8f9fa;
    color: var(--header-primary);
}

/* Shopping Icons */
.header.shop .sinlge-bar {
    position: relative;
}

.header.shop .sinlge-bar .single-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 44px;
    height: 44px;
    color: var(--header-text);
    font-size: 22px;
    text-decoration: none;
    border-radius: var(--header-radius);
    position: relative;
    transition: all var(--header-transition);
}

.header.shop .sinlge-bar .single-icon:hover {
    background: #f8f9fa;
    color: var(--header-primary);
}

.header.shop .sinlge-bar .total-count {
    position: absolute;
    top: 2px;
    right: 2px;
    background: var(--header-danger);
    color: var(--header-light);
    font-size: 10px;
    font-weight: 600;
    min-width: 18px;
    height: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    padding: 0 4px;
}

/* Shopping Dropdown */
.header.shop .shopping-item {
    position: absolute;
    top: 100%;
    right: 0;
    width: 320px;
    background: var(--header-light);
    border-radius: var(--header-radius);
    box-shadow: 0 10px 40px var(--header-shadow);
    opacity: 0;
    visibility: hidden;
    transform: translateY(10px);
    transition: all var(--header-transition);
    z-index: 1001;
    max-height: 400px;
    overflow: hidden;
}

.header.shop .sinlge-bar:hover .shopping-item {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.header.shop .dropdown-cart-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px;
    border-bottom: 1px solid var(--header-border);
    font-weight: 600;
}

.header.shop .dropdown-cart-header a {
    color: var(--header-primary);
    font-size: 13px;
    text-decoration: none;
}

.header.shop .shopping-list {
    list-style: none;
    margin: 0;
    padding: 0;
    max-height: 240px;
    overflow-y: auto;
}

.header.shop .shopping-list li {
    display: flex;
    align-items: center;
    padding: 12px 15px;
    border-bottom: 1px solid var(--header-border);
    position: relative;
}

.header.shop .shopping-list li:last-child {
    border-bottom: none;
}

.header.shop .shopping-list .remove {
    position: absolute;
    top: 8px;
    right: 10px;
    color: var(--header-gray);
    font-size: 14px;
    text-decoration: none;
    transition: color var(--header-transition);
}

.header.shop .shopping-list .remove:hover {
    color: var(--header-danger);
}

.header.shop .shopping-list .cart-img {
    width: 50px;
    height: 50px;
    border-radius: 6px;
    overflow: hidden;
    margin-right: 12px;
    flex-shrink: 0;
}

.header.shop .shopping-list .cart-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.header.shop .shopping-list h4 {
    font-size: 13px;
    margin: 0 0 5px;
    font-weight: 500;
    line-height: 1.4;
    flex: 1;
    padding-right: 20px;
}

.header.shop .shopping-list h4 a {
    color: var(--header-text);
    text-decoration: none;
}

.header.shop .shopping-list .quantity {
    font-size: 12px;
    color: var(--header-gray);
    margin: 0;
}

.header.shop .shopping-list .amount {
    color: var(--header-primary);
    font-weight: 600;
}

.header.shop .shopping-item .bottom {
    padding: 15px;
    background: #f8f9fa;
    border-top: 1px solid var(--header-border);
}

.header.shop .shopping-item .total {
    display: flex;
    justify-content: space-between;
    font-weight: 600;
    margin-bottom: 12px;
}

.header.shop .shopping-item .total-amount {
    color: var(--header-primary);
}

.header.shop .shopping-item .btn {
    display: block;
    width: 100%;
    padding: 12px;
    background: var(--header-primary);
    color: var(--header-light);
    text-align: center;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 500;
    transition: background var(--header-transition);
}

.header.shop .shopping-item .btn:hover {
    background: #219955;
}

/* =============================================
   MOBILE MENU TOGGLE (HAMBURGER)
   ============================================= */
.header.shop .mobile-menu-toggle {
    display: none;
    align-items: center;
    justify-content: center;
    width: 44px;
    height: 44px;
    padding: 0;
    background: var(--header-primary);
    border: none;
    border-radius: var(--header-radius);
    cursor: pointer;
    transition: all var(--header-transition);
}

.header.shop .mobile-menu-toggle:hover {
    background: #219955;
    transform: translateY(-2px);
}

.header.shop .hamburger-box {
    width: 24px;
    height: 18px;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
}

.header.shop .hamburger-inner,
.header.shop .hamburger-inner::before,
.header.shop .hamburger-inner::after {
    width: 24px;
    height: 2px;
    background: var(--header-light);
    border-radius: 2px;
    position: absolute;
    transition: all var(--header-transition);
}

.header.shop .hamburger-inner::before {
    content: '';
    top: -7px;
}

.header.shop .hamburger-inner::after {
    content: '';
    bottom: -7px;
}

/* Hamburger Active State */
.header.shop .mobile-menu-toggle.active .hamburger-inner {
    background: transparent;
}

.header.shop .mobile-menu-toggle.active .hamburger-inner::before {
    transform: translateY(7px) rotate(45deg);
}

.header.shop .mobile-menu-toggle.active .hamburger-inner::after {
    transform: translateY(-7px) rotate(-45deg);
}

/* =============================================
   HEADER INNER (MAIN NAVIGATION)
   ============================================= */
.header.shop .header-inner {
    background: linear-gradient(135deg, var(--header-primary) 0%, var(--header-secondary) 50%, var(--header-accent) 100%);
    background-size: 200% 200%;
    animation: gradientFlow 15s ease infinite;
    box-shadow: 0 4px 20px rgba(39, 174, 96, 0.2);
}

@keyframes gradientFlow {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

.header.shop .menu-area {
    position: relative;
}

.header.shop .navbar {
    padding: 0;
}

.header.shop .nav.main-menu {
    display: flex;
    align-items: center;
    list-style: none;
    margin: 0;
    padding: 0;
}

.header.shop .nav.main-menu > li {
    position: relative;
}

.header.shop .nav.main-menu > li > .nav-link {
    display: block;
    padding: 16px 20px;
    color: var(--header-light) !important;
    font-weight: 500;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    text-decoration: none;
    transition: all var(--header-transition);
    border-radius: 4px;
    margin: 4px 2px;
}

.header.shop .nav.main-menu > li > .nav-link:hover {
    background: rgba(255, 255, 255, 0.15);
}

.header.shop .nav.main-menu > li.active > .nav-link {
    background: rgba(255, 255, 255, 0.2);
    font-weight: 600;
}

/* New Badge */
.header.shop .nav.main-menu > li > .new {
    position: absolute;
    top: 6px;
    right: 2px;
    background: linear-gradient(135deg, var(--header-warning), var(--header-danger));
    color: var(--header-light);
    font-size: 9px;
    font-weight: 700;
    padding: 2px 6px;
    border-radius: 10px;
    text-transform: uppercase;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

/* Dropdown Menu */
.header.shop .nav.main-menu .dropdown-menu {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    min-width: 200px;
    background: var(--header-light);
    border-radius: var(--header-radius);
    box-shadow: 0 10px 40px var(--header-shadow);
    padding: 10px 0;
    z-index: 1001;
}

.header.shop .nav.main-menu li:hover > .dropdown-menu {
    display: block;
}

.header.shop .nav.main-menu .dropdown-menu li a {
    display: block;
    padding: 10px 20px;
    color: var(--header-text);
    text-decoration: none;
    transition: all var(--header-transition);
}

.header.shop .nav.main-menu .dropdown-menu li a:hover {
    background: #f8f9fa;
    color: var(--header-primary);
    padding-left: 25px;
}

/* Mobile Nav Extras - Hidden on Desktop */
.header.shop .mobile-nav-extras {
    display: none;
}

/* =============================================
   MOBILE SEARCH OVERLAY
   ============================================= */
.mobile-search-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.95);
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    visibility: hidden;
    transition: all var(--header-transition);
}

.mobile-search-overlay.active {
    opacity: 1;
    visibility: visible;
}

.mobile-search-container {
    background: var(--header-light);
    padding: 30px;
    border-radius: 16px;
    width: 90%;
    max-width: 450px;
    position: relative;
    transform: scale(0.9) translateY(20px);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.mobile-search-overlay.active .mobile-search-container {
    transform: scale(1) translateY(0);
}

.close-search {
    position: absolute;
    top: 15px;
    right: 15px;
    background: none;
    border: none;
    font-size: 24px;
    color: var(--header-gray);
    cursor: pointer;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: all var(--header-transition);
}

.close-search:hover {
    background: #f8f9fa;
    color: var(--header-danger);
}

.search-title {
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 20px;
    color: var(--header-text);
}

.mobile-search-form .form-group {
    margin-bottom: 15px;
}

.mobile-search-form .form-control {
    width: 100%;
    padding: 14px 16px;
    border: 2px solid var(--header-border);
    border-radius: var(--header-radius);
    font-size: 15px;
    transition: all var(--header-transition);
}

.mobile-search-form .form-control:focus {
    outline: none;
    border-color: var(--header-primary);
    box-shadow: 0 0 0 3px rgba(39, 174, 96, 0.1);
}

.mobile-search-form .form-control.error {
    border-color: var(--header-danger);
}

.mobile-search-form .error-message {
    color: var(--header-danger);
    font-size: 13px;
    margin-top: 5px;
    display: none;
}

.mobile-search-form .error-message.show {
    display: block;
}

.mobile-search-form .btn-search {
    width: 100%;
    padding: 14px 20px;
    background: var(--header-primary);
    color: var(--header-light);
    border: none;
    border-radius: var(--header-radius);
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    transition: all var(--header-transition);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.mobile-search-form .btn-search:hover {
    background: #219955;
    transform: translateY(-2px);
}

/* =============================================
   MOBILE MENU OVERLAY
   ============================================= */
.mobile-menu-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    z-index: 998;
    opacity: 0;
    visibility: hidden;
    transition: all var(--header-transition);
}

.mobile-menu-overlay.active {
    opacity: 1;
    visibility: visible;
}

/* =============================================
   RESPONSIVE STYLES
   ============================================= */

/* Large Devices (Desktops, less than 1200px) */
@media (max-width: 1199.98px) {
    .header.shop .nav.main-menu > li > .nav-link {
        padding: 14px 16px;
        font-size: 13px;
    }
    
    .header.shop .search-category {
        min-width: 140px;
    }
}

/* Medium Devices (Tablets, less than 992px) */
@media (max-width: 991.98px) {
    /* Show mobile menu toggle */
    .header.shop .mobile-menu-toggle {
        display: flex;
    }
    
    /* Hide topbar */
    .header.shop .topbar {
        display: none;
    }
    
    /* Adjust middle section */
    .header.shop .middle-inner {
        padding: 15px 0;
    }
    
    .header.shop .logo img {
        max-height: 50px;
    }
    
    /* Navigation collapse */
    .header.shop .navbar-collapse {
        position: fixed;
        top: 0;
        right: -300px;
        width: 300px;
        height: 100vh;
        background: linear-gradient(180deg, var(--header-primary) 0%, var(--header-accent) 100%);
        padding: 80px 0 30px;
        overflow-y: auto;
        z-index: 999;
        transition: right 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: -5px 0 30px rgba(0, 0, 0, 0.2);
    }
    
    .header.shop .navbar-collapse.show {
        right: 0;
    }
    
    /* Mobile close button */
    .header.shop .navbar-collapse::before {
        content: '✕';
        position: absolute;
        top: 20px;
        right: 20px;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.2);
        color: var(--header-light);
        font-size: 18px;
        border-radius: 50%;
        cursor: pointer;
    }
    
    .header.shop .nav.main-menu {
        flex-direction: column;
        align-items: stretch;
        padding: 0 20px;
    }
    
    .header.shop .nav.main-menu > li {
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .header.shop .nav.main-menu > li:last-child {
        border-bottom: none;
    }
    
    .header.shop .nav.main-menu > li > .nav-link {
        padding: 15px 10px;
        margin: 0;
        border-radius: 0;
    }
    
    .header.shop .nav.main-menu > li > .new {
        position: static;
        margin-left: 10px;
    }
    
    /* Dropdown in mobile */
    .header.shop .nav.main-menu .dropdown-menu {
        position: static;
        background: rgba(0, 0, 0, 0.1);
        box-shadow: none;
        border-radius: 0;
        padding: 0;
    }
    
    .header.shop .nav.main-menu .dropdown-menu li a {
        color: var(--header-light);
        padding: 12px 30px;
    }
    
    .header.shop .nav.main-menu .dropdown-menu li a:hover {
        background: rgba(255, 255, 255, 0.1);
        padding-left: 35px;
    }
    
    /* Show mobile nav extras */
    .header.shop .mobile-nav-extras {
        display: block;
        padding: 0 20px;
        margin-top: 20px;
    }
    
    .header.shop .mobile-nav-divider {
        height: 1px;
        background: rgba(255, 255, 255, 0.2);
        margin: 20px 0;
    }
    
    .header.shop .mobile-extra-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .header.shop .mobile-extra-links li a {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 10px;
        color: var(--header-light);
        text-decoration: none;
        font-size: 14px;
        border-radius: 6px;
        transition: all var(--header-transition);
    }
    
    .header.shop .mobile-extra-links li a:hover {
        background: rgba(255, 255, 255, 0.1);
    }
    
    .header.shop .mobile-extra-links li a i {
        width: 20px;
        font-size: 16px;
    }
    
    .header.shop .mobile-contact-info {
        margin-top: 20px;
        padding: 15px;
        background: rgba(0, 0, 0, 0.1);
        border-radius: var(--header-radius);
    }
    
    .header.shop .mobile-contact-info p {
        display: flex;
        align-items: center;
        gap: 10px;
        color: rgba(255, 255, 255, 0.9);
        font-size: 13px;
        margin: 8px 0;
    }
    
    .header.shop .mobile-contact-info p i {
        color: rgba(255, 255, 255, 0.7);
    }
    
    /* Hide desktop dropdowns */
    .header.shop .sinlge-bar:hover .shopping-item {
        opacity: 0;
        visibility: hidden;
    }
}

/* Small Devices (Landscape phones, less than 768px) */
@media (max-width: 767.98px) {
    .header.shop .middle-inner {
        padding: 12px 0;
    }
    
    .header.shop .logo img {
        max-height: 45px;
    }
    
    .header.shop .right-bar {
        gap: 8px;
    }
    
    .header.shop .sinlge-bar .single-icon {
        width: 40px;
        height: 40px;
        font-size: 20px;
    }
    
    .header.shop .mobile-menu-toggle {
        width: 40px;
        height: 40px;
    }
    
    .header.shop .hamburger-box {
        width: 20px;
        height: 16px;
    }
    
    .header.shop .hamburger-inner,
    .header.shop .hamburger-inner::before,
    .header.shop .hamburger-inner::after {
        width: 20px;
    }
    
    .header.shop .hamburger-inner::before {
        top: -6px;
    }
    
    .header.shop .hamburger-inner::after {
        bottom: -6px;
    }
    
    .header.shop .mobile-menu-toggle.active .hamburger-inner::before {
        transform: translateY(6px) rotate(45deg);
    }
    
    .header.shop .mobile-menu-toggle.active .hamburger-inner::after {
        transform: translateY(-6px) rotate(-45deg);
    }
    
    /* Mobile search overlay */
    .mobile-search-container {
        padding: 25px 20px;
        width: 95%;
    }
    
    .search-title {
        font-size: 20px;
    }
}

/* Extra Small Devices (Portrait phones, less than 576px) */
@media (max-width: 575.98px) {
    .header.shop .middle-inner {
        padding: 10px 0;
    }
    
    .header.shop .logo img {
        max-height: 40px;
    }
    
    .header.shop .right-bar {
        gap: 5px;
    }
    
    .header.shop .sinlge-bar .single-icon {
        width: 36px;
        height: 36px;
        font-size: 18px;
    }
    
    .header.shop .sinlge-bar .total-count {
        top: 0;
        right: 0;
        min-width: 16px;
        height: 16px;
        font-size: 9px;
    }
    
    .header.shop .mobile-menu-toggle {
        width: 36px;
        height: 36px;
    }
    
    .header.shop .mobile-search-btn {
        width: 36px;
        height: 36px;
        font-size: 18px;
    }
    
    /* Mobile menu narrower */
    .header.shop .navbar-collapse {
        width: 280px;
        right: -280px;
    }
    
    .header.shop .nav.main-menu > li > .nav-link {
        font-size: 13px;
        padding: 12px 10px;
    }
    
    /* Mobile search overlay */
    .mobile-search-container {
        padding: 20px 15px;
        border-radius: 12px;
    }
    
    .search-title {
        font-size: 18px;
        margin-bottom: 15px;
    }
    
    .mobile-search-form .form-control {
        padding: 12px 14px;
        font-size: 14px;
    }
    
    .mobile-search-form .btn-search {
        padding: 12px 16px;
        font-size: 15px;
    }
}

/* Very Small Devices (less than 400px) */
@media (max-width: 399.98px) {
    .header.shop .logo img {
        max-height: 35px;
    }
    
    .header.shop .sinlge-bar .single-icon {
        width: 32px;
        height: 32px;
        font-size: 16px;
    }
    
    .header.shop .mobile-menu-toggle {
        width: 32px;
        height: 32px;
    }
    
    .header.shop .mobile-search-btn {
        width: 32px;
        height: 32px;
        font-size: 16px;
    }
    
    /* Hide wishlist on very small devices */
    .header.shop .wishlist-bar {
        display: none;
    }
}

/* =============================================
   PRINT STYLES
   ============================================= */
@media print {
    .header.shop {
        display: none;
    }
}

/* =============================================
   ACCESSIBILITY
   ============================================= */
.header.shop *:focus-visible {
    outline: 2px solid var(--header-primary);
    outline-offset: 2px;
}

/* Reduced motion */
@media (prefers-reduced-motion: reduce) {
    .header.shop,
    .header.shop *,
    .header.shop *::before,
    .header.shop *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}

/* High contrast mode support */
@media (prefers-contrast: high) {
    .header.shop .header-inner {
        background: var(--header-primary);
    }
    
    .header.shop .sinlge-bar .single-icon {
        border: 2px solid var(--header-text);
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // =============================================
    // CACHE DOM ELEMENTS
    // =============================================
    const header = document.querySelector('.header.shop');
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const navbarCollapse = document.getElementById('navbarMain');
    const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
    const mobileSearchBtn = document.querySelector('.mobile-search-btn');
    const mobileSearchOverlay = document.getElementById('mobileSearchOverlay');
    const closeSearchBtn = document.querySelector('.close-search');
    const searchForms = document.querySelectorAll('.search-form, .mobile-search-form');
    const shoppingBars = document.querySelectorAll('.sinlge-bar.shopping');
    
    // =============================================
    // MOBILE MENU TOGGLE
    // =============================================
    function openMobileMenu() {
        mobileMenuToggle.classList.add('active');
        mobileMenuToggle.setAttribute('aria-expanded', 'true');
        navbarCollapse.classList.add('show');
        mobileMenuOverlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    
    function closeMobileMenu() {
        mobileMenuToggle.classList.remove('active');
        mobileMenuToggle.setAttribute('aria-expanded', 'false');
        navbarCollapse.classList.remove('show');
        mobileMenuOverlay.classList.remove('active');
        document.body.style.overflow = '';
    }
    
    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', function(e) {
            e.preventDefault();
            if (navbarCollapse.classList.contains('show')) {
                closeMobileMenu();
            } else {
                openMobileMenu();
            }
        });
    }
    
    // Close menu via overlay click
    if (mobileMenuOverlay) {
        mobileMenuOverlay.addEventListener('click', closeMobileMenu);
    }
    
    // Close menu via close button in navbar
    if (navbarCollapse) {
        navbarCollapse.addEventListener('click', function(e) {
            const rect = this.getBoundingClientRect();
            // Check if click is on the close button (::before pseudo element)
            if (e.clientX > rect.right - 60 && e.clientY < rect.top + 60) {
                closeMobileMenu();
            }
        });
    }
    
    // Close menu when clicking on nav links (on mobile)
    const navLinks = document.querySelectorAll('.nav.main-menu .nav-link');
    navLinks.forEach(function(link) {
        link.addEventListener('click', function() {
            if (window.innerWidth <= 991) {
                closeMobileMenu();
            }
        });
    });
    
    // =============================================
    // MOBILE SEARCH OVERLAY
    // =============================================
    function openMobileSearch() {
        mobileSearchOverlay.classList.add('active');
        document.body.style.overflow = 'hidden';
        
        // Focus on search input after animation
        setTimeout(function() {
            const searchInput = mobileSearchOverlay.querySelector('.search-input');
            if (searchInput) searchInput.focus();
        }, 300);
    }
    
    function closeMobileSearch() {
        mobileSearchOverlay.classList.remove('active');
        document.body.style.overflow = '';
    }
    
    if (mobileSearchBtn) {
        mobileSearchBtn.addEventListener('click', function(e) {
            e.preventDefault();
            openMobileSearch();
        });
    }
    
    if (closeSearchBtn) {
        closeSearchBtn.addEventListener('click', closeMobileSearch);
    }
    
    // Close search on overlay click
    if (mobileSearchOverlay) {
        mobileSearchOverlay.addEventListener('click', function(e) {
            if (e.target === mobileSearchOverlay) {
                closeMobileSearch();
            }
        });
    }
    
    // =============================================
    // KEYBOARD NAVIGATION
    // =============================================
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            if (mobileSearchOverlay && mobileSearchOverlay.classList.contains('active')) {
                closeMobileSearch();
            }
            if (navbarCollapse && navbarCollapse.classList.contains('show')) {
                closeMobileMenu();
            }
        }
    });
    
    // =============================================
    // FORM VALIDATION
    // =============================================
    function validateSearchForm(form) {
        const searchInput = form.querySelector('.search-input');
        let errorMessage = form.querySelector('.error-message');
        
        // Create error message element if not exists
        if (!errorMessage) {
            errorMessage = document.createElement('div');
            errorMessage.className = 'error-message';
            searchInput.parentNode.appendChild(errorMessage);
        }
        
        const value = searchInput.value.trim();
        
        // Clear previous errors
        searchInput.classList.remove('error');
        errorMessage.classList.remove('show');
        
        // Validate
        if (!value) {
            searchInput.classList.add('error');
            errorMessage.textContent = 'Veuillez entrer un terme de recherche';
            errorMessage.classList.add('show');
            searchInput.focus();
            return false;
        }
        
        if (value.length < 2) {
            searchInput.classList.add('error');
            errorMessage.textContent = 'Le terme doit contenir au moins 2 caractères';
            errorMessage.classList.add('show');
            searchInput.focus();
            return false;
        }
        
        return true;
    }
    
    // Handle form submissions
    searchForms.forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!validateSearchForm(this)) {
                return false;
            }
            
            // Add category if selected (for main desktop form)
            const categorySelect = this.closest('.search-bar')?.querySelector('.search-category');
            if (categorySelect && categorySelect.value) {
                let categoryInput = this.querySelector('input[name="category"]');
                if (!categoryInput) {
                    categoryInput = document.createElement('input');
                    categoryInput.type = 'hidden';
                    categoryInput.name = 'category';
                    this.appendChild(categoryInput);
                }
                categoryInput.value = categorySelect.value;
            }
            
            // Close mobile search if open
            if (mobileSearchOverlay && mobileSearchOverlay.classList.contains('active')) {
                closeMobileSearch();
            }
            
            // Submit the form
            this.submit();
        });
    });
    
    // Clear errors on input
    document.querySelectorAll('.search-input').forEach(function(input) {
        input.addEventListener('input', function() {
            this.classList.remove('error');
            const errorMessage = this.parentNode.querySelector('.error-message');
            if (errorMessage) errorMessage.classList.remove('show');
        });
    });
    
    // =============================================
    // SHOPPING DROPDOWN (DESKTOP)
    // =============================================
    shoppingBars.forEach(function(bar) {
        const dropdown = bar.querySelector('.shopping-item');
        if (!dropdown) return;
        
        let timeout;
        
        bar.addEventListener('mouseenter', function() {
            if (window.innerWidth > 991) {
                clearTimeout(timeout);
                dropdown.style.opacity = '1';
                dropdown.style.visibility = 'visible';
                dropdown.style.transform = 'translateY(0)';
            }
        });
        
        bar.addEventListener('mouseleave', function() {
            if (window.innerWidth > 991) {
                timeout = setTimeout(function() {
                    dropdown.style.opacity = '0';
                    dropdown.style.visibility = 'hidden';
                    dropdown.style.transform = 'translateY(10px)';
                }, 200);
            }
        });
    });
    
    // =============================================
    // DROPDOWN SUBMENUS (MOBILE)
    // =============================================
    const dropdownToggles = document.querySelectorAll('.nav.main-menu > li.has-dropdown > .nav-link');
    dropdownToggles.forEach(function(toggle) {
        toggle.addEventListener('click', function(e) {
            if (window.innerWidth <= 991) {
                const parent = this.parentElement;
                const dropdown = parent.querySelector('.dropdown-menu');
                
                if (dropdown) {
                    e.preventDefault();
                    
                    // Close other dropdowns
                    document.querySelectorAll('.nav.main-menu > li.has-dropdown').forEach(function(item) {
                        if (item !== parent) {
                            item.classList.remove('open');
                            const otherDropdown = item.querySelector('.dropdown-menu');
                            if (otherDropdown) otherDropdown.style.display = 'none';
                        }
                    });
                    
                    // Toggle current dropdown
                    parent.classList.toggle('open');
                    dropdown.style.display = parent.classList.contains('open') ? 'block' : 'none';
                }
            }
        });
    });
    
    // =============================================
    // WINDOW RESIZE HANDLER
    // =============================================
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            // Close mobile menu on resize to desktop
            if (window.innerWidth > 991) {
                closeMobileMenu();
                
                // Reset dropdown styles
                document.querySelectorAll('.nav.main-menu .dropdown-menu').forEach(function(dropdown) {
                    dropdown.style.display = '';
                });
                
                document.querySelectorAll('.nav.main-menu > li.has-dropdown').forEach(function(item) {
                    item.classList.remove('open');
                });
            }
            
            // Close mobile search on resize
            if (window.innerWidth > 768) {
                closeMobileSearch();
            }
        }, 250);
    });
    
    // =============================================
    // STICKY HEADER (OPTIONAL)
    // =============================================
    let lastScrollTop = 0;
    const headerHeight = header ? header.offsetHeight : 0;
    
    window.addEventListener('scroll', function() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
        if (scrollTop > headerHeight) {
            header.classList.add('header-sticky');
        } else {
            header.classList.remove('header-sticky');
        }
        
        lastScrollTop = scrollTop;
    }, { passive: true });
    
    // =============================================
    // TOUCH SUPPORT
    // =============================================
    let touchStartX = 0;
    let touchEndX = 0;
    
    document.addEventListener('touchstart', function(e) {
        touchStartX = e.changedTouches[0].screenX;
    }, { passive: true });
    
    document.addEventListener('touchend', function(e) {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    }, { passive: true });
    
    function handleSwipe() {
        const swipeThreshold = 100;
        const diff = touchStartX - touchEndX;
        
        // Swipe left to open menu (from right edge)
        if (diff > swipeThreshold && touchStartX > window.innerWidth - 50) {
            if (window.innerWidth <= 991 && !navbarCollapse.classList.contains('show')) {
                openMobileMenu();
            }
        }
        
        // Swipe right to close menu
        if (diff < -swipeThreshold && navbarCollapse.classList.contains('show')) {
            closeMobileMenu();
        }
    }
    
    // =============================================
    // INITIALIZE
    // =============================================
    console.log('Responsive Header Initialized');
});
</script>
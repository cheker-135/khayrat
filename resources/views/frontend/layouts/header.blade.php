@php
    use App\Http\Helper;
    $settings = DB::table('settings')->first();
    $logo     = DB::table('settings')->value('logo');
@endphp

<header class="header shop" id="headerShop">

    {{-- ============ TOPBAR ============ --}}
    <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="top-left">
                        <ul class="list-main">
                            <li><i class="ti-headphone-alt"></i>{{ $settings->phone ?? '' }}</li>
                            <li><i class="ti-email"></i>{{ $settings->email ?? '' }}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="right-content">
                        <ul class="list-main">
                            <li><i class="ti-location-pin"></i> <a href="{{ route('order.track') }}">Suivi Commande</a></li>
                            @auth
                                @if(Auth::user()->role=='admin')
                                    <li><i class="ti-user"></i> <a href="{{ route('admin') }}" target="_blank">Tableau de bord</a></li>
                                @else
                                    <li><i class="ti-user"></i> <a href="{{ route('user') }}" target="_blank">Tableau de bord</a></li>
                                @endif
                                <li><i class="ti-power-off"></i> <a href="{{ route('user.logout') }}">Déconnexion</a></li>
                            @else
                                <li><i class="ti-power-off"></i><a href="{{ route('login.form') }}">Connexion /</a> <a href="{{ route('register.form') }}">Inscription</a></li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ============ MIDDLE BAR ============ --}}
    <div class="middle-inner">
        <div class="container">
            <div class="middle-inner-row">

                {{-- LOGO --}}
                <div class="middle-col middle-col--logo">
                    <a href="{{ route('home') }}" class="logo-link">
                        <img src="{{ asset(ltrim($logo, '/')) }}" alt="logo" class="logo-img">
                    </a>
                </div>

                {{-- DESKTOP SEARCH --}}
                <div class="middle-col middle-col--search">
                    <form method="POST" action="{{ route('product.search') }}" class="desktop-search-form" id="desktopSearchForm">
                        @csrf
                        <div class="desktop-search-bar">
                            <input name="search" placeholder="Rechercher des produits..." type="search" class="desktop-search-input" autocomplete="off" required>
                            <button class="desktop-search-btn" type="submit">
                                <i class="ti-search"></i>
                            </button>
                        </div>
                    </form>
                </div>

                {{-- RIGHT ICONS --}}
                <div class="middle-col middle-col--icons">
                    <div class="header-icons">

                        {{-- Mobile search trigger --}}
                        <a href="#" class="header-icon-btn mobile-only" id="mobileSearchBtn" aria-label="Recherche">
                            <i class="ti-search"></i>
                        </a>

                        {{-- Wishlist --}}
                        <div class="header-icon-wrap wishlist-wrap">
                            <a href="{{ route('wishlist') }}" class="header-icon-btn" aria-label="Wishlist">
                                <i class="fa fa-heart-o"></i>
                                <span class="header-badge">{{ Helper::wishlistCount() }}</span>
                            </a>
                            @auth
                            <div class="header-dropdown">
                                <div class="header-dropdown__head">
                                    <span>{{ count(Helper::getAllProductFromWishlist()) }} Articles</span>
                                    <a href="{{ route('wishlist') }}">Voir Liste</a>
                                </div>
                                <ul class="header-dropdown__list">
                                    @foreach(Helper::getAllProductFromWishlist() as $data)
                                        @php $photo = explode(',', $data->product['photo']); @endphp
                                        <li>
                                            <a href="{{ route('wishlist-delete', $data->id) }}" class="header-dropdown__remove"><i class="fa fa-remove"></i></a>
                                            <a class="header-dropdown__img" href="{{ route('product-detail', $data->product['slug']) }}"><img src="{{ $photo[0] }}" alt="" loading="lazy"></a>
                                            <div class="header-dropdown__info">
                                                <h4><a href="{{ route('product-detail', $data->product['slug']) }}">{{ $data->product['title'] }}</a></h4>
                                                <p>{{ $data->quantity }} x - <span>{{ number_format($data->price, 2) }} {{Helper::base_currency()}}</span></p>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="header-dropdown__foot">
                                    <div class="header-dropdown__total"><span>Total</span><span>{{ number_format(Helper::totalWishlistPrice(), 2) }} {{Helper::base_currency()}}</span></div>
                                    <a href="{{ route('cart') }}" class="header-dropdown__btn">Panier</a>
                                </div>
                            </div>
                            @endauth
                        </div>

                        {{-- Cart --}}
                        <div class="header-icon-wrap cart-wrap">
                            <a href="{{ route('cart') }}" class="header-icon-btn" aria-label="Panier">
                                <i class="ti-bag"></i>
                                <span class="header-badge">{{ Helper::cartCount() }}</span>
                            </a>
                            @auth
                            <div class="header-dropdown">
                                <div class="header-dropdown__head">
                                    <span>{{ count(Helper::getAllProductFromCart()) }} Articles</span>
                                    <a href="{{ route('cart') }}">Voir Panier</a>
                                </div>
                                <ul class="header-dropdown__list">
                                    @foreach(Helper::getAllProductFromCart() as $data)
                                        @php $photo = explode(',', $data->product['photo']); @endphp
                                        <li>
                                            <a href="{{ route('cart-delete', $data->id) }}" class="header-dropdown__remove"><i class="fa fa-remove"></i></a>
                                            <a class="header-dropdown__img" href="{{ route('product-detail', $data->product['slug']) }}"><img src="{{ $photo[0] }}" alt="" loading="lazy"></a>
                                            <div class="header-dropdown__info">
                                                <h4><a href="{{ route('product-detail', $data->product['slug']) }}">{{ $data->product['title'] }}</a></h4>
                                                <p>{{ $data->quantity }} x - <span>{{ number_format($data->price, 2) }} {{Helper::base_currency()}}</span></p>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="header-dropdown__foot">
                                    <div class="header-dropdown__total"><span>Total</span><span>{{ number_format(Helper::totalCartPrice(), 2) }} {{Helper::base_currency()}}</span></div>
                                    <a href="{{ route('checkout') }}" class="header-dropdown__btn">Payer</a>
                                </div>
                            </div>
                            @endauth
                        </div>

                        {{-- User Profile --}}
                        <div class="header-icon-wrap user-wrap">
                            <a href="#" class="header-icon-btn" aria-label="Profil">
                                <i class="ti-user"></i>
                            </a>
                            <div class="header-dropdown profile-dropdown">
                                @auth
                                    <div class="header-dropdown__head profile-head">
                                        <div class="profile-avatar">
                                            @if(Auth::user()->photo)
                                                <img src="{{Auth::user()->photo}}" alt="avatar">
                                            @else
                                                <i class="ti-user"></i>
                                            @endif
                                        </div>
                                        <div class="profile-info">
                                            <span class="profile-name">{{Auth::user()->name}}</span>
                                            <span class="profile-role">{{Auth::user()->role == 'admin' ? 'Administrateur' : 'Client'}}</span>
                                        </div>
                                    </div>
                                    <ul class="header-dropdown__list profile-list">
                                        <li>
                                            <a href="{{ Auth::user()->role == 'admin' ? route('admin') : route('user') }}">
                                                <i class="ti-layout-grid2"></i> Tableau de bord
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ Auth::user()->role == 'admin' ? route('admin-profile') : route('user-profile') }}">
                                                <i class="ti-user"></i> Mon Profil
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('order.track') }}">
                                                <i class="ti-location-pin"></i> Suivi Commande
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="header-dropdown__foot">
                                        <a href="{{ route('user.logout') }}" class="header-dropdown__btn logout-btn">
                                            <i class="ti-power-off"></i> Déconnexion
                                        </a>
                                    </div>
                                @else
                                    <div class="header-dropdown__head text-center">
                                        <span>Bienvenue chez KHAYRAT</span>
                                    </div>
                                    <div class="header-dropdown__foot">
                                        <a href="{{ route('login.form') }}" class="header-dropdown__btn mb-2">Connexion</a>
                                        <a href="{{ route('register.form') }}" class="header-dropdown__btn btn-secondary" style="background: #f8f9fa; color: #333; border: 1px solid #ddd;">Inscription</a>
                                    </div>
                                @endauth
                            </div>
                        </div>

                        {{-- Hamburger --}}
                        <button class="header-icon-btn hamburger-btn mobile-only" type="button" id="mobileMenuToggle" aria-label="Menu" aria-expanded="false">
                            <span class="hamburger-box"><span class="hamburger-inner"></span></span>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- ============ DESKTOP NAV BAR ============ --}}
    <div class="header-inner d-none d-lg-block">
        <div class="container">
            <nav class="desktop-nav">
                <ul class="desktop-nav__menu">
                    <li class="{{ Request::path()=='home' ? 'active' : '' }}">
                        <a href="{{ route('home') }}">Accueil</a>
                    </li>
                    <li class="{{ Request::path()=='about-us' ? 'active' : '' }}">
                        <a href="{{ route('about-us') }}">À Propos</a>
                    </li>
                    <li class="{{ Request::path()=='product-grids' || Request::path()=='product-lists' ? 'active' : '' }}">
                        <a href="{{ route('product-grids') }}">Produits</a>
                        <span class="nav-badge">Nouveau</span>
                    </li>
                    @php $header_categories = Helper::getHeaderCategory(); @endphp
                    {!! $header_categories !!}
                    <li class="{{ Request::path()=='blog' ? 'active' : '' }}">
                        <a href="{{ route('blog') }}">Blog</a>
                    </li>
                    <li class="{{ Request::path()=='contact' ? 'active' : '' }}">
                        <a href="{{ route('contact') }}">Contact</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>

{{-- ============================================================
     MOBILE SIDEBAR
     ============================================================ --}}
<div class="mobile-sidebar-overlay" id="mobileSidebarOverlay"></div>
<div class="mobile-sidebar" id="mobileSidebar">

    {{-- Sidebar Header --}}
    <div class="mobile-sidebar__header">
        <button class="mobile-sidebar__close" id="mobileSidebarClose" type="button" aria-label="Fermer">
            <i class="ti-close"></i>
        </button>
        <div class="mobile-sidebar__user">
            @auth
                <div class="mobile-sidebar__avatar"><i class="ti-user"></i></div>
                <div class="mobile-sidebar__info">
                    <span class="mobile-sidebar__welcome">Bienvenue,</span>
                    <span class="mobile-sidebar__name">{{ Auth::user()->name }}</span>
                </div>
            @else
                <a href="{{ route('login.form') }}" class="mobile-sidebar__login">
                    <i class="ti-power-off"></i> Connexion / Inscription
                </a>
            @endauth
        </div>

        {{-- SIDEBAR SEARCH --}}
        <form method="POST" action="{{ route('product.search') }}" class="mobile-sidebar__search">
            @csrf
            <div class="mobile-sidebar__search-wrap">
                <input name="search" placeholder="Rechercher des produits..." type="search" required>
                <button type="submit" aria-label="Rechercher"><i class="ti-search"></i></button>
            </div>
        </form>
    </div>

    {{-- Sidebar Body --}}
    <div class="mobile-sidebar__body">
        <ul class="mobile-sidebar__nav" id="mobileSidebarNav">
            <li class="{{ Request::path()=='home' ? 'active' : '' }}">
                <a href="{{ route('home') }}"><i class="ti-home"></i> Accueil</a>
            </li>
            <li class="{{ Request::path()=='about-us' ? 'active' : '' }}">
                <a href="{{ route('about-us') }}"><i class="ti-info-alt"></i> À Propos</a>
            </li>
            <li class="{{ Request::path()=='product-grids' || Request::path()=='product-lists' ? 'active' : '' }}">
                <a href="{{ route('product-grids') }}"><i class="ti-package"></i> Produits <span class="badge-new-mobile">Nouveau</span></a>
            </li>

            @php
                $categories = \App\Models\Category::where('status','active')
                    ->whereNull('parent_id')
                    ->with('child_cat')
                    ->orderBy('title','ASC')
                    ->get();
            @endphp
            @if($categories->count() > 0)
                <li class="has-children">
                    <a href="javascript:void(0)"><i class="ti-menu-alt"></i> Catégories <span class="arrow-icon">&#9662;</span></a>
                    <ul class="mobile-sidebar__sub">
                        @foreach($categories as $cat)
                            @if($cat->child_cat->count() > 0)
                                <li class="has-children">
                                    <a href="{{ route('product-cat', $cat->slug) }}">{{ $cat->title }} <span class="arrow-icon">&#9662;</span></a>
                                    <ul class="mobile-sidebar__sub">
                                        @foreach($cat->child_cat as $child)
                                            <li><a href="{{ route('product-sub-cat', [$cat->slug, $child->slug]) }}">{{ $child->title }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li><a href="{{ route('product-cat', $cat->slug) }}">{{ $cat->title }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            @endif

            <li class="{{ Request::path()=='blog' ? 'active' : '' }}">
                <a href="{{ route('blog') }}"><i class="ti-pencil-alt"></i> Blog</a>
            </li>
            <li class="{{ Request::path()=='contact' ? 'active' : '' }}">
                <a href="{{ route('contact') }}"><i class="ti-email"></i> Contact</a>
            </li>
        </ul>

        <div class="mobile-sidebar__divider"></div>

        <h4 class="mobile-sidebar__section-title">Paramètres & Suivi</h4>
        <ul class="mobile-sidebar__extras">
            <li><a href="{{ route('order.track') }}"><i class="ti-location-pin"></i> Suivi Commande</a></li>
            @auth
                @if(Auth::user()->role=='admin')
                    <li><a href="{{ route('admin') }}" target="_blank"><i class="ti-dashboard"></i> Tableau de bord</a></li>
                @else
                    <li><a href="{{ route('user') }}" target="_blank"><i class="ti-layout-grid2"></i> Tableau de bord</a></li>
                @endif
                <li><a href="{{ route('user.logout') }}"><i class="ti-power-off"></i> Déconnexion</a></li>
            @endauth
        </ul>
    </div>

    {{-- Sidebar Footer --}}
    <div class="mobile-sidebar__footer">
        <div class="mobile-sidebar__contact">
            <div><i class="ti-headphone-alt"></i> {{ $settings->phone ?? '' }}</div>
            <div><i class="ti-email"></i> {{ $settings->email ?? '' }}</div>
        </div>
    </div>
</div>

{{-- ============ MOBILE SEARCH OVERLAY ============ --}}
<div class="mobile-search-overlay" id="mobileSearchOverlay">
    <div class="mobile-search-container">
        <button class="mobile-search-close" id="mobileSearchClose" aria-label="Fermer"><i class="ti-close"></i></button>
        <h3 class="mobile-search-title">Rechercher</h3>
        <form method="POST" action="{{ route('product.search') }}" class="mobile-search-form">
            @csrf
            <input name="search" placeholder="Rechercher des produits..." type="search" class="form-control" required>
            <button type="submit" class="mobile-search-submit"><i class="ti-search"></i> Rechercher</button>
        </form>
    </div>
</div>


{{-- ================================================================
     STYLES
     ================================================================ --}}
<style>
/* ===========================
   VARIABLES
   =========================== */
:root {
    --hp: #27ae60;
    --hs: #2ecc71;
    --ha: #16a085;
    --ht: #333;
    --hw: #fff;
    --hg: #777;
    --hb: #41c20e;
    --hr: 8px;
    --htr: .3s ease;
    --danger: #e74c3c;
    --sidebar-w: 320px;
}

*, *::before, *::after { box-sizing: border-box; }

/* ===========================
   HEADER BASE
   =========================== */
.header.shop { position: relative; width: 100%; z-index: 1050; background: var(--hw); }
.header.shop.header-sticky { position: fixed; top: 0; left: 0; width: 100%; box-shadow: 0 4px 20px rgba(0,0,0,.1); animation: hdrSlide .4s ease-out; z-index: 1050; }
@keyframes hdrSlide { from { transform: translateY(-100%); } to { transform: translateY(0); } }
.header.shop.header-sticky .topbar { display: none; }
.header.shop.header-sticky .middle-inner { padding: 6px 0; }

/* ===========================
   TOPBAR
   =========================== */
.header.shop .topbar { background: #f8f9fa; padding: 10px 0; font-size: 13px; color: var(--hg); border-bottom: 1px solid #eee; }
.header.shop .topbar .list-main { display: flex; align-items: center; flex-wrap: wrap; gap: 18px; list-style: none; margin: 0; padding: 0; }
.header.shop .topbar .list-main li { display: flex; align-items: center; gap: 6px; }
.header.shop .topbar .list-main li i { color: var(--hp); font-size: 14px; }
.header.shop .topbar .list-main a { color: #333; text-decoration: none; transition: color var(--htr); }
.header.shop .topbar .list-main a:hover { color: var(--hp); }
.header.shop .topbar .right-content .list-main { justify-content: flex-end; }

/* ===========================
   MIDDLE INNER - FLEXBOX ROW
   =========================== */
.header.shop .middle-inner {
    padding: 15px 0;
    background: var(--hw);
    border-bottom: 2px solid var(--hb);
    position: relative;
    z-index: 1060;
}

/* Custom flex row - NOT bootstrap grid */
.middle-inner-row {
    display: flex;
    align-items: center;      /* ← KEY: vertically centers everything */
    justify-content: space-between;
    gap: 20px;
    width: 100%;
    min-height: 60px;          /* ensure consistent height */
}

/* Logo column */
.middle-col--logo {
    flex: 0 0 auto;
    display: flex;
    align-items: center;       /* ← center logo vertically */
}
.logo-link {
    display: inline-flex;
    align-items: center;
    text-decoration: none;
    line-height: 0;            /* remove ghost spacing */
}
.logo-img {
    max-height: 60px;
    width: auto;
    object-fit: contain;
    display: block;
}

/* Search column */
.middle-col--search {
    flex: 1 1 auto;
    display: flex;
    align-items: center;       /* ← center search vertically */
    min-width: 0;
}

/* Icons column */
.middle-col--icons {
    flex: 0 0 auto;
    display: flex;
    align-items: center;       /* ← center icons vertically */
}

/* ===========================
   DESKTOP SEARCH BAR — FULLY FUNCTIONAL
   =========================== */
.desktop-search-form {
    width: 100%;
    display: flex;
    align-items: center;
    position: relative;
    z-index: 100;              /* above everything nearby */
}
.desktop-search-bar {
    display: flex;
    align-items: center;
    width: 100%;
    background: #f8f9fa;
    border: 2px solid var(--hb);
    border-radius: var(--hr);
    overflow: visible;         /* ← not hidden */
    transition: all var(--htr);
    position: relative;
    z-index: 101;
}
.desktop-search-bar:focus-within {
    border-color: var(--hp);
    box-shadow: 0 0 0 4px rgba(39,174,96,.15);
    background: #fff;
}
.desktop-search-input {
    flex: 1;
    border: none !important;
    padding: 12px 16px !important;
    font-size: 15px !important;
    background: transparent !important;
    color: #333 !important;
    outline: none !important;
    box-shadow: none !important;
    -webkit-appearance: none !important;
    appearance: none !important;
    cursor: text !important;
    pointer-events: auto !important;
    opacity: 1 !important;
    position: relative;
    z-index: 102;
    width: 100%;
    min-height: 44px;
    line-height: 1.4;
    margin: 0;
}
.desktop-search-input:focus {
    outline: none !important;
    box-shadow: none !important;
    background: transparent !important;
}
.desktop-search-input::placeholder {
    color: #999;
    opacity: 1;
}
.desktop-search-btn {
    background: var(--hp) !important;
    color: #fff !important;
    border: none !important;
    padding: 0 24px !important;
    min-height: 44px;
    cursor: pointer !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    font-size: 18px !important;
    transition: background var(--htr);
    pointer-events: auto !important;
    opacity: 1 !important;
    flex-shrink: 0;
    position: relative;
    z-index: 102;
    border-radius: 0 calc(var(--hr) - 2px) calc(var(--hr) - 2px) 0;
}
.desktop-search-btn:hover {
    background: #219955 !important;
}

/* ===========================
   HEADER ICONS ROW
   =========================== */
.header-icons {
    display: flex;
    align-items: center;       /* ← all icons centered vertically */
    gap: 8px;
    height: 100%;
}

/* Individual icon button */
.header-icon-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 44px;
    height: 44px;
    color: var(--ht);
    font-size: 22px;
    text-decoration: none;
    border-radius: var(--hr);
    transition: all var(--htr);
    position: relative;
    cursor: pointer;
    background: none;
    border: none;
    padding: 0;
    line-height: 1;
    flex-shrink: 0;
}
.header-icon-btn:hover {
    background: #f1f1f1;
    color: var(--hp);
}

/* Badge */
.header-badge {
    position: absolute;
    top: 2px;
    right: 2px;
    background: var(--danger);
    color: #fff;
    font-size: 10px;
    font-weight: 700;
    min-width: 18px;
    height: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    padding: 0 4px;
    line-height: 1;
}

/* Icon wrap (for dropdown positioning) */
.header-icon-wrap {
    position: relative;
    display: inline-flex;
    align-items: center;
}

/* Mobile-only elements */
.mobile-only { display: none !important; }

/* ===========================
   HAMBURGER
   =========================== */
.hamburger-btn {
    background: var(--hp) !important;
    color: #fff !important;
}
.hamburger-btn:hover { background: #219955 !important; }
.hamburger-box { width: 22px; height: 16px; position: relative; display: flex; align-items: center; justify-content: center; }
.hamburger-inner, .hamburger-inner::before, .hamburger-inner::after { width: 22px; height: 2px; background: #fff; border-radius: 2px; position: absolute; transition: all var(--htr); }
.hamburger-inner::before { content: ''; top: -7px; }
.hamburger-inner::after { content: ''; bottom: -7px; }
.hamburger-btn.active .hamburger-inner { background: transparent; }
.hamburger-btn.active .hamburger-inner::before { transform: translateY(7px) rotate(45deg); }
.hamburger-btn.active .hamburger-inner::after { transform: translateY(-7px) rotate(-45deg); }

/* ===========================
   CART/WISHLIST DROPDOWNS
   =========================== */
.header-dropdown {
    position: absolute;
    top: calc(100% + 8px);
    right: 0;
    width: 320px;
    background: #fff;
    border-radius: var(--hr);
    box-shadow: 0 10px 40px rgba(0,0,0,.12);
    opacity: 0;
    visibility: hidden;
    transform: translateY(10px);
    transition: all var(--htr);
    z-index: 9999 !important;
    overflow: hidden;
}
.header-icon-wrap:hover .header-dropdown {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}
.header-dropdown__head {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px;
    border-bottom: 1px solid #eee;
    font-weight: 600;
    font-size: 14px;
}
.header-dropdown__head a { color: var(--hp); font-size: 13px; text-decoration: none; }
.header-dropdown__list { list-style: none; margin: 0; padding: 0; max-height: 240px; overflow-y: auto; }
.header-dropdown__list li { display: flex; align-items: center; padding: 12px 15px; border-bottom: 1px solid #f5f5f5; position: relative; }
.header-dropdown__list li:last-child { border-bottom: none; }
.header-dropdown__remove { position: absolute; top: 8px; right: 10px; color: var(--hg); font-size: 14px; text-decoration: none; }
.header-dropdown__remove:hover { color: var(--danger); }
.header-dropdown__img { width: 50px; height: 50px; border-radius: 6px; overflow: hidden; margin-right: 12px; flex-shrink: 0; display: block; }
.header-dropdown__img img { width: 100%; height: 100%; object-fit: cover; display: block; }
.header-dropdown__info { flex: 1; min-width: 0; padding-right: 20px; }
.header-dropdown__info h4 { font-size: 13px; margin: 0 0 4px; font-weight: 500; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.header-dropdown__info h4 a { color: var(--ht); text-decoration: none; }
.header-dropdown__info p { font-size: 12px; color: var(--hg); margin: 0; }
.header-dropdown__info p span { color: var(--hp); font-weight: 600; }
.header-dropdown__foot { padding: 15px; background: #f8f9fa; border-top: 1px solid #eee; }

/* ===========================
   NAV DROPDOWN (Desktop)
   =========================== */
.desktop-nav__menu li .dropdown {
    position: absolute;
    top: 100%;
    left: 0;
    width: 240px;
    background: #fff;
    list-style: none;
    margin: 0;
    padding: 10px 0;
    box-shadow: 0 10px 30px rgba(0,0,0,.15);
    border-radius: 0 0 8px 8px;
    opacity: 0;
    visibility: hidden;
    transform: translateY(15px);
    transition: all .3s ease;
    z-index: 1000;
}
.desktop-nav__menu li:hover > .dropdown {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}
.desktop-nav__menu li .dropdown li {
    position: relative;
    width: 100%;
}
.desktop-nav__menu li .dropdown li a {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 11px 20px;
    color: #444 !important;
    font-size: 14px;
    text-transform: none;
    letter-spacing: 0;
    text-decoration: none;
    transition: all .2s ease;
    font-weight: 500;
}
.desktop-nav__menu li .dropdown li a:hover {
    background: rgba(39,174,96,.06);
    color: var(--hp) !important;
    padding-left: 24px;
}

/* Sub-dropdown positioning */
.desktop-nav__menu li .dropdown .sub-dropdown {
    top: 0;
    left: 100%;
    border-radius: 0 8px 8px 8px;
    transform: translateX(15px);
}
.desktop-nav__menu li .dropdown li:hover > .sub-dropdown {
    opacity: 1;
    visibility: visible;
    transform: translateX(0);
}
.desktop-nav__menu li .dropdown li:has(.sub-dropdown) > a::after {
    content: '\f105';
    font-family: 'FontAwesome';
    font-size: 12px;
    margin-left: 10px;
    opacity: 0.6;
}
.header-dropdown__total { display: flex; justify-content: space-between; font-weight: 600; margin-bottom: 12px; }
.header-dropdown__total span:last-child { color: var(--hp); }
.header-dropdown__btn { display: block; width: 100%; padding: 12px; background: var(--hp); color: #fff; text-align: center; border-radius: 6px; text-decoration: none; font-weight: 500; transition: background var(--htr); }
.header-dropdown__btn:hover { background: #219955; }

/* Profile Dropdown Specifics */
.profile-head {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 20px 15px !important;
}
.profile-avatar {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background: #f0f0f0;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    border: 2px solid var(--hp);
    flex-shrink: 0;
}
.profile-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.profile-avatar i {
    color: var(--hp);
    font-size: 20px;
}
.profile-info {
    display: flex;
    flex-direction: column;
    min-width: 0;
}
.profile-name {
    font-weight: 700;
    font-size: 15px;
    color: var(--ht);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.profile-role {
    font-size: 12px;
    color: var(--hg);
    margin-top: 2px;
}
.profile-list li {
    padding: 0 !important;
}
.profile-list li a {
    display: flex !important;
    align-items: center;
    gap: 12px;
    padding: 12px 20px !important;
    color: #555 !important;
    text-decoration: none;
    font-size: 14px;
    transition: all var(--htr);
}
.profile-list li a:hover {
    background: #f8f9fa !important;
    color: var(--hp) !important;
    padding-left: 25px !important;
}
.profile-list li a i {
    color: var(--hp);
    font-size: 16px;
    width: 20px;
    text-align: center;
}
.logout-btn {
    background: #fff5f5 !important;
    color: #e53e3e !important;
    border: 1px solid #fed7d7 !important;
}
.logout-btn:hover {
    background: #e53e3e !important;
    color: #fff !important;
}

/* ===========================
   DESKTOP NAV BAR
   =========================== */
.header.shop .header-inner {
    background: linear-gradient(135deg, var(--hp) 0%, var(--hs) 50%, var(--ha) 100%);
    box-shadow: 0 4px 15px rgba(39,174,96,.2);
}
.desktop-nav { padding: 0; }
.desktop-nav__menu {
    display: flex;
    align-items: center;
    list-style: none;
    margin: 0;
    padding: 0;
}
.desktop-nav__menu > li { position: relative; }
.desktop-nav__menu > li > a {
    display: block;
    padding: 16px 20px;
    color: #fff !important;
    font-weight: 500;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: .5px;
    text-decoration: none;
    border-radius: 4px;
    margin: 4px 2px;
    transition: all var(--htr);
}
.desktop-nav__menu > li > a:hover { background: rgba(255,255,255,.15); }
.desktop-nav__menu > li.active > a { background: rgba(255,255,255,.2); font-weight: 600; }
.nav-badge {
    background: var(--danger);
    color: #fff;
    font-size: 9px;
    padding: 2px 6px;
    border-radius: 3px;
    position: absolute;
    top: 5px;
    right: -8px;
    text-transform: uppercase;
    font-weight: 700;
    letter-spacing: .5px;
}

/* ======================================================
   MOBILE SIDEBAR
   ====================================================== */
.mobile-sidebar-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.5);
    z-index: 9998;
    opacity: 0;
    transition: opacity .35s ease;
}
.mobile-sidebar-overlay.active { display: block; opacity: 1; }

.mobile-sidebar {
    position: fixed;
    top: 0;
    right: calc(-1 * var(--sidebar-w));
    width: var(--sidebar-w);
    height: 100vh;
    height: 100dvh;
    background: var(--hw);
    z-index: 9999;
    display: flex;
    flex-direction: column;
    box-shadow: -8px 0 30px rgba(0,0,0,.2);
    transition: right .4s cubic-bezier(.4,0,.2,1);
    overflow: hidden;
}
.mobile-sidebar.open { right: 0; }

.mobile-sidebar__header {
    background: linear-gradient(135deg, var(--hp), var(--ha));
    padding: 50px 20px 20px;
    color: #fff;
    flex-shrink: 0;
    position: relative;
}
.mobile-sidebar__close {
    position: absolute;
    top: 12px;
    right: 12px;
    width: 36px;
    height: 36px;
    border: none;
    background: rgba(255,255,255,.2);
    color: #fff;
    font-size: 18px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background var(--htr);
    z-index: 5;
}
.mobile-sidebar__close:hover { background: rgba(255,255,255,.35); }

.mobile-sidebar__user { display: flex; align-items: center; gap: 12px; margin-bottom: 16px; }
.mobile-sidebar__avatar { width: 44px; height: 44px; border-radius: 50%; background: rgba(255,255,255,.2); display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0; }
.mobile-sidebar__info { display: flex; flex-direction: column; }
.mobile-sidebar__welcome { font-size: 12px; opacity: .8; }
.mobile-sidebar__name { font-size: 16px; font-weight: 600; }
.mobile-sidebar__login { color: #fff; text-decoration: none; font-weight: 500; font-size: 15px; display: flex; align-items: center; gap: 10px; padding: 8px 0; }

.mobile-sidebar__search { margin-top: 4px; }
.mobile-sidebar__search-wrap {
    display: flex;
    align-items: center;
    background: rgba(255,255,255,.2);
    border-radius: var(--hr);
    overflow: hidden;
    border: 1px solid rgba(255,255,255,.25);
    transition: all var(--htr);
}
.mobile-sidebar__search-wrap:focus-within { background: rgba(255,255,255,.3); border-color: rgba(255,255,255,.5); }
.mobile-sidebar__search-wrap input { flex: 1; border: none; background: transparent; padding: 11px 14px; color: #fff; font-size: 14px; outline: none; }
.mobile-sidebar__search-wrap input::placeholder { color: rgba(255,255,255,.7); }
.mobile-sidebar__search-wrap button { background: transparent; border: none; color: #fff; padding: 0 14px; font-size: 18px; cursor: pointer; height: 42px; display: flex; align-items: center; justify-content: center; transition: background var(--htr); }
.mobile-sidebar__search-wrap button:hover { background: rgba(255,255,255,.15); }

.mobile-sidebar__body { flex: 1; overflow-y: auto; padding: 10px 0; -webkit-overflow-scrolling: touch; }

.mobile-sidebar__nav { list-style: none; margin: 0; padding: 0; }
.mobile-sidebar__nav > li > a {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 20px;
    color: var(--ht);
    text-decoration: none;
    font-size: 15px;
    font-weight: 600;
    border-bottom: 1px solid #f0f0f0;
    transition: all var(--htr);
}
.mobile-sidebar__nav > li > a i { color: var(--hp); font-size: 16px; width: 22px; text-align: center; }
.mobile-sidebar__nav > li > a:hover { color: var(--hp); background: rgba(39,174,96,.04); }
.mobile-sidebar__nav > li.active > a { color: var(--hp); background: rgba(39,174,96,.06); border-left: 3px solid var(--hp); }

.arrow-icon { margin-left: auto; font-size: 12px; transition: transform .3s ease; display: inline-block; }
.mobile-sidebar__nav li.has-children.open > a .arrow-icon { transform: rotate(180deg); }

.mobile-sidebar__sub { list-style: none; margin: 0; padding: 0; display: none; background: #fafafa; }
.mobile-sidebar__nav li.has-children.open > .mobile-sidebar__sub { display: block; }
.mobile-sidebar__sub li a { display: block; padding: 11px 20px 11px 54px; color: var(--ht); text-decoration: none; font-size: 14px; border-bottom: 1px solid #f0f0f0; transition: all var(--htr); }
.mobile-sidebar__sub li a:hover { color: var(--hp); background: rgba(39,174,96,.04); }
.mobile-sidebar__sub .mobile-sidebar__sub li a { padding-left: 72px; font-size: 13px; }

.badge-new-mobile { background: var(--danger); color: #fff; font-size: 9px; padding: 2px 6px; border-radius: 3px; margin-left: 8px; text-transform: uppercase; font-weight: 700; }

.mobile-sidebar__divider { height: 1px; background: #e8e8e8; margin: 10px 20px; }
.mobile-sidebar__section-title { font-size: 11px; text-transform: uppercase; letter-spacing: 1.2px; color: #999; padding: 10px 20px 8px; font-weight: 700; margin: 0; }

/* Custom Category Styles in Sidebar */
.mobile-sidebar__nav li.has-children > a i.ti-menu-alt {
    color: var(--ha);
}
.mobile-sidebar__sub li a {
    font-weight: 500;
    color: #555;
    background: #fdfdfd;
}
.mobile-sidebar__sub .mobile-sidebar__sub li a {
    background: #f9f9f9;
    color: #666;
}
.mobile-sidebar__nav li.has-children.open > a {
    color: var(--hp);
    background: rgba(39,174,96,.03);
}

.mobile-sidebar__extras { list-style: none; margin: 0; padding: 0; }
.mobile-sidebar__extras li a { display: flex; align-items: center; gap: 12px; padding: 12px 20px; color: var(--ht); text-decoration: none; font-size: 14px; border-bottom: 1px solid #f5f5f5; transition: color var(--htr); }
.mobile-sidebar__extras li a:hover { color: var(--hp); }
.mobile-sidebar__extras li a i { color: var(--hp); font-size: 15px; width: 22px; text-align: center; }

.mobile-sidebar__footer { flex-shrink: 0; padding: 15px 20px; background: #f8f9fa; border-top: 1px solid #eee; }
.mobile-sidebar__contact div { display: flex; align-items: center; gap: 10px; font-size: 13px; color: var(--hg); padding: 5px 0; }
.mobile-sidebar__contact div i { color: var(--hp); font-size: 15px; width: 20px; text-align: center; }

/* ======================================================
   MOBILE SEARCH OVERLAY
   ====================================================== */
.mobile-search-overlay {
    position: fixed; inset: 0; background: rgba(0,0,0,.92);
    z-index: 10000; display: flex; align-items: center; justify-content: center;
    opacity: 0; visibility: hidden; transition: all .3s ease;
}
.mobile-search-overlay.active { opacity: 1; visibility: visible; }
.mobile-search-container {
    background: #fff; padding: 30px; border-radius: 16px; width: 90%; max-width: 450px;
    position: relative; transform: scale(.9) translateY(20px);
    transition: all .4s cubic-bezier(.4,0,.2,1);
}
.mobile-search-overlay.active .mobile-search-container { transform: scale(1) translateY(0); }
.mobile-search-close {
    position: absolute; top: 12px; right: 12px; background: none; border: none;
    font-size: 22px; color: var(--hg); cursor: pointer; width: 40px; height: 40px;
    display: flex; align-items: center; justify-content: center; border-radius: 50%;
    transition: all var(--htr);
}
.mobile-search-close:hover { background: #f1f1f1; color: var(--danger); }
.mobile-search-title { font-size: 22px; font-weight: 600; margin: 0 0 20px; color: var(--ht); }
.mobile-search-form .form-control {
    width: 100%; padding: 14px 16px; border: 2px solid #ddd; border-radius: var(--hr);
    font-size: 15px; transition: all var(--htr); outline: none;
}
.mobile-search-form .form-control:focus { border-color: var(--hp); box-shadow: 0 0 0 3px rgba(39,174,96,.12); }
.mobile-search-submit {
    width: 100%; padding: 14px; background: var(--hp); color: #fff; border: none;
    border-radius: var(--hr); font-size: 16px; font-weight: 500; cursor: pointer;
    display: flex; align-items: center; justify-content: center; gap: 10px;
    margin-top: 15px; transition: all var(--htr);
}
.mobile-search-submit:hover { background: #219955; }

/* ======================================================
   RESPONSIVE
   ====================================================== */

/* --- TABLET & MOBILE (< 992px) --- */
@media (max-width: 991.98px) {
    .header.shop .topbar { display: none; }
    .header.shop .middle-inner { padding: 10px 0; }

    .middle-inner-row {
        min-height: 50px;
        gap: 10px;
    }
    .logo-img { max-height: 50px; }

    /* hide desktop search column */
    .middle-col--search { display: none !important; }

    /* show mobile-only buttons */
    .mobile-only { display: inline-flex !important; }

    /* hide cart dropdowns on hover */
    .header-icon-wrap:hover .header-dropdown { opacity: 0; visibility: hidden; }
}

/* --- PHONE (< 768px) --- */
@media (max-width: 767.98px) {
    .header-icons { gap: 6px; }
    .header-icon-btn { width: 40px; height: 40px; font-size: 19px; }
    .middle-inner-row { min-height: 46px; }
}

/* --- SMALL PHONE (< 576px) --- */
@media (max-width: 575.98px) {
    .logo-img { max-height: 42px; }
    .header-icons { gap: 4px; }
    .header-icon-btn { width: 36px; height: 36px; font-size: 17px; }
    .mobile-sidebar { --sidebar-w: 280px; width: 280px; }
}

/* --- VERY SMALL (< 400px) --- */
@media (max-width: 399.98px) {
    .logo-img { max-height: 35px; }
    .header-icon-btn { width: 32px; height: 32px; font-size: 16px; }
    .header-icons { gap: 3px; }
    .wishlist-wrap { display: none; }
    .mobile-sidebar { --sidebar-w: 260px; width: 260px; }
}

/* Body scroll lock */
body.sidebar-open { overflow: hidden !important; }
</style>


{{-- ================================================================
     JAVASCRIPT
     ================================================================ --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    // === REFERENCES ===
    var toggle       = document.getElementById('mobileMenuToggle');
    var sidebar      = document.getElementById('mobileSidebar');
    var overlay      = document.getElementById('mobileSidebarOverlay');
    var closeBtn     = document.getElementById('mobileSidebarClose');
    var searchBtn    = document.getElementById('mobileSearchBtn');
    var searchOvl    = document.getElementById('mobileSearchOverlay');
    var searchClose  = document.getElementById('mobileSearchClose');

    // === SIDEBAR ===
    function openSidebar() {
        if (!sidebar) return;
        sidebar.classList.add('open');
        if (overlay) { overlay.classList.add('active'); overlay.style.display = 'block'; }
        if (toggle) { toggle.classList.add('active'); toggle.setAttribute('aria-expanded', 'true'); }
        document.body.classList.add('sidebar-open');
    }

    function closeSidebar() {
        if (!sidebar) return;
        sidebar.classList.remove('open');
        if (overlay) {
            overlay.classList.remove('active');
            setTimeout(function () { overlay.style.display = 'none'; }, 350);
        }
        if (toggle) { toggle.classList.remove('active'); toggle.setAttribute('aria-expanded', 'false'); }
        document.body.classList.remove('sidebar-open');
    }

    if (toggle) {
        toggle.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            sidebar.classList.contains('open') ? closeSidebar() : openSidebar();
        });
    }
    if (closeBtn) closeBtn.addEventListener('click', function (e) { e.preventDefault(); closeSidebar(); });
    if (overlay) overlay.addEventListener('click', closeSidebar);

    // Close on nav link (non-parent)
    document.querySelectorAll('#mobileSidebarNav > li:not(.has-children) > a').forEach(function (a) {
        a.addEventListener('click', closeSidebar);
    });

    // === SUBMENU ACCORDION ===
    document.querySelectorAll('#mobileSidebar .has-children').forEach(function (li) {
        var link = li.querySelector(':scope > a');
        if (!link) return;
        link.addEventListener('click', function (e) {
            e.preventDefault();
            var isOpen = li.classList.contains('open');
            // Close siblings
            li.parentElement.querySelectorAll(':scope > .has-children').forEach(function (s) {
                if (s !== li) s.classList.remove('open');
            });
            li.classList.toggle('open', !isOpen);
        });
    });

    // === MOBILE SEARCH OVERLAY ===
    function openSearch() {
        if (!searchOvl) return;
        searchOvl.classList.add('active');
        document.body.style.overflow = 'hidden';
        setTimeout(function () {
            var inp = searchOvl.querySelector('input[name=search]');
            if (inp) inp.focus();
        }, 350);
    }
    function closeSearch() {
        if (!searchOvl) return;
        searchOvl.classList.remove('active');
        document.body.style.overflow = '';
    }

    if (searchBtn) searchBtn.addEventListener('click', function (e) { e.preventDefault(); openSearch(); });
    if (searchClose) searchClose.addEventListener('click', closeSearch);
    if (searchOvl) searchOvl.addEventListener('click', function (e) { if (e.target === searchOvl) closeSearch(); });

    // === FORM VALIDATION ===
    document.querySelectorAll('.desktop-search-form, .mobile-search-form, .mobile-sidebar__search').forEach(function (form) {
        form.addEventListener('submit', function (e) {
            var inp = this.querySelector('input[name=search]');
            if (!inp) return;
            if (inp.value.trim().length < 2) {
                e.preventDefault();
                inp.focus();
                inp.style.borderColor = 'var(--danger)';
                setTimeout(function () { inp.style.borderColor = ''; }, 2000);
                return;
            }
            closeSearch();
            closeSidebar();
        });
    });

    // === DESKTOP SEARCH — FORCE ENABLE ===
    var desktopInput = document.querySelector('.desktop-search-input');
    if (desktopInput) {
        desktopInput.removeAttribute('disabled');
        desktopInput.removeAttribute('readonly');
        desktopInput.style.pointerEvents = 'auto';
        desktopInput.style.opacity = '1';
        desktopInput.style.cursor = 'text';
        // Click handler to ensure focus
        desktopInput.addEventListener('click', function () {
            this.focus();
        });
    }
    var desktopBtn = document.querySelector('.desktop-search-btn');
    if (desktopBtn) {
        desktopBtn.removeAttribute('disabled');
        desktopBtn.style.pointerEvents = 'auto';
        desktopBtn.style.cursor = 'pointer';
    }

    // === STICKY HEADER ===
    var header = document.getElementById('headerShop');
    window.addEventListener('scroll', function () {
        if (!header) return;
        header.classList.toggle('header-sticky', window.scrollY > 200);
    });

    // === RESIZE CLEANUP ===
    window.addEventListener('resize', function () {
        if (window.innerWidth >= 992) closeSidebar();
        if (window.innerWidth >= 768) closeSearch();
    });

    // === ESC KEY ===
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') { closeSidebar(); closeSearch(); }
    });
});
</script>
@extends('frontend.layouts.master')

@section('title','KHAYRAT || Grille des Produits')

@section('main-content')
	<!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{route('home')}}">Accueil<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0);">Grille des Produits</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Product Grid -->
    <form action="{{route('shop.filter')}}" method="POST">
        @csrf
        <section class="product-grid-section shop-section">
            <div class="container">
                <div class="row">
                    <!-- Sidebar Filters -->
                    <div class="col-lg-3 col-md-4 col-12">
                        <div class="shop-sidebar sidebar-modern">
                            <!-- Mobile Filter Toggle -->
                            <div class="sidebar-mobile-toggle">
                                <button type="button" class="filter-toggle-btn">
                                    <i class="ti-filter"></i>
                                    <span>Filtres</span>
                                </button>
                            </div>
                            
                            <div class="sidebar-content">
                                <!-- Categories Widget -->
                                <div class="sidebar-widget category-widget">
                                    <div class="widget-header">
                                        <h3 class="widget-title">
                                            <i class="ti-menu-alt"></i>
                                            <span>Catégories</span>
                                        </h3>
                                        <button type="button" class="widget-toggle">
                                            <i class="ti-angle-down"></i>
                                        </button>
                                    </div>
                                    <div class="widget-content">
                                        <ul class="category-list modern-list">
                                            @php
                                                $menu=App\Models\Category::getAllParentWithChild();
                                            @endphp
                                            @if($menu)
                                                @foreach($menu as $cat_info)
                                                    @if($cat_info->child_cat->count()>0)
                                                        <li class="has-children">
                                                            <div class="category-item">
                                                                <a href="{{route('product-cat',$cat_info->slug)}}">{{$cat_info->title}}</a>
                                                                <button type="button" class="expand-btn">
                                                                    <i class="ti-angle-right"></i>
                                                                </button>
                                                            </div>
                                                            <ul class="sub-category-list">
                                                                @foreach($cat_info->child_cat as $sub_menu)
                                                                    <li>
                                                                        <a href="{{route('product-sub-cat',[$cat_info->slug,$sub_menu->slug])}}">
                                                                            <i class="ti-angle-right"></i>
                                                                            {{$sub_menu->title}}
                                                                        </a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </li>
                                                    @else
                                                        <li>
                                                            <div class="category-item">
                                                                <a href="{{route('product-cat',$cat_info->slug)}}">{{$cat_info->title}}</a>
                                                            </div>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                <!--/ End Categories Widget -->
                                
                                <!-- Price Filter Widget -->
                                <div class="sidebar-widget price-widget">
                                    <div class="widget-header">
                                        <h3 class="widget-title">
                                            <i class="ti-money"></i>
                                            <span>Filtrer par Prix</span>
                                        </h3>
                                        <button type="button" class="widget-toggle">
                                            <i class="ti-angle-down"></i>
                                        </button>
                                    </div>
                                    <div class="widget-content">
                                        <div class="price-filter-modern">
                                            @php
                                                $max=DB::table('products')->max('price');
                                            @endphp
                                            <div class="price-slider-container">
                                                <div id="price-slider-range" data-min="0" data-max="{{$max}}"></div>
                                                <div class="price-values">
                                                    <span class="price-label">Fourchette de prix :</span>
                                                    <input type="text" id="price-range-display" readonly/>
                                                    <input type="hidden" name="price_range" id="price_range" value="@if(!empty($_GET['price'])){{$_GET['price']}}@endif"/>
                                                </div>
                                                <button type="submit" class="btn-filter-apply">
                                                    <i class="ti-check"></i>
                                                    <span>Appliquer</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/ End Price Filter Widget -->
                                
                                <!-- Recent Products Widget -->
                                <div class="sidebar-widget recent-products-widget">
                                    <div class="widget-header">
                                        <h3 class="widget-title">
                                            <i class="ti-time"></i>
                                            <span>Produits Récents</span>
                                        </h3>
                                        <button type="button" class="widget-toggle">
                                            <i class="ti-angle-down"></i>
                                        </button>
                                    </div>
                                    <div class="widget-content">
                                        <div class="recent-products-list">
                                            @foreach($recent_products as $product)
                                                @php 
                                                    $photo=explode(',',$product->photo);
                                                    $after_discount=($product->price-($product->price*$product->discount)/100);
                                                @endphp
                                                <div class="recent-product-item">
                                                    <div class="product-image">
                                                        <a href="{{route('product-detail',$product->slug)}}">
                                                            <img src="{{$photo[0]}}" alt="{{$product->title}}">
                                                        </a>
                                                    </div>
                                                    <div class="product-info">
                                                        <h5 class="product-title">
                                                            <a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a>
                                                        </h5>
                                                        <div class="product-price">
                                                            <span class="current-price">{{number_format($after_discount,2)}} {{Helper::base_currency()}}</span>
                                                            @if($product->discount > 0)
                                                                <span class="old-price">{{number_format($product->price,2)}} {{Helper::base_currency()}}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <!--/ End Recent Products Widget -->
                                
                                <!-- Brands Widget -->
                                <div class="sidebar-widget brands-widget">
                                    <div class="widget-header">
                                        <h3 class="widget-title">
                                            <i class="ti-tag"></i>
                                            <span>Marques</span>
                                        </h3>
                                        <button type="button" class="widget-toggle">
                                            <i class="ti-angle-down"></i>
                                        </button>
                                    </div>
                                    <div class="widget-content">
                                        <ul class="brands-list modern-list">
                                            @php
                                                $brands=DB::table('brands')->orderBy('title','ASC')->where('status','active')->get();
                                            @endphp
                                            @foreach($brands as $brand)
                                                <li>
                                                    <a href="{{route('product-brand',$brand->slug)}}">
                                                        {{$brand->title}}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <!--/ End Brands Widget -->
                            </div>
                        </div>
                    </div>
                    <!--/ End Sidebar Filters -->
                    
                    <!-- Product Grid Content -->
                    <div class="col-lg-9 col-md-8 col-12">
                        <!-- Shop Toolbar -->
                        <div class="shop-toolbar-modern">
                            <div class="toolbar-left">
                                <div class="shop-info">
                                    <p>Affichage de <span>{{$products->firstItem()}} à {{$products->lastItem()}}</span> sur <span>{{$products->total()}}</span> produits</p>
                                </div>
                            </div>
                            
                            <div class="toolbar-right">
                                <div class="toolbar-controls">
                                    <div class="sort-control">
                                        <label>Trier par :</label>
                                        <select class="sort-select" name='sortBy' onchange="this.form.submit();">
                                            <option value="">Par défaut</option>
                                            <option value="title" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='title') selected @endif>Nom (A-Z)</option>
                                            <option value="title_desc" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='title_desc') selected @endif>Nom (Z-A)</option>
                                            <option value="price" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='price') selected @endif>Prix croissant</option>
                                            <option value="price_desc" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='price_desc') selected @endif>Prix décroissant</option>
                                            <option value="created_at" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='created_at') selected @endif>Nouveautés</option>
                                        </select>
                                    </div>
                                    
                                    <div class="show-control">
                                        <label>Afficher :</label>
                                        <select class="show-select" name="show" onchange="this.form.submit();">
                                            <option value="">Par défaut</option>
                                            <option value="9" @if(!empty($_GET['show']) && $_GET['show']=='9') selected @endif>9</option>
                                            <option value="15" @if(!empty($_GET['show']) && $_GET['show']=='15') selected @endif>15</option>
                                            <option value="21" @if(!empty($_GET['show']) && $_GET['show']=='21') selected @endif>21</option>
                                            <option value="30" @if(!empty($_GET['show']) && $_GET['show']=='30') selected @endif>30</option>
                                        </select>
                                    </div>
                                    
                                    <div class="view-control">
                                        <a href="javascript:void(0)" class="view-btn grid-view active" title="Vue Grille">
                                            <i class="ti-layout-grid2"></i>
                                        </a>
                                        <a href="{{route('product-lists')}}" class="view-btn list-view" title="Vue Liste">
                                            <i class="ti-view-list-alt"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ End Shop Toolbar -->
                        
                        <!-- Product Grid -->
                        <div class="product-grid-modern">
                            @if(count($products)>0)
                                <div class="row">
                                    @foreach($products as $product)
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                                            <div class="product-card-grid">
                                                <div class="product-badges">
                                                    @if($product->stock<=0)
                                                        <span class="badge out-of-stock">Rupture</span>
                                                    @elseif($product->condition=='new')
                                                        <span class="badge new">Nouveau</span>
                                                    @elseif($product->condition=='hot')
                                                        <span class="badge hot">Tendance</span>
                                                    @elseif($product->discount > 0)
                                                        <span class="badge discount">-{{$product->discount}}%</span>
                                                    @endif
                                                </div>
                                                
                                                <div class="product-image">
                                                    <a href="{{route('product-detail',$product->slug)}}" class="image-link">
                                                        @php
                                                            $photo=explode(',',$product->photo);
                                                        @endphp
                                                        <img class="default-image" src="{{$photo[0]}}" alt="{{$product->title}}">
                                                        @if(count($photo) > 1)
                                                            <img class="hover-image" src="{{$photo[1]}}" alt="{{$product->title}}">
                                                        @endif
                                                    </a>
                                                    
                                                    <div class="product-actions">
                                                        <button type="button" class="action-btn quick-view" data-toggle="modal" data-target="#{{$product->id}}" title="Vue Rapide">
                                                            <i class="ti-eye"></i>
                                                        </button>
                                                        <a href="{{route('add-to-wishlist',$product->slug)}}" class="action-btn wishlist" data-id="{{$product->id}}" title="Favoris">
                                                            <i class="ti-heart"></i>
                                                        </a>
                                                        <a href="{{route('add-to-cart',$product->slug)}}" class="action-btn add-cart" title="Ajouter au Panier">
                                                            <i class="ti-shopping-cart"></i>
                                                        </a>
                                                    </div>
                                                    
                                                    <a href="{{route('add-to-cart',$product->slug)}}" class="btn-add-to-cart-grid">
                                                        <i class="ti-shopping-cart"></i>
                                                        <span>Ajouter au Panier</span>
                                                    </a>
                                                </div>
                                                
                                                <div class="product-content">
                                                    <div class="product-category">
                                                        @if($product->cat_info)
                                                            <a href="{{route('product-cat',$product->cat_info->slug)}}">{{$product->cat_info->title}}</a>
                                                        @endif
                                                    </div>
                                                    
                                                    <h3 class="product-title">
                                                        <a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a>
                                                    </h3>
                                                    
                                                    <div class="product-rating">
                                                        @php
                                                            $rate=DB::table('product_reviews')->where('product_id',$product->id)->avg('rate');
                                                            $rate_count=DB::table('product_reviews')->where('product_id',$product->id)->count();
                                                        @endphp
                                                        <div class="stars">
                                                            @for($i=1; $i<=5; $i++)
                                                                @if($rate>=$i)
                                                                    <i class="ti-star filled"></i>
                                                                @else
                                                                    <i class="ti-star"></i>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                        <span class="rating-count">({{$rate_count}})</span>
                                                    </div>
                                                    
                                                    <div class="product-price">
                                                        @php
                                                            $after_discount=($product->price-($product->price*$product->discount)/100);
                                                        @endphp
                                                        <div class="current-price">{{number_format($after_discount,2)}} {{Helper::base_currency()}}</div>
                                                        @if($product->discount > 0)
                                                            <div class="price-details">
                                                                <span class="original-price">{{number_format($product->price,2)}} {{Helper::base_currency()}}</span>
                                                                <span class="discount-percent">-{{$product->discount}}%</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    
                                                    <div class="product-stock">
                                                        @if($product->stock > 0)
                                                            <span class="in-stock">
                                                                <i class="ti-check-box"></i>
                                                                <span>{{$product->stock}} en stock</span>
                                                            </span>
                                                        @else
                                                            <span class="out-stock">
                                                                <i class="ti-close"></i>
                                                                <span>Rupture de stock</span>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="no-products-found">
                                    <div class="empty-state">
                                        <i class="ti-package"></i>
                                        <h3>Aucun produit trouvé</h3>
                                        <p>Essayez de modifier vos critères de recherche</p>
                                        <a href="{{route('product-grids')}}" class="btn-browse-products">
                                            <i class="ti-shopping-cart"></i>
                                            <span>Parcourir tous les produits</span>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <!--/ End Product Grid -->
                        
                        <!-- Pagination -->
                        @if($products->hasPages())
                            <div class="pagination-modern">
                                {{$products->appends($_GET)->links('vendor.pagination.custom')}}
                            </div>
                        @endif
                        <!--/ End Pagination -->
                    </div>
                    <!--/ End Product Grid Content -->
                </div>
            </div>
        </section>
    </form>

    <!--/ End Product Grid -->

    <!-- Product Quick View Modals -->
    @if($products)
        @foreach($products as $key=>$product)
            <div class="modal fade quick-view-modal" id="{{$product->id}}" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <button type="button" class="modal-close" data-dismiss="modal">
                            <i class="ti-close"></i>
                        </button>
                        
                        <div class="modal-body">
                            <div class="row">
                                <!-- Product Gallery -->
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="product-gallery-modern">
                                        <div class="main-image">
                                            @php 
                                                $photo=explode(',',$product->photo);
                                            @endphp
                                            <img src="{{$photo[0]}}" alt="{{$product->title}}" class="active">
                                        </div>
                                        @if(count($photo) > 1)
                                            <div class="image-thumbnails">
                                                @foreach($photo as $key=>$image)
                                                    <div class="thumb-item @if($key==0) active @endif">
                                                        <img src="{{$image}}" alt="{{$product->title}}">
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <!--/ End Product Gallery -->
                                
                                <!-- Product Details -->
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="product-details-modern">
                                        <h2 class="product-title">{{$product->title}}</h2>
                                        
                                        <div class="product-meta">
                                            <div class="product-rating">
                                                <div class="stars">
                                                    @php
                                                        $rate=DB::table('product_reviews')->where('product_id',$product->id)->avg('rate');
                                                        $rate_count=DB::table('product_reviews')->where('product_id',$product->id)->count();
                                                    @endphp
                                                    @for($i=1; $i<=5; $i++)
                                                        @if($rate>=$i)
                                                            <i class="ti-star filled"></i>
                                                        @else
                                                            <i class="ti-star"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <span class="review-count">({{$rate_count}} avis clients)</span>
                                            </div>
                                            
                                            <div class="product-stock">
                                                @if($product->stock >0)
                                                    <span class="in-stock"><i class="ti-check-box"></i> En stock</span>
                                                @else
                                                    <span class="out-stock"><i class="ti-close"></i> Rupture</span>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="product-price-section">
                                            @php
                                                $after_discount=($product->price-($product->price*$product->discount)/100);
                                            @endphp
                                            <div class="current-price">{{number_format($after_discount,2)}} {{Helper::base_currency()}}</div>
                                            @if($product->discount > 0)
                                                <div class="price-details">
                                                    <span class="original-price">{{number_format($product->price,2)}} {{Helper::base_currency()}}</span>
                                                    <span class="discount-percent">-{{$product->discount}}%</span>
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <div class="product-description">
                                            <p>{!! html_entity_decode($product->summary) !!}</p>
                                        </div>
                                        
                                        @if($product->size)
                                            <div class="product-variants">
                                                <h5>Taille :</h5>
                                                <div class="size-options">
                                                    @php 
                                                        $sizes=explode(',',$product->size);
                                                    @endphp
                                                    @foreach($sizes as $size)
                                                        <button type="button" class="size-option">{{$size}}</button>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                        
                                        <form action="{{route('single-add-to-cart')}}" method="POST" class="product-form-modern">
                                            @csrf
                                            <input type="hidden" name="slug" value="{{$product->slug}}">
                                            
                                            <div class="quantity-selector">
                                                <label>Quantité :</label>
                                                <div class="quantity-input-group">
                                                    <button type="button" class="qty-btn minus">
                                                        <i class="ti-minus"></i>
                                                    </button>
                                                    <input type="number" name="quant[1]" value="1" min="1" max="100" class="qty-input">
                                                    <button type="button" class="qty-btn plus">
                                                        <i class="ti-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            
                                            <div class="product-actions-modern">
                                                <button type="submit" class="btn-add-to-cart-modal">
                                                    <i class="ti-shopping-cart"></i>
                                                    <span>Ajouter au Panier</span>
                                                </button>
                                                <a href="{{route('add-to-wishlist',$product->slug)}}" class="btn-wishlist-modal">
                                                    <i class="ti-heart"></i>
                                                    <span>Favoris</span>
                                                </a>
                                            </div>
                                        </form>
                                        
                                        <div class="product-share">
                                            <h5>Partager :</h5>
                                            <div class="share-buttons">
                                                <a href="#" class="share-btn facebook">
                                                    <i class="ti-facebook"></i>
                                                </a>
                                                <a href="#" class="share-btn twitter">
                                                    <i class="ti-twitter"></i>
                                                </a>
                                                <a href="#" class="share-btn pinterest">
                                                    <i class="ti-pinterest"></i>
                                                </a>
                                                <a href="#" class="share-btn linkedin">
                                                    <i class="ti-linkedin"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/ End Product Details -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    <!--/ End Product Quick View Modals -->

@endsection

@push('styles')
<style>
    /* Base Styles */
    :root {
        --primary-color: #28a745;
        --primary-light: #20c997;
        --primary-dark: #1e7e34;
        --secondary-color: #1e293b;
        --text-color: #334155;
        --light-gray: #f8fafc;
        --border-color: #e2e8f0;
        --shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        --shadow-hover: 0 15px 35px rgba(0, 0, 0, 0.12);
        --transition: all 0.3s ease;
    }
    
    /* Breadcrumbs */
    .breadcrumbs {
        background: var(--light-gray);
        padding: 20px 0;
    }
    
    .bread-inner {
        display: flex;
        align-items: center;
    }
    
    .bread-list {
        display: flex;
        align-items: center;
        gap: 10px;
        list-style: none;
        margin: 0;
        padding: 0;
    }
    
    .bread-list li {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .bread-list a {
        color: var(--text-color);
        text-decoration: none;
        transition: var(--transition);
    }
    
    .bread-list a:hover {
        color: var(--primary-color);
    }
    
    .bread-list .ti-arrow-right {
        font-size: 12px;
        color: #94a3b8;
    }
    
    .bread-list .active a {
        color: var(--primary-color);
        font-weight: 600;
    }
    
    /* Product Grid Section */
    .product-grid-section {
        padding: 50px 0;
        background: #fff;
    }
    
    /* Modern Sidebar */
    .shop-sidebar.sidebar-modern {
        background: white;
        border-radius: 16px;
        box-shadow: var(--shadow);
        overflow: hidden;
        margin-bottom: 30px;
    }
    
    .sidebar-mobile-toggle {
        display: none;
    }
    
    .filter-toggle-btn {
        width: 100%;
        padding: 15px;
        background: var(--primary-color);
        color: white;
        border: none;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
    }
    
    .filter-toggle-btn:hover {
        background: var(--primary-dark);
    }
    
    .sidebar-content {
        padding: 0;
    }
    
    /* Sidebar Widgets */
    .sidebar-widget {
        border-bottom: 1px solid var(--border-color);
    }
    
    .sidebar-widget:last-child {
        border-bottom: none;
    }
    
    .widget-header {
        padding: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        cursor: pointer;
        background: var(--light-gray);
    }
    
    .widget-title {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--secondary-color);
        margin: 0;
    }
    
    .widget-toggle {
        background: none;
        border: none;
        color: var(--text-color);
        font-size: 1.2rem;
        cursor: pointer;
        transition: var(--transition);
    }
    
    .widget-toggle:hover {
        color: var(--primary-color);
    }
    
    .widget-content {
        padding: 20px;
    }
    
    /* Category List */
    .category-list.modern-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .category-list li {
        margin-bottom: 8px;
    }
    
    .category-list li:last-child {
        margin-bottom: 0;
    }
    
    .category-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px;
        border-radius: 8px;
        transition: var(--transition);
    }
    
    .category-item:hover {
        background: var(--light-gray);
    }
    
    .category-item a {
        color: var(--text-color);
        text-decoration: none;
        flex: 1;
        transition: var(--transition);
    }
    
    .category-item:hover a {
        color: var(--primary-color);
    }
    
    .expand-btn {
        background: none;
        border: none;
        color: #94a3b8;
        font-size: 1rem;
        cursor: pointer;
        transition: var(--transition);
        padding: 5px;
    }
    
    .expand-btn:hover {
        color: var(--primary-color);
    }
    
    .expand-btn.active {
        transform: rotate(90deg);
        color: var(--primary-color);
    }
    
    .sub-category-list {
        list-style: none;
        padding-left: 20px;
        margin: 10px 0 0 0;
        display: none;
    }
    
    .sub-category-list.active {
        display: block;
    }
    
    .sub-category-list li {
        margin-bottom: 5px;
    }
    
    .sub-category-list a {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 10px;
        color: #64748b;
        text-decoration: none;
        border-radius: 6px;
        transition: var(--transition);
    }
    
    .sub-category-list a:hover {
        background: var(--light-gray);
        color: var(--primary-color);
    }
    
    .sub-category-list .ti-angle-right {
        font-size: 12px;
    }
    
    /* Price Filter */
    .price-filter-modern {
        padding: 10px 0;
    }
    
    .price-slider-container {
        position: relative;
    }
    
    #price-slider-range {
        height: 4px;
        background: #e2e8f0;
        border-radius: 2px;
        margin: 20px 0;
    }
    
    .ui-slider-range {
        background: var(--primary-color);
    }
    
    .ui-slider-handle {
        width: 20px;
        height: 20px;
        background: white;
        border: 2px solid var(--primary-color);
        border-radius: 50%;
        cursor: pointer;
        top: -8px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }
    
    .price-values {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }
    
    .price-label {
        font-weight: 500;
        color: var(--secondary-color);
    }
    
    #price-range-display {
        flex: 1;
        padding: 10px 15px;
        border: 2px solid var(--border-color);
        border-radius: 8px;
        background: white;
        font-weight: 500;
        color: var(--text-color);
        min-width: 200px;
    }
    
    .btn-filter-apply {
        width: 100%;
        padding: 12px;
        background: var(--primary-color);
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        cursor: pointer;
        transition: var(--transition);
    }
    
    .btn-filter-apply:hover {
        background: var(--primary-dark);
    }
    
    /* Recent Products Widget */
    .recent-products-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
    
    .recent-product-item {
        display: flex;
        gap: 15px;
        padding: 10px;
        border-radius: 8px;
        transition: var(--transition);
    }
    
    .recent-product-item:hover {
        background: var(--light-gray);
    }
    
    .recent-product-item .product-image {
        width: 60px;
        height: 60px;
        border-radius: 8px;
        overflow: hidden;
        flex-shrink: 0;
    }
    
    .recent-product-item .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .recent-product-item .product-info {
        flex: 1;
    }
    
    .recent-product-item .product-title {
        font-size: 0.9rem;
        margin-bottom: 5px;
        line-height: 1.4;
    }
    
    .recent-product-item .product-title a {
        color: var(--secondary-color);
        text-decoration: none;
    }
    
    .recent-product-item .product-title a:hover {
        color: var(--primary-color);
    }
    
    .recent-product-item .product-price {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .recent-product-item .current-price {
        font-weight: 600;
        color: var(--primary-color);
        font-size: 0.95rem;
    }
    
    .recent-product-item .old-price {
        font-size: 0.85rem;
        color: #94a3b8;
        text-decoration: line-through;
    }
    
    /* Brands List */
    .brands-list.modern-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }
    
    .brands-list li {
        margin: 0;
    }
    
    .brands-list a {
        display: block;
        padding: 10px;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        color: var(--text-color);
        text-decoration: none;
        text-align: center;
        transition: var(--transition);
    }
    
    .brands-list a:hover {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }
    
    /* Shop Toolbar */
    .shop-toolbar-modern {
        background: white;
        border-radius: 16px;
        box-shadow: var(--shadow);
        padding: 20px;
        margin-bottom: 30px;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
    }
    
    .toolbar-left .shop-info p {
        margin: 0;
        color: var(--text-color);
    }
    
    .toolbar-left .shop-info span {
        font-weight: 600;
        color: var(--primary-color);
    }
    
    .toolbar-right .toolbar-controls {
        display: flex;
        align-items: center;
        gap: 20px;
        flex-wrap: wrap;
    }
    
    .sort-control,
    .show-control {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .sort-control label,
    .show-control label {
        font-weight: 500;
        color: var(--secondary-color);
        white-space: nowrap;
    }
    
    .sort-select,
    .show-select {
        padding: 10px 15px;
        border: 2px solid var(--border-color);
        border-radius: 8px;
        background: white;
        color: var(--text-color);
        min-width: 150px;
        cursor: pointer;
        transition: var(--transition);
    }
    
    .sort-select:focus,
    .show-select:focus {
        outline: none;
        border-color: var(--primary-color);
    }
    
    .view-control {
        display: flex;
        gap: 10px;
    }
    
    .view-btn {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid var(--border-color);
        border-radius: 8px;
        color: var(--text-color);
        text-decoration: none;
        transition: var(--transition);
    }
    
    .view-btn:hover {
        border-color: var(--primary-color);
        color: var(--primary-color);
    }
    
    .view-btn.active {
        background: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
    }
    
    /* Product Grid Cards */
    .product-grid-modern {
        margin-bottom: 40px;
    }
    
    .product-card-grid {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: var(--transition);
        height: 100%;
        position: relative;
        margin-bottom: 30px;
    }
    
    .product-card-grid:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-hover);
    }
    
    .product-badges {
        position: absolute;
        top: 15px;
        left: 15px;
        z-index: 2;
        display: flex;
        flex-direction: column;
        gap: 5px;
    }
    
    .badge {
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 600;
        color: white;
    }
    
    .badge.new { background: #10b981; }
    .badge.hot { background: #ef4444; }
    .badge.discount { background: #f59e0b; }
    .badge.out-of-stock { background: #6b7280; }
    
    .product-image {
        position: relative;
        height: 250px;
        overflow: hidden;
    }
    
    .image-link {
        display: block;
        width: 100%;
        height: 100%;
        position: relative;
    }
    
    .default-image,
    .hover-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        position: absolute;
        top: 0;
        left: 0;
        transition: opacity 0.5s ease;
    }
    
    .default-image {
        opacity: 1;
        z-index: 1;
    }
    
    .hover-image {
        opacity: 0;
        z-index: 2;
    }
    
    .product-card-grid:hover .default-image {
        opacity: 0;
    }
    
    .product-card-grid:hover .hover-image {
        opacity: 1;
    }
    
    .product-actions {
        position: absolute;
        top: 15px;
        right: 15px;
        display: flex;
        flex-direction: column;
        gap: 10px;
        opacity: 0;
        transform: translateX(20px);
        transition: var(--transition);
        z-index: 3;
    }
    
    .product-card-grid:hover .product-actions {
        opacity: 1;
        transform: translateX(0);
    }
    
    .action-btn {
        width: 40px;
        height: 40px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-color);
        text-decoration: none;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        transition: var(--transition);
        border: none;
    }
    
    .action-btn:hover {
        background: var(--primary-color);
        color: white;
        transform: translateY(-2px);
    }
    
    .btn-add-to-cart-grid {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        background: var(--primary-color);
        color: white;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 12px;
        font-weight: 600;
        transform: translateY(100%);
        transition: var(--transition);
        z-index: 3;
    }
    
    .product-card-grid:hover .btn-add-to-cart-grid {
        transform: translateY(0);
    }
    
    .btn-add-to-cart-grid:hover {
        background: var(--primary-dark);
        color: white;
    }
    
    .product-content {
        padding: 20px;
    }
    
    .product-category {
        margin-bottom: 8px;
    }
    
    .product-category a {
        font-size: 0.85rem;
        color: #64748b;
        text-decoration: none;
        transition: var(--transition);
    }
    
    .product-category a:hover {
        color: var(--primary-color);
    }
    
    .product-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 10px;
        line-height: 1.4;
    }
    
    .product-title a {
        color: var(--secondary-color);
        text-decoration: none;
        transition: var(--transition);
    }
    
    .product-title a:hover {
        color: var(--primary-color);
    }
    
    .product-rating {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 10px;
    }
    
    .stars {
        display: flex;
        gap: 2px;
    }
    
    .ti-star {
        color: #cbd5e1;
        font-size: 0.9rem;
    }
    
    .ti-star.filled {
        color: #f59e0b;
    }
    
    .rating-count {
        font-size: 0.85rem;
        color: #64748b;
    }
    
    .product-price {
        margin-bottom: 10px;
    }
    
    .product-price .current-price {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--primary-color);
    }
    
    .price-details {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 5px;
    }
    
    .price-details .original-price {
        font-size: 1rem;
        color: #94a3b8;
        text-decoration: line-through;
    }
    
    .price-details .discount-percent {
        font-size: 0.85rem;
        background: #fef3c7;
        color: #92400e;
        padding: 4px 8px;
        border-radius: 4px;
        font-weight: 600;
    }
    
    .product-stock {
        margin-top: 10px;
    }
    
    .in-stock,
    .out-stock {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.9rem;
        font-weight: 500;
    }
    
    .in-stock {
        color: #10b981;
    }
    
    .out-stock {
        color: #ef4444;
    }
    
    /* No Products Found */
    .no-products-found {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 16px;
        box-shadow: var(--shadow);
    }
    
    .empty-state {
        max-width: 400px;
        margin: 0 auto;
    }
    
    .empty-state i {
        font-size: 4rem;
        color: #cbd5e1;
        margin-bottom: 20px;
    }
    
    .empty-state h3 {
        font-size: 1.5rem;
        color: var(--secondary-color);
        margin-bottom: 10px;
    }
    
    .empty-state p {
        color: #64748b;
        margin-bottom: 30px;
    }
    
    .btn-browse-products {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 24px;
        background: var(--primary-color);
        color: white;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: var(--transition);
    }
    
    .btn-browse-products:hover {
        background: var(--primary-dark);
        color: white;
    }
    
    /* Pagination */
    .pagination-modern {
        margin-top: 40px;
    }
    
    /* Quick View Modal */
    .quick-view-modal .modal-content {
        border-radius: 20px;
        overflow: hidden;
        border: none;
    }
    
    .modal-close {
        position: absolute;
        top: 20px;
        right: 20px;
        z-index: 10;
        width: 40px;
        height: 40px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        transition: var(--transition);
    }
    
    .modal-close:hover {
        transform: rotate(90deg);
    }
    
    .modal-body {
        padding: 0;
    }
    
    .product-gallery-modern {
        padding: 30px;
    }
    
    .main-image {
        height: 400px;
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 20px;
    }
    
    .main-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .image-thumbnails {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
    
    .thumb-item {
        width: 80px;
        height: 80px;
        border-radius: 8px;
        overflow: hidden;
        cursor: pointer;
        opacity: 0.6;
        transition: var(--transition);
        border: 2px solid transparent;
    }
    
    .thumb-item:hover,
    .thumb-item.active {
        opacity: 1;
        border-color: var(--primary-color);
    }
    
    .thumb-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .product-details-modern {
        padding: 30px;
        height: 100%;
    }
    
    .product-details-modern .product-title {
        font-size: 1.8rem;
        margin-bottom: 15px;
    }
    
    .product-details-modern .product-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    
    .product-details-modern .product-description {
        margin: 20px 0;
    }
    
    .product-variants {
        margin: 20px 0;
    }
    
    .size-options {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 10px;
    }
    
    .size-option {
        padding: 8px 16px;
        background: var(--light-gray);
        border: 2px solid var(--border-color);
        border-radius: 6px;
        color: var(--text-color);
        font-weight: 500;
        cursor: pointer;
        transition: var(--transition);
    }
    
    .size-option:hover,
    .size-option.active {
        background: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
    }
    
    .product-form-modern {
        margin: 30px 0;
    }
    
    .quantity-selector {
        margin-bottom: 20px;
    }
    
    .quantity-input-group {
        display: flex;
        align-items: center;
        gap: 10px;
        max-width: 200px;
    }
    
    .qty-btn {
        width: 40px;
        height: 40px;
        background: var(--light-gray);
        border: 2px solid var(--border-color);
        border-radius: 8px;
        color: var(--text-color);
        cursor: pointer;
        transition: var(--transition);
    }
    
    .qty-btn:hover {
        background: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
    }
    
    .qty-input {
        flex: 1;
        height: 40px;
        text-align: center;
        border: 2px solid var(--border-color);
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 500;
    }
    
    .product-actions-modern {
        display: flex;
        gap: 15px;
    }
    
    .btn-add-to-cart-modal,
    .btn-wishlist-modal {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 15px;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        transition: var(--transition);
    }
    
    .btn-add-to-cart-modal {
        background: var(--primary-color);
        color: white;
        border: none;
    }
    
    .btn-add-to-cart-modal:hover {
        background: var(--primary-dark);
    }
    
    .btn-wishlist-modal {
        background: white;
        color: var(--text-color);
        border: 2px solid var(--border-color);
    }
    
    .btn-wishlist-modal:hover {
        border-color: var(--primary-color);
        color: var(--primary-color);
    }
    
    .product-share {
        margin-top: 30px;
    }
    
    .share-buttons {
        display: flex;
        gap: 10px;
        margin-top: 10px;
    }
    
    .share-btn {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        color: white;
        text-decoration: none;
        transition: var(--transition);
    }
    
    .share-btn.facebook { background: #3b5998; }
    .share-btn.twitter { background: #1da1f2; }
    .share-btn.pinterest { background: #bd081c; }
    .share-btn.linkedin { background: #0077b5; }
    
    .share-btn:hover {
        transform: translateY(-2px);
        opacity: 0.9;
    }
    
    /* Responsive Design */
    @media (max-width: 992px) {
        .product-image {
            height: 200px;
        }
        
        .sidebar-mobile-toggle {
            display: block;
            margin-bottom: 20px;
        }
        
        .sidebar-content {
            display: none;
        }
        
        .sidebar-content.active {
            display: block;
        }
        
        .main-image {
            height: 300px;
        }
    }
    
    @media (max-width: 768px) {
        .shop-toolbar-modern {
            flex-direction: column;
            align-items: stretch;
        }
        
        .toolbar-left,
        .toolbar-right {
            width: 100%;
        }
        
        .toolbar-controls {
            flex-direction: column;
            align-items: stretch;
            gap: 15px;
        }
        
        .sort-control,
        .show-control {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .sort-select,
        .show-select {
            width: 100%;
        }
        
        .view-control {
            justify-content: center;
        }
        
        .product-card-grid {
            margin-bottom: 20px;
        }
        
        .quick-view-modal .modal-dialog {
            max-width: 95%;
            margin: 10px auto;
        }
    }
    
    @media (max-width: 576px) {
        .product-image {
            height: 180px;
        }
        
        .product-content {
            padding: 15px;
        }
        
        .product-title {
            font-size: 1rem;
        }
        
        .product-price .current-price {
            font-size: 1.1rem;
        }
        
        .brands-list.modern-list {
            grid-template-columns: 1fr;
        }
        
        .product-actions {
            opacity: 1;
            transform: translateX(0);
            flex-direction: row;
            top: auto;
            bottom: 15px;
            right: 15px;
        }
        
        .action-btn {
            width: 35px;
            height: 35px;
        }
        
        .btn-add-to-cart-grid {
            position: relative;
            transform: none;
            margin-top: 10px;
        }
        
        .quick-view-modal .modal-dialog {
            margin: 5px;
        }
        
        .product-gallery-modern,
        .product-details-modern {
            padding: 20px;
        }
        
        .main-image {
            height: 250px;
        }
    }
    
    @media (max-width: 480px) {
        .col-12 {
            padding-left: 8px;
            padding-right: 8px;
        }
        
        .product-card-grid {
            margin-bottom: 15px;
        }
        
        .price-values {
            flex-direction: column;
            align-items: stretch;
        }
        
        #price-range-display {
            min-width: auto;
            width: 100%;
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mobile sidebar toggle
        const filterToggleBtn = document.querySelector('.filter-toggle-btn');
        const sidebarContent = document.querySelector('.sidebar-content');
        
        if (filterToggleBtn) {
            filterToggleBtn.addEventListener('click', function() {
                sidebarContent.classList.toggle('active');
            });
        }
        
        // Category expand/collapse
        const expandBtns = document.querySelectorAll('.expand-btn');
        expandBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const parentLi = this.closest('li.has-children');
                const subList = parentLi.querySelector('.sub-category-list');
                
                this.classList.toggle('active');
                subList.classList.toggle('active');
                
                // Rotate icon
                const icon = this.querySelector('i');
                if (this.classList.contains('active')) {
                    icon.style.transform = 'rotate(90deg)';
                } else {
                    icon.style.transform = 'rotate(0deg)';
                }
            });
        });
        
        // Widget toggle
        const widgetToggles = document.querySelectorAll('.widget-toggle');
        widgetToggles.forEach(toggle => {
            toggle.addEventListener('click', function() {
                const widget = this.closest('.sidebar-widget');
                const content = widget.querySelector('.widget-content');
                const icon = this.querySelector('i');
                
                if (content.style.display === 'none') {
                    content.style.display = 'block';
                    icon.style.transform = 'rotate(0deg)';
                } else {
                    content.style.display = 'none';
                    icon.style.transform = 'rotate(180deg)';
                }
            });
        });
        
        // Price slider
        if ($("#price-slider-range").length > 0) {
            const max_value = parseInt($("#price-slider-range").data('max')) || 5000;
            const min_value = parseInt($("#price-slider-range").data('min')) || 0;
            let price_range = min_value+'-'+max_value;
            
            if($("#price_range").length > 0 && $("#price_range").val()){
                price_range = $("#price_range").val().trim();
            }
            
            let price = price_range.split('-');
            
            $("#price-slider-range").slider({
                range: true,
                min: min_value,
                max: max_value,
                values: price,
                slide: function (event, ui) {
                    $("#price-range-display").val(ui.values[0] + " {{Helper::base_currency()}} - " + ui.values[1] + " {{Helper::base_currency()}}");
                    $("#price_range").val(ui.values[0] + "-" + ui.values[1]);
                }
            });
            
            // Set initial display value
            if ($("#price-range-display").length > 0) {
                $("#price-range-display").val(
                    $("#price-slider-range").slider("values", 0) + 
                    " {{Helper::base_currency()}} - " + 
                    $("#price-slider-range").slider("values", 1) + 
                    " {{Helper::base_currency()}}"
                );
            }
        }
        
        // Quick view modal thumbnails
        const thumbItems = document.querySelectorAll('.thumb-item');
        const mainImage = document.querySelector('.main-image img');
        
        thumbItems.forEach(thumb => {
            thumb.addEventListener('click', function() {
                const thumbSrc = this.querySelector('img').src;
                if (mainImage) {
                    mainImage.src = thumbSrc;
                    
                    // Update active state
                    thumbItems.forEach(item => item.classList.remove('active'));
                    this.classList.add('active');
                }
            });
        });
        
        // Size options selection
        const sizeOptions = document.querySelectorAll('.size-option');
        sizeOptions.forEach(option => {
            option.addEventListener('click', function() {
                sizeOptions.forEach(opt => opt.classList.remove('active'));
                this.classList.add('active');
            });
        });
        
        // Quantity controls
        const qtyControls = document.querySelectorAll('.quantity-input-group');
        qtyControls.forEach(control => {
            const minusBtn = control.querySelector('.minus');
            const plusBtn = control.querySelector('.plus');
            const input = control.querySelector('.qty-input');
            
            if (minusBtn && plusBtn && input) {
                minusBtn.addEventListener('click', function() {
                    let value = parseInt(input.value);
                    if (value > 1) {
                        input.value = value - 1;
                    }
                });
                
                plusBtn.addEventListener('click', function() {
                    let value = parseInt(input.value);
                    if (value < parseInt(input.max)) {
                        input.value = value + 1;
                    }
                });
            }
        });
        
        // Add to cart animation
        const addToCartBtns = document.querySelectorAll('.btn-add-to-cart-grid, .action-btn.add-cart');
        addToCartBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (!this.href || !this.href.includes('add-to-cart')) return;
                
                e.preventDefault();
                const originalText = this.innerHTML;
                const originalBg = this.style.background;
                
                // Animate button
                this.innerHTML = '<i class="ti-check"></i><span>Ajouté !</span>';
                this.style.background = '#10b981';
                this.style.pointerEvents = 'none';
                
                // Reset after animation
                setTimeout(() => {
                    this.innerHTML = originalText;
                    this.style.background = originalBg;
                    this.style.pointerEvents = 'auto';
                    
                    // Redirect to cart page
                    window.location.href = this.href;
                }, 1000);
            });
        });
        
        // Wishlist button animation
        const wishlistBtns = document.querySelectorAll('.wishlist, .btn-wishlist-modal');
        wishlistBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (!this.href) return;
                
                e.preventDefault();
                const icon = this.querySelector('i');
                
                // Animate heart icon
                if (icon) {
                    icon.style.transform = 'scale(1.3)';
                    icon.style.color = '#ef4444';
                    
                    setTimeout(() => {
                        icon.style.transform = 'scale(1)';
                        
                        // Redirect to wishlist page
                        window.location.href = this.href;
                    }, 300);
                }
            });
        });
        
        // Quick view modal
        const quickViewBtns = document.querySelectorAll('.quick-view');
        quickViewBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const target = this.getAttribute('data-target');
                $(target).modal('show');
            });
        });
        
        // Product card hover effect
        const productCards = document.querySelectorAll('.product-card-grid');
        productCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transition = 'transform 0.3s ease, box-shadow 0.3s ease';
            });
        });
        
        // Initialize all modals
        $('.quick-view-modal').on('show.bs.modal', function () {
            // Reset thumbnails to first image
            const modal = this;
            const thumbnails = modal.querySelectorAll('.thumb-item');
            const mainImg = modal.querySelector('.main-image img');
            
            if (thumbnails.length > 0 && mainImg) {
                thumbnails.forEach(thumb => thumb.classList.remove('active'));
                thumbnails[0].classList.add('active');
                mainImg.src = thumbnails[0].querySelector('img').src;
            }
            
            // Reset size options
            const sizeOptions = modal.querySelectorAll('.size-option');
            if (sizeOptions.length > 0) {
                sizeOptions.forEach(option => option.classList.remove('active'));
                sizeOptions[0].classList.add('active');
            }
            
            // Reset quantity
            const qtyInput = modal.querySelector('.qty-input');
            if (qtyInput) {
                qtyInput.value = 1;
            }
        });
    });
</script>
@endpush
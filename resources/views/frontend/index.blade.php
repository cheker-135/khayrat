@extends('frontend.layouts.master')
@section('title','KHAYRAT || Frais & Surgelés')

@section('main-content')

<!-- Hero Slider -->
@if(count($banners)>0)
    <section class="hero-slider">
        <div class="swiper heroSwiper">
            <div class="swiper-wrapper">
                @foreach($banners as $key=>$banner)
                    <div class="swiper-slide">
                        <div class="slide-background">
                            <img src="{{$banner->photo}}" alt="{{$banner->title}}" loading="lazy">
                            <div class="overlay"></div>
                        </div>
                        <div class="slide-content">
                            <div class="container">
                                <div class="content-wrapper">
                                    <span class="slide-subtitle wow fadeInUp">Produits Surgelés Tunisiens</span>
                                    <h1 class="slide-title wow fadeInDown">{{$banner->title}}</h1>
                                    <p class="slide-description wow fadeInUp">{!! html_entity_decode($banner->description) !!}</p>
                                    <a href="{{route('product-grids')}}" class="btn-hero wow fadeInUp">
                                        <i class="ti-shopping-cart"></i>
                                        <span>Découvrir Nos Produits</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>
@endif
<!--/ End Hero Slider -->

<!-- Category Banner -->
<section class="category-banner">
    <div class="container">
        <div class="section-header">
            <h2>Nos Catégories</h2>
            <p>Découvrez nos produits surgelés par catégorie</p>
        </div>
        <div class="category-grid">
            @php
            $category_lists=DB::table('categories')->where('status','active')->limit(3)->get();
            @endphp
            @if($category_lists)
                @foreach($category_lists as $cat)
                    @if($cat->is_parent==1)
                        <div class="category-card">
                            <div class="category-image">
                                @if($cat->photo)
                                    <img src="{{$cat->photo}}" alt="{{$cat->title}}" loading="lazy">
                                @else
                                    <img src="https://images.unsplash.com/photo-1540420773420-3366772f4999?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="{{$cat->title}}" loading="lazy">
                                @endif
                                <div class="image-overlay"></div>
                            </div>
                            <div class="category-content">
                                <h3>{{$cat->title}}</h3>
                                <p>Produits frais surgelés</p>
                                <a href="{{route('product-cat',$cat->slug)}}" class="btn-category">
                                    <span>Explorer</span>
                                    <i class="ti-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
</section>
<!-- End Category Banner -->

<!-- Featured Products -->
<section class="featured-products">
    <div class="container">
        <div class="section-header">
            <h2>Produits Phares</h2>
            <p>Nos produits les plus populaires</p>
        </div>
        
        <div class="featured-products-slider">
            <div class="swiper featuredSwiper">
                <div class="swiper-wrapper">
                    @if($product_lists)
                        @foreach($product_lists as $key=>$product)
                            <div class="swiper-slide">
                                <div class="product-card">
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
                                        @php
                                            $photo=explode(',',$product->photo);
                                        @endphp
                                        <img src="{{$photo[0]}}" alt="{{$product->title}}" class="product-img" loading="lazy">
                                        <div class="product-overlay">
                                            <div class="overlay-actions">
                                                <button class="action-btn quick-view" data-toggle="modal" data-target="#{{$product->id}}">
                                                    <i class="ti-eye"></i>
                                                    <span>Voir</span>
                                                </button>
                                                <a href="{{route('add-to-wishlist',$product->slug)}}" class="action-btn wishlist">
                                                    <i class="ti-heart"></i>
                                                    <span>Favoris</span>
                                                </a>
                                            </div>
                                            <a href="{{route('add-to-cart',$product->slug)}}" class="btn-add-cart">
                                                <i class="ti-shopping-cart"></i>
                                                <span>Ajouter au panier</span>
                                            </a>
                                        </div>
                                    </div>
                                    
                                    <div class="product-info">
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
                                            <span class="current-price">{{number_format($after_discount,2)}} {{Helper::base_currency()}}</span>
                                            @if($product->discount > 0)
                                                <span class="old-price">{{number_format($product->price,2)}} {{Helper::base_currency()}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
        
        <div class="text-center mt-50">
            <a href="{{route('product-grids')}}" class="btn-view-all">
                <span>Voir Tous les Produits</span>
                <i class="ti-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
<!-- End Featured Products -->

<!-- Promo Banner -->
<section class="promo-banner">
    @if($featured)
        @foreach($featured as $data)
            <div class="container">
                <div class="promo-content">
                    <div class="promo-text">
                        <span class="promo-subtitle">Offre Spéciale</span>
                        <h2>{{$data->title}}</h2>
                        <p>Profitez de {{$data->discount}}% de réduction sur cette sélection</p>
                        <a href="{{route('product-detail',$data->slug)}}" class="btn-promo">
                            <i class="ti-shopping-cart"></i>
                            <span>Acheter Maintenant</span>
                        </a>
                    </div>
                    <div class="promo-image">
                        @php
                            $photo=explode(',',$data->photo);
                        @endphp
                        <img src="{{$photo[0]}}" alt="{{$data->title}}" loading="lazy">
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</section>
<!-- End Promo Banner -->

<!-- Trending Products -->
<section class="trending-products">
    <div class="container">
        <div class="section-header">
            <h2>Produits Tendance</h2>
            <p>Découvrez les produits les plus populaires</p>
        </div>
        
        <div class="trending-slider">
            <div class="swiper trendingSwiper">
                <div class="swiper-wrapper">
                    @foreach($product_lists as $product)
                        @if($product->condition=='hot')
                            <div class="swiper-slide">
                                <div class="trending-card">
                                    <div class="trending-badge">
                                        <span class="hot-badge">Tendance</span>
                                    </div>
                                    <div class="trending-image">
                                        @php
                                            $photo=explode(',',$product->photo);
                                        @endphp
                                        <img src="{{$photo[0]}}" alt="{{$product->title}}" loading="lazy">
                                        <div class="trending-overlay">
                                            <button class="action-btn quick-view" data-toggle="modal" data-target="#{{$product->id}}">
                                                <i class="ti-eye"></i>
                                            </button>
                                            <a href="{{route('add-to-wishlist',$product->slug)}}" class="action-btn wishlist">
                                                <i class="ti-heart"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="trending-info">
                                        <h3 class="trending-title">
                                            <a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a>
                                        </h3>
                                        <div class="trending-price">
                                            @php
                                                $after_discount=($product->price-($product->price*$product->discount)/100)
                                            @endphp
                                            <span class="current-price">{{number_format($after_discount,2)}} {{Helper::base_currency()}}</span>
                                            <span class="old-price">{{number_format($product->price,2)}} {{Helper::base_currency()}}</span>
                                        </div>
                                        <a href="{{route('add-to-cart',$product->slug)}}" class="btn-trending-cart">
                                            <i class="ti-shopping-cart"></i>
                                            <span>Ajouter</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
</section>
<!-- End Trending Products -->

<!-- Feedback Section -->
<section class="feedback-section">
    <div class="container">
        <div class="section-header">
            <h2>Ce Que Disent Nos Clients</h2>
            <p>Découvrez les avis de nos clients satisfaits en Tunisie</p>
        </div>
        
        <div class="feedback-slider">
            <div class="swiper feedbackSwiper">
                <div class="swiper-wrapper">
                    <!-- Feedback 1 -->
                    <div class="swiper-slide">
                        <div class="feedback-card">
                            <div class="feedback-rating">
                                <i class="ti-star filled"></i>
                                <i class="ti-star filled"></i>
                                <i class="ti-star filled"></i>
                                <i class="ti-star filled"></i>
                                <i class="ti-star filled"></i>
                            </div>
                            <p class="feedback-text">
                                "Produits d'excellente qualité et livraison rapide à Tunis. Les surgelés sont toujours parfaitement conservés. Je recommande vivement !"
                            </p>
                            <div class="feedback-author">
                                <div class="author-avatar">
                                    <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Client" loading="lazy">
                                </div>
                                <div class="author-info">
                                    <h4>Amira Ben Salah</h4>
                                    <span>Client depuis 2 ans</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Feedback 2 -->
                    <div class="swiper-slide">
                        <div class="feedback-card">
                            <div class="feedback-rating">
                                <i class="ti-star filled"></i>
                                <i class="ti-star filled"></i>
                                <i class="ti-star filled"></i>
                                <i class="ti-star filled"></i>
                                <i class="ti-star"></i>
                            </div>
                            <p class="feedback-text">
                                "Service client impeccable et produits toujours frais à Sfax. La variété des produits surgelés est impressionnante. Très satisfait !"
                            </p>
                            <div class="feedback-author">
                                <div class="author-avatar">
                                    <img src="https://randomuser.me/api/portraits/men/54.jpg" alt="Client" loading="lazy">
                                </div>
                                <div class="author-info">
                                    <h4>Mohamed Khédira</h4>
                                    <span>Client régulier</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Feedback 3 -->
                    <div class="swiper-slide">
                        <div class="feedback-card">
                            <div class="feedback-rating">
                                <i class="ti-star filled"></i>
                                <i class="ti-star filled"></i>
                                <i class="ti-star filled"></i>
                                <i class="ti-star filled"></i>
                                <i class="ti-star filled"></i>
                            </div>
                            <p class="feedback-text">
                                "Commande facile et livraison express à Sousse. Les produits sont parfaitement emballés et la qualité est au rendez-vous. Bravo !"
                            </p>
                            <div class="feedback-author">
                                <div class="author-avatar">
                                    <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Client" loading="lazy">
                                </div>
                                <div class="author-info">
                                    <h4>Fatma Trabelsi</h4>
                                    <span>Nouveau client</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Feedback 4 -->
                    <div class="swiper-slide">
                        <div class="feedback-card">
                            <div class="feedback-rating">
                                <i class="ti-star filled"></i>
                                <i class="ti-star filled"></i>
                                <i class="ti-star filled"></i>
                                <i class="ti-star filled"></i>
                                <i class="ti-star filled"></i>
                            </div>
                            <p class="feedback-text">
                                "Les produits surgelés tunisiens sont excellents ! Fraîcheur garantie et prix très compétitifs. Livraison dans toute la Tunisie."
                            </p>
                            <div class="feedback-author">
                                <div class="author-avatar">
                                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Client" loading="lazy">
                                </div>
                                <div class="author-info">
                                    <h4>Youssef Gharbi</h4>
                                    <span>Client fidèle</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Feedback 5 -->
                    <div class="swiper-slide">
                        <div class="feedback-card">
                            <div class="feedback-rating">
                                <i class="ti-star filled"></i>
                                <i class="ti-star filled"></i>
                                <i class="ti-star filled"></i>
                                <i class="ti-star filled"></i>
                                <i class="ti-star filled"></i>
                            </div>
                            <p class="feedback-text">
                                "Qualité exceptionnelle des produits tunisiens. Le service après-vente est excellent. Je fais toutes mes courses de surgelés ici !"
                            </p>
                            <div class="feedback-author">
                                <div class="author-avatar">
                                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Client" loading="lazy">
                                </div>
                                <div class="author-info">
                                    <h4>Nadia Zaïdi</h4>
                                    <span>Client VIP</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
</section>
<!-- End Feedback Section -->

<!-- Latest Products -->
<section class="latest-products">
    <div class="container-fluid" style="padding: 0 40px;">
        <div class="section-header">
            <h2>Nouveaux Arrivages</h2>
            <p>Découvrez nos dernières additions</p>
        </div>
        
        <div class="latest-slider">
            <div class="swiper latestSwiper">
                <div class="swiper-wrapper">
                    @php
                        $product_lists=DB::table('products')->where('status','active')->orderBy('id','DESC')->limit(8)->get();
                    @endphp
                    @foreach($product_lists as $product)
                        <div class="swiper-slide">
                            <div class="latest-card">
                                <div class="latest-image">
                                    @php
                                        $photo=explode(',',$product->photo);
                                    @endphp
                                    <img src="{{$photo[0]}}" alt="{{$product->title}}" loading="lazy">
                                    <div class="latest-overlay">
                                        <a href="{{route('add-to-cart',$product->slug)}}" class="btn-latest-cart">
                                            <i class="ti-shopping-cart"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="latest-info">
                                    <h4 class="latest-title">
                                        <a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a>
                                    </h4>
                                    <div class="latest-price">
                                        @php
                                            $after_discount=($product->price-($product->price*$product->discount)/100);
                                        @endphp
                                        <span class="price">{{number_format($after_discount,2)}} {{Helper::base_currency()}}</span>
                                        @if($product->discount > 0)
                                            <span class="old-price">{{number_format($product->price,2)}} {{Helper::base_currency()}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
</section>
<!-- End Latest Products -->

<!-- Blog Section -->
<section class="blog-section">
    <div class="container">
        <div class="section-header">
            <h2>Conseils & Actualités</h2>
            <p>Découvrez nos conseils sur les produits surgelés tunisiens</p>
        </div>
        
        <div class="blog-grid">
            @if($posts)
                @foreach($posts as $post)
                    <article class="blog-card">
                        <div class="blog-image">
                            <img src="{{$post->photo}}" alt="{{$post->title}}" loading="lazy">
                            <div class="blog-date">
                                <span class="date-day">{{$post->created_at->format('d')}}</span>
                                <span class="date-month">{{$post->created_at->format('M')}}</span>
                            </div>
                        </div>
                        <div class="blog-content">
                            <h3 class="blog-title">
                                <a href="{{route('blog.detail',$post->slug)}}">{{$post->title}}</a>
                            </h3>
                            <p class="blog-excerpt">{{ Str::limit(strip_tags($post->summary), 100) }}</p>
                            <a href="{{route('blog.detail',$post->slug)}}" class="btn-blog">
                                <span>Lire Plus</span>
                                <i class="ti-arrow-right"></i>
                            </a>
                        </div>
                    </article>
                @endforeach
            @endif
        </div>
    </div>
</section>
<!-- End Blog Section -->

<!-- Services Section -->
<section class="services-section">
    <div class="container">
        <div class="section-header">
            <h2>Nos Services</h2>
            <p>Votre satisfaction, notre priorité</p>
        </div>
        <div class="services-grid">
            <div class="service-card">
                <div class="service-icon">
                    <i class="ti-truck"></i>
                </div>
                <div class="service-content">
                    <h3>Livraison Rapide</h3>
                    <p>Livraison dans toute la Tunisie</p>
                </div>
            </div>
            
            <div class="service-card">
                <div class="service-icon">
                    <i class="ti-reload"></i>
                </div>
                <div class="service-content">
                    <h3>Retour Facile</h3>
                    <p>14 jours pour retourner</p>
                </div>
            </div>
            
            <div class="service-card">
                <div class="service-icon">
                    <i class="ti-shield"></i>
                </div>
                <div class="service-content">
                    <h3>Paiement Sécurisé</h3>
                    <p>Paiement à la livraison</p>
                </div>
            </div>
            
            <div class="service-card">
                <div class="service-icon">
                    <i class="ti-headphone-alt"></i>
                </div>
                <div class="service-content">
                    <h3>Support 24/7</h3>
                    <p>Assistance téléphonique</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Services Section -->

<!-- Newsletter -->
@include('frontend.layouts.newsletter')

<!-- Modals -->
@if($product_lists)
    @foreach($product_lists as $key=>$product)
        <div class="modal fade product-modal" id="{{$product->id}}" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="ti-close"></i>
                    </button>
                    <div class="modal-body">
                        <div class="modal-product">
                            <div class="product-gallery">
                                @php
                                    $photo=explode(',',$product->photo);
                                @endphp
                                <div class="gallery-main">
                                    <img src="{{$photo[0]}}" alt="{{$product->title}}">
                                </div>
                                @if(count($photo) > 1)
                                    <div class="gallery-thumbs">
                                        @foreach($photo as $data)
                                            <div class="thumb-item">
                                                <img src="{{$data}}" alt="{{$product->title}}">
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            
                            <div class="product-details">
                                <h2 class="product-title">{{$product->title}}</h2>
                                
                                <div class="product-meta">
                                    <div class="product-rating">
                                        <div class="stars">
                                            @for($i=1; $i<=5; $i++)
                                                @if($rate>=$i)
                                                    <i class="ti-star filled"></i>
                                                @else
                                                    <i class="ti-star"></i>
                                                @endif
                                            @endfor
                                        </div>
                                        <span class="review-count">({{$rate_count}} avis)</span>
                                    </div>
                                    <div class="product-stock">
                                        @if($product->stock >0)
                                            <span class="in-stock"><i class="ti-check-box"></i> En stock</span>
                                        @else
                                            <span class="out-stock"><i class="ti-close"></i> Rupture</span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="product-price">
                                    @php
                                        $after_discount=($product->price-($product->price*$product->discount)/100);
                                    @endphp
                                    <span class="price">{{number_format($after_discount,2)}} {{Helper::base_currency()}}</span>
                                    @if($product->discount > 0)
                                        <span class="old-price">{{number_format($product->price,2)}} {{Helper::base_currency()}}</span>
                                    @endif
                                </div>
                                
                                <div class="product-description">
                                    <p>{!! html_entity_decode($product->summary) !!}</p>
                                </div>
                                
                                @if($product->size)
                                    <div class="product-variants">
                                        <div class="variant-group">
                                            <label>Taille :</label>
                                            <div class="variant-options">
                                                @php
                                                    $sizes=explode(',',$product->size);
                                                @endphp
                                                @foreach($sizes as $size)
                                                    <button type="button" class="variant-btn">{{$size}}</button>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                
                                <form action="{{route('single-add-to-cart')}}" method="POST" class="product-form">
                                    @csrf
                                    <input type="hidden" name="slug" value="{{$product->slug}}">
                                    <div class="product-quantity">
                                        <label>Quantité :</label>
                                        <div class="quantity-control">
                                            <button type="button" class="qty-btn minus"><i class="ti-minus"></i></button>
                                            <input type="number" name="quant[1]" value="1" min="1" max="100" class="qty-input">
                                            <button type="button" class="qty-btn plus"><i class="ti-plus"></i></button>
                                        </div>
                                    </div>
                                    <div class="product-actions">
                                        <button type="submit" class="btn-add-to-cart">
                                            <i class="ti-shopping-cart"></i>
                                            <span>Ajouter au Panier</span>
                                        </button>
                                        <a href="{{route('add-to-wishlist',$product->slug)}}" class="btn-wishlist">
                                            <i class="ti-heart"></i>
                                            <span>Favoris</span>
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif
<!-- End Modals -->

@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<style>
    /* Base Styles */
    :root {
        --primary-gradient: linear-gradient(135deg, #10b981 0%, #059669 100%);
        --primary-color: #059669;
        --primary-light: #34d399;
        --secondary-color: #0f172a;
        --accent-color: #fbbf24;
        --text-main: #1e293b;
        --text-muted: #64748b;
        --bg-glass: rgba(255, 255, 255, 0.8);
        --bg-glass-dark: rgba(15, 23, 42, 0.8);
        --border-glass: rgba(255, 255, 255, 0.2);
        --shadow-premium: 0 20px 40px -15px rgba(0, 0, 0, 0.1);
        --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: var(--text-color);
        background: #ffffff;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .section-header {
        text-align: center;
        margin-bottom: 60px;
    }

    .section-header h2 {
        font-size: clamp(2rem, 4vw, 3rem);
        color: var(--secondary-color);
        margin-bottom: 16px;
        font-weight: 800;
        letter-spacing: -1px;
        position: relative;
        display: inline-block;
    }

    .section-header h2::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 4px;
        background: var(--primary-gradient);
        border-radius: 2px;
    }

    .section-header p {
        color: var(--text-muted);
        font-size: 1.1rem;
        max-width: 600px;
        margin: 20px auto 0;
        line-height: 1.6;
    }

    /* Hero Slider */
    .hero-slider {
        position: relative;
        height: 85vh;
        min-height: 600px;
        overflow: hidden;
        border-radius: 0 0 50px 50px;
        margin-bottom: -50px;
        z-index: 1;
    }

    .heroSwiper {
        width: 100%;
        height: 100%;
    }

    .slide-background {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    .slide-background img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .slide-background .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, rgba(0,0,0,0.7), rgba(0,0,0,0.3));
    }

    .slide-content {
        position: relative;
        z-index: 2;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
    }

    .content-wrapper {
        max-width: 800px;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .slide-subtitle {
        display: inline-block;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        padding: 8px 20px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 20px;
        letter-spacing: 1px;
    }

    .slide-title {
        font-size: clamp(2.5rem, 5vw, 4.5rem);
        font-weight: 800;
        margin-bottom: 24px;
        line-height: 1.1;
        letter-spacing: -2px;
        text-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .slide-description {
        font-size: 1.2rem;
        margin-bottom: 60px;
        color: #ffffff;
        opacity: 1;
        line-height: 1.8;
        text-align: justify;
        max-width: 700px;
        margin-left: auto;
        margin-right: auto;
        text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }

    .btn-hero {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        margin-top: 30px;
        padding: 18px 36px;
        background: var(--primary-gradient);
        color: white;
        border: none;
        border-radius: 100px;
        font-size: 1.1rem;
        font-weight: 700;
        text-decoration: none;
        transition: var(--transition);
        box-shadow: 0 10px 25px rgba(16, 185, 129, 0.4);
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .btn-hero:hover {
        transform: translateY(-5px) scale(1.05);
        box-shadow: 0 20px 40px rgba(16, 185, 129, 0.5);
        color: white;
    }

    /* Swiper Navigation */
    .swiper-button-next,
    .swiper-button-prev {
        color: white;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        width: 60px;
        height: 60px;
        border-radius: 50%;
        transition: var(--transition);
    }

    .swiper-button-next:hover,
    .swiper-button-prev:hover {
        background: rgba(255, 255, 255, 0.2);
    }

    .swiper-button-next:after,
    .swiper-button-prev:after {
        font-size: 1.5rem;
    }

    /* Category Banner */
    .category-banner {
        padding: 80px 0;
        background: var(--light-gray);
    }

    .category-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
    }

    .category-card {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        background: white;
        transition: var(--transition);
        box-shadow: var(--shadow-premium);
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .category-image {
        position: relative;
        height: 250px;
        width: 100%;
        overflow: hidden;
    }

    .category-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .category-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
    }

    .category-card:hover .category-image img {
        transform: scale(1.05);
    }

    .image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, transparent, rgba(0,0,0,0.7));
    }

    .category-content {
        padding: 30px;
        text-align: center;
    }

    .category-content h3 {
        font-size: 1.5rem;
        color: var(--secondary-color);
        margin-bottom: 8px;
        font-weight: 600;
    }

    .category-content p {
        color: #64748b;
        margin-bottom: 20px;
        font-size: 0.95rem;
    }

    .btn-category {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--primary-color);
        font-weight: 600;
        text-decoration: none;
        transition: var(--transition);
    }

    .btn-category:hover {
        gap: 12px;
        color: var(--primary-light);
    }

    /* Featured Products */
    .featured-products {
        padding: 80px 0;
    }

    .featured-products-slider {
        position: relative;
        padding: 0 50px;
    }

    .featuredSwiper {
        padding: 20px 0;
    }

    .products-slider .swiper-slide {
        height: auto;
        display: flex; /* Ensure resize behavior in swiper */
    }

    .product-card {
        background: white;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: var(--shadow-premium);
        transition: var(--transition);
        height: 100%;
        display: flex;
        flex-direction: column;
        position: relative;
        border: 1px solid rgba(0, 0, 0, 0.05);
        width: 100%; /* Ensure full width in slide */
    }

    .product-card:hover {
        transform: translateY(-12px) scale(1.02);
        box-shadow: 0 30px 60px -20px rgba(16, 185, 129, 0.15);
        border-color: var(--primary-light);
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
        height: 200px;
        overflow: hidden;
    }

    .product-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .product-card:hover .product-img {
        transform: scale(1.05);
    }

    .product-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 15px;
        opacity: 0;
        transition: var(--transition);
    }

    .product-card:hover .product-overlay {
        opacity: 1;
    }

    .overlay-actions {
        display: flex;
        gap: 15px;
    }

    .action-btn {
        width: 45px;
        height: 45px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-color);
        text-decoration: none;
        transition: var(--transition);
    }

    .action-btn:hover {
        background: var(--primary-color);
        color: white;
        transform: translateY(-2px);
    }

    .action-btn span {
        display: none;
    }

    .btn-add-cart {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        background: var(--primary-color);
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 500;
        text-decoration: none;
        transition: var(--transition);
    }

    .btn-add-cart:hover {
        background: var(--primary-light);
        transform: translateY(-2px);
    }

    .product-info {
        padding: 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .product-title {
        font-size: 1.1rem;
        margin-bottom: 10px;
        font-weight: 600;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        height: 2.8em; /* Force height for alignment */
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
    }

    .ti-star.filled {
        color: #f59e0b;
    }

    .rating-count {
        font-size: 0.875rem;
        color: #64748b;
    }

    .product-price {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .current-price {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--primary-color);
    }

    .old-price {
        font-size: 0.95rem;
        color: #94a3b8;
        text-decoration: line-through;
    }

    .btn-view-all {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        padding: 18px 40px;
        background: white;
        border: 2px solid var(--primary-color);
        color: var(--primary-color);
        border-radius: 100px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: var(--transition);
        box-shadow: 0 10px 20px rgba(16, 185, 129, 0.1);
    }

    .btn-view-all:hover {
        background: var(--primary-color);
        color: white;
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 15px 30px rgba(16, 185, 129, 0.3);
    }

    /* Promo Banner - Modifié pour le noir */
    .promo-banner {
        padding: 100px 0;
        background: var(--secondary-color);
        position: relative;
        overflow: hidden;
    }

    .promo-banner::before {
        content: '';
        position: absolute;
        width: 500px;
        height: 500px;
        background: var(--primary-color);
        filter: blur(150px);
        opacity: 0.15;
        top: -250px;
        right: -250px;
        border-radius: 50%;
    }

    .promo-content {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 40px;
        padding: 60px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        align-items: center;
        gap: 60px;
    }

    @media (max-width: 992px) {
        .promo-content {
            grid-template-columns: 1fr;
            text-align: center;
            padding: 40px;
        }
    }
    .promo-subtitle {
        font-size: 1.2rem;
        margin-bottom: 16px;
        color: rgba(255, 255, 255, 0.9);
        line-height: 1.6;
    }
    .promo-text h2 {
        font-size: clamp(2rem, 4vw, 3.5rem);
        margin-bottom: 24px;
        font-weight: 800;
        line-height: 1.1;
        letter-spacing: -1px;
        color: white; /* Ensure visible white text */
    }

    .promo-text p {
        font-size: 1.2rem;
        margin-bottom: 40px; /* Increased space before button */
        color: rgba(255, 255, 255, 0.9); /* Clear white text */
        line-height: 1.6;
    }

    .btn-promo {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        padding: 18px 40px;
        background: var(--primary-gradient);
        color: white;
        border: none;
        border-radius: 100px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        text-decoration: none;
        transition: var(--transition);
        box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3);
        position: relative;
        overflow: hidden;
    }

    .btn-promo::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: 0.5s;
    }

    .btn-promo:hover {
        transform: translateY(-5px) scale(1.05);
        background: var(--primary-color);
        color: white;
        box-shadow: 0 20px 40px rgba(16, 185, 129, 0.5);
    }

    .btn-promo:hover::before {
        left: 100%;
    }

    .promo-image {
        flex: 1;
    }

    .promo-image img {
        width: 100%;
        height: 350px;
        object-fit: cover;
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    }

    /* Trending Products */
    .trending-products {
        padding: 80px 0;
        background: var(--light-gray);
    }

    .trending-slider {
        position: relative;
        padding: 0 50px;
    }

    .trendingSwiper {
        padding: 20px 0;
    }

    .trending-slider .swiper-slide {
        height: auto;
        display: flex; /* Ensure resize behavior in swiper */
    }

    .trending-card {
        background: white;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: var(--shadow-premium);
        transition: var(--transition);
        height: 100%;
        display: flex;
        flex-direction: column;
        border: 1px solid rgba(0, 0, 0, 0.05);
        width: 100%;
    }

    .trending-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
    }

    .trending-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        z-index: 2;
    }

    .hot-badge {
        background: #ef4444;
        color: white;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .trending-image {
        position: relative;
        height: 200px;
        overflow: hidden;
    }

    .trending-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .trending-card:hover .trending-image img {
        transform: scale(1.05);
    }

    .trending-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        gap: 10px;
        justify-content: center;
        align-items: center;
        opacity: 0;
        transition: var(--transition);
    }

    .trending-card:hover .trending-overlay {
        opacity: 1;
    }

    .trending-info {
        padding: 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .trending-title {
        font-size: 1.1rem;
        margin-bottom: 10px;
        font-weight: 600;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        height: 2.8em;
    }

    .trending-title a {
        color: var(--secondary-color);
        text-decoration: none;
    }

    .trending-price {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 15px;
    }

    .btn-trending-cart {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        background: var(--light-gray);
        color: var(--text-color);
        border: none;
        border-radius: 8px;
        font-weight: 500;
        text-decoration: none;
        transition: var(--transition);
        width: 100%;
        justify-content: center;
    }

    .btn-trending-cart:hover {
        background: var(--primary-color);
        color: white;
    }

    /* Feedback Section */
    .feedback-section {
        padding: 80px 0;
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    }

    .feedback-slider {
        position: relative;
        padding: 0 50px;
    }

    .feedbackSwiper {
        padding: 20px 0;
    }

    .feedback-card {
        background: var(--bg-glass);
        backdrop-filter: blur(20px);
        border: 1px solid var(--border-glass);
        border-radius: 30px;
        padding: 40px;
        box-shadow: var(--shadow-premium);
        transition: var(--transition);
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .feedback-card:hover {
        transform: translateY(-10px) scale(1.02);
        background: white;
        box-shadow: 0 40px 80px -20px rgba(0, 0, 0, 0.1);
    }

    .feedback-rating {
        display: flex;
        gap: 5px;
        margin-bottom: 20px;
    }

    .feedback-rating .ti-star.filled {
        color: #f59e0b;
    }

    .feedback-text {
        font-size: 1rem;
        line-height: 1.6;
        color: #4b5563;
        margin-bottom: 25px;
        flex-grow: 1;
        font-style: italic;
        position: relative;
        padding-left: 20px;
    }

    .feedback-text:before {
        content: '"';
        font-size: 3rem;
        color: var(--primary-color);
        opacity: 0.3;
        position: absolute;
        left: 0;
        top: -15px;
    }

    .feedback-author {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .author-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        overflow: hidden;
        border: 3px solid var(--primary-color);
    }

    .author-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .author-info h4 {
        font-size: 1rem;
        font-weight: 600;
        color: var(--secondary-color);
        margin-bottom: 4px;
    }

    .author-info span {
        font-size: 0.875rem;
        color: #6b7280;
    }

    .feedbackSwiper .swiper-pagination {
        position: relative;
        margin-top: 30px;
    }

    .feedbackSwiper .swiper-pagination-bullet {
        width: 10px;
        height: 10px;
        background: #cbd5e1;
        opacity: 1;
    }

    .feedbackSwiper .swiper-pagination-bullet-active {
        background: var(--primary-color);
    }

    /* Latest Products */
    .latest-products {
        padding: 80px 0;
    }

    .latest-slider {
        position: relative;
        padding: 0;
        width: 100%;
        overflow: hidden;
    }

    .latestSwiper {
        padding: 20px 0;
    }

    .latest-slider .swiper-slide {
        height: auto;
        display: flex;
    }

    .latest-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.03);
        transition: var(--transition);
        border: 1px solid rgba(0, 0, 0, 0.02);
        height: 100%;
        display: flex;
        flex-direction: column;
        width: 100%;
    }

    .latest-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-premium);
        border-color: var(--primary-light);
    }

    .latest-image {
        position: relative;
        height: 150px;
        overflow: hidden;
    }

    .latest-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .latest-card:hover .latest-image img {
        transform: scale(1.05);
    }

    .latest-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: var(--transition);
    }

    .latest-card:hover .latest-overlay {
        opacity: 1;
    }

    .btn-latest-cart {
        width: 45px;
        height: 45px;
        background: var(--primary-color);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-decoration: none;
        transition: var(--transition);
    }

    .btn-latest-cart:hover {
        background: var(--primary-light);
        transform: scale(1.1);
    }

    .latest-info {
        padding: 15px;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .latest-title {
        font-size: 1rem;
        margin-bottom: 8px;
        font-weight: 600;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        height: 2.5em;
    }

    .latest-title a {
        color: var(--secondary-color);
        text-decoration: none;
    }

    .latest-price {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .latest-price .price {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--primary-color);
    }

    .latest-price .old-price {
        font-size: 0.9rem;
        color: #94a3b8;
        text-decoration: line-through;
    }

    /* Blog Section */
    .blog-section {
        padding: 80px 0;
        background: var(--light-gray);
    }

    .blog-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
    }

    .blog-card {
        background: white;
        border-radius: 30px;
        overflow: hidden;
        box-shadow: var(--shadow-premium);
        transition: var(--transition);
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .blog-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 30px 60px -15px rgba(0, 0, 0, 0.1);
        border-color: var(--primary-light);
    }

    .blog-image {
        position: relative;
        height: 200px;
        overflow: hidden;
    }

    .blog-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .blog-card:hover .blog-image img {
        transform: scale(1.05);
    }

    .blog-date {
        position: absolute;
        top: 20px;
        left: 20px;
        background: white;
        padding: 10px;
        border-radius: 8px;
        text-align: center;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .date-day {
        display: block;
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary-color);
    }

    .date-month {
        display: block;
        font-size: 0.875rem;
        color: var(--text-color);
        font-weight: 500;
    }

    .blog-content {
        padding: 30px;
    }

    .blog-title {
        font-size: 1.25rem;
        margin-bottom: 12px;
        font-weight: 600;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        line-height: 1.4;
        height: 2.8em;
    }

    .blog-title a {
        color: var(--secondary-color);
        text-decoration: none;
    }

    .blog-title a:hover {
        color: var(--primary-color);
    }

    .blog-excerpt {
        color: #64748b;
        margin-bottom: 20px;
        line-height: 1.6;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        height: 4.8em;
    }

    .btn-blog {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--primary-color);
        font-weight: 600;
        text-decoration: none;
        transition: var(--transition);
    }

    .btn-blog:hover {
        gap: 12px;
        color: var(--primary-light);
    }

    /* Services Section */
    .services-section {
        padding: 80px 0;
    }

    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
    }

    .service-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        gap: 20px;
        padding: 40px;
        background: white;
        border-radius: 30px;
        transition: var(--transition);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
        border: 1px solid rgba(0, 0, 0, 0.02);
    }

    .service-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-premium);
        border-color: var(--primary-light);
    }

    .service-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
        flex-shrink: 0;
    }

    .service-content h3 {
        font-size: 1.2rem;
        margin-bottom: 8px;
        font-weight: 600;
        color: var(--secondary-color);
    }

    .service-content p {
        color: #64748b;
        font-size: 0.95rem;
    }

    /* Product Modal */
    .product-modal .modal-content {
        border: none;
        border-radius: 20px;
        overflow: hidden;
    }

    .product-modal .close {
        position: absolute;
        top: 20px;
        right: 20px;
        z-index: 10;
        background: white;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        opacity: 0.8;
        transition: var(--transition);
    }

    .product-modal .close:hover {
        opacity: 1;
        transform: rotate(90deg);
    }

    .modal-product {
        display: flex;
        gap: 40px;
        padding: 30px;
    }

    .product-gallery {
        flex: 1;
    }

    .gallery-main {
        height: 400px;
        overflow: hidden;
        border-radius: 12px;
        margin-bottom: 20px;
    }

    .gallery-main img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .gallery-thumbs {
        display: flex;
        gap: 10px;
    }

    .thumb-item {
        width: 80px;
        height: 80px;
        border-radius: 8px;
        overflow: hidden;
        cursor: pointer;
        opacity: 0.6;
        transition: var(--transition);
    }

    .thumb-item:hover,
    .thumb-item.active {
        opacity: 1;
    }

    .thumb-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .product-details {
        flex: 1;
    }

    .product-title {
        font-size: 2rem;
        margin-bottom: 20px;
        font-weight: 700;
        color: var(--secondary-color);
    }

    .product-meta {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 20px;
    }

    .product-stock .in-stock {
        color: #10b981;
        font-weight: 500;
    }

    .product-stock .out-stock {
        color: #ef4444;
        font-weight: 500;
    }

    .product-price {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
    }

    .product-price .price {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary-color);
    }

    .product-price .old-price {
        font-size: 1.2rem;
        color: #94a3b8;
        text-decoration: line-through;
    }

    .product-description {
        margin-bottom: 30px;
    }

    .product-description p {
        color: #64748b;
        line-height: 1.6;
    }

    .product-variants {
        margin-bottom: 30px;
    }

    .variant-group {
        margin-bottom: 15px;
    }

    .variant-group label {
        display: block;
        margin-bottom: 10px;
        font-weight: 500;
        color: var(--secondary-color);
    }

    .variant-options {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .variant-btn {
        padding: 8px 16px;
        background: var(--light-gray);
        border: 2px solid var(--border-color);
        border-radius: 8px;
        color: var(--text-color);
        font-weight: 500;
        cursor: pointer;
        transition: var(--transition);
    }

    .variant-btn:hover,
    .variant-btn.active {
        background: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
    }

    .product-form {
        margin-top: 30px;
    }

    .product-quantity {
        margin-bottom: 30px;
    }

    .product-quantity label {
        display: block;
        margin-bottom: 10px;
        font-weight: 500;
        color: var(--secondary-color);
    }

    .quantity-control {
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

    .product-actions {
        display: flex;
        gap: 15px;
    }

    .btn-add-to-cart {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 16px;
        background: var(--primary-color);
        color: white;
        border: none;
        border-radius: 12px;
        font-weight: 600;
        transition: var(--transition);
    }

    .btn-add-to-cart:hover {
        background: var(--primary-light);
        transform: translateY(-2px);
    }

    .btn-wishlist {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 16px 24px;
        background: white;
        border: 2px solid var(--border-color);
        color: var(--text-color);
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: var(--transition);
    }

    .btn-wishlist:hover {
        border-color: var(--primary-color);
        color: var(--primary-color);
        transform: translateY(-2px);
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .promo-content {
            gap: 40px;
        }
        
        .promo-text h2 {
            font-size: 2rem;
        }
    }

    @media (max-width: 992px) {
        .hero-slider {
            height: 600px;
        }
        
        .slide-title {
            font-size: 2.5rem;
        }
        
        .promo-content {
            flex-direction: column;
            text-align: center;
        }
        
        .promo-image img {
            height: 300px;
        }
        
        .modal-product {
            flex-direction: column;
        }
        
        .gallery-main {
            height: 300px;
        }
        
        .featured-products-slider,
        .trending-slider,
        .feedback-slider,
        .latest-slider {
            padding: 0 30px;
        }
    }

    @media (max-width: 768px) {
        .hero-slider {
            height: 500px;
        }
        
        .slide-title {
            font-size: 2rem;
        }
        
        .slide-description {
            font-size: 1rem;
        }
        
        .section-header h2 {
            font-size: 2rem;
        }
        
        .category-grid,
        .blog-grid,
        .services-grid {
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        }
        
        .swiper-button-next,
        .swiper-button-prev {
            display: none;
        }
        
        .product-actions {
            flex-direction: column;
        }
        
        .featured-products-slider,
        .trending-slider,
        .feedback-slider,
        .latest-slider {
            padding: 0 15px;
        }
    }

    @media (max-width: 480px) {
        .hero-slider {
            height: 400px;
        }
        
        .slide-title {
            font-size: 1.8rem;
        }
        
        .content-wrapper {
            text-align: center;
        }
        
        .section-header h2 {
            font-size: 1.8rem;
        }
        
        .modal-product {
            padding: 20px;
        }
        
        .feedback-card {
            padding: 20px;
        }
    }

    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .wow {
        animation-duration: 0.6s;
    }

    .fadeInUp {
        animation-name: fadeInUp;
    }

    .fadeInDown {
        animation-name: fadeInUp;
        animation-delay: 0.2s;
    }
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize WOW.js for animations
        new WOW().init();
        
        // Hero Slider
        const heroSwiper = new Swiper('.heroSwiper', {
            loop: true,
            speed: 800,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            }
        });
        
        // Featured Products Slider
        const featuredSwiper = new Swiper('.featuredSwiper', {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 4,
                    spaceBetween: 20,
                },
            }
        });
        
        // Trending Products Slider
        const trendingSwiper = new Swiper('.trendingSwiper', {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 3500,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 4,
                    spaceBetween: 20,
                },
            }
        });
        
        // Feedback Slider
        const feedbackSwiper = new Swiper('.feedbackSwiper', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                768: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
            }
        });
        
        // Latest Products Slider
        const latestSwiper = new Swiper('.latestSwiper', {
            slidesPerView: 2,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                576: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
                992: {
                    slidesPerView: 4,
                    spaceBetween: 20,
                },
                1200: {
                    slidesPerView: 5,
                    spaceBetween: 25,
                },
                1400: {
                    slidesPerView: 6,
                    spaceBetween: 30,
                }
            }
        });
        
        // Product quantity controls
        const qtyControls = document.querySelectorAll('.quantity-control');
        qtyControls.forEach(control => {
            const minusBtn = control.querySelector('.minus');
            const plusBtn = control.querySelector('.plus');
            const input = control.querySelector('.qty-input');
            
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
        });
        
        // Modal gallery thumbs
        const thumbItems = document.querySelectorAll('.thumb-item');
        const mainImage = document.querySelector('.gallery-main img');
        
        thumbItems.forEach(thumb => {
            thumb.addEventListener('click', function() {
                const thumbSrc = this.querySelector('img').src;
                mainImage.src = thumbSrc;
                
                // Update active state
                thumbItems.forEach(item => item.classList.remove('active'));
                this.classList.add('active');
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
        
        // Variant buttons
        const variantBtns = document.querySelectorAll('.variant-btn');
        variantBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                variantBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
            });
        });
        
        // Add to cart animation
        const addToCartBtns = document.querySelectorAll('.btn-add-cart, .btn-add-to-cart');
        addToCartBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (!this.href.includes('add-to-cart')) return;
                
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
        const wishlistBtns = document.querySelectorAll('.wishlist');
        wishlistBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (!this.href) return;
                
                e.preventDefault();
                const icon = this.querySelector('i');
                
                // Animate heart icon
                icon.style.transform = 'scale(1.3)';
                icon.style.color = '#ef4444';
                
                setTimeout(() => {
                    icon.style.transform = 'scale(1)';
                    
                    // Redirect to wishlist page
                    window.location.href = this.href;
                }, 300);
            });
        });
        
        // Card hover effects
        const cards = document.querySelectorAll('.product-card, .trending-card, .category-card, .blog-card, .service-card, .feedback-card');
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transition = 'transform 0.3s ease, box-shadow 0.3s ease';
            });
        });
        
        // Image lazy loading
        const images = document.querySelectorAll('img[loading="lazy"]');
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                    }
                    imageObserver.unobserve(img);
                }
            });
        }, {
            rootMargin: '50px 0px',
            threshold: 0.1
        });
        
        images.forEach(img => {
            if (img.complete) return;
            imageObserver.observe(img);
        });
    });
</script>
@endpush
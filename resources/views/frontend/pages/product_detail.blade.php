@extends('frontend.layouts.master')

@section('meta')
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name='copyright' content=''>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="keywords" content="magasin en ligne, achat, panier, ecommerce, meilleur shopping">
	<meta name="description" content="{{$product_detail->summary}}">
	<meta property="og:url" content="{{route('product-detail',$product_detail->slug)}}">
	<meta property="og:type" content="article">
	<meta property="og:title" content="{{$product_detail->title}}">
	<meta property="og:image" content="{{$product_detail->photo}}">
	<meta property="og:description" content="{{$product_detail->description}}">
@endsection

@section('title','KHAYRAT || Détail du Produit')

@section('main-content')
		<!-- Breadcrumbs -->
		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="bread-inner">
							<ul class="bread-list">
								<li><a href="{{route('home')}}">Accueil<i class="ti-arrow-right"></i></a></li>
								@if($product_detail->cat_info)
									<li><a href="{{route('product-cat',$product_detail->cat_info['slug'])}}">{{$product_detail->cat_info['title']}}<i class="ti-arrow-right"></i></a></li>
								@endif
								<li class="active"><a href="javascript:void(0);">{{$product_detail->title}}</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Breadcrumbs -->
				
		<!-- Product Detail -->
		<section class="product-detail-section">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="product-detail-modern">
							<div class="row">
								<!-- Product Gallery -->
								<div class="col-lg-6 col-md-6 col-12">
									<div class="product-gallery-modern">
										<div class="main-image-container">
											@php 
												$photo=explode(',',$product_detail->photo);
											@endphp
											<div class="main-image">
												<img src="{{$photo[0]}}" alt="{{$product_detail->title}}" id="main-product-image">
											</div>
											<div class="product-badges">
												@if($product_detail->stock<=0)
													<span class="badge out-of-stock">Rupture de Stock</span>
												@elseif($product_detail->condition=='new')
													<span class="badge new">Nouveau</span>
												@elseif($product_detail->condition=='hot')
													<span class="badge hot">Tendance</span>
												@elseif($product_detail->discount > 0)
													<span class="badge discount">-{{$product_detail->discount}}%</span>
												@endif
											</div>
										</div>
										
										@if(count($photo) > 1)
											<div class="image-thumbnails">
												@foreach($photo as $key=>$image)
													<div class="thumb-item @if($key==0) active @endif" data-image="{{$image}}">
														<img src="{{$image}}" alt="{{$product_detail->title}}">
													</div>
												@endforeach
											</div>
										@endif
										
										<div class="product-share-modern">
											<span>Partager :</span>
											<div class="share-buttons">
												<a href="#" class="share-btn facebook" onclick="shareOnFacebook()">
													<i class="ti-facebook"></i>
												</a>
												<a href="#" class="share-btn twitter" onclick="shareOnTwitter()">
													<i class="ti-twitter"></i>
												</a>
												<a href="#" class="share-btn pinterest" onclick="shareOnPinterest()">
													<i class="ti-pinterest"></i>
												</a>
												<a href="#" class="share-btn linkedin" onclick="shareOnLinkedIn()">
													<i class="ti-linkedin"></i>
												</a>
											</div>
										</div>
									</div>
								</div>
								<!--/ End Product Gallery -->
								
								<!-- Product Info -->
								<div class="col-lg-6 col-md-6 col-12">
									<div class="product-info-modern">
										<div class="product-header">
											<h1 class="product-title">{{$product_detail->title}}</h1>
											
											<div class="product-meta">
												<div class="product-rating">
													<div class="stars">
														@php
															$rate=ceil($product_detail->getReview->avg('rate'))
														@endphp
														@for($i=1; $i<=5; $i++)
															@if($rate>=$i)
																<i class="ti-star filled"></i>
															@else 
																<i class="ti-star"></i>
															@endif
														@endfor
													</div>
													<a href="#reviews" class="review-count">({{$product_detail['getReview']->count()}} avis)</a>
												</div>
												
												<div class="product-sku">
													<span>Référence :</span>
													<strong>{{$product_detail->sku}}</strong>
												</div>
											</div>
										</div>
										
										<div class="product-price-section">
											@php 
												$after_discount=($product_detail->price-(($product_detail->price*$product_detail->discount)/100));
											@endphp
											<div class="current-price">{{number_format($after_discount,2)}} {{Helper::base_currency()}}</div>
											@if($product_detail->discount > 0)
												<div class="price-details">
													<span class="original-price">{{number_format($product_detail->price,2)}} {{Helper::base_currency()}}</span>
													<span class="discount-percent">-{{$product_detail->discount}}%</span>
												</div>
											@endif
										</div>
										
										<div class="product-excerpt">
											<p>{!! $product_detail->summary !!}</p>
										</div>
										
										<div class="product-stock-info">
											<div class="stock-status @if($product_detail->stock>0) in-stock @else out-stock @endif">
												@if($product_detail->stock>0)
													<i class="ti-check-box"></i>
													<span>{{$product_detail->stock}} en stock</span>
												@else
													<i class="ti-close"></i>
													<span>Rupture de stock</span>
												@endif
											</div>
											
											<div class="delivery-info">
												<i class="ti-truck"></i>
												<span>Livraison gratuite à partir de 200 {{Helper::base_currency()}}</span>
											</div>
										</div>
										
										@if($product_detail->size)
											<div class="product-variants">
												<h5>Taille :</h5>
												<div class="variant-options">
													@php 
														$sizes=explode(',',$product_detail->size);
													@endphp
													@foreach($sizes as $size)
														<button type="button" class="variant-btn size-btn" data-value="{{trim($size)}}">{{trim($size)}}</button>
													@endforeach
												</div>
											</div>
										@endif
										
										<form action="{{route('single-add-to-cart')}}" method="POST" class="product-form-modern">
											@csrf 
											<input type="hidden" name="slug" value="{{$product_detail->slug}}">
											<input type="hidden" name="size" id="selected-size" value="">
											
											<div class="quantity-selector">
												<label>Quantité :</label>
												<div class="quantity-input-group">
													<button type="button" class="qty-btn minus">
														<i class="ti-minus"></i>
													</button>
													<input type="number" name="quant[1]" value="1" min="1" max="100" class="qty-input" id="quantity">
													<button type="button" class="qty-btn plus">
														<i class="ti-plus"></i>
													</button>
												</div>
											</div>
											
											<div class="product-actions">
												<button type="submit" class="btn-add-to-cart" id="add-to-cart-btn">
													<i class="ti-shopping-cart"></i>
													<span>Ajouter au Panier</span>
												</button>
												<a href="{{route('add-to-wishlist',$product_detail->slug)}}" class="btn-wishlist">
													<i class="ti-heart"></i>
													<span>Favoris</span>
												</a>
											</div>
										</form>
										
										<div class="product-categories">
											<div class="category-item">
												<span>Catégorie :</span>
												<a href="{{route('product-cat',$product_detail->cat_info['slug'])}}" class="category-link">{{$product_detail->cat_info['title']}}</a>
											</div>
											@if($product_detail->sub_cat_info)
												<div class="category-item">
													<span>Sous-catégorie :</span>
													<a href="{{route('product-sub-cat',[$product_detail->cat_info['slug'],$product_detail->sub_cat_info['slug']])}}" class="category-link">{{$product_detail->sub_cat_info['title']}}</a>
												</div>
											@endif
										</div>
										
										<div class="product-features">
											<div class="feature-item">
												<i class="ti-truck"></i>
												<div>
													<h6>Livraison Rapide</h6>
													<p>Livraison sous 24-48h</p>
												</div>
											</div>
											<div class="feature-item">
												<i class="ti-reload"></i>
												<div>
													<h6>Retour Facile</h6>
													<p>14 jours pour retourner</p>
												</div>
											</div>
											<div class="feature-item">
												<i class="ti-shield"></i>
												<div>
													<h6>Paiement Sécurisé</h6>
													<p>Paiement 100% sécurisé</p>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!--/ End Product Info -->
							</div>
							
							<!-- Product Tabs -->
							<div class="product-tabs-modern">
								<nav class="tab-navigation">
									<div class="nav nav-tabs" id="productTab" role="tablist">
										<button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab">
											<i class="ti-file"></i>
											<span>Description</span>
										</button>
										<button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab">
											<i class="ti-comment-alt"></i>
											<span>Avis ({{$product_detail['getReview']->count()}})</span>
										</button>
										<button class="nav-link" id="shipping-tab" data-bs-toggle="tab" data-bs-target="#shipping" type="button" role="tab">
											<i class="ti-truck"></i>
											<span>Livraison & Retour</span>
										</button>
									</div>
								</nav>
								
								<div class="tab-content" id="productTabContent">
									<!-- Description Tab -->
									<div class="tab-pane fade show active" id="description" role="tabpanel">
										<div class="tab-content-inner">
											<h3>Description du Produit</h3>
											<div class="product-description-content">
												{!! $product_detail->description !!}
											</div>
											
											@if($product_detail->additional_info)
												<div class="additional-info">
													<h4>Informations Complémentaires</h4>
													{!! $product_detail->additional_info !!}
												</div>
											@endif
										</div>
									</div>
									<!--/ End Description Tab -->
									
									<!-- Reviews Tab -->
									<div class="tab-pane fade" id="reviews" role="tabpanel">
										<div class="tab-content-inner">
											<div class="reviews-container">
												<div class="reviews-header">
													<h3>Avis Clients</h3>
													<div class="overall-rating">
														<div class="rating-number">{{number_format($product_detail->getReview->avg('rate'),1)}}/5</div>
														<div class="stars">
															@for($i=1; $i<=5; $i++)
																@if($rate>=$i)
																	<i class="ti-star filled"></i>
																@else 
																	<i class="ti-star"></i>
																@endif
															@endfor
														</div>
														<span class="total-reviews">Basé sur {{$product_detail['getReview']->count()}} avis</span>
													</div>
												</div>
												
												@if($product_detail['getReview']->count() > 0)
													<div class="reviews-list">
														@foreach($product_detail['getReview'] as $data)
															<div class="review-item">
																<div class="review-header">
																	<div class="reviewer-info">
																		@if($data->user_info['photo'])
																			<img src="{{$data->user_info['photo']}}" alt="{{$data->user_info['name']}}" class="reviewer-avatar">
																		@else 
																			<img src="{{asset('backend/img/avatar.png')}}" alt="Avatar" class="reviewer-avatar">
																		@endif
																		<div class="reviewer-details">
																			<h5>{{$data->user_info['name']}}</h5>
																			<div class="review-date">
																				{{$data->created_at->format('d/m/Y')}}
																			</div>
																		</div>
																	</div>
																	<div class="review-rating">
																		<div class="stars">
																			@for($i=1; $i<=5; $i++)
																				@if($data->rate>=$i)
																					<i class="ti-star filled"></i>
																				@else 
																					<i class="ti-star"></i>
																				@endif
																			@endfor
																		</div>
																	</div>
																</div>
																<div class="review-content">
																	<p>{{$data->review}}</p>
																</div>
															</div>
														@endforeach
													</div>
												@else
													<div class="no-reviews">
														<i class="ti-comment-alt"></i>
														<h4>Aucun avis pour le moment</h4>
														<p>Soyez le premier à laisser un avis sur ce produit</p>
													</div>
												@endif
												
												<!-- Add Review Form -->
												<div class="add-review-form">
													<h4>Ajouter un Avis</h4>
													<p>Votre adresse email ne sera pas publiée. Les champs obligatoires sont indiqués avec *</p>
													
													@auth
													<form class="review-form" method="post" action="{{route('review.store',$product_detail->slug)}}">
														@csrf
														<div class="form-group">
															<label>Votre Note *</label>
															<div class="rating-input">
																<div class="star-rating-modern">
																	<input type="radio" id="star5" name="rate" value="5">
																	<label for="star5" title="Excellent">
																		<i class="ti-star"></i>
																	</label>
																	<input type="radio" id="star4" name="rate" value="4">
																	<label for="star4" title="Très bon">
																		<i class="ti-star"></i>
																	</label>
																	<input type="radio" id="star3" name="rate" value="3">
																	<label for="star3" title="Bon">
																		<i class="ti-star"></i>
																	</label>
																	<input type="radio" id="star2" name="rate" value="2">
																	<label for="star2" title="Moyen">
																		<i class="ti-star"></i>
																	</label>
																	<input type="radio" id="star1" name="rate" value="1">
																	<label for="star1" title="Mauvais">
																		<i class="ti-star"></i>
																	</label>
																</div>
																@error('rate')
																	<span class="error-message">{{$message}}</span>
																@enderror
															</div>
														</div>
														
														<div class="form-group">
															<label for="review">Votre Avis *</label>
															<textarea name="review" id="review" rows="5" placeholder="Partagez votre expérience avec ce produit..."></textarea>
															@error('review')
																<span class="error-message">{{$message}}</span>
															@enderror
														</div>
														
														<button type="submit" class="btn-submit-review">
															<i class="ti-check"></i>
															<span>Soumettre l'avis</span>
														</button>
													</form>
													@else
													<div class="login-required">
														<p>Vous devez être connecté pour laisser un avis.</p>
														<div class="auth-buttons">
															<a href="{{route('login.form')}}" class="btn-login">
																<i class="ti-user"></i>
																<span>Se Connecter</span>
															</a>
															<a href="{{route('register.form')}}" class="btn-register">
																<i class="ti-plus"></i>
																<span>S'inscrire</span>
															</a>
														</div>
													</div>
													@endauth
												</div>
												<!--/ End Add Review Form -->
											</div>
										</div>
									</div>
									<!--/ End Reviews Tab -->
									
									<!-- Shipping Tab -->
									<div class="tab-pane fade" id="shipping" role="tabpanel">
										<div class="tab-content-inner">
											<h3>Livraison & Retour</h3>
											<div class="shipping-info">
												<div class="shipping-item">
													<div class="shipping-icon">
														<i class="ti-truck"></i>
													</div>
													<div class="shipping-content">
														<h4>Livraison</h4>
														<ul>
															<li>Livraison standard : 3-5 jours ouvrables</li>
															<li>Livraison express : 24-48 heures</li>
															<li>Livraison gratuite à partir de 200 {{Helper::base_currency()}}</li>
															<li>Suivi de commande disponible</li>
														</ul>
													</div>
												</div>
												
												<div class="shipping-item">
													<div class="shipping-icon">
														<i class="ti-reload"></i>
													</div>
													<div class="shipping-content">
														<h4>Retour & Échange</h4>
														<ul>
															<li>Politique de retour de 14 jours</li>
															<li>Produits non ouverts et non utilisés uniquement</li>
															<li>Frais de retour à la charge du client</li>
															<li>Remboursement sous 5-7 jours ouvrables</li>
														</ul>
													</div>
												</div>
												
												<div class="shipping-item">
													<div class="shipping-icon">
														<i class="ti-headphone-alt"></i>
													</div>
													<div class="shipping-content">
														<h4>Assistance Client</h4>
														<ul>
															<li>Service client disponible du lundi au vendredi (9h-18h)</li>
															<li>Téléphone : +216 XX XXX XXX</li>
															<li>Email : support@khayrat.tn</li>
															<li>Chat en ligne disponible</li>
														</ul>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!--/ End Shipping Tab -->
								</div>
							</div>
							<!--/ End Product Tabs -->
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--/ End Product Detail -->
		
		<!-- Related Products -->
		<section class="related-products-section">
			<div class="container">
				<div class="section-header">
					<h2>Produits Similaires</h2>
					<p>Découvrez d'autres produits qui pourraient vous intéresser</p>
				</div>
				
				<div class="related-products-slider">
					<div class="swiper relatedSwiper">
						<div class="swiper-wrapper">
							@foreach($product_detail->rel_prods as $data)
								@if($data->id !== $product_detail->id)
									<div class="swiper-slide">
										<div class="related-product-card">
											<div class="product-badges">
												@if($data->discount > 0)
													<span class="badge discount">-{{$data->discount}}%</span>
												@endif
												@if($data->condition == 'new')
													<span class="badge new">Nouveau</span>
												@endif
											</div>
											
											<div class="product-image">
												<a href="{{route('product-detail',$data->slug)}}">
													@php 
														$photo=explode(',',$data->photo);
													@endphp
													<img src="{{$photo[0]}}" alt="{{$data->title}}">
												</a>
												<div class="product-overlay">
													<a href="{{route('add-to-cart',$data->slug)}}" class="btn-quick-add">
														<i class="ti-shopping-cart"></i>
													</a>
												</div>
											</div>
											
											<div class="product-info">
												<h3 class="product-title">
													<a href="{{route('product-detail',$data->slug)}}">{{$data->title}}</a>
												</h3>
												
												<div class="product-rating">
													@php
														$rate=DB::table('product_reviews')->where('product_id',$data->id)->avg('rate');
														$rate_count=DB::table('product_reviews')->where('product_id',$data->id)->count();
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
														$after_discount=($data->price-(($data->discount*$data->price)/100));
													@endphp
													<span class="current-price">{{number_format($after_discount,2)}} {{Helper::base_currency()}}</span>
													@if($data->discount > 0)
														<span class="original-price">{{number_format($data->price,2)}} {{Helper::base_currency()}}</span>
													@endif
												</div>
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
		<!--/ End Related Products -->
@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
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
	
	/* Product Detail Section */
	.product-detail-section {
		padding: 50px 0;
		background: #fff;
	}
	
	.product-detail-modern {
		background: white;
		border-radius: 20px;
		overflow: hidden;
	}
	
	/* Product Gallery */
	.product-gallery-modern {
		padding: 30px;
	}
	
	.main-image-container {
		position: relative;
		border-radius: 16px;
		overflow: hidden;
		margin-bottom: 20px;
		box-shadow: var(--shadow);
	}
	
	.main-image {
		height: 500px;
		display: flex;
		align-items: center;
		justify-content: center;
		background: var(--light-gray);
	}
	
	.main-image img {
		max-width: 100%;
		max-height: 100%;
		object-fit: contain;
	}
	
	.product-badges {
		position: absolute;
		top: 20px;
		left: 20px;
		display: flex;
		flex-direction: column;
		gap: 8px;
		z-index: 2;
	}
	
	.badge {
		padding: 8px 16px;
		border-radius: 8px;
		font-size: 0.85rem;
		font-weight: 600;
		color: white;
	}
	
	.badge.new { background: #10b981; }
	.badge.hot { background: #ef4444; }
	.badge.discount { background: #f59e0b; }
	.badge.out-of-stock { background: #6b7280; }
	
	.image-thumbnails {
		display: flex;
		gap: 10px;
		flex-wrap: wrap;
		margin-bottom: 30px;
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
	
	.product-share-modern {
		display: flex;
		align-items: center;
		gap: 15px;
		padding: 20px;
		background: var(--light-gray);
		border-radius: 12px;
	}
	
	.product-share-modern span {
		font-weight: 600;
		color: var(--secondary-color);
	}
	
	.share-buttons {
		display: flex;
		gap: 10px;
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
	
	/* Product Info */
	.product-info-modern {
		padding: 30px;
		height: 100%;
		display: flex;
		flex-direction: column;
	}
	
	.product-header {
		margin-bottom: 20px;
		border-bottom: 1px solid var(--border-color);
		padding-bottom: 20px;
	}
	
	.product-title {
		font-size: 2.2rem;
		font-weight: 700;
		color: var(--secondary-color);
		margin-bottom: 15px;
		line-height: 1.3;
	}
	
	.product-meta {
		display: flex;
		justify-content: space-between;
		align-items: center;
	}
	
	.product-rating {
		display: flex;
		align-items: center;
		gap: 10px;
	}
	
	.product-rating .stars {
		display: flex;
		gap: 2px;
	}
	
	.ti-star {
		color: #cbd5e1;
		font-size: 1.1rem;
	}
	
	.ti-star.filled {
		color: #f59e0b;
	}
	
	.review-count {
		color: #64748b;
		text-decoration: none;
		font-size: 0.95rem;
	}
	
	.review-count:hover {
		color: var(--primary-color);
	}
	
	.product-sku {
		display: flex;
		align-items: center;
		gap: 5px;
		color: #64748b;
		font-size: 0.95rem;
	}
	
	.product-sku strong {
		color: var(--secondary-color);
	}
	
	/* Price Section */
	.product-price-section {
		margin-bottom: 25px;
	}
	
	.product-price-section .current-price {
		font-size: 2.5rem;
		font-weight: 700;
		color: var(--primary-color);
	}
	
	.price-details {
		display: flex;
		align-items: center;
		gap: 15px;
		margin-top: 10px;
	}
	
	.original-price {
		font-size: 1.5rem;
		color: #94a3b8;
		text-decoration: line-through;
	}
	
	.discount-percent {
		font-size: 1rem;
		background: #fef3c7;
		color: #92400e;
		padding: 6px 12px;
		border-radius: 6px;
		font-weight: 600;
	}
	
	/* Product Excerpt */
	.product-excerpt {
		margin-bottom: 25px;
		padding-bottom: 25px;
		border-bottom: 1px solid var(--border-color);
	}
	
	.product-excerpt p {
		color: #64748b;
		line-height: 1.6;
		font-size: 1.1rem;
		margin: 0;
	}
	
	/* Stock Info */
	.product-stock-info {
		display: flex;
		flex-direction: column;
		gap: 15px;
		margin-bottom: 25px;
	}
	
	.stock-status {
		display: flex;
		align-items: center;
		gap: 10px;
		font-weight: 500;
	}
	
	.stock-status.in-stock {
		color: #10b981;
	}
	
	.stock-status.out-stock {
		color: #ef4444;
	}
	
	.delivery-info {
		display: flex;
		align-items: center;
		gap: 10px;
		color: #64748b;
	}
	
	/* Product Variants */
	.product-variants {
		margin-bottom: 25px;
	}
	
	.product-variants h5 {
		font-size: 1.1rem;
		font-weight: 600;
		color: var(--secondary-color);
		margin-bottom: 15px;
	}
	
	.variant-options {
		display: flex;
		gap: 10px;
		flex-wrap: wrap;
	}
	
	.variant-btn {
		padding: 10px 20px;
		background: white;
		border: 2px solid var(--border-color);
		border-radius: 8px;
		color: var(--text-color);
		font-weight: 500;
		cursor: pointer;
		transition: var(--transition);
		min-width: 60px;
		text-align: center;
	}
	
	.variant-btn:hover,
	.variant-btn.active {
		background: var(--primary-color);
		border-color: var(--primary-color);
		color: white;
	}
	
	/* Product Form */
	.product-form-modern {
		margin-bottom: 30px;
	}
	
	.quantity-selector {
		margin-bottom: 20px;
	}
	
	.quantity-selector label {
		display: block;
		margin-bottom: 10px;
		font-weight: 600;
		color: var(--secondary-color);
	}
	
	.quantity-input-group {
		display: flex;
		align-items: center;
		gap: 10px;
		max-width: 200px;
	}
	
	.qty-btn {
		width: 45px;
		height: 45px;
		background: var(--light-gray);
		border: 2px solid var(--border-color);
		border-radius: 8px;
		color: var(--text-color);
		cursor: pointer;
		transition: var(--transition);
		display: flex;
		align-items: center;
		justify-content: center;
	}
	
	.qty-btn:hover {
		background: var(--primary-color);
		border-color: var(--primary-color);
		color: white;
	}
	
	.qty-input {
		flex: 1;
		height: 45px;
		text-align: center;
		border: 2px solid var(--border-color);
		border-radius: 8px;
		font-size: 1.1rem;
		font-weight: 500;
	}
	
	.product-actions {
		display: flex;
		gap: 15px;
	}
	
	.btn-add-to-cart,
	.btn-wishlist {
		flex: 1;
		display: flex;
		align-items: center;
		justify-content: center;
		gap: 10px;
		padding: 16px;
		border-radius: 12px;
		font-weight: 600;
		text-decoration: none;
		transition: var(--transition);
		border: none;
		cursor: pointer;
		font-size: 1rem;
	}
	
	.btn-add-to-cart {
		background: var(--primary-color);
		color: white;
	}
	
	.btn-add-to-cart:hover {
		background: var(--primary-dark);
		transform: translateY(-2px);
	}
	
	.btn-wishlist {
		background: white;
		color: var(--text-color);
		border: 2px solid var(--border-color);
	}
	
	.btn-wishlist:hover {
		border-color: var(--primary-color);
		color: var(--primary-color);
		transform: translateY(-2px);
	}
	
	/* Product Categories */
	.product-categories {
		margin-bottom: 30px;
		padding: 20px;
		background: var(--light-gray);
		border-radius: 12px;
	}
	
	.category-item {
		display: flex;
		align-items: center;
		gap: 10px;
		margin-bottom: 10px;
	}
	
	.category-item:last-child {
		margin-bottom: 0;
	}
	
	.category-item span {
		color: #64748b;
		font-weight: 500;
	}
	
	.category-link {
		color: var(--primary-color);
		text-decoration: none;
		font-weight: 600;
	}
	
	.category-link:hover {
		text-decoration: underline;
	}
	
	/* Product Features */
	.product-features {
		display: grid;
		grid-template-columns: repeat(3, 1fr);
		gap: 20px;
		margin-bottom: 30px;
	}
	
	.feature-item {
		display: flex;
		align-items: center;
		gap: 15px;
		padding: 15px;
		background: var(--light-gray);
		border-radius: 12px;
		transition: var(--transition);
	}
	
	.feature-item:hover {
		transform: translateY(-5px);
		box-shadow: var(--shadow);
	}
	
	.feature-item i {
		font-size: 1.5rem;
		color: var(--primary-color);
	}
	
	.feature-item h6 {
		font-size: 0.9rem;
		font-weight: 600;
		color: var(--secondary-color);
		margin-bottom: 4px;
	}
	
	.feature-item p {
		font-size: 0.85rem;
		color: #64748b;
		margin: 0;
	}
	
	/* Product Tabs */
	.product-tabs-modern {
		margin-top: 50px;
	}
	
	.tab-navigation {
		border-bottom: 2px solid var(--border-color);
	}
	
	.tab-navigation .nav-tabs {
		border: none;
		display: flex;
		gap: 5px;
	}
	
	.tab-navigation .nav-link {
		display: flex;
		align-items: center;
		gap: 10px;
		padding: 15px 30px;
		background: var(--light-gray);
		border: none;
		border-radius: 12px 12px 0 0;
		color: var(--text-color);
		font-weight: 500;
		transition: var(--transition);
	}
	
	.tab-navigation .nav-link:hover,
	.tab-navigation .nav-link.active {
		background: var(--primary-color);
		color: white;
	}
	
	.tab-content {
		padding: 40px 0;
	}
	
	.tab-content-inner {
		animation: fadeIn 0.5s ease;
	}
	
	@keyframes fadeIn {
		from { opacity: 0; transform: translateY(10px); }
		to { opacity: 1; transform: translateY(0); }
	}
	
	.tab-content-inner h3 {
		font-size: 1.8rem;
		color: var(--secondary-color);
		margin-bottom: 25px;
		font-weight: 600;
	}
	
	.product-description-content {
		color: #64748b;
		line-height: 1.8;
	}
	
	.product-description-content p {
		margin-bottom: 20px;
	}
	
	.product-description-content ul,
	.product-description-content ol {
		margin-bottom: 20px;
		padding-left: 20px;
	}
	
	.additional-info {
		margin-top: 40px;
		padding-top: 30px;
		border-top: 1px solid var(--border-color);
	}
	
	.additional-info h4 {
		font-size: 1.4rem;
		color: var(--secondary-color);
		margin-bottom: 20px;
		font-weight: 600;
	}
	
	/* Reviews Tab */
	.reviews-container {
		max-width: 800px;
	}
	
	.reviews-header {
		display: flex;
		justify-content: space-between;
		align-items: center;
		margin-bottom: 40px;
		padding-bottom: 20px;
		border-bottom: 1px solid var(--border-color);
	}
	
	.overall-rating {
		text-align: center;
	}
	
	.rating-number {
		font-size: 3rem;
		font-weight: 700;
		color: var(--secondary-color);
		line-height: 1;
	}
	
	.overall-rating .stars {
		display: flex;
		justify-content: center;
		gap: 5px;
		margin: 10px 0;
	}
	
	.total-reviews {
		color: #64748b;
		font-size: 0.9rem;
	}
	
	.reviews-list {
		display: flex;
		flex-direction: column;
		gap: 30px;
		margin-bottom: 50px;
	}
	
	.review-item {
		padding: 25px;
		background: var(--light-gray);
		border-radius: 12px;
	}
	
	.review-header {
		display: flex;
		justify-content: space-between;
		align-items: center;
		margin-bottom: 15px;
	}
	
	.reviewer-info {
		display: flex;
		align-items: center;
		gap: 15px;
	}
	
	.reviewer-avatar {
		width: 50px;
		height: 50px;
		border-radius: 50%;
		object-fit: cover;
	}
	
	.reviewer-details h5 {
		font-size: 1.1rem;
		color: var(--secondary-color);
		margin-bottom: 5px;
		font-weight: 600;
	}
	
	.review-date {
		color: #94a3b8;
		font-size: 0.9rem;
	}
	
	.review-rating .stars {
		display: flex;
		gap: 2px;
	}
	
	.review-content p {
		color: #64748b;
		line-height: 1.6;
		margin: 0;
	}
	
	.no-reviews {
		text-align: center;
		padding: 60px 20px;
		background: var(--light-gray);
		border-radius: 12px;
		margin-bottom: 50px;
	}
	
	.no-reviews i {
		font-size: 4rem;
		color: #cbd5e1;
		margin-bottom: 20px;
	}
	
	.no-reviews h4 {
		font-size: 1.5rem;
		color: var(--secondary-color);
		margin-bottom: 10px;
	}
	
	.no-reviews p {
		color: #64748b;
	}
	
	/* Add Review Form */
	.add-review-form {
		background: white;
		padding: 40px;
		border-radius: 16px;
		box-shadow: var(--shadow);
	}
	
	.add-review-form h4 {
		font-size: 1.5rem;
		color: var(--secondary-color);
		margin-bottom: 10px;
		font-weight: 600;
	}
	
	.add-review-form > p {
		color: #64748b;
		margin-bottom: 30px;
	}
	
	.form-group {
		margin-bottom: 25px;
	}
	
	.form-group label {
		display: block;
		margin-bottom: 10px;
		font-weight: 600;
		color: var(--secondary-color);
	}
	
	.rating-input .star-rating-modern {
		display: flex;
		flex-direction: row-reverse;
		justify-content: flex-end;
	}
	
	.star-rating-modern input {
		display: none;
	}
	
	.star-rating-modern label {
		font-size: 2rem;
		color: #cbd5e1;
		cursor: pointer;
		transition: var(--transition);
		margin-right: 5px;
		margin-bottom: 0;
	}
	
	.star-rating-modern label:hover,
	.star-rating-modern label:hover ~ label,
	.star-rating-modern input:checked ~ label {
		color: #f59e0b;
	}
	
	.error-message {
		display: block;
		margin-top: 8px;
		color: #ef4444;
		font-size: 0.9rem;
	}
	
	.form-group textarea {
		width: 100%;
		padding: 15px;
		border: 2px solid var(--border-color);
		border-radius: 8px;
		font-family: inherit;
		font-size: 1rem;
		transition: var(--transition);
		resize: vertical;
	}
	
	.form-group textarea:focus {
		outline: none;
		border-color: var(--primary-color);
	}
	
	.btn-submit-review {
		display: flex;
		align-items: center;
		gap: 10px;
		padding: 15px 30px;
		background: var(--primary-color);
		color: white;
		border: none;
		border-radius: 8px;
		font-weight: 600;
		cursor: pointer;
		transition: var(--transition);
	}
	
	.btn-submit-review:hover {
		background: var(--primary-dark);
		transform: translateY(-2px);
	}
	
	.login-required {
		text-align: center;
		padding: 40px;
		background: var(--light-gray);
		border-radius: 12px;
	}
	
	.login-required p {
		color: #64748b;
		margin-bottom: 25px;
		font-size: 1.1rem;
	}
	
	.auth-buttons {
		display: flex;
		justify-content: center;
		gap: 15px;
	}
	
	.btn-login,
	.btn-register {
		display: flex;
		align-items: center;
		gap: 8px;
		padding: 12px 24px;
		border-radius: 8px;
		font-weight: 600;
		text-decoration: none;
		transition: var(--transition);
	}
	
	.btn-login {
		background: var(--primary-color);
		color: white;
	}
	
	.btn-register {
		background: white;
		color: var(--primary-color);
		border: 2px solid var(--primary-color);
	}
	
	.btn-login:hover,
	.btn-register:hover {
		transform: translateY(-2px);
	}
	
	/* Shipping Tab */
	.shipping-info {
		display: flex;
		flex-direction: column;
		gap: 30px;
	}
	
	.shipping-item {
		display: flex;
		gap: 20px;
		padding: 25px;
		background: var(--light-gray);
		border-radius: 12px;
	}
	
	.shipping-icon {
		flex-shrink: 0;
		width: 60px;
		height: 60px;
		background: var(--primary-color);
		border-radius: 12px;
		display: flex;
		align-items: center;
		justify-content: center;
		color: white;
		font-size: 1.5rem;
	}
	
	.shipping-content h4 {
		font-size: 1.3rem;
		color: var(--secondary-color);
		margin-bottom: 15px;
		font-weight: 600;
	}
	
	.shipping-content ul {
		list-style: none;
		padding: 0;
		margin: 0;
	}
	
	.shipping-content li {
		padding: 8px 0;
		color: #64748b;
		position: relative;
		padding-left: 20px;
	}
	
	.shipping-content li:before {
		content: "•";
		color: var(--primary-color);
		font-weight: bold;
		position: absolute;
		left: 0;
	}
	
	/* Related Products */
	.related-products-section {
		padding: 80px 0;
		background: var(--light-gray);
	}
	
	.section-header {
		text-align: center;
		margin-bottom: 50px;
	}
	
	.section-header h2 {
		font-size: 2.5rem;
		color: var(--secondary-color);
		margin-bottom: 12px;
		font-weight: 700;
	}
	
	.section-header p {
		color: #64748b;
		font-size: 1.1rem;
		line-height: 1.6;
	}
	
	.related-products-slider {
		position: relative;
		padding: 0 50px;
	}
	
	.relatedSwiper {
		padding: 20px 0;
	}
	
	.related-product-card {
		background: white;
		border-radius: 16px;
		overflow: hidden;
		box-shadow: var(--shadow);
		transition: var(--transition);
		height: 100%;
	}
	
	.related-product-card:hover {
		transform: translateY(-10px);
		box-shadow: var(--shadow-hover);
	}
	
	.related-product-card .product-badges {
		position: absolute;
		top: 15px;
		left: 15px;
	}
	
	.related-product-card .product-image {
		position: relative;
		height: 200px;
		overflow: hidden;
	}
	
	.related-product-card .product-image img {
		width: 100%;
		height: 100%;
		object-fit: cover;
		transition: transform 0.5s ease;
	}
	
	.related-product-card:hover .product-image img {
		transform: scale(1.05);
	}
	
	.product-overlay {
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
	
	.related-product-card:hover .product-overlay {
		opacity: 1;
	}
	
	.btn-quick-add {
		width: 50px;
		height: 50px;
		background: var(--primary-color);
		border-radius: 50%;
		display: flex;
		align-items: center;
		justify-content: center;
		color: white;
		text-decoration: none;
		transition: var(--transition);
	}
	
	.btn-quick-add:hover {
		background: var(--primary-dark);
		transform: scale(1.1);
	}
	
	.related-product-card .product-info {
		padding: 20px;
	}
	
	.related-product-card .product-title {
		font-size: 1.1rem;
		margin-bottom: 10px;
	}
	
	.related-product-card .product-title a {
		color: var(--secondary-color);
		text-decoration: none;
	}
	
	.related-product-card .product-title a:hover {
		color: var(--primary-color);
	}
	
	.related-product-card .product-rating {
		display: flex;
		align-items: center;
		gap: 8px;
		margin-bottom: 10px;
	}
	
	.related-product-card .product-price {
		display: flex;
		align-items: center;
		gap: 10px;
	}
	
	.related-product-card .current-price {
		font-size: 1.2rem;
		font-weight: 700;
		color: var(--primary-color);
	}
	
	.related-product-card .original-price {
		font-size: 1rem;
		color: #94a3b8;
		text-decoration: line-through;
	}
	
	/* Swiper Navigation */
	.swiper-button-next,
	.swiper-button-prev {
		color: var(--primary-color);
		background: white;
		width: 50px;
		height: 50px;
		border-radius: 50%;
		box-shadow: var(--shadow);
		transition: var(--transition);
	}
	
	.swiper-button-next:hover,
	.swiper-button-prev:hover {
		background: var(--primary-color);
		color: white;
	}
	
	.swiper-button-next:after,
	.swiper-button-prev:after {
		font-size: 1.2rem;
	}
	
	/* Responsive Design */
	@media (max-width: 1200px) {
		.main-image {
			height: 400px;
		}
		
		.product-title {
			font-size: 1.8rem;
		}
		
		.product-price-section .current-price {
			font-size: 2rem;
		}
	}
	
	@media (max-width: 992px) {
		.main-image {
			height: 350px;
		}
		
		.product-features {
			grid-template-columns: repeat(2, 1fr);
		}
		
		.reviews-header {
			flex-direction: column;
			align-items: flex-start;
			gap: 20px;
		}
		
		.overall-rating {
			text-align: left;
		}
		
		.tab-navigation .nav-link {
			padding: 12px 20px;
			font-size: 0.9rem;
		}
		
		.related-products-slider {
			padding: 0 30px;
		}
	}
	
	@media (max-width: 768px) {
		.product-detail-modern .row > div {
			padding: 15px;
		}
		
		.main-image {
			height: 300px;
		}
		
		.product-title {
			font-size: 1.5rem;
		}
		
		.product-actions {
			flex-direction: column;
		}
		
		.product-features {
			grid-template-columns: 1fr;
		}
		
		.tab-navigation .nav-tabs {
			flex-direction: column;
		}
		
		.tab-navigation .nav-link {
			border-radius: 8px;
			margin-bottom: 5px;
		}
		
		.add-review-form {
			padding: 25px;
		}
		
		.auth-buttons {
			flex-direction: column;
		}
		
		.related-products-slider {
			padding: 0 15px;
		}
		
		.swiper-button-next,
		.swiper-button-prev {
			display: none;
		}
	}
	
	@media (max-width: 576px) {
		.main-image {
			height: 250px;
		}
		
		.product-title {
			font-size: 1.3rem;
		}
		
		.product-price-section .current-price {
			font-size: 1.8rem;
		}
		
		.original-price {
			font-size: 1.2rem;
		}
		
		.variant-options {
			justify-content: center;
		}
		
		.quantity-input-group {
			max-width: 100%;
		}
		
		.shipping-item {
			flex-direction: column;
			text-align: center;
		}
		
		.shipping-icon {
			margin: 0 auto;
		}
		
		.section-header h2 {
			font-size: 2rem;
		}
	}
	
	@media (max-width: 480px) {
		.product-gallery-modern,
		.product-info-modern {
			padding: 15px;
		}
		
		.image-thumbnails {
			justify-content: center;
		}
		
		.thumb-item {
			width: 60px;
			height: 60px;
		}
		
		.tab-content {
			padding: 20px 0;
		}
		
		.review-header {
			flex-direction: column;
			align-items: flex-start;
			gap: 15px;
		}
	}
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script>
	document.addEventListener('DOMContentLoaded', function() {
		// Initialize Swiper for related products
		const relatedSwiper = new Swiper('.relatedSwiper', {
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
		
		// Image thumbnails functionality
		const thumbItems = document.querySelectorAll('.thumb-item');
		const mainImage = document.getElementById('main-product-image');
		
		thumbItems.forEach(thumb => {
			thumb.addEventListener('click', function() {
				const imageSrc = this.getAttribute('data-image');
				if (mainImage && imageSrc) {
					mainImage.src = imageSrc;
					
					// Update active state
					thumbItems.forEach(item => item.classList.remove('active'));
					this.classList.add('active');
				}
			});
		});
		
		// Size selection
		const sizeBtns = document.querySelectorAll('.size-btn');
		const selectedSizeInput = document.getElementById('selected-size');
		
		sizeBtns.forEach(btn => {
			btn.addEventListener('click', function() {
				const size = this.getAttribute('data-value');
				sizeBtns.forEach(b => b.classList.remove('active'));
				this.classList.add('active');
				selectedSizeInput.value = size;
			});
		});
		
		// Quantity controls
		const minusBtn = document.querySelector('.qty-btn.minus');
		const plusBtn = document.querySelector('.qty-btn.plus');
		const qtyInput = document.querySelector('.qty-input');
		
		if (minusBtn && plusBtn && qtyInput) {
			minusBtn.addEventListener('click', function() {
				let value = parseInt(qtyInput.value);
				if (value > 1) {
					qtyInput.value = value - 1;
				}
			});
			
			plusBtn.addEventListener('click', function() {
				let value = parseInt(qtyInput.value);
				if (value < parseInt(qtyInput.max)) {
					qtyInput.value = value + 1;
				}
			});
		}
		
		// Add to cart animation
		const addToCartBtn = document.getElementById('add-to-cart-btn');
		if (addToCartBtn) {
			addToCartBtn.addEventListener('click', function(e) {
				// Only show animation if form is valid
				if (this.closest('form').checkValidity()) {
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
					}, 1000);
				}
			});
		}
		
		// Wishlist button animation
		const wishlistBtn = document.querySelector('.btn-wishlist');
		if (wishlistBtn) {
			wishlistBtn.addEventListener('click', function(e) {
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
		}
		
		// Star rating for review form
		const starInputs = document.querySelectorAll('.star-rating-modern input');
		starInputs.forEach(input => {
			input.addEventListener('change', function() {
				const selectedValue = this.value;
				// Optional: You can add visual feedback here
			});
		});
		
		// Bootstrap 5 Tab functionality (fallback if Bootstrap 4 is used)
		const tabButtons = document.querySelectorAll('[data-bs-toggle="tab"]');
		tabButtons.forEach(button => {
			button.addEventListener('click', function(e) {
				e.preventDefault();
				const target = this.getAttribute('data-bs-target');
				
				// Remove active class from all buttons and content
				document.querySelectorAll('.nav-link').forEach(link => {
					link.classList.remove('active');
				});
				document.querySelectorAll('.tab-pane').forEach(pane => {
					pane.classList.remove('show', 'active');
				});
				
				// Add active class to clicked button and target content
				this.classList.add('active');
				document.querySelector(target).classList.add('show', 'active');
			});
		});
		
		// Review form submission
		const reviewForm = document.querySelector('.review-form');
		if (reviewForm) {
			reviewForm.addEventListener('submit', function(e) {
				const rating = this.querySelector('input[name="rate"]:checked');
				if (!rating) {
					e.preventDefault();
					alert('Veuillez sélectionner une note avant de soumettre votre avis.');
					return false;
				}
			});
		}
		
		// Share buttons functionality
		function shareOnFacebook() {
			const url = encodeURIComponent(window.location.href);
			const title = encodeURIComponent(document.title);
			window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank');
		}
		
		function shareOnTwitter() {
			const url = encodeURIComponent(window.location.href);
			const text = encodeURIComponent(document.title);
			window.open(`https://twitter.com/intent/tweet?url=${url}&text=${text}`, '_blank');
		}
		
		function shareOnPinterest() {
			const url = encodeURIComponent(window.location.href);
			const media = encodeURIComponent('{{$product_detail->photo}}');
			const description = encodeURIComponent(document.title);
			window.open(`https://pinterest.com/pin/create/button/?url=${url}&media=${media}&description=${description}`, '_blank');
		}
		
		function shareOnLinkedIn() {
			const url = encodeURIComponent(window.location.href);
			const title = encodeURIComponent(document.title);
			window.open(`https://www.linkedin.com/shareArticle?mini=true&url=${url}&title=${title}`, '_blank');
		}
		
		// Assign share functions to buttons
		document.querySelectorAll('.share-btn').forEach(btn => {
			btn.addEventListener('click', function(e) {
				e.preventDefault();
			});
		});
		
		// Scroll to reviews when clicking on review count
		const reviewCountLink = document.querySelector('.review-count');
		if (reviewCountLink) {
			reviewCountLink.addEventListener('click', function(e) {
				e.preventDefault();
				const reviewsTab = document.querySelector('#reviews-tab');
				if (reviewsTab) {
					// Activate reviews tab
					document.querySelectorAll('.nav-link').forEach(link => {
						link.classList.remove('active');
					});
					document.querySelectorAll('.tab-pane').forEach(pane => {
						pane.classList.remove('show', 'active');
					});
					
					reviewsTab.classList.add('active');
					document.querySelector('#reviews').classList.add('show', 'active');
					
					// Scroll to reviews section
					document.querySelector('#reviews').scrollIntoView({
						behavior: 'smooth',
						block: 'start'
					});
				}
			});
		}
		
		// Stock warning
		const stockElement = document.querySelector('.stock-status.out-stock');
		if (stockElement) {
			// Disable add to cart button if out of stock
			if (addToCartBtn) {
				addToCartBtn.disabled = true;
				addToCartBtn.style.opacity = '0.5';
				addToCartBtn.style.cursor = 'not-allowed';
			}
		}
		
		// Image zoom on hover (optional)
		const mainImageContainer = document.querySelector('.main-image');
		if (mainImageContainer && mainImage) {
			mainImageContainer.addEventListener('mouseenter', function() {
				mainImage.style.transform = 'scale(1.05)';
				mainImage.style.transition = 'transform 0.3s ease';
			});
			
			mainImageContainer.addEventListener('mouseleave', function() {
				mainImage.style.transform = 'scale(1)';
			});
		}
		
		// Related product quick add to cart
		const quickAddBtns = document.querySelectorAll('.btn-quick-add');
		quickAddBtns.forEach(btn => {
			btn.addEventListener('click', function(e) {
				if (!this.href) return;
				
				e.preventDefault();
				const originalHtml = this.innerHTML;
				
				// Show loading animation
				this.innerHTML = '<i class="ti-check"></i>';
				this.style.background = '#10b981';
				
				// Redirect after animation
				setTimeout(() => {
					window.location.href = this.href;
				}, 500);
			});
		});
	});
</script>
@endpush
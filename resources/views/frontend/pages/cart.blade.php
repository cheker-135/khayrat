@extends('frontend.layouts.master')
@section('title','Panier')
@section('main-content')
	<!-- Breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bread-inner">
						<ul class="bread-list">
							<li><a href="{{route('home')}}">Accueil<i class="ti-arrow-right"></i></a></li>
							<li class="active"><a href="">Panier</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->

	<!-- Shopping Cart -->
	<div class="shopping-cart section">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<!-- Shopping Summery -->
					<div class="cart-table">
						<table class="table">
							<thead>
								<tr class="main-hading">
									<th class="product-col">PRODUIT</th>
									<th class="name-col">NOM</th>
									<th class="price-col text-center">PRIX UNITAIRE</th>
									<th class="quantity-col text-center">QUANTITÉ</th>
									<th class="total-col text-center">TOTAL</th>
									<th class="action-col text-center"><i class="ti-trash remove-icon"></i></th>
								</tr>
							</thead>
							<tbody id="cart_item_list">
								<form action="{{route('cart.update')}}" method="POST">
									@csrf
									@if(Helper::getAllProductFromCart())
										@foreach(Helper::getAllProductFromCart() as $key=>$cart)
											<tr>
												@php
												$photo=explode(',',$cart->product['photo']);
												@endphp
												<td class="product-image">
													<img src="{{$photo[0]}}" alt="{{$photo[0]}}">
												</td>
												<td class="product-info">
													<p class="product-name"><a href="{{route('product-detail',$cart->product['slug'])}}" target="_blank">{{$cart->product['title']}}</a></p>
													<p class="product-description">{!!($cart['summary']) !!}</p>
												</td>
												<td class="unit-price"><span>{{number_format($cart['price'],2)}} DT</span></td>
												<td class="quantity">
													<!-- Input Order -->
													<div class="quantity-control">
														<button type="button" class="quantity-btn minus" data-type="minus" data-field="quant[{{$key}}]">
															<i class="ti-minus"></i>
														</button>
														<input type="text" name="quant[{{$key}}]" class="quantity-input" data-min="1" data-max="100" value="{{$cart->quantity}}">
														<input type="hidden" name="qty_id[]" value="{{$cart->id}}">
														<button type="button" class="quantity-btn plus" data-type="plus" data-field="quant[{{$key}}]">
															<i class="ti-plus"></i>
														</button>
													</div>
													<!--/ End Input Order -->
												</td>
												<td class="total-price"><span>{{$cart['amount']}} DT</span></td>
												<td class="remove">
													<a href="{{route('cart-delete',$cart->id)}}" class="remove-btn">
														<i class="ti-trash"></i>
													</a>
												</td>
											</tr>
										@endforeach
										<tr class="update-row">
											<td colspan="5"></td>
											<td class="text-end">
												<button class="btn-update-cart" type="submit">
													<i class="ti-reload"></i>
													<span>Mettre à jour</span>
												</button>
											</td>
										</tr>
									@else
										<tr>
											<td colspan="6">
												<div class="empty-cart">
													<div class="empty-cart-icon">
														<i class="ti-shopping-cart"></i>
													</div>
													<h4>Votre panier est vide</h4>
													<p>Ajoutez des produits à votre panier pour commencer vos achats</p>
													<a href="{{route('product-grids')}}" class="btn-shop-now">
														<i class="ti-shopping-cart-full"></i>
														<span>Commencer mes achats</span>
													</a>
												</div>
											</td>
										</tr>
									@endif
								</form>
							</tbody>
						</table>
					</div>
					<!--/ End Shopping Summery -->
				</div>
			</div>
			
			@if(Helper::getAllProductFromCart())
			<div class="row">
				<div class="col-lg-8 col-md-7 col-12">
					<div class="cart-actions">
						<div class="coupon-card">
							<h4><i class="ti-ticket"></i> Appliquer un coupon</h4>
							<form action="{{route('coupon-store')}}" method="POST" class="coupon-form">
								@csrf
								<div class="input-group">
									<input type="text" name="code" placeholder="Entrez votre code promo" required>
									<button type="submit" class="btn-apply">
										<i class="ti-check"></i>
										<span>Appliquer</span>
									</button>
								</div>
							</form>
						</div>
						
						<div class="continue-shopping">
							<a href="{{route('product-grids')}}" class="btn-continue">
								<i class="ti-arrow-left"></i>
								<span>Continuer mes achats</span>
							</a>
						</div>
					</div>
				</div>
				
				<div class="col-lg-4 col-md-5 col-12">
					<div class="cart-summary">
						<h4>Récapitulatif du panier</h4>
						
						<div class="summary-details">
							<div class="summary-item">
								<span>Sous-total</span>
								<strong class="cart-subtotal">{{number_format(Helper::totalCartPrice(),2)}} DT</strong>
							</div>
							
							@if(session()->has('coupon'))
							<div class="summary-item discount">
								<span>Économies coupon</span>
								<strong>-{{number_format(Session::get('coupon')['value'],2)}} DT</strong>
							</div>
							@endif
							
							@php
								$total_amount=Helper::totalCartPrice();
								if(session()->has('coupon')){
									$total_amount=$total_amount-Session::get('coupon')['value'];
								}
							@endphp
							
							<div class="summary-total">
								<span>Total</span>
								<strong class="order-total">{{number_format($total_amount,2)}} DT</strong>
							</div>
						</div>
						
						<div class="summary-note">
							<p><i class="ti-info-alt"></i> Les taxes et frais de livraison seront calculés lors du paiement</p>
						</div>
						
						<div class="summary-actions">
							<a href="{{route('checkout')}}" class="btn-checkout">
								<i class="ti-credit-card"></i>
								<span>Passer à la caisse</span>
							</a>
						</div>
					</div>
				</div>
			</div>
			@endif
		</div>
	</div>
	<!--/ End Shopping Cart -->

	<!-- Services Section -->
	<section class="services-section section">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section-header">
						<h2>Pourquoi choisir KHAYRAT ?</h2>
						<p>Nous nous engageons à vous offrir la meilleure expérience d'achat</p>
					</div>
				</div>
			</div>
			
			<div class="row services-grid">
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="service-card">
						<div class="service-icon">
							<i class="ti-rocket"></i>
						</div>
						<div class="service-content">
							<h4>Livraison gratuite</h4>
							<p>Pour toute commande supérieure à 300 DT</p>
						</div>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="service-card">
						<div class="service-icon">
							<i class="ti-reload"></i>
						</div>
						<div class="service-content">
							<h4>Retour gratuit</h4>
							<p>Retours acceptés sous 30 jours</p>
						</div>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="service-card">
						<div class="service-icon">
							<i class="ti-lock"></i>
						</div>
						<div class="service-content">
							<h4>Paiement sécurisé</h4>
							<p>100% sécurisé avec cryptage SSL</p>
						</div>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="service-card">
						<div class="service-icon">
							<i class="ti-headphone-alt"></i>
						</div>
						<div class="service-content">
							<h4>Support 24/7</h4>
							<p>Assistance clientèle dédiée</p>
						</div>
					</div>
					<!-- End Single Service -->
				</div>
			</div>
		</div>
	</section>
	<!-- End Services Section -->

	<!-- Newsletter -->
	@include('frontend.layouts.newsletter')
	<!-- End Newsletter -->
@endsection

@push('styles')
<style>
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
	
	/* Shopping Cart Section */
	.shopping-cart {
		padding: 60px 0;
		background: #fff;
	}
	
	/* Cart Table */
	.cart-table {
		background: white;
		border-radius: 20px;
		box-shadow: var(--shadow);
		overflow: hidden;
		margin-bottom: 40px;
	}
	
	.cart-table table {
		width: 100%;
		border-collapse: collapse;
		margin: 0;
	}
	
	.cart-table thead {
		background: var(--light-gray);
	}
	
	.cart-table th {
		padding: 25px 20px;
		text-align: left;
		font-weight: 600;
		color: var(--secondary-color);
		border-bottom: 2px solid var(--border-color);
		font-size: 1rem;
	}
	
	.cart-table td {
		padding: 25px 20px;
		border-bottom: 1px solid var(--border-color);
		vertical-align: middle;
	}
	
	.cart-table tbody tr:last-child td {
		border-bottom: none;
	}
	
	/* Product Image */
	.product-image img {
		width: 80px;
		height: 80px;
		border-radius: 12px;
		object-fit: cover;
		box-shadow: var(--shadow);
	}
	
	/* Product Info */
	.product-info {
		max-width: 300px;
	}
	
	.product-name {
		font-size: 1.1rem;
		color: var(--secondary-color);
		font-weight: 600;
		margin-bottom: 8px;
	}
	
	.product-name a {
		color: var(--secondary-color);
		text-decoration: none;
		transition: var(--transition);
	}
	
	.product-name a:hover {
		color: var(--primary-color);
	}
	
	.product-description {
		color: #64748b;
		font-size: 0.9rem;
		line-height: 1.5;
		margin: 0;
		display: -webkit-box;
		-webkit-line-clamp: 2;
		-webkit-box-orient: vertical;
		overflow: hidden;
	}
	
	/* Unit Price */
	.unit-price span {
		font-size: 1.1rem;
		font-weight: 600;
		color: var(--primary-color);
	}
	
	/* Quantity Control */
	.quantity-control {
		display: flex;
		align-items: center;
		justify-content: center;
		max-width: 150px;
		margin: 0 auto;
	}
	
	.quantity-btn {
		width: 40px;
		height: 40px;
		border: 1px solid var(--border-color);
		background: white;
		color: var(--text-color);
		display: flex;
		align-items: center;
		justify-content: center;
		cursor: pointer;
		transition: var(--transition);
		font-size: 0.8rem;
	}
	
	.quantity-btn.minus {
		border-radius: 8px 0 0 8px;
	}
	
	.quantity-btn.plus {
		border-radius: 0 8px 8px 0;
	}
	
	.quantity-btn:hover {
		background: var(--primary-color);
		color: white;
		border-color: var(--primary-color);
	}
	
	.quantity-input {
		width: 60px;
		height: 40px;
		border: 1px solid var(--border-color);
		border-left: none;
		border-right: none;
		text-align: center;
		font-size: 1rem;
		color: var(--text-color);
		background: white;
	}
	
	.quantity-input:focus {
		outline: none;
		border-color: var(--primary-color);
	}
	
	/* Total Price */
	.total-price span {
		font-size: 1.2rem;
		font-weight: 700;
		color: var(--secondary-color);
	}
	
	/* Remove Button */
	.remove-btn {
		display: inline-flex;
		align-items: center;
		justify-content: center;
		width: 40px;
		height: 40px;
		background: #fee2e2;
		color: #dc2626;
		border-radius: 8px;
		text-decoration: none;
		transition: var(--transition);
	}
	
	.remove-btn:hover {
		background: #dc2626;
		color: white;
		transform: scale(1.1);
	}
	
	/* Empty Cart */
	.empty-cart {
		padding: 60px 40px;
		text-align: center;
	}
	
	.empty-cart-icon {
		width: 100px;
		height: 100px;
		background: var(--light-gray);
		border-radius: 50%;
		display: flex;
		align-items: center;
		justify-content: center;
		margin: 0 auto 25px;
		color: #cbd5e1;
		font-size: 2.5rem;
	}
	
	.empty-cart h4 {
		font-size: 1.8rem;
		color: var(--secondary-color);
		margin-bottom: 15px;
		font-weight: 600;
	}
	
	.empty-cart p {
		color: #64748b;
		font-size: 1.1rem;
		margin-bottom: 30px;
		max-width: 400px;
		margin-left: auto;
		margin-right: auto;
		line-height: 1.6;
	}
	
	.btn-shop-now {
		display: inline-flex;
		align-items: center;
		justify-content: center;
		gap: 10px;
		padding: 16px 35px;
		background: var(--primary-color);
		color: white;
		border-radius: 12px;
		text-decoration: none;
		font-weight: 600;
		transition: var(--transition);
		border: none;
		cursor: pointer;
		font-size: 1rem;
	}
	
	.btn-shop-now:hover {
		background: var(--primary-dark);
		transform: translateY(-2px);
		box-shadow: var(--shadow-hover);
	}
	
	/* Update Button */
	.update-row {
		background: var(--light-gray);
	}
	
	.btn-update-cart {
		display: inline-flex;
		align-items: center;
		justify-content: center;
		gap: 10px;
		padding: 12px 25px;
		background: white;
		color: var(--primary-color);
		border: 2px solid var(--primary-color);
		border-radius: 12px;
		font-weight: 600;
		transition: var(--transition);
		cursor: pointer;
		font-size: 0.95rem;
	}
	
	.btn-update-cart:hover {
		background: var(--primary-color);
		color: white;
		transform: translateY(-2px);
	}
	
	.text-end {
		text-align: right !important;
	}
	
	/* Cart Actions */
	.cart-actions {
		display: flex;
		flex-direction: column;
		gap: 25px;
	}
	
	.coupon-card {
		background: white;
		border-radius: 16px;
		padding: 30px;
		box-shadow: var(--shadow);
	}
	
	.coupon-card h4 {
		font-size: 1.3rem;
		color: var(--secondary-color);
		margin-bottom: 20px;
		font-weight: 600;
		display: flex;
		align-items: center;
		gap: 10px;
	}
	
	.coupon-card h4 i {
		color: var(--primary-color);
	}
	
	.coupon-form .input-group {
		display: flex;
		gap: 10px;
	}
	
	.coupon-form input {
		flex: 1;
		padding: 15px 20px;
		border: 2px solid var(--border-color);
		border-radius: 12px;
		font-size: 1rem;
		color: var(--text-color);
		transition: var(--transition);
	}
	
	.coupon-form input:focus {
		outline: none;
		border-color: var(--primary-color);
	}
	
	.btn-apply {
		display: inline-flex;
		align-items: center;
		justify-content: center;
		gap: 8px;
		padding: 15px 25px;
		background: var(--primary-color);
		color: white;
		border: none;
		border-radius: 12px;
		font-weight: 600;
		cursor: pointer;
		transition: var(--transition);
		font-size: 0.95rem;
	}
	
	.btn-apply:hover {
		background: var(--primary-dark);
		transform: translateY(-2px);
	}
	
	/* Continue Shopping */
	.btn-continue {
		display: inline-flex;
		align-items: center;
		justify-content: center;
		gap: 10px;
		padding: 15px 30px;
		background: white;
		color: var(--secondary-color);
		border: 2px solid var(--border-color);
		border-radius: 12px;
		text-decoration: none;
		font-weight: 600;
		transition: var(--transition);
	}
	
	.btn-continue:hover {
		border-color: var(--primary-color);
		color: var(--primary-color);
		background: var(--light-gray);
	}
	
	/* Cart Summary */
	.cart-summary {
		background: white;
		border-radius: 20px;
		padding: 30px;
		box-shadow: var(--shadow);
		position: sticky;
		top: 20px;
	}
	
	.cart-summary h4 {
		font-size: 1.5rem;
		color: var(--secondary-color);
		margin-bottom: 25px;
		font-weight: 600;
		padding-bottom: 20px;
		border-bottom: 1px solid var(--border-color);
	}
	
	.summary-details {
		margin-bottom: 25px;
	}
	
	.summary-item {
		display: flex;
		justify-content: space-between;
		align-items: center;
		padding: 15px 0;
		border-bottom: 1px solid var(--border-color);
	}
	
	.summary-item:last-child {
		border-bottom: none;
	}
	
	.summary-item span {
		color: #64748b;
		font-size: 1rem;
	}
	
	.summary-item strong {
		font-size: 1.1rem;
		color: var(--secondary-color);
		font-weight: 600;
	}
	
	.summary-item.discount strong {
		color: #dc2626;
	}
	
	.summary-total {
		display: flex;
		justify-content: space-between;
		align-items: center;
		padding: 20px 0;
		margin-top: 10px;
		border-top: 2px solid var(--border-color);
	}
	
	.summary-total span {
		font-size: 1.2rem;
		color: var(--secondary-color);
		font-weight: 600;
	}
	
	.order-total {
		font-size: 1.5rem;
		color: var(--primary-color);
		font-weight: 700;
	}
	
	.summary-note {
		background: var(--light-gray);
		padding: 15px;
		border-radius: 12px;
		margin-bottom: 25px;
	}
	
	.summary-note p {
		color: #64748b;
		font-size: 0.9rem;
		margin: 0;
		display: flex;
		align-items: center;
		gap: 8px;
	}
	
	.summary-note i {
		color: var(--primary-color);
		font-size: 1rem;
	}
	
	/* Checkout Button */
	.btn-checkout {
		display: flex;
		align-items: center;
		justify-content: center;
		gap: 10px;
		width: 100%;
		padding: 18px;
		background: var(--primary-color);
		color: white;
		border: none;
		border-radius: 12px;
		font-weight: 600;
		font-size: 1.1rem;
		text-decoration: none;
		transition: var(--transition);
	}
	
	.btn-checkout:hover {
		background: var(--primary-dark);
		transform: translateY(-2px);
		box-shadow: var(--shadow-hover);
	}
	
	/* Services Section */
	.services-section {
		padding: 60px 0;
		background: var(--light-gray);
	}
	
	.section-header {
		text-align: center;
		margin-bottom: 50px;
	}
	
	.section-header h2 {
		font-size: 2.2rem;
		color: var(--secondary-color);
		margin-bottom: 15px;
		font-weight: 700;
	}
	
	.section-header p {
		color: #64748b;
		font-size: 1.1rem;
		max-width: 600px;
		margin: 0 auto;
		line-height: 1.6;
	}
	
	.services-grid {
		display: grid;
		grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
		gap: 30px;
	}
	
	.service-card {
		background: white;
		border-radius: 16px;
		padding: 30px;
		text-align: center;
		box-shadow: var(--shadow);
		transition: var(--transition);
	}
	
	.service-card:hover {
		transform: translateY(-10px);
		box-shadow: var(--shadow-hover);
	}
	
	.service-icon {
		width: 70px;
		height: 70px;
		background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
		border-radius: 16px;
		display: flex;
		align-items: center;
		justify-content: center;
		margin: 0 auto 25px;
		color: white;
		font-size: 1.8rem;
	}
	
	.service-content h4 {
		font-size: 1.3rem;
		color: var(--secondary-color);
		margin-bottom: 12px;
		font-weight: 600;
	}
	
	.service-content p {
		color: #64748b;
		line-height: 1.6;
		margin: 0;
	}
	
	/* Responsive Design */
	@media (max-width: 1200px) {
		.cart-table th,
		.cart-table td {
			padding: 20px 15px;
		}
	}
	
	@media (max-width: 992px) {
		.shopping-cart {
			padding: 40px 0;
		}
		
		.cart-summary {
			position: static;
			margin-top: 30px;
		}
		
		.services-grid {
			grid-template-columns: repeat(2, 1fr);
		}
	}
	
	@media (max-width: 768px) {
		.cart-table {
			overflow-x: auto;
		}
		
		.cart-table table {
			min-width: 700px;
		}
		
		.coupon-form .input-group {
			flex-direction: column;
		}
		
		.btn-apply {
			width: 100%;
		}
		
		.continue-shopping {
			text-align: center;
		}
		
		.btn-continue {
			width: 100%;
			justify-content: center;
		}
		
		.services-grid {
			grid-template-columns: 1fr;
			gap: 20px;
		}
		
		.section-header h2 {
			font-size: 1.8rem;
		}
		
		.empty-cart {
			padding: 40px 20px;
		}
		
		.empty-cart h4 {
			font-size: 1.5rem;
		}
	}
	
	@media (max-width: 576px) {
		.cart-table table {
			min-width: 600px;
		}
		
		.quantity-control {
			max-width: 120px;
		}
		
		.quantity-btn {
			width: 35px;
			height: 35px;
		}
		
		.quantity-input {
			width: 50px;
			height: 35px;
		}
		
		.product-image img {
			width: 60px;
			height: 60px;
		}
		
		.cart-summary,
		.coupon-card {
			padding: 20px;
		}
		
		.section-header h2 {
			font-size: 1.6rem;
		}
		
		.section-header p {
			font-size: 1rem;
		}
		
		.service-card {
			padding: 25px 20px;
		}
		
		.service-icon {
			width: 60px;
			height: 60px;
			font-size: 1.5rem;
		}
		
		.service-content h4 {
			font-size: 1.2rem;
		}
	}
	
	@media (max-width: 480px) {
		.bread-list {
			font-size: 0.9rem;
		}
		
		.empty-cart-icon {
			width: 80px;
			height: 80px;
			font-size: 2rem;
		}
		
		.empty-cart h4 {
			font-size: 1.3rem;
		}
		
		.empty-cart p {
			font-size: 1rem;
		}
		
		.btn-shop-now {
			padding: 14px 25px;
			font-size: 0.95rem;
		}
	}
</style>
@endpush

@push('scripts')
	<script src="{{asset('frontend/js/nice-select/js/jquery.nice-select.min.js')}}"></script>
	<script src="{{ asset('frontend/js/select2/js/select2.min.js') }}"></script>
	<script>
		$(document).ready(function() { 
			$("select.select2").select2(); 
		});
		
		$('select.nice-select').niceSelect();
		
		$(document).ready(function(){
			// Quantity button functionality
			$('.quantity-btn').click(function(){
				var type = $(this).data('type');
				var input = $(this).closest('.quantity-control').find('.quantity-input');
				var currentVal = parseInt(input.val());
				var min = input.data('min');
				var max = input.data('max');
				
				if(type == 'plus') {
					if(currentVal < max) {
						input.val(currentVal + 1).change();
					}
				} else if(type == 'minus') {
					if(currentVal > min) {
						input.val(currentVal - 1).change();
					}
				}
			});
			
			// Input validation
			$('.quantity-input').on('change', function(){
				var min = parseInt($(this).data('min'));
				var max = parseInt($(this).data('max'));
				var currentVal = parseInt($(this).val());
				
				if(isNaN(currentVal) || currentVal < min) {
					$(this).val(min);
				} else if(currentVal > max) {
					$(this).val(max);
				}
			});
			
			// Coupon form validation
			$('.coupon-form').on('submit', function(e){
				var couponInput = $(this).find('input[name="code"]');
				if(!couponInput.val().trim()) {
					e.preventDefault();
					couponInput.focus();
					couponInput.css('border-color', '#dc2626');
					
					setTimeout(function(){
						couponInput.css('border-color', 'var(--border-color)');
					}, 2000);
					return false;
				}
			});
			
			// Add animation to service cards
			$('.service-card').each(function(index){
				$(this).css({
					'opacity': '0',
					'transform': 'translateY(20px)',
					'transition': 'opacity 0.5s ease, transform 0.5s ease'
				});
				
				setTimeout(() => {
					$(this).css({
						'opacity': '1',
						'transform': 'translateY(0)'
					});
				}, index * 200);
			});
			
			// Remove item confirmation
			$('.remove-btn').on('click', function(e){
				if(!confirm('Êtes-vous sûr de vouloir supprimer cet article du panier ?')) {
					e.preventDefault();
				}
			});
			
			// Update cart button animation
			$('.btn-update-cart').on('click', function(){
				var button = $(this);
				var originalText = button.html();
				
				button.html('<i class="ti-reload spinning"></i><span>Mise à jour...</span>');
				button.prop('disabled', true);
				
				setTimeout(function(){
					button.html(originalText);
					button.prop('disabled', false);
				}, 2000);
			});
		});
		
		// Spinning animation
		var style = document.createElement('style');
		style.textContent = `
			.spinning {
				animation: spin 1s linear infinite;
			}
			@keyframes spin {
				from { transform: rotate(0deg); }
				to { transform: rotate(360deg); }
			}
		`;
		document.head.appendChild(style);
	</script>
@endpush
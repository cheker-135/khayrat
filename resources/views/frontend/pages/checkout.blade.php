@extends('frontend.layouts.master')

@section('title','Checkout page')

@section('main-content')

    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{route('home')}}">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0)">Checkout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
            
    <!-- Start Checkout -->
    <section class="shop checkout section">
        <div class="container">
                <form class="form" method="POST" action="{{route('cart.order')}}">
                    @csrf
                    <div class="row"> 

                        <div class="col-lg-8 col-12">
                            <div class="checkout-form">
                                <h2>Finalisez votre commande</h2>
                                <p>Veuillez remplir les informations pour passer commande</p>
                                <!-- Form -->
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Prénom<span>*</span></label>
                                            <input type="text" name="first_name" placeholder="Votre prénom" value="{{old('first_name')}}">
                                            @error('first_name')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Nom<span>*</span></label>
                                            <input type="text" name="last_name" placeholder="Votre nom" value="{{old('lat_name')}}">
                                            @error('last_name')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Adresse E-mail<span>*</span></label>
                                            <input type="email" name="email" placeholder="votre@email.com" value="{{old('email')}}">
                                            @error('email')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Numéro de téléphone <span>*</span></label>
                                            <input type="number" name="phone" placeholder="Votre téléphone" required value="{{old('phone')}}">
                                            @error('phone')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label>Pays<span>*</span></label>
                                            <select name="country" id="country">
                                                <option value="TN" selected>Tunisie</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            <label>Adresse<span>*</span></label>
                                            <input type="text" name="address1" placeholder="Rue, quartier, ville..." value="{{old('address1')}}">
                                            @error('address1')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                </div>
                                <!--/ End Form -->
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="order-details">
                                <!-- Order Widget -->
                                <div class="single-widget">
                                    <h2>TOTAL DU PANIER</h2>
                                    <div class="content">
                                        <ul>
										    <li class="order_subtotal" data-price="{{Helper::totalCartPrice()}}">Sous-total du panier<span>{{number_format(Helper::totalCartPrice(),2)}} {{Helper::base_currency()}}</span></li>
                                            <li class="shipping">
                                                Frais de livraison
                                                @if(count(Helper::shipping())>0 && Helper::cartCount()>0)
                                                    <select name="shipping" class="nice-select">
                                                    <option value="">Sélectionnez votre zone</option>
                                                        @foreach(Helper::shipping() as $shipping)
                                                        <option value="{{$shipping->id}}" class="shippingOption" data-price="{{$shipping->price}}">{{$shipping->type}}: {{$shipping->price}} {{Helper::base_currency()}}</option>
                                                        @endforeach
                                                    </select>
                                                @else 
                                                    <span>Gratuit</span>
                                                @endif
                                            </li>
                                            
                                            @if(session('coupon'))
                                            <li class="coupon_price" data-price="{{session('coupon')['value']}}">Vous économisez<span>{{number_format(session('coupon')['value'],2)}} {{Helper::base_currency()}}</span></li>
                                            @endif
                                            @php
                                                $total_amount=Helper::totalCartPrice();
                                                if(session('coupon')){
                                                    $total_amount=$total_amount-session('coupon')['value'];
                                                }
                                            @endphp
                                            @if(session('coupon'))
                                                <li class="last"  id="order_total_price">Total<span>{{number_format($total_amount,2)}} {{Helper::base_currency()}}</span></li>
                                            @else
                                                <li class="last"  id="order_total_price">Total<span>{{number_format($total_amount,2)}} {{Helper::base_currency()}}</span></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                <!--/ End Order Widget -->
                                <!-- Order Widget -->
                                <div class="single-widget">
                                    <h2>Paiements</h2>
                                    <div class="content">
                                        <div class="checkbox">
                                            {{-- <label class="checkbox-inline" for="1"><input name="updates" id="1" type="checkbox"> Check Payments</label> --}}
                                            <form-group>
                                                <input name="payment_method"  type="radio" value="cod" checked> <label> Paiement à la livraison</label><br>
                                                <div class="payment-option disabled" style="display: flex; align-items: center; gap: 10px; margin-top: 5px; opacity: 0.6;">
                                                    <input name="payment_method" type="radio" value="card" disabled> 
                                                    <label style="margin-bottom: 0;"> Carte Bancaire</label>
                                                    <span class="badge-soon" style="background: #64748b; color: white; font-size: 10px; padding: 2px 8px; border-radius: 20px; font-weight: 600; text-transform: uppercase;">Bientôt disponible</span>
                                                </div>
                                            </form-group>
                                            
                                        </div>
                                    </div>
                                </div>
                                <!--/ End Order Widget -->
                                <!-- Payment Method Widget -->
                                <div class="single-widget payement">
                                    <div class="content">
                                        <img src="{{('backend/img/payment-method.png')}}" alt="#">
                                    </div>
                                </div>
                                <!--/ End Payment Method Widget -->
                                <!-- Button Widget -->
                                <div class="single-widget get-button">
                                    <div class="content">
                                        <div class="button">
                                            <button type="submit" class="btn checkout-submit-btn">
                                                <span class="btn-text">Confirmer la commande</span>
                                                <i class="fa fa-shopping-cart ml-2"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!--/ End Button Widget -->
                            </div>
                        </div>
                    </div>
                </form>
        </div>
    </section>
    <!--/ End Checkout -->
    
    <section class="shop-services section home">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-header">
                        <h2>Pourquoi choisir KHAYRAT ?</h2>
                        <p>Nous nous engageons à vous offrir la meilleure expérience d'achat</p>
                    </div>
                </div>
            </div>
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon"><i class="ti-rocket"></i></div>
                    <div class="service-content">
                        <h4>Livraison Express</h4>
                        <p>Livraison rapide partout en Tunisie</p>
                    </div>
                </div>
                <div class="service-card">
                    <div class="service-icon"><i class="ti-reload"></i></div>
                    <div class="service-content">
                        <h4>Retours Faciles</h4>
                        <p>Échange possible sous 15 jours</p>
                    </div>
                </div>
                <div class="service-card">
                    <div class="service-icon"><i class="ti-lock"></i></div>
                    <div class="service-content">
                        <h4>Paiement Sécurisé</h4>
                        <p>Vos transactions sont protégées</p>
                    </div>
                </div>
                <div class="service-card">
                    <div class="service-icon"><i class="ti-headphone-alt"></i></div>
                    <div class="service-content">
                        <h4>Service Client</h4>
                        <p>Assistance disponible 7j/7</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Shop Services -->
    

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

		.section-header {
			text-align: center;
			margin-bottom: 50px;
		}
		
		.section-header h2 {
			font-size: 2rem;
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
			grid-template-columns: repeat(4, 1fr);
			gap: 30px;
		}
		
		.service-card {
			background: white;
			border-radius: 16px;
			padding: 30px;
			text-align: center;
			box-shadow: var(--shadow);
			transition: var(--transition);
			height: 100%;
		}
		
		.service-card:hover {
			transform: translateY(-10px);
			box-shadow: var(--shadow-hover);
		}
		
		.service-icon {
			width: 60px;
			height: 60px;
			background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
			border-radius: 14px;
			display: flex;
			align-items: center;
			justify-content: center;
			margin: 0 auto 20px;
			color: white;
			font-size: 1.5rem;
		}
		
		.service-content h4 {
			font-size: 1.1rem;
			color: var(--secondary-color);
			margin-bottom: 8px;
			font-weight: 600;
		}
		
		.service-content p {
			color: #64748b;
			line-height: 1.5;
			margin: 0;
			font-size: 0.9rem;
		}

		/* Premium Checkout Button */
		.checkout-submit-btn {
			width: 100% !important;
			padding: 18px 30px !important;
			background: linear-gradient(135deg, #28a745, #1e7e34) !important;
			color: white !important;
			border: none !important;
			border-radius: 12px !important;
			font-size: 1.1rem !important;
			font-weight: 700 !important;
			letter-spacing: 0.5px !important;
			text-transform: uppercase !important;
			display: flex !important;
			align-items: center !important;
			justify-content: center !important;
			transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
			box-shadow: 0 10px 20px rgba(40, 167, 69, 0.2) !important;
			cursor: pointer !important;
			position: relative !important;
			overflow: hidden !important;
		}

		.checkout-submit-btn:hover {
			transform: translateY(-3px) scale(1.02) !important;
			background: linear-gradient(135deg, #2ecc71, #28a745) !important;
			box-shadow: 0 15px 30px rgba(40, 167, 69, 0.3) !important;
		}

		.checkout-submit-btn:active {
			transform: translateY(-1px) scale(1) !important;
		}

		.checkout-submit-btn i {
			transition: transform 0.3s ease !important;
		}

		.checkout-submit-btn:hover i {
			transform: translateX(5px) rotate(-10deg) !important;
		}

		.checkout-submit-btn::before {
			content: '';
			position: absolute;
			top: -50%;
			left: -50%;
			width: 200%;
			height: 200%;
			background: rgba(255, 255, 255, 0.1);
			transform: rotate(45deg);
			transition: all 0.5s ease;
			pointer-events: none;
		}

		.checkout-submit-btn:hover::before {
			left: 100%;
		}

		@media (max-width: 1200px) {
			.services-grid {
				grid-template-columns: repeat(2, 1fr);
			}
		}

		@media (max-width: 768px) {
			.services-grid {
				grid-template-columns: 1fr;
				gap: 20px;
			}
			.section-header h2 {
				font-size: 1.8rem;
			}
		}

		li.shipping{
			display: inline-flex;
			width: 100%;
			font-size: 14px;
		}
		li.shipping .input-group-icon {
			width: 100%;
			margin-left: 10px;
		}
		.input-group-icon .icon {
			position: absolute;
			left: 20px;
			top: 0;
			line-height: 40px;
			z-index: 3;
		}
		.form-select {
			height: 30px;
			width: 100%;
		}
		.form-select .nice-select {
			border: none;
			border-radius: 0px;
			height: 40px;
			background: #f6f6f6 !important;
			padding-left: 45px;
			padding-right: 40px;
			width: 100%;
		}
		.list li{
			margin-bottom:0 !important;
		}
		.list li:hover{
			background:#F7941D !important;
			color:white !important;
		}
		.form-select .nice-select::after {
			top: 14px;
		}
	</style>
@endpush
@push('scripts')
	<script src="{{asset('frontend/js/nice-select/js/jquery.nice-select.min.js')}}"></script>
	<script src="{{ asset('frontend/js/select2/js/select2.min.js') }}"></script>
	<script>
		$(document).ready(function() { $("select.select2").select2(); });
  		$('select.nice-select').niceSelect();
	</script>
	<script>
		function showMe(box){
			var checkbox=document.getElementById('shipping').style.display;
			// alert(checkbox);
			var vis= 'none';
			if(checkbox=="none"){
				vis='block';
			}
			if(checkbox=="block"){
				vis="none";
			}
			document.getElementById(box).style.display=vis;
		}
	</script>
	<script>
		$(document).ready(function(){
			$('.shipping select[name=shipping]').change(function(){
				let cost = parseFloat( $(this).find('option:selected').data('price') ) || 0;
				let subtotal = parseFloat( $('.order_subtotal').data('price') ); 
				let coupon = parseFloat( $('.coupon_price').data('price') ) || 0; 
				// alert(coupon);
				$('#order_total_price span').text((subtotal + cost-coupon).toFixed(2) + ' ' + '{{Helper::base_currency()}}');
			});

		});

	</script>

@endpush
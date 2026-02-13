@extends('frontend.layouts.master')

@section('title','KHAYRAT || Suivi de Commande')

@section('main-content')
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{route('home')}}">Accueil<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0);">Suivi de Commande</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Order Tracking Section -->
    <section class="order-tracking-section">
        <div class="container">
            <div class="section-header">
                <h2>Suivre Votre Commande</h2>
                <p>Suivez l'état de votre commande en temps réel</p>
            </div>

            <div class="tracking-container">
                <div class="tracking-card">
                    <div class="tracking-header">
                        <div class="tracking-icon">
                            <i class="ti-package"></i>
                        </div>
                        <div class="tracking-intro">
                            <h3>Où est ma commande ?</h3>
                            <p>Entrez votre numéro de commande pour suivre son statut et sa livraison</p>
                        </div>
                    </div>

                    <form class="tracking-form" action="{{route('product.track.order')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="order-number">
                                <i class="ti-receipt"></i>
                                <span>Numéro de commande</span>
                            </label>
                            <div class="input-with-icon">
                                <input type="text" 
                                       class="form-control" 
                                       id="order-number" 
                                       name="order_number" 
                                       placeholder="Ex: ORD-123456"
                                       required>
                                <div class="input-icon">
                                    <i class="ti-search"></i>
                                </div>
                            </div>
                            <small class="form-hint">
                                <i class="ti-info-alt"></i>
                                Vous trouverez ce numéro sur votre reçu et dans l'email de confirmation
                            </small>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-track-order">
                                <i class="ti-search"></i>
                                <span>Suivre la Commande</span>
                            </button>
                            <a href="{{route('order.index')}}" class="btn-view-orders">
                                <i class="ti-list"></i>
                                <span>Voir mes Commandes</span>
                            </a>
                        </div>
                    </form>

                    @if(isset($order))
                        <!-- Tracking Results -->
                        <div class="tracking-results">
                            <div class="results-header">
                                <h4>Résultats du suivi</h4>
                                <div class="order-status-badge status-{{strtolower($order->status)}}">
                                    {{ucfirst($order->status)}}
                                </div>
                            </div>

                            <div class="order-summary">
                                <div class="summary-grid">
                                    <div class="summary-item">
                                        <div class="summary-icon">
                                            <i class="ti-receipt"></i>
                                        </div>
                                        <div class="summary-content">
                                            <span class="summary-label">Numéro de commande</span>
                                            <strong class="summary-value">{{$order->order_number}}</strong>
                                        </div>
                                    </div>
                                    
                                    <div class="summary-item">
                                        <div class="summary-icon">
                                            <i class="ti-calendar"></i>
                                        </div>
                                        <div class="summary-content">
                                            <span class="summary-label">Date de commande</span>
                                            <strong class="summary-value">{{$order->created_at->format('d/m/Y')}}</strong>
                                        </div>
                                    </div>
                                    
                                    <div class="summary-item">
                                        <div class="summary-icon">
                                            <i class="ti-money"></i>
                                        </div>
                                        <div class="summary-content">
                                            <span class="summary-label">Montant total</span>
                                            <strong class="summary-value">{{number_format($order->total_amount, 2)}} DT</strong>
                                        </div>
                                    </div>
                                    
                                    <div class="summary-item">
                                        <div class="summary-icon">
                                            <i class="ti-user"></i>
                                        </div>
                                        <div class="summary-content">
                                            <span class="summary-label">Client</span>
                                            <strong class="summary-value">{{$order->first_name}} {{$order->last_name}}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tracking Timeline -->
                            <div class="tracking-timeline">
                                <h5>Historique du suivi</h5>
                                <div class="timeline">
                                    <!-- Step 1: Commande confirmée -->
                                    <div class="timeline-step @if(in_array($order->status, ['pending', 'process', 'delivered', 'cancel'])) active @endif">
                                        <div class="step-icon">
                                            <i class="ti-check-box"></i>
                                        </div>
                                        <div class="step-content">
                                            <h6>Commande Confirmée</h6>
                                            <p>Votre commande a été confirmée</p>
                                            <span class="step-date">{{$order->created_at->format('d/m/Y H:i')}}</span>
                                        </div>
                                    </div>
                                    
                                    <!-- Step 2: En traitement -->
                                    <div class="timeline-step @if(in_array($order->status, ['process', 'delivered'])) active @endif">
                                        <div class="step-icon">
                                            <i class="ti-settings"></i>
                                        </div>
                                        <div class="step-content">
                                            <h6>En Traitement</h6>
                                            <p>Votre commande est en cours de préparation</p>
                                            @if($order->status == 'process' || $order->status == 'delivered')
                                                <span class="step-date">{{$order->updated_at->format('d/m/Y H:i')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <!-- Step 3: Expédiée -->
                                    <div class="timeline-step @if($order->status == 'delivered') active @endif">
                                        <div class="step-icon">
                                            <i class="ti-truck"></i>
                                        </div>
                                        <div class="step-content">
                                            <h6>Expédiée</h6>
                                            <p>Votre commande a été expédiée</p>
                                            @if($order->status == 'delivered')
                                                <span class="step-date">{{$order->updated_at->format('d/m/Y H:i')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <!-- Step 4: Livrée -->
                                    <div class="timeline-step @if($order->status == 'delivered') active @endif">
                                        <div class="step-icon">
                                            <i class="ti-home"></i>
                                        </div>
                                        <div class="step-content">
                                            <h6>Livrée</h6>
                                            <p>Votre commande a été livrée</p>
                                            @if($order->status == 'delivered')
                                                <span class="step-date">{{$order->updated_at->format('d/m/Y H:i')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Order Details -->
                            <div class="order-details">
                                <h5>Détails de la commande</h5>
                                <div class="details-table">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Produit</th>
                                                    <th>Prix unitaire</th>
                                                    <th>Quantité</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($order->cart_info as $cart)
                                                    @php
                                                        $product = \App\Models\Product::find($cart->product_id);
                                                    @endphp
                                                    @if($product)
                                                        <tr>
                                                            <td>
                                                                <div class="product-info">
                                                                    @php
                                                                        $photo = explode(',', $product->photo);
                                                                    @endphp
                                                                    <img src="{{$photo[0]}}" alt="{{$product->title}}">
                                                                    <div>
                                                                        <h6>{{$product->title}}</h6>
                                                                        @if($cart->size)
                                                                            <span class="product-size">Taille: {{$cart->size}}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>{{number_format($cart->price, 2)}} DT</td>
                                                            <td>{{$cart->quantity}}</td>
                                                            <td>{{number_format($cart->price * $cart->quantity, 2)}} DT</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="3" class="text-end"><strong>Sous-total:</strong></td>
                                                    <td>{{number_format($order->sub_total, 2)}} DT</td>
                                                </tr>
                                                @if($order->coupon > 0)
                                                    <tr>
                                                        <td colspan="3" class="text-end"><strong>Réduction coupon:</strong></td>
                                                        <td>-{{number_format($order->coupon, 2)}} DT</td>
                                                    </tr>
                                                @endif
                                                @if($order->shipping->price > 0)
                                                    <tr>
                                                        <td colspan="3" class="text-end"><strong>Frais de livraison:</strong></td>
                                                        <td>{{number_format($order->shipping->price, 2)}} DT</td>
                                                    </tr>
                                                @endif
                                                <tr class="total-row">
                                                    <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                                    <td>{{number_format($order->total_amount, 2)}} DT</td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Shipping Information -->
                            <div class="shipping-info-card">
                                <h5>Informations de livraison</h5>
                                <div class="info-grid">
                                    <div class="info-item">
                                        <div class="info-icon">
                                            <i class="ti-location-pin"></i>
                                        </div>
                                        <div class="info-content">
                                            <h6>Adresse de livraison</h6>
                                            <p>{{$order->address1}}, {{$order->address2}}</p>
                                            <p>{{$order->country}}, {{$order->post_code}}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="info-item">
                                        <div class="info-icon">
                                            <i class="ti-user"></i>
                                        </div>
                                        <div class="info-content">
                                            <h6>Informations client</h6>
                                            <p>{{$order->first_name}} {{$order->last_name}}</p>
                                            <p>{{$order->email}}</p>
                                            <p>{{$order->phone}}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="info-item">
                                        <div class="info-icon">
                                            <i class="ti-truck"></i>
                                        </div>
                                        <div class="info-content">
                                            <h6>Mode de livraison</h6>
                                            <p>{{$order->shipping->type}}</p>
                                            <p>Délai estimé: {{$order->shipping->price == 0 ? 'Standard (3-5 jours)' : 'Express (24-48h)'}}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="info-item">
                                        <div class="info-icon">
                                            <i class="ti-credit-card"></i>
                                        </div>
                                        <div class="info-content">
                                            <h6>Mode de paiement</h6>
                                            <p>{{$order->payment_method}}</p>
                                            <p>Statut: 
                                                <span class="payment-status {{$order->payment_status == 'paid' ? 'paid' : 'unpaid'}}">
                                                    {{$order->payment_status == 'paid' ? 'Payé' : 'Non payé'}}
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="tracking-actions">
                                <a href="{{route('order.pdf', $order->id)}}" class="btn-action" target="_blank">
                                    <i class="ti-download"></i>
                                    <span>Télécharger la facture</span>
                                </a>
                                @if($order->status != 'delivered')
                                    <a href="{{route('order.index')}}" class="btn-action secondary">
                                        <i class="ti-headphone-alt"></i>
                                        <span>Contacter le support</span>
                                    </a>
                                @endif
                                <a href="{{route('product-grids')}}" class="btn-action outline">
                                    <i class="ti-shopping-cart"></i>
                                    <span>Continuer mes achats</span>
                                </a>
                            </div>
                        </div>
                    @elseif(request()->has('order_number'))
                        <!-- No Results -->
                        <div class="no-results">
                            <div class="no-results-icon">
                                <i class="ti-search"></i>
                            </div>
                            <h4>Aucune commande trouvée</h4>
                            <p>Désolé, nous n'avons pas trouvé de commande avec le numéro "{{request('order_number')}}".</p>
                            <div class="suggestions">
                                <p>Suggestions :</p>
                                <ul>
                                    <li>Vérifiez que le numéro de commande est correct</li>
                                    <li>Assurez-vous d'avoir entré le bon numéro</li>
                                    <li>Contactez notre service client si le problème persiste</li>
                                </ul>
                            </div>
                            <a href="{{route('product.track.order')}}" class="btn-retry">
                                <i class="ti-reload"></i>
                                <span>Réessayer</span>
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Help Section -->
                <div class="help-section">
                    <div class="help-card">
                        <div class="help-icon">
                            <i class="ti-help-alt"></i>
                        </div>
                        <div class="help-content">
                            <h4>Besoin d'aide ?</h4>
                            <p>Si vous rencontrez des problèmes avec le suivi de votre commande, contactez notre service client.</p>
                            <div class="contact-info">
                                <p><i class="ti-headphone-alt"></i> +216 XX XXX XXX</p>
                                <p><i class="ti-email"></i> support@khayrat.tn</p>
                            </div>
                            <a href="{{route('contact')}}" class="btn-help">
                                <i class="ti-comment-alt"></i>
                                <span>Nous contacter</span>
                            </a>
                        </div>
                    </div>
                    
                    <div class="faq-card">
                        <h5>Questions fréquentes</h5>
                        <div class="faq-item">
                            <div class="faq-question">
                                <i class="ti-angle-down"></i>
                                <span>Combien de temps faut-il pour suivre ma commande ?</span>
                            </div>
                            <div class="faq-answer">
                                <p>Les informations de suivi sont disponibles immédiatement après la confirmation de votre commande. Les mises à jour sont effectuées en temps réel.</p>
                            </div>
                        </div>
                        
                        <div class="faq-item">
                            <div class="faq-question">
                                <i class="ti-angle-down"></i>
                                <span>Que faire si mon colis est en retard ?</span>
                            </div>
                            <div class="faq-answer">
                                <p>Si votre colis dépasse la date de livraison estimée, veuillez contacter notre service client pour obtenir une assistance.</p>
                            </div>
                        </div>
                        
                        <div class="faq-item">
                            <div class="faq-question">
                                <i class="ti-angle-down"></i>
                                <span>Puis-je modifier l'adresse de livraison ?</span>
                            </div>
                            <div class="faq-answer">
                                <p>Les modifications d'adresse sont possibles uniquement avant l'expédition. Contactez-nous rapidement si vous devez modifier votre adresse.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Order Tracking Section -->
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
    
    /* Order Tracking Section */
    .order-tracking-section {
        padding: 60px 0;
        background: #fff;
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
    
    /* Tracking Container */
    .tracking-container {
        display: grid;
        grid-template-columns: 1fr 350px;
        gap: 40px;
    }
    
    @media (max-width: 992px) {
        .tracking-container {
            grid-template-columns: 1fr;
        }
    }
    
    /* Tracking Card */
    .tracking-card {
        background: white;
        border-radius: 20px;
        box-shadow: var(--shadow);
        overflow: hidden;
        padding: 40px;
    }
    
    /* Tracking Header */
    .tracking-header {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 40px;
        padding-bottom: 30px;
        border-bottom: 1px solid var(--border-color);
    }
    
    .tracking-icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.8rem;
        flex-shrink: 0;
    }
    
    .tracking-intro h3 {
        font-size: 1.8rem;
        color: var(--secondary-color);
        margin-bottom: 10px;
        font-weight: 600;
    }
    
    .tracking-intro p {
        color: #64748b;
        line-height: 1.6;
        margin: 0;
    }
    
    /* Tracking Form */
    .tracking-form {
        margin-bottom: 40px;
    }
    
    .form-group {
        margin-bottom: 30px;
    }
    
    .form-group label {
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 600;
        color: var(--secondary-color);
        margin-bottom: 12px;
    }
    
    .form-group label i {
        color: var(--primary-color);
    }
    
    .input-with-icon {
        position: relative;
    }
    
    .input-with-icon input {
        width: 100%;
        padding: 15px 20px 15px 50px;
        border: 2px solid var(--border-color);
        border-radius: 12px;
        font-size: 1rem;
        color: var(--text-color);
        transition: var(--transition);
        background: white;
    }
    
    .input-with-icon input:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.1);
    }
    
    .input-icon {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 1.2rem;
    }
    
    .form-hint {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 8px;
        color: #64748b;
        font-size: 0.9rem;
    }
    
    .form-hint i {
        color: var(--primary-color);
    }
    
    /* Form Actions */
    .form-actions {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }
    
    .btn-track-order,
    .btn-view-orders {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 16px 30px;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: var(--transition);
        border: none;
        cursor: pointer;
        font-size: 1rem;
        flex: 1;
        min-width: 200px;
    }
    
    .btn-track-order {
        background: var(--primary-color);
        color: white;
    }
    
    .btn-track-order:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: var(--shadow-hover);
    }
    
    .btn-view-orders {
        background: white;
        color: var(--primary-color);
        border: 2px solid var(--primary-color);
    }
    
    .btn-view-orders:hover {
        background: var(--light-gray);
        transform: translateY(-2px);
    }
    
    /* Tracking Results */
    .tracking-results {
        margin-top: 40px;
        animation: fadeIn 0.5s ease;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .results-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid var(--border-color);
    }
    
    .results-header h4 {
        font-size: 1.5rem;
        color: var(--secondary-color);
        margin: 0;
    }
    
    .order-status-badge {
        padding: 8px 20px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.9rem;
    }
    
    .status-pending { background: #fef3c7; color: #92400e; }
    .status-process { background: #dbeafe; color: #1e40af; }
    .status-delivered { background: #d1fae5; color: #065f46; }
    .status-cancel { background: #fee2e2; color: #991b1b; }
    
    /* Order Summary */
    .order-summary {
        background: var(--light-gray);
        border-radius: 16px;
        padding: 30px;
        margin-bottom: 40px;
    }
    
    .summary-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }
    
    .summary-item {
        display: flex;
        align-items: center;
        gap: 15px;
    }
    
    .summary-icon {
        width: 50px;
        height: 50px;
        background: white;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-color);
        font-size: 1.2rem;
        box-shadow: var(--shadow);
    }
    
    .summary-content {
        flex: 1;
    }
    
    .summary-label {
        display: block;
        color: #64748b;
        font-size: 0.9rem;
        margin-bottom: 4px;
    }
    
    .summary-value {
        font-size: 1.2rem;
        color: var(--secondary-color);
        font-weight: 600;
    }
    
    /* Tracking Timeline */
    .tracking-timeline {
        margin-bottom: 40px;
    }
    
    .tracking-timeline h5 {
        font-size: 1.3rem;
        color: var(--secondary-color);
        margin-bottom: 25px;
        font-weight: 600;
    }
    
    .timeline {
        position: relative;
        padding-left: 40px;
    }
    
    .timeline:before {
        content: '';
        position: absolute;
        left: 25px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: var(--border-color);
    }
    
    .timeline-step {
        position: relative;
        margin-bottom: 40px;
        opacity: 0.5;
    }
    
    .timeline-step.active {
        opacity: 1;
    }
    
    .timeline-step:last-child {
        margin-bottom: 0;
    }
    
    .step-icon {
        position: absolute;
        left: -40px;
        top: 0;
        width: 50px;
        height: 50px;
        background: white;
        border: 2px solid var(--border-color);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #94a3b8;
        font-size: 1.2rem;
        z-index: 1;
        transition: var(--transition);
    }
    
    .timeline-step.active .step-icon {
        background: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
        transform: scale(1.1);
    }
    
    .step-content {
        padding-left: 20px;
    }
    
    .step-content h6 {
        font-size: 1.1rem;
        color: var(--secondary-color);
        margin-bottom: 5px;
        font-weight: 600;
    }
    
    .step-content p {
        color: #64748b;
        margin-bottom: 8px;
        line-height: 1.5;
    }
    
    .step-date {
        display: inline-block;
        background: var(--light-gray);
        padding: 4px 12px;
        border-radius: 6px;
        font-size: 0.85rem;
        color: var(--text-color);
    }
    
    /* Order Details */
    .order-details {
        margin-bottom: 40px;
    }
    
    .order-details h5 {
        font-size: 1.3rem;
        color: var(--secondary-color);
        margin-bottom: 25px;
        font-weight: 600;
    }
    
    .details-table {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: var(--shadow);
    }
    
    .table-responsive {
        overflow-x: auto;
    }
    
    .table {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
    }
    
    .table thead {
        background: var(--light-gray);
    }
    
    .table th {
        padding: 20px;
        text-align: left;
        font-weight: 600;
        color: var(--secondary-color);
        border-bottom: 2px solid var(--border-color);
    }
    
    .table td {
        padding: 20px;
        border-bottom: 1px solid var(--border-color);
        vertical-align: middle;
    }
    
    .table tbody tr:last-child td {
        border-bottom: none;
    }
    
    .table tfoot tr:last-child {
        border-top: 2px solid var(--border-color);
    }
    
    .total-row td {
        font-weight: 700;
        color: var(--primary-color);
        font-size: 1.1rem;
        background: var(--light-gray);
    }
    
    .text-end {
        text-align: right !important;
    }
    
    .product-info {
        display: flex;
        align-items: center;
        gap: 15px;
    }
    
    .product-info img {
        width: 60px;
        height: 60px;
        border-radius: 8px;
        object-fit: cover;
    }
    
    .product-info h6 {
        font-size: 1rem;
        color: var(--secondary-color);
        margin-bottom: 5px;
        font-weight: 600;
    }
    
    .product-size {
        font-size: 0.85rem;
        color: #64748b;
    }
    
    /* Shipping Information */
    .shipping-info-card {
        background: var(--light-gray);
        border-radius: 16px;
        padding: 30px;
        margin-bottom: 40px;
    }
    
    .shipping-info-card h5 {
        font-size: 1.3rem;
        color: var(--secondary-color);
        margin-bottom: 25px;
        font-weight: 600;
    }
    
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
    }
    
    .info-item {
        display: flex;
        align-items: flex-start;
        gap: 15px;
    }
    
    .info-icon {
        width: 50px;
        height: 50px;
        background: white;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-color);
        font-size: 1.2rem;
        box-shadow: var(--shadow);
        flex-shrink: 0;
    }
    
    .info-content h6 {
        font-size: 1rem;
        color: var(--secondary-color);
        margin-bottom: 8px;
        font-weight: 600;
    }
    
    .info-content p {
        color: #64748b;
        margin-bottom: 4px;
        line-height: 1.5;
    }
    
    .payment-status {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 500;
    }
    
    .payment-status.paid { background: #d1fae5; color: #065f46; }
    .payment-status.unpaid { background: #fee2e2; color: #991b1b; }
    
    /* Tracking Actions */
    .tracking-actions {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }
    
    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 15px 25px;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: var(--transition);
        flex: 1;
        min-width: 200px;
    }
    
    .btn-action {
        background: var(--primary-color);
        color: white;
        border: none;
    }
    
    .btn-action:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
    }
    
    .btn-action.secondary {
        background: white;
        color: var(--secondary-color);
        border: 2px solid var(--border-color);
    }
    
    .btn-action.secondary:hover {
        border-color: var(--primary-color);
        color: var(--primary-color);
    }
    
    .btn-action.outline {
        background: transparent;
        color: var(--primary-color);
        border: 2px solid var(--primary-color);
    }
    
    .btn-action.outline:hover {
        background: var(--primary-color);
        color: white;
    }
    
    /* No Results */
    .no-results {
        text-align: center;
        padding: 60px 40px;
        background: var(--light-gray);
        border-radius: 16px;
        margin-top: 40px;
        animation: fadeIn 0.5s ease;
    }
    
    .no-results-icon {
        width: 80px;
        height: 80px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 25px;
        color: #cbd5e1;
        font-size: 2rem;
        box-shadow: var(--shadow);
    }
    
    .no-results h4 {
        font-size: 1.5rem;
        color: var(--secondary-color);
        margin-bottom: 15px;
        font-weight: 600;
    }
    
    .no-results p {
        color: #64748b;
        margin-bottom: 25px;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
    }
    
    .suggestions {
        text-align: left;
        max-width: 500px;
        margin: 30px auto;
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: var(--shadow);
    }
    
    .suggestions p {
        font-weight: 600;
        color: var(--secondary-color);
        margin-bottom: 15px;
    }
    
    .suggestions ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .suggestions li {
        padding: 8px 0;
        color: #64748b;
        position: relative;
        padding-left: 20px;
    }
    
    .suggestions li:before {
        content: "•";
        color: var(--primary-color);
        font-weight: bold;
        position: absolute;
        left: 0;
    }
    
    .btn-retry {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 15px 30px;
        background: var(--primary-color);
        color: white;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        transition: var(--transition);
    }
    
    .btn-retry:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
    }
    
    /* Help Section */
    .help-section {
        display: flex;
        flex-direction: column;
        gap: 30px;
    }
    
    .help-card,
    .faq-card {
        background: white;
        border-radius: 20px;
        box-shadow: var(--shadow);
        overflow: hidden;
    }
    
    .help-card {
        padding: 30px;
        text-align: center;
    }
    
    .help-icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.8rem;
        margin: 0 auto 25px;
    }
    
    .help-content h4 {
        font-size: 1.5rem;
        color: var(--secondary-color);
        margin-bottom: 15px;
        font-weight: 600;
    }
    
    .help-content p {
        color: #64748b;
        line-height: 1.6;
        margin-bottom: 25px;
    }
    
    .contact-info {
        background: var(--light-gray);
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 25px;
    }
    
    .contact-info p {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin-bottom: 10px;
        color: var(--text-color);
    }
    
    .contact-info p:last-child {
        margin-bottom: 0;
    }
    
    .contact-info i {
        color: var(--primary-color);
    }
    
    .btn-help {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 15px 30px;
        background: var(--primary-color);
        color: white;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        transition: var(--transition);
    }
    
    .btn-help:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
    }
    
    /* FAQ Card */
    .faq-card {
        padding: 30px;
    }
    
    .faq-card h5 {
        font-size: 1.3rem;
        color: var(--secondary-color);
        margin-bottom: 25px;
        font-weight: 600;
        text-align: center;
    }
    
    .faq-item {
        margin-bottom: 15px;
        border: 1px solid var(--border-color);
        border-radius: 12px;
        overflow: hidden;
    }
    
    .faq-item:last-child {
        margin-bottom: 0;
    }
    
    .faq-question {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 20px;
        background: var(--light-gray);
        cursor: pointer;
        transition: var(--transition);
    }
    
    .faq-question:hover {
        background: #e2e8f0;
    }
    
    .faq-question i {
        color: var(--primary-color);
        transition: var(--transition);
    }
    
    .faq-question.active i {
        transform: rotate(180deg);
    }
    
    .faq-question span {
        font-weight: 600;
        color: var(--secondary-color);
        flex: 1;
    }
    
    .faq-answer {
        padding: 0 20px;
        max-height: 0;
        overflow: hidden;
        transition: var(--transition);
    }
    
    .faq-item.active .faq-answer {
        padding: 20px;
        max-height: 200px;
    }
    
    .faq-answer p {
        color: #64748b;
        line-height: 1.6;
        margin: 0;
    }
    
    /* Responsive Design */
    @media (max-width: 1200px) {
        .tracking-container {
            gap: 30px;
        }
        
        .btn-track-order,
        .btn-view-orders,
        .btn-action {
            min-width: 180px;
        }
    }
    
    @media (max-width: 992px) {
        .tracking-card {
            padding: 30px;
        }
        
        .help-section {
            flex-direction: row;
        }
        
        .help-card,
        .faq-card {
            flex: 1;
        }
        
        .btn-track-order,
        .btn-view-orders,
        .btn-action {
            min-width: 160px;
        }
    }
    
    @media (max-width: 768px) {
        .section-header h2 {
            font-size: 2rem;
        }
        
        .tracking-header {
            flex-direction: column;
            text-align: center;
            gap: 15px;
        }
        
        .tracking-icon {
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
        }
        
        .tracking-intro h3 {
            font-size: 1.5rem;
        }
        
        .form-actions,
        .tracking-actions {
            flex-direction: column;
        }
        
        .btn-track-order,
        .btn-view-orders,
        .btn-action {
            width: 100%;
        }
        
        .summary-grid,
        .info-grid {
            grid-template-columns: 1fr;
        }
        
        .timeline {
            padding-left: 30px;
        }
        
        .timeline:before {
            left: 20px;
        }
        
        .step-icon {
            left: -30px;
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }
        
        .help-section {
            flex-direction: column;
        }
        
        .table {
            font-size: 0.9rem;
        }
        
        .table th,
        .table td {
            padding: 15px 10px;
        }
    }
    
    @media (max-width: 576px) {
        .tracking-card {
            padding: 20px;
        }
        
        .section-header h2 {
            font-size: 1.8rem;
        }
        
        .tracking-intro h3 {
            font-size: 1.3rem;
        }
        
        .input-with-icon input {
            padding: 12px 15px 12px 45px;
            font-size: 0.9rem;
        }
        
        .product-info {
            flex-direction: column;
            text-align: center;
            gap: 10px;
        }
        
        .product-info img {
            width: 50px;
            height: 50px;
        }
        
        .table-responsive {
            margin: 0 -20px;
            padding: 0 20px;
        }
        
        .no-results {
            padding: 40px 20px;
        }
        
        .help-card,
        .faq-card {
            padding: 20px;
        }
    }
    
    @media (max-width: 480px) {
        .timeline {
            padding-left: 25px;
        }
        
        .step-icon {
            left: -25px;
            width: 35px;
            height: 35px;
        }
        
        .step-content {
            padding-left: 15px;
        }
        
        .step-content h6 {
            font-size: 1rem;
        }
        
        .step-content p {
            font-size: 0.9rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // FAQ functionality
        const faqQuestions = document.querySelectorAll('.faq-question');
        
        faqQuestions.forEach(question => {
            question.addEventListener('click', function() {
                const faqItem = this.closest('.faq-item');
                const isActive = faqItem.classList.contains('active');
                
                // Close all FAQ items
                document.querySelectorAll('.faq-item').forEach(item => {
                    item.classList.remove('active');
                });
                
                // Open clicked item if it wasn't active
                if (!isActive) {
                    faqItem.classList.add('active');
                }
            });
        });
        
        // Form submission with loading state
        const trackForm = document.querySelector('.tracking-form');
        const trackButton = document.querySelector('.btn-track-order');
        
        if (trackForm) {
            trackForm.addEventListener('submit', function(e) {
                // Validate form
                const orderNumber = document.getElementById('order-number');
                if (!orderNumber.value.trim()) {
                    e.preventDefault();
                    orderNumber.focus();
                    orderNumber.style.borderColor = '#ef4444';
                    return false;
                }
                
                // Add loading state to button
                if (trackButton) {
                    const originalText = trackButton.innerHTML;
                    trackButton.innerHTML = '<i class="ti-reload spinning"></i><span>Recherche...</span>';
                    trackButton.disabled = true;
                    
                    // Revert button after 3 seconds if form submission fails
                    setTimeout(() => {
                        trackButton.innerHTML = originalText;
                        trackButton.disabled = false;
                    }, 3000);
                }
            });
        }
        
        // Add spinning animation class
        const style = document.createElement('style');
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
        
        // Auto-focus on order number input
        const orderNumberInput = document.getElementById('order-number');
        if (orderNumberInput) {
            orderNumberInput.focus();
        }
        
        // Input validation
        if (orderNumberInput) {
            orderNumberInput.addEventListener('input', function() {
                if (this.value.trim()) {
                    this.style.borderColor = '#28a745';
                } else {
                    this.style.borderColor = '#e2e8f0';
                }
            });
        }
        
        // Print functionality
        const printButton = document.querySelector('[onclick*="print"]');
        if (printButton) {
            printButton.addEventListener('click', function(e) {
                e.preventDefault();
                window.print();
            });
        }
        
        // Smooth scroll to results
        const results = document.querySelector('.tracking-results');
        if (results && window.location.hash === '#results') {
            setTimeout(() => {
                results.scrollIntoView({ behavior: 'smooth' });
            }, 500);
        }
        
        // Copy order number functionality
        const orderNumberElements = document.querySelectorAll('.summary-value');
        orderNumberElements.forEach(element => {
            if (element.textContent.includes('ORD-')) {
                element.style.cursor = 'pointer';
                element.title = 'Cliquez pour copier';
                element.addEventListener('click', function() {
                    const text = this.textContent.trim();
                    navigator.clipboard.writeText(text).then(() => {
                        // Show copied message
                        const originalText = this.innerHTML;
                        this.innerHTML = '<i class="ti-check"></i> Copié !';
                        this.style.color = '#28a745';
                        
                        setTimeout(() => {
                            this.innerHTML = originalText;
                            this.style.color = '';
                        }, 2000);
                    });
                });
            }
        });
        
        // Timeline animation on scroll
        const observerOptions = {
            threshold: 0.5,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const timelineObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const steps = entry.target.querySelectorAll('.timeline-step');
                    steps.forEach((step, index) => {
                        setTimeout(() => {
                            step.style.opacity = '1';
                            step.style.transform = 'translateX(0)';
                        }, index * 200);
                    });
                    timelineObserver.unobserve(entry.target);
                }
            });
        }, observerOptions);
        
        const timeline = document.querySelector('.timeline');
        if (timeline) {
            // Set initial state
            const steps = timeline.querySelectorAll('.timeline-step');
            steps.forEach(step => {
                step.style.opacity = '0';
                step.style.transform = 'translateX(-20px)';
                step.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            });
            
            timelineObserver.observe(timeline);
        }
    });
</script>
@endpush
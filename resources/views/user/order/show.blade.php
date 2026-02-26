@extends('user.layouts.master')

@section('title','KHAYRAT || Détails de la commande')

@section('main-content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary text-uppercase">Détails de la commande #{{$order->order_number}}</h6>
        <div class="d-flex" style="gap: 10px;">
            <a href="{{route('user.order.index')}}" class="btn btn-sm btn-secondary shadow-sm">
                <i class="fas fa-arrow-left fa-sm text-white-50 mr-1"></i> Retour aux commandes
            </a>
            <a href="{{route('order.pdf',$order->id)}}" class="btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-download fa-sm text-white-50 mr-1"></i> Générer PDF
            </a>
        </div>
    </div>
    <div class="card-body">
        @if($order)
        {{-- Visual Tracking --}}
        <div class="tracking-wrap mb-5">
            <div class="tracking-steps d-flex justify-content-between">
                <div class="step {{ in_array($order->status, ['new', 'process', 'shipped', 'delivered']) ? 'active' : '' }}">
                    <div class="step-icon"><i class="fas fa-shopping-cart"></i></div>
                    <span class="step-text">Confirmée</span>
                </div>
                <div class="step {{ in_array($order->status, ['process', 'shipped', 'delivered']) ? 'active' : '' }}">
                    <div class="step-icon"><i class="fas fa-cog"></i></div>
                    <span class="step-text">Traitement</span>
                </div>
                <div class="step {{ in_array($order->status, ['shipped', 'delivered']) ? 'active' : '' }}">
                    <div class="step-icon"><i class="fas fa-truck"></i></div>
                    <span class="step-text">Expédiée</span>
                </div>
                <div class="step {{ $order->status == 'delivered' ? 'active' : '' }}">
                    <div class="step-icon"><i class="fas fa-check-circle"></i></div>
                    <span class="step-text">Livrée</span>
                </div>
            </div>
            @if($order->status == 'cancel')
            <div class="alert alert-danger mt-3 text-center">
                <i class="fas fa-times-circle mr-2"></i> Cette commande a été annulée.
            </div>
            @endif
        </div>

        <div class="table-responsive mb-4">
            <table class="table table-bordered">
                <thead class="bg-light">
                    <tr>
                        <th>N°</th>
                        <th>N° Commande</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Qté</th>
                        <th>Frais</th>
                        <th>Montant Total</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>{{$order->order_number}}</td>
                        <td>{{$order->first_name}} {{$order->last_name}}</td>
                        <td>{{$order->email}}</td>
                        <td>{{$order->quantity}}</td>
                        <td>{{$order->shipping->price ?? 0}} {{Helper::base_currency()}}</td>
                        <td>{{number_format($order->total_amount,2)}} {{Helper::base_currency()}}</td>
                        <td>
                            @if($order->status=='new')
                                <span class="badge badge-info">Nouveau</span>
                            @elseif($order->status=='process')
                                <span class="badge badge-warning">En cours</span>
                            @elseif($order->status=='shipped')
                                <span class="badge badge-primary">Expédié</span>
                            @elseif($order->status=='delivered')
                                <span class="badge badge-success">Livré</span>
                            @else
                                <span class="badge badge-danger">Annulé</span>
                            @endif
                        </td>
                        <td>
                            <form method="POST" action="{{route('order.destroy',[$order->id])}}">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-sm dltBtn" data-id={{$order->id}} data-toggle="tooltip" data-placement="bottom" title="Supprimer"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="row mt-4">
            <div class="col-lg-6 mb-4">
                <div class="info-card h-100">
                    <div class="info-card-header">
                        <div class="info-card-icon order-icon">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <h5>Informations Commande</h5>
                    </div>
                    <div class="info-card-body">
                        <div class="info-item">
                            <span class="info-label">N° de Commande</span>
                            <span class="info-value">#{{$order->order_number}}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Date de Commande</span>
                            <span class="info-value">{{$order->created_at->format('d M Y, H:i')}}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Quantité Totale</span>
                            <span class="info-value">{{$order->quantity}} Produits</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Mode de Paiement</span>
                            <span class="info-value badge badge-light-primary">{{$order->payment_method == 'cod' ? 'Paiement à la livraison' : 'Paypal'}}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Statut du Paiement</span>
                            <span class="info-value">
                                <span class="badge {{ $order->payment_status == 'paid' ? 'badge-success' : 'badge-warning' }} badge-pill">
                                    {{$order->payment_status == 'paid' ? 'Payé' : 'En attente'}}
                                </span>
                            </span>
                        </div>
                        <div class="info-divider"></div>
                        <div class="info-item total-item">
                            <span class="info-label">Montant Total</span>
                            <span class="info-value text-primary font-weight-bold" style="font-size: 1.2rem;">{{number_format($order->total_amount,2)}} {{Helper::base_currency()}}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="info-card h-100">
                    <div class="info-card-header">
                        <div class="info-card-icon shipping-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h5>Informations de Livraison</h5>
                    </div>
                    <div class="info-card-body">
                        <div class="info-item">
                            <span class="info-label">Client</span>
                            <span class="info-value">{{$order->first_name}} {{$order->last_name}}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Email</span>
                            <span class="info-value text-muted">{{$order->email}}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Téléphone</span>
                            <span class="info-value font-weight-bold">{{$order->phone}}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Adresse</span>
                            <span class="info-value">{{$order->address1}} {{ $order->address2 ? ', '.$order->address2 : '' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Ville / Pays</span>
                            <span class="info-value">{{$order->country}}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Code Postal</span>
                            <span class="info-value">{{$order->post_code}}</span>
                        </div>
                        <div class="info-divider"></div>
                        <div class="info-item">
                            <span class="info-label">Frais de Livraison</span>
                            <span class="info-value">{{$order->shipping->price ?? 0}} {{Helper::base_currency()}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<style>
/* Info Card Styles */
.info-card {
    background: #fff;
    border-radius: 12px;
    border: 1px solid #edf2f7;
    box-shadow: 0 4px 12px rgba(0,0,0,0.03);
    overflow: hidden;
    transition: transform 0.2s ease;
}
.info-card:hover {
    transform: translateY(-5px);
}
.info-card-header {
    background: #f8fafc;
    padding: 20px;
    display: flex;
    align-items: center;
    border-bottom: 1px solid #edf2f7;
}
.info-card-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    color: #fff;
    font-size: 1.1rem;
}
.order-icon {
    background: linear-gradient(135deg, #4e73df, #224abe);
}
.shipping-icon {
    background: linear-gradient(135deg, #1cc88a, #13855c);
}
.info-card-header h5 {
    margin: 0;
    font-size: 1.1rem;
    font-weight: 700;
    color: #2d3748;
}
.info-card-body {
    padding: 20px;
}
.info-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
}
.info-label {
    color: #718096;
    font-size: 0.9rem;
    font-weight: 500;
}
.info-value {
    color: #2d3748;
    font-weight: 600;
    text-align: right;
}
.info-divider {
    height: 1px;
    background: #edf2f7;
    margin: 10px 0;
}
.badge-light-primary {
    background: #ebf4ff;
    color: #3182ce;
    border: none;
}
.total-item {
    background: #f7fafc;
    padding: 15px;
    border-radius: 8px;
    margin-top: 10px;
}
.table-borderless td {
    padding: 0.75rem 0.5rem;
    color: #4a5568;
}

/* Tracking Bar Styles */
.tracking-wrap {
    position: relative;
    padding: 20px 0;
}
.tracking-steps {
    position: relative;
    z-index: 1;
}
.tracking-steps::before {
    content: '';
    position: absolute;
    top: 25px;
    left: 5%;
    right: 5%;
    height: 3px;
    background: #e2e8f0;
    z-index: -1;
}
.step {
    text-align: center;
    width: 25%;
    position: relative;
}
.step-icon {
    width: 50px;
    height: 50px;
    background: #fff;
    border: 3px solid #e2e8f0;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 10px;
    color: #cbd5e1;
    transition: all 0.3s ease;
}
.step-text {
    font-size: 0.85rem;
    font-weight: 600;
    color: #94a3b8;
    transition: all 0.3s ease;
}
.step.active .step-icon {
    border-color: #28a745;
    background: #28a745;
    color: #fff;
    box-shadow: 0 0 15px rgba(40, 167, 69, 0.3);
}
.step.active .step-text {
    color: #1e293b;
}
.step.active ~ .step::before {
    background: #28a745;
}

/* Connect lines logic using adjacent sibling for progress */
.step.active {
    position: relative;
}
.step.active:not(:last-child)::after {
    content: '';
    position: absolute;
    top: 25px;
    left: 50%;
    width: 100%;
    height: 3px;
    background: #28a745;
    z-index: -1;
}
</style>
@endsection

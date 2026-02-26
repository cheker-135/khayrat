@extends('backend.layouts.master')

@section('title','Order Detail')

@section('main-content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5><i class="fas fa-shopping-bag mr-2"></i>Détails de la commande #{{$order->order_number}}</h5>
        <a href="{{route('order.pdf',$order->id)}}" class="btn btn-primary btn-sm rounded-pill shadow-sm">
            <i class="fas fa-download mr-1"></i> Télécharger PDF
        </a>
    </div>
    <div class="card-body">
        @if($order)
        <div class="order-dashboard-grid">
            <!-- Header Summary Row -->
            <div class="summary-card grid-col-span-3">
                <div class="summary-item">
                    <span class="label">Date</span>
                    <span class="value">{{$order->created_at->format('d M Y, H:i')}}</span>
                </div>
                <div class="summary-item">
                    <span class="label">Client</span>
                    <span class="value">{{$order->first_name}} {{$order->last_name}}</span>
                </div>
                <div class="summary-item">
                    <span class="label">Total</span>
                    <span class="value text-primary font-weight-bold">{{number_format($order->total_amount,2)}} {{Helper::base_currency()}}</span>
                </div>
                <div class="summary-item">
                    <span class="label">Statut</span>
                    <span class="value">
                        @if($order->status=='new')
                          <span class="badge badge-primary-soft">Nouveau</span>
                        @elseif($order->status=='process')
                          <span class="badge badge-warning-soft">En cours</span>
                        @elseif($order->status=='delivered')
                          <span class="badge badge-success-soft">Livré</span>
                        @else
                          <span class="badge badge-danger-soft">Annulé</span>
                        @endif
                    </span>
                </div>
            </div>

            <!-- Bento Sections -->
            <div class="bento-section">
                <h6 class="section-title"><i class="fas fa-info-circle mr-2"></i>Détails commande</h6>
                <ul class="detail-list">
                    <li><span>Quantité total:</span> <strong>{{$order->quantity}}</strong></li>
                    <li><span>Mode de paiement:</span> <strong>{{$order->payment_method == 'cod' ? 'Paiement à la livraison' : 'Paypal'}}</strong></li>
                    <li><span>Statut paiement:</span> <span class="badge {{ $order->payment_status == 'paid' ? 'badge-success' : 'badge-warning' }}">{{$order->payment_status}}</span></li>
                </ul>
            </div>

            <div class="bento-section">
                <h6 class="section-title"><i class="fas fa-truck mr-2"></i>Livraison</h6>
                <ul class="detail-list">
                    <li><span>Méthode:</span> <strong>{{$order->shipping->type}}</strong></li>
                    <li><span>Frais:</span> <strong>{{number_format($order->shipping->price,2)}} {{Helper::base_currency()}}</strong></li>
                    <li><span>Adresse:</span> <strong>{{$order->address1}}, {{$order->address2}}</strong></li>
                    <li><span>Ville/Pays:</span> <strong>{{$order->country}} ({{$order->post_code}})</strong></li>
                </ul>
            </div>

            <div class="bento-section">
                <h6 class="section-title"><i class="fas fa-user-tag mr-2"></i>Client</h6>
                <ul class="detail-list">
                    <li><span>Email:</span> <strong>{{$order->email}}</strong></li>
                    <li><span>Téléphone:</span> <strong>{{$order->phone}}</strong></li>
                </ul>
                <div class="mt-4 pt-3 border-top">
                    <a href="{{route('order.edit',$order->id)}}" class="btn btn-warning btn-block btn-sm">
                        <i class="fas fa-edit mr-1"></i> Modifier statut
                    </a>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<style>
    .order-dashboard-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
    }

    .grid-col-span-3 {
        grid-column: span 3;
    }

    @media (max-width: 992px) {
        .order-dashboard-grid {
            grid-template-columns: 1fr;
        }
        .grid-col-span-3 {
            grid-column: span 1;
        }
    }

    .summary-card {
        background: #f8f9fc;
        border: 1px solid #e3e6f0;
        border-radius: 12px;
        padding: 1.5rem;
        display: flex;
        justify-content: space-around;
        align-items: center;
    }

    .summary-item {
        text-align: center;
    }

    .summary-item .label {
        display: block;
        font-size: 0.75rem;
        text-transform: uppercase;
        color: #858796;
        margin-bottom: 0.25rem;
    }

    .summary-item .value {
        font-size: 1rem;
        color: #3a3b45;
        font-weight: 600;
    }

    .bento-section {
        background: #fff;
        border: 1px solid #e3e6f0;
        border-radius: 12px;
        padding: 1.5rem;
        transition: transform 0.2s;
    }

    .bento-section:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }

    .section-title {
        color: #4e73df;
        font-weight: 700;
        border-bottom: 2px solid #f8f9fc;
        padding-bottom: 1rem;
        margin-bottom: 1rem;
    }

    .detail-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .detail-list li {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.75rem;
        font-size: 0.9rem;
    }

    .detail-list li span:first-child {
        color: #858796;
    }

    /* Soft Badges */
    .badge-primary-soft { background: #eef2f7; color: #4e73df; }
    .badge-warning-soft { background: #fffbe6; color: #f6c23e; }
    .badge-success-soft { background: #e6fffa; color: #1cc88a; }
    .badge-danger-soft { background: #fff5f5; color: #e74a3b; }
</style>
@endsection

@push('styles')
<style>
    .order-info,.shipping-info{
        background:#ECECEC;
        padding:20px;
    }
    .order-info h4,.shipping-info h4{
        text-decoration: underline;
    }

</style>
@endpush

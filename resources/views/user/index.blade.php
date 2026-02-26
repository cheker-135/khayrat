@extends('user.layouts.master')

@section('main-content')
<div class="container-fluid">
    @include('user.layouts.notification')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Tableau de bord</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
      <!-- Order Card -->
      <div class="col-xl-4 col-md-6 mb-4 card-entrance">
        <div class="premium-card card-orders h-100">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <div class="card-info">
                <span class="card-label">Commandes</span>
                <h2 class="card-value">{{\App\Models\Order::where('user_id', auth()->user()->id)->count()}}</h2>
              </div>
              <div class="card-icon">
                <i class="fas fa-shopping-bag"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Reviews Card -->
      <div class="col-xl-4 col-md-6 mb-4 card-entrance">
        <div class="premium-card card-reviews h-100">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <div class="card-info">
                <span class="card-label">Mes Avis</span>
                <h2 class="card-value">{{\App\Models\ProductReview::where('user_id', auth()->user()->id)->count()}}</h2>
              </div>
              <div class="card-icon">
                <i class="fas fa-star"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Comments Card -->
      <div class="col-xl-4 col-md-6 mb-4 card-entrance">
        <div class="premium-card card-comments h-100">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
              <div class="card-info">
                <span class="card-label">Commentaires</span>
                <h2 class="card-value">{{\App\Models\PostComment::where('user_id', auth()->user()->id)->count()}}</h2>
              </div>
              <div class="card-icon">
                <i class="fas fa-comments"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Content Row -->
    <div class="row">
      @php
          $orders=DB::table('orders')->where('user_id',auth()->user()->id)->paginate(10);
      @endphp
      <!-- Order Table -->
      <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left">Commandes Récentes</h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="order-dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>N°</th>
                    <th>N° Commande</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Quantité</th>
                    <th>Montant Total</th>
                    <th>Statut</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @if(count($orders)>0)
                    @foreach($orders as $order)   
                      <tr>
                          <td>{{$order->id}}</td>
                          <td>{{$order->order_number}}</td>
                          <td>{{$order->first_name}} {{$order->last_name}}</td>
                          <td>{{$order->email}}</td>
                          <td>{{$order->quantity}}</td>
                          <td>{{number_format($order->total_amount,2)}} {{Helper::base_currency()}}</td>
                          <td>
                              @if($order->status=='new')
                                <span class="badge badge-info">Nouveau</span>
                              @elseif($order->status=='process')
                                <span class="badge badge-warning">En cours</span>
                              @elseif($order->status=='delivered')
                                <span class="badge badge-success">Livré</span>
                              @else
                                <span class="badge badge-danger">{{$order->status}}</span>
                              @endif
                          </td>
                          <td>
                              <a href="{{route('user.order.show',$order->id)}}" class="btn btn-primary btn-sm float-left mr-1" data-toggle="tooltip" title="Voir" data-placement="bottom"><i class="fas fa-eye"></i></a>
                              <form method="POST" action="{{route('user.order.delete',[$order->id])}}">
                                @csrf 
                                @method('delete')
                                    <button class="btn btn-danger btn-sm dltBtn" data-id={{$order->id}} data-toggle="tooltip" data-placement="bottom" title="Supprimer"><i class="fas fa-trash-alt"></i></button>
                              </form>
                          </td>
                      </tr>  
                    @endforeach
                    @else
                      <tr>
                        <td colspan="8" class="text-center"><h4 class="my-4">Vous n'avez pas encore de commande !! N'hésitez pas à commander nos produits.</h4></td>
                      </tr>
                    @endif
                </tbody>
              </table>
              <div class="float-right">
                {{$orders->links()}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<style>
/* ============================================================
   PREMIUM USER DASHBOARD STYLING
   ============================================================ */
.premium-card {
    border: none;
    border-radius: 16px;
    padding: 20px;
    color: #fff;
    position: relative;
    overflow: hidden;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
.premium-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.15);
}

.card-orders   { background: linear-gradient(135deg, #a78bfa 0%, #7c3aed 100%); }
.card-reviews  { background: linear-gradient(135deg, #fbbf24 0%, #d97706 100%); }
.card-comments { background: linear-gradient(135deg, #34d399 0%, #059669 100%); }

.card-label {
    display: block;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    opacity: 0.8;
}
.card-value {
    font-size: 2rem;
    font-weight: 800;
    margin: 5px 0 0;
}
.card-icon {
    font-size: 2.5rem;
    opacity: 0.3;
}

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
.card-entrance {
    animation: fadeInUp 0.5s ease backwards;
}
.card-entrance:nth-child(1) { animation-delay: 0.1s; }
.card-entrance:nth-child(2) { animation-delay: 0.2s; }
.card-entrance:nth-child(3) { animation-delay: 0.3s; }
</style>
@endsection

@push('scripts')
<script>
    $(document).ready(function(){
        $('#order-dataTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/French.json"
            },
            "columnDefs":[{
                "orderable": false,
                "targets": [7]
            }]
        });
    });
</script>
@endpush
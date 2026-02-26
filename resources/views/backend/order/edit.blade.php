@extends('backend.layouts.master')

@section('title','KHAYRAT || Détails de la commande')

@section('main-content')
<div class="card">
    <div class="card-header">
        <h5><i class="fas fa-edit mr-2"></i>Modifier le statut de la commande</h5>
    </div>
    <div class="card-body">
      <form action="{{route('order.update',$order->id)}}" method="POST">
        @csrf
        @method('PATCH')
        
        <div class="form-grid">
            <div class="form-group grid-full">
              <label for="status">Statut de la commande</label>
              <select name="status" id="status" class="form-control">
                <option value="new" {{($order->status=='delivered' || $order->status=='shipped' || $order->status=="process" || $order->status=="cancel") ? 'disabled' : ''}}  {{(($order->status=='new')? 'selected' : '')}}>Nouveau</option>
                <option value="process" {{($order->status=='delivered'|| $order->status=='shipped' || $order->status=="cancel") ? 'disabled' : ''}}  {{(($order->status=='process')? 'selected' : '')}}>En cours</option>
                <option value="shipped" {{($order->status=='delivered' || $order->status=="cancel") ? 'disabled' : ''}}  {{(($order->status=='shipped')? 'selected' : '')}}>Expédié</option>
                <option value="delivered" {{($order->status=="cancel") ? 'disabled' : ''}}  {{(($order->status=='delivered')? 'selected' : '')}}>Livré</option>
                <option value="cancel" {{($order->status=='delivered' || $order->status=='shipped') ? 'disabled' : ''}}  {{(($order->status=='cancel')? 'selected' : '')}}>Annulé</option>
              </select>
            </div>
        </div>

        <div class="form-actions mb-3">
           <button type="submit" class="btn btn-success"><i class="fas fa-save mr-2"></i>Mettre à jour le statut</button>
        </div>
      </form>
    </div>
</div>
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

<!DOCTYPE html>
<html>
<head>
  <title>Commande @if($order)- {{$order->cart_id}} @endif</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

@if($order)
<style type="text/css">
  .invoice-header {
    background: #f7f7f7;
    padding: 10px 20px;
    border-bottom: 1px solid #ddd;
  }
  .site-logo {
    margin-top: 10px;
  }
  .invoice-right-top h3 {
    padding-right: 20px;
    margin-top: 20px;
    color: #7c3aed;
    font-size: 30px!important;
    font-family: serif;
  }
  .invoice-left-top {
    border-left: 4px solid #7c3aed;
    padding-left: 20px;
    padding-top: 10px;
  }
  .invoice-left-top p {
    margin: 0;
    line-height: 20px;
    font-size: 16px;
    margin-bottom: 3px;
  }
  thead {
    background: #7c3aed;
    color: #FFF;
  }
  .authority h5 {
    margin-top: -10px;
    color: #7c3aed;
  }
  .thanks h4 {
    color: #7c3aed;
    font-size: 25px;
    font-weight: normal;
    font-family: serif;
    margin-top: 20px;
  }
  .table tfoot .empty {
    border: none;
  }
  .table td, .table th {
    padding: .5rem;
  }
  .text-purple {
      color: #7c3aed;
  }
</style>
  <div class="invoice-header">
    <div class="float-left site-logo">
      <img src="{{asset('backend/img/logo.png')}}" alt="KHAYRAT" style="max-height: 50px;">
    </div>
    <div class="float-right site-address text-right">
      <h4 class="text-purple">{{env('APP_NAME')}}</h4>
      <p>{{env('APP_ADDRESS')}}</p>
      <p>Tél: {{env('APP_PHONE')}}</p>
      <p>Email: {{env('APP_EMAIL')}}</p>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="invoice-description py-4">
    <div class="invoice-left-top float-left">
      <h6>Facturé à :</h6>
       <h3>{{$order->first_name}} {{$order->last_name}}</h3>
       <div class="address">
        <p><strong>Pays: </strong> {{$order->country}}</p>
        <p><strong>Adresse: </strong> {{$order->address1}} {{ $order->address2 ? ', '.$order->address2 : '' }}</p>
         <p><strong>Tél:</strong> {{ $order->phone }}</p>
         <p><strong>Email:</strong> {{ $order->email }}</p>
       </div>
    </div>
    <div class="invoice-right-top float-right text-right">
      <h3 class="text-purple">Facture #{{$order->order_number}}</h3>
      <p>Date: {{ $order->created_at->format('d/m/Y') }}</p>
    </div>
    <div class="clearfix"></div>
  </div>
  <section class="order_details pt-3">
    <div class="table-header bg-light p-2 mb-2 border rounded">
      <h5 class="mb-0">Détails de la commande</h5>
    </div>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">Produit</th>
          <th scope="col" class="text-center">Quantité</th>
          <th scope="col" class="text-right">Total</th>
        </tr>
      </thead>
      <tbody>
      @foreach($order->cart_info as $cart)
      @php 
        $product=DB::table('products')->select('title')->where('id',$cart->product_id)->first();
      @endphp
        <tr>
          <td>{{$product->title ?? 'Produit supprimé'}}</td>
          <td class="text-center">x{{$cart->quantity}}</td>
          <td class="text-right">{{number_format($cart->price,2)}} €</td>
        </tr>
      @endforeach
      </tbody>
      <tfoot>
        <tr>
          <th scope="col" class="empty border-0"></th>
          <th scope="col" class="text-right">Sous-total :</th>
          <th scope="col" class="text-right">{{number_format($order->sub_total,2)}} €</th>
        </tr>
        <tr>
          <th scope="col" class="empty border-0"></th>
          <th scope="col" class="text-right">Livraison :</th>
          <th scope="col" class="text-right">{{number_format($order->delivery_charge,2)}} €</th>
        </tr>
        <tr class="table-active">
          <th scope="col" class="empty border-0"></th>
          <th scope="col" class="text-right font-weight-bold">Total :</th>
          <th scope="col" class="text-right font-weight-bold text-purple">{{number_format($order->total_amount,2)}} €</th>
        </tr>
      </tfoot>
    </table>
  </section>
  <div class="thanks mt-4">
    <h4>Merci pour votre confiance !!</h4>
  </div>
  <div class="authority float-right mt-5 text-center">
    <p class="mb-0 text-muted">Signature de l'autorité</p>
    <p>-----------------------------------</p>
  </div>
  <div class="clearfix"></div>
@else
  <h5 class="text-danger">Invalide</h5>
@endif
</body>
</html>
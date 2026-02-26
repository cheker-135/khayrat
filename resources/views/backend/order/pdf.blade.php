<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Commande #{{$order->order_number}}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #334155;
            margin: 0;
            padding: 0;
            font-size: 14px;
        }
        .header {
            padding: 30px;
            background: #f8fafc;
            border-bottom: 2px solid #28a745;
        }
        .logo {
            float: left;
            width: 150px;
        }
        .order-info {
            float: right;
            text-align: right;
        }
        .order-info h2 {
            margin: 0;
            color: #28a745;
            font-size: 24px;
        }
        .order-info p {
            margin: 5px 0 0;
            color: #64748b;
        }
        .clearfix {
            clear: both;
        }
        .details-section {
            padding: 30px;
        }
        .row {
            margin-bottom: 30px;
        }
        .column {
            float: left;
            width: 50%;
        }
        .section-title {
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            color: #94a3b8;
            margin-bottom: 10px;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 5px;
        }
        .info-p {
            margin: 3px 0;
            line-height: 1.5;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th {
            background: #28a745;
            color: white;
            text-align: left;
            padding: 12px;
            font-size: 11px;
            text-transform: uppercase;
        }
        td {
            padding: 12px;
            border-bottom: 1px solid #e2e8f0;
        }
        .total-row td {
            border-bottom: none;
            padding: 8px 12px;
        }
        .grand-total {
            background: #f8fafc;
            font-weight: bold;
            color: #28a745;
            font-size: 18px;
        }
        .footer {
            position: fixed;
            bottom: 30px;
            width: 100%;
            text-align: center;
            color: #94a3b8;
            font-size: 10px;
            border-top: 1px solid #e2e8f0;
            padding-top: 10px;
        }
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
        }
        .badge-success { background: #dcfce7; color: #166534; }
        .badge-warning { background: #fef9c3; color: #854d0e; }
    </style>
</head>
<body>
    @if($order)
    <div class="header">
        <div class="logo">
            {{-- Using base64 for logo to ensure it loads in PDF --}}
            @php
                $settingsLogo = DB::table('settings')->value('logo');
                $path = public_path(ltrim($settingsLogo, '/'));
                $base64 = '';
                if (file_exists($path) && is_file($path)) {
                    $type = pathinfo($path, PATHINFO_EXTENSION);
                    $data = file_get_contents($path);
                    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                }
            @endphp
            @if($base64)
                <img src="{{ $base64 }}" style="max-height: 60px;">
            @else
                <h1 style="color: #28a745; margin: 0;">{{ env('APP_NAME', 'KHAYRAT') }}</h1>
            @endif
        </div>
        <div class="order-info">
            <h2>FACTURE</h2>
            <p>Commande #{{$order->order_number}}</p>
            <p>Date: {{ $order->created_at->format('d/m/Y') }}</p>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="details-section">
        <div class="row">
            <div class="column">
                <div class="section-title">De</div>
                <p class="info-p"><strong>{{env('APP_NAME', 'KHAYRAT')}}</strong></p>
                <p class="info-p">{{env('APP_ADDRESS', 'Tunisie')}}</p>
                <p class="info-p">Tél: {{env('APP_PHONE', '+216')}}</p>
                <p class="info-p">Email: {{env('APP_EMAIL', 'contact@khayrat.tn')}}</p>
            </div>
            <div class="column">
                <div class="section-title">Facturé à</div>
                <p class="info-p"><strong>{{$order->first_name}} {{$order->last_name}}</strong></p>
                <p class="info-p">{{$order->address1}} {{ $order->address2 ? ', '.$order->address2 : '' }}</p>
                <p class="info-p">{{$order->post_code}} {{$order->country}}</p>
                <p class="info-p">Tél: {{ $order->phone }}</p>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="row" style="margin-top: 20px;">
            <div class="column">
                <div class="section-title">Paiement</div>
                <p class="info-p">Mode: {{ $order->payment_method == 'cod' ? 'Paiement à la livraison' : 'Paypal' }}</p>
                <p class="info-p">Statut: 
                    <span class="badge {{ $order->payment_status == 'paid' ? 'badge-success' : 'badge-warning' }}">
                        {{ $order->payment_status == 'paid' ? 'Payé' : 'En attente' }}
                    </span>
                </p>
            </div>
            <div class="column">
                <div class="section-title">Expédition</div>
                <p class="info-p">Statut: {{ $order->status == 'delivered' ? 'Livré' : ($order->status == 'shipped' ? 'Expédié' : ($order->status == 'process' ? 'En cours' : 'Nouveau')) }}</p>
            </div>
            <div class="clearfix"></div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Description du Produit</th>
                    <th style="text-align: center;">Prix Unitaire</th>
                    <th style="text-align: center;">Quantité</th>
                    <th style="text-align: right;">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->cart_info as $cart)
                <tr>
                    <td>
                        {{ $cart->product->title ?? 'Produit' }}
                    </td>
                    <td style="text-align: center;">{{ number_format($cart->price, 2) }} {{ Helper::base_currency() }}</td>
                    <td style="text-align: center;">{{ $cart->quantity }}</td>
                    <td style="text-align: right;">{{ number_format($cart->amount, 2) }} {{ Helper::base_currency() }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div style="float: right; width: 40%; margin-top: 20px;">
            <table style="border: none;">
                <tr class="total-row">
                    <td style="text-align: left; border: none;">Sous-total</td>
                    <td style="text-align: right; border: none;">{{ number_format($order->sub_total, 2) }} {{ Helper::base_currency() }}</td>
                </tr>
                <tr class="total-row">
                    @php
                        $shipping_price = $order->shipping->price ?? 0;
                    @endphp
                    <td style="text-align: left; border: none;">Livraison</td>
                    <td style="text-align: right; border: none;">{{ number_format($shipping_price, 2) }} {{ Helper::base_currency() }}</td>
                </tr>
                @if($order->coupon)
                <tr class="total-row">
                    <td style="text-align: left; border: none;">Remise (Coupon)</td>
                    <td style="text-align: right; border: none;">-{{ number_format($order->coupon, 2) }} {{ Helper::base_currency() }}</td>
                </tr>
                @endif
                <tr class="total-row grand-total">
                    <td style="text-align: left; border: none; padding: 15px 12px;">TOTAL</td>
                    <td style="text-align: right; border: none; padding: 15px 12px;">{{ number_format($order->total_amount, 2) }} {{ Helper::base_currency() }}</td>
                </tr>
            </table>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="footer">
        <p>&copy; {{ date('Y') }} {{ env('APP_NAME') }} - Tous droits réservés.</p>
        <p>Merci pour votre confiance !</p>
    </div>
    @endif
</body>
</html>
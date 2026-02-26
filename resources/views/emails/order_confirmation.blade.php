<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #334155;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }
        .header {
            background: linear-gradient(135deg, #28a745, #20c997);
            padding: 40px 20px;
            text-align: center;
            color: white;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
        }
        .content {
            padding: 30px;
        }
        .order-info {
            background: #f1f5f9;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 25px;
        }
        .order-info h2 {
            margin-top: 0;
            font-size: 18px;
            color: #1e293b;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th {
            text-align: left;
            border-bottom: 2px solid #e2e8f0;
            padding: 10px 0;
            color: #64748b;
            font-size: 14px;
            text-transform: uppercase;
        }
        .table td {
            padding: 12px 0;
            border-bottom: 1px solid #f1f5f9;
        }
        .total {
            text-align: right;
            font-size: 18px;
            font-weight: 700;
            color: #28a745;
            margin-top: 20px;
        }
        .footer {
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #94a3b8;
            background: #f8fafc;
        }
        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            background: #dcfce7;
            color: #166534;
            font-weight: 600;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Merci pour votre commande !</h1>
            <p>Commande #{{ $order->order_number }}</p>
        </div>
        <div class="content">
            <p>Bonjour {{ $order->first_name }},</p>
            <p>Nous avons bien reçu votre commande et nous commençons à la préparer avec soin.</p>

            <div class="order-info">
                <h2>Détails du paiement</h2>
                <p><strong>Mode de paiement :</strong> {{ $order->payment_method == 'cod' ? 'Paiement à la livraison' : $order->payment_method }}</p>
                <p><strong>Statut :</strong> <span class="badge">{{ $order->payment_status == 'paid' ? 'Payé' : 'En attente' }}</span></p>
            </div>

            <h2>Récapitulatif de la commande</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Qté</th>
                        <th style="text-align: right;">Prix</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->cart_info as $item)
                    <tr>
                        <td>{{ $item->product->title }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td style="text-align: right;">{{ number_format($item->amount, 2) }} TND</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="total">
                Total: {{ number_format($order->total_amount, 2) }} TND
            </div>

            <p style="margin-top: 30px;">
                <strong>Adresse de livraison :</strong><br>
                {{ $order->address1 }}<br>
                {{ $order->post_code }} {{ $order->country }}
            </p>
        </div>
        <div class="footer">
            <p>© {{ date('Y') }} KHAYRAT. Tous droits réservés.</p>
            <p>Si vous avez des questions, n'hésitez pas à nous contacter.</p>
        </div>
    </div>
</body>
</html>

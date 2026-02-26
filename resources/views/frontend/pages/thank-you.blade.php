@extends('frontend.layouts.master')

@section('title','KHAYRAT || Thank You')

@section('main-content')
<div class="thank-you-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="thank-you-content">
                    <div class="success-icon animated zoomIn">
                        <div class="check-mark">
                            <i class="fa fa-check"></i>
                        </div>
                    </div>
                    <h1 class="animated fadeInUp">Merci pour votre commande !</h1>
                    <p class="animated fadeInUp animate-delay-1s">Votre commande a été reçue et est en cours de traitement. Un email de confirmation vous a été envoyé.</p>
                    
                    @if(isset($order))
                    <div class="order-details animated fadeInUp animate-delay-2s">
                        <div class="detail-item">
                            <span>Numéro de commande</span>
                            <strong>#{{$order->order_number}}</strong>
                        </div>
                        <div class="detail-item">
                            <span>Montant total</span>
                            <strong>{{number_format($order->total_amount, 2)}} {{Helper::base_currency()}}</strong>
                        </div>
                        <div class="detail-item">
                            <span>Méthode de paiement</span>
                            <strong>{{strtoupper($order->payment_method)}}</strong>
                        </div>
                    </div>
                    @endif

                    <div class="action-buttons animated fadeInUp animate-delay-3s">
                        <a href="{{route('home')}}" class="btn-continue">Continuer mes achats</a>
                        <a href="{{route('user.order.index')}}" class="btn-orders">Voir mes commandes</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .thank-you-area {
        padding: 100px 0;
        background: #f8fafc;
        min-height: 70vh;
        display: flex;
        align-items: center;
    }

    .thank-you-content {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
        padding: 60px 40px;
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .success-icon {
        margin-bottom: 30px;
        display: flex;
        justify-content: center;
    }

    .check-mark {
        width: 100px;
        height: 100px;
        background: #27ae60;
        color: #fff;
        font-size: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        box-shadow: 0 10px 20px rgba(39, 174, 96, 0.3);
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(39, 174, 96, 0.4); }
        70% { transform: scale(1.05); box-shadow: 0 0 0 20px rgba(39, 174, 96, 0); }
        100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(39, 174, 96, 0); }
    }

    .thank-you-content h1 {
        font-size: 36px;
        font-weight: 700;
        color: #333;
        margin-bottom: 20px;
    }

    .thank-you-content p {
        font-size: 18px;
        color: #666;
        margin-bottom: 40px;
        line-height: 1.6;
    }

    .order-details {
        background: #fff;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 40px;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        border: 1px solid #edf2f7;
    }

    .detail-item {
        display: flex;
        flex-direction: column;
        border-right: 1px solid #edf2f7;
    }

    .detail-item:last-child {
        border-right: none;
    }

    .detail-item span {
        font-size: 12px;
        color: #a0aec0;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 5px;
    }

    .detail-item strong {
        font-size: 16px;
        color: #2d3748;
    }

    .action-buttons {
        display: flex;
        gap: 20px;
        justify-content: center;
    }

    /* Animation Delays */
    .animate-delay-1s { animation-delay: 0.5s; }
    .animate-delay-2s { animation-delay: 1s; }
    .animate-delay-3s { animation-delay: 1.5s; }

    .btn-continue, .btn-orders {
        padding: 15px 30px;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .btn-continue {
        background: #27ae60;
        color: #fff;
        border: none;
        box-shadow: 0 4px 14px rgba(39, 174, 96, 0.3);
    }

    .btn-continue:hover {
        background: #219150;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(39, 174, 96, 0.4);
        color: #fff;
        text-decoration: none;
    }

    .btn-orders {
        background: #fff;
        color: #27ae60;
        border: 2px solid #27ae60;
    }

    .btn-orders:hover {
        background: #f0fdf4;
        transform: translateY(-2px);
        color: #27ae60;
        text-decoration: none;
    }

    @media (max-width: 768px) {
        .order-details {
            grid-template-columns: 1fr;
            text-align: left;
        }
        .detail-item {
            border-right: none;
            border-bottom: 1px solid #edf2f7;
            padding-bottom: 10px;
        }
        .detail-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }
        .action-buttons {
            flex-direction: column;
        }
        .thank-you-content {
            padding: 40px 20px;
        }
    }
</style>

{{-- Confetti Effect --}}
<canvas id="canvas" style="position:fixed;top:0;left:0;width:100%;height:100%;pointer-events:none;z-index:9999"></canvas>

<script>
    // Simple confetti effect
    window.onload = function() {
        var canvas = document.getElementById("canvas");
        var ctx = canvas.getContext("2d");
        var W = window.innerWidth;
        var H = window.innerHeight;
        canvas.width = W;
        canvas.height = H;

        var mp = 150; // max particles
        var particles = [];
        for (var i = 0; i < mp; i++) {
            particles.push({
                x: Math.random() * W, // x-coordinate
                y: Math.random() * H, // y-coordinate
                r: Math.random() * 4 + 1, // radius
                d: Math.random() * mp, // density
                color: "rgba(" + Math.floor(Math.random() * 255) + ", " + Math.floor(Math.random() * 255) + ", " + Math.floor(Math.random() * 255) + ", 0.8)",
                tilt: Math.floor(Math.random() * 10) - 10,
                tiltAngleIncremental: Math.random() * 0.07 + 0.05,
                tiltAngle: 0
            });
        }

        function draw() {
            ctx.clearRect(0, 0, W, H);
            for (var i = 0; i < particles.length; i++) {
                var p = particles[i];
                ctx.beginPath();
                ctx.lineWidth = p.r;
                ctx.strokeStyle = p.color;
                ctx.moveTo(p.x + p.tilt + p.r / 2, p.y);
                ctx.lineTo(p.x + p.tilt, p.y + p.tilt + p.r / 2);
                ctx.stroke();
            }
            update();
        }

        var angle = 0;
        function update() {
            angle += 0.01;
            for (var i = 0; i < particles.length; i++) {
                var p = particles[i];
                p.y += Math.cos(angle + p.d) + 1 + p.r / 2;
                p.x += Math.sin(angle) * 2;
                p.tiltAngle += p.tiltAngleIncremental;
                p.tilt = Math.sin(p.tiltAngle) * 15;

                if (p.x > W + 5 || p.x < -5 || p.y > H) {
                    if (i % 3 > 0) {
                        particles[i] = { x: Math.random() * W, y: -10, r: p.r, d: p.d, color: p.color, tilt: p.tilt, tiltAngleIncremental: p.tiltAngleIncremental, tiltAngle: p.tiltAngle };
                    } else {
                        if (Math.sin(angle) > 0) {
                            particles[i] = { x: -5, y: Math.random() * H, r: p.r, d: p.d, color: p.color, tilt: p.tilt, tiltAngleIncremental: p.tiltAngleIncremental, tiltAngle: p.tiltAngle };
                        } else {
                            particles[i] = { x: W + 5, y: Math.random() * H, r: p.r, d: p.d, color: p.color, tilt: p.tilt, tiltAngleIncremental: p.tiltAngleIncremental, tiltAngle: p.tiltAngle };
                        }
                    }
                }
            }
        }

        var animation = setInterval(draw, 20);
        setTimeout(function() {
            clearInterval(animation);
            ctx.clearRect(0, 0, W, H);
        }, 5000); // Stop after 5 seconds
    };
</script>
@endsection

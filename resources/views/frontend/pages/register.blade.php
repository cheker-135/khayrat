@extends('frontend.layouts.master')

@section('title','Khayrat || Register Page')

@section('main-content')
    <!-- Register Section -->
    <section class="register-section">
        <div class="register-container">
            <div class="register-card">
                <!-- Left Form Panel -->
                <div class="form-panel">
                    <div class="form-header">
                        <div class="header-logo">
                            <span class="logo-icon">K</span>
                            <h2>Khayrat</h2>
                        </div>
                        <h3>Créer un compte</h3>
                        <p>Rejoignez notre communauté exclusive</p>
                    </div>
                    
                    <!-- Register Form -->
                    <form class="register-form" method="post" action="{{route('register.submit')}}">
                        @csrf
                        
                        <div class="form-group">
                            <label>Nom complet <span class="required">*</span></label>
                            <div class="input-with-icon">
                                <i class="ti-user"></i>
                                <input type="text" name="name" placeholder="Votre nom complet" required value="{{old('name')}}">
                            </div>
                            @error('name')
                                <div class="error-message">{{$message}}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label>Email <span class="required">*</span></label>
                            <div class="input-with-icon">
                                <i class="ti-email"></i>
                                <input type="email" name="email" placeholder="exemple@email.com" required value="{{old('email')}}">
                            </div>
                            @error('email')
                                <div class="error-message">{{$message}}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label>Mot de passe <span class="required">*</span></label>
                            <div class="input-with-icon">
                                <i class="ti-lock"></i>
                                <input type="password" name="password" placeholder="••••••••" required id="passwordInput">
                                <i class="ti-eye password-toggle" id="togglePassword"></i>
                            </div>
                            @error('password')
                                <div class="error-message">{{$message}}</div>
                            @enderror
                            <div class="password-strength">
                                <div class="strength-bar">
                                    <div class="strength-fill" id="strengthFill"></div>
                                </div>
                                <span class="strength-text" id="strengthText">Faible</span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>Confirmer le mot de passe <span class="required">*</span></label>
                            <div class="input-with-icon">
                                <i class="ti-lock"></i>
                                <input type="password" name="password_confirmation" placeholder="••••••••" required id="confirmPasswordInput">
                                <i class="ti-eye password-toggle" id="toggleConfirmPassword"></i>
                            </div>
                            @error('password_confirmation')
                                <div class="error-message">{{$message}}</div>
                            @enderror
                            <div class="password-match" id="passwordMatch"></div>
                        </div>
                        
                        <div class="form-actions">
                            <button type="submit" class="btn-register">
                                <i class="ti-user"></i>
                                <span>Créer mon compte</span>
                            </button>
                        </div>
                        
                        <div class="divider">
                            <span>Ou</span>
                        </div>
                        
                        <div class="social-login">
                            <a href="#" class="social-btn google">
                                <i class="ti-google"></i>
                                <span>Continuer avec Google</span>
                            </a>
                            <a href="#" class="social-btn facebook">
                                <i class="ti-facebook"></i>
                                <span>Continuer avec Facebook</span>
                            </a>
                        </div>
                        
                        <div class="form-footer">
                            <p>Vous avez déjà un compte ? <a href="{{route('login.form')}}" class="login-link">Se connecter</a></p>
                            <p class="terms">En vous inscrivant, vous acceptez nos <a href="#">Conditions d'utilisation</a> et notre <a href="#">Politique de confidentialité</a></p>
                        </div>
                    </form>
                </div>
                
                <!-- Right Brand Panel -->
                <div class="brand-panel">
                    <div class="brand-overlay"></div>
                    <div class="brand-content">
                        <div class="brand-quote">
                            <i class="ti-quote-left"></i>
                            <h3>Rejoignez plus de 10,000 membres satisfaits</h3>
                            <p>Découvrez une expérience shopping exceptionnelle avec Khayrat</p>
                        </div>
                        
                        <div class="brand-features">
                            <div class="feature">
                                <div class="feature-icon">
                                    <i class="ti-truck"></i>
                                </div>
                                <div class="feature-text">
                                    <h4>Livraison Rapide</h4>
                                    <p>Livraison gratuite dès 50€ d'achat</p>
                                </div>
                            </div>
                            
                            <div class="feature">
                                <div class="feature-icon">
                                    <i class="ti-shield"></i>
                                </div>
                                <div class="feature-text">
                                    <h4>Paiement Sécurisé</h4>
                                    <p>Transactions 100% sécurisées</p>
                                </div>
                            </div>
                            
                            <div class="feature">
                                <div class="feature-icon">
                                    <i class="ti-headphone-alt"></i>
                                </div>
                                <div class="feature-text">
                                    <h4>Support 24/7</h4>
                                    <p>Notre équipe vous assiste à tout moment</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="testimonial">
                            <div class="testimonial-content">
                                <p>"Khayrat a transformé mon expérience d'achat en ligne. Service impeccable et produits de qualité!"</p>
                            </div>
                            <div class="testimonial-author">
                                <img src="https://ui-avatars.com/api/?name=Marie+L&background=28a745&color=fff" alt="Marie L.">
                                <div>
                                    <h5>Marie L.</h5>
                                    <span>Membre depuis 2022</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    /* Base Styles */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        min-height: 100vh;
        
        justify-content: center;
      
        color: #334155;
    }

    /* Main Container */
    .register-section {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 0;
    }

    .register-container {
        width: 100%;
        max-width: 1000px;
        margin: 0 auto;
    }

    /* Card Container */
    .register-card {
        display: flex;
        background: white;
        border-radius: 24px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        height: auto;
        min-height: 620px;
        max-width: 950px;
        margin: 0 auto;
        transition: transform 0.3s ease;
    }

    .register-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 32px 64px -12px rgba(0, 0, 0, 0.12);
    }

    /* Form Panel */
    .form-panel {
        flex: 1;
        padding: 48px;
        display: flex;
        flex-direction: column;
        background: white;
        min-width: 450px;
    }

    .form-header {
        margin-bottom: 40px;
        text-align: center;
    }

    .header-logo {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        margin-bottom: 20px;
    }

    .logo-icon {
        width: 42px;
        height: 42px;
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 1.5rem;
        box-shadow: 0 4px 12px rgba(40, 167, 69, 0.2);
    }

    .header-logo h2 {
        font-size: 1.8rem;
        font-weight: 700;
        color: #1e293b;
        letter-spacing: -0.5px;
    }

    .form-header h3 {
        font-size: 2rem;
        color: #1e293b;
        margin-bottom: 8px;
        font-weight: 700;
    }

    .form-header p {
        color: #64748b;
        font-size: 1rem;
        line-height: 1.5;
    }

    /* Form Elements */
    .register-form {
        width: 100%;
    }

    .form-group {
        margin-bottom: 24px;
        animation: slideUp 0.5s ease forwards;
        opacity: 0;
        transform: translateY(10px);
    }

    @keyframes slideUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .form-group label {
        display: block;
        color: #475569;
        font-weight: 600;
        font-size: 0.875rem;
        margin-bottom: 8px;
        letter-spacing: -0.2px;
    }

    .required {
        color: #ef4444;
    }

    .input-with-icon {
        position: relative;
        transition: transform 0.2s ease;
    }

    .input-with-icon:focus-within {
        transform: translateY(-1px);
    }

    .input-with-icon i:first-of-type {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #28a745;
        font-size: 1.1rem;
        z-index: 1;
    }

    .input-with-icon input {
        width: 100%;
        padding: 14px 16px 14px 48px;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 0.95rem;
        color: #1e293b;
        background: #f8fafc;
        transition: all 0.2s ease;
        font-family: inherit;
        height: 52px;
    }

    .input-with-icon input:focus {
        outline: none;
        border-color: #28a745;
        background: white;
        box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.1);
    }

    .input-with-icon input::placeholder {
        color: #94a3b8;
    }

    .password-toggle {
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        cursor: pointer;
        font-size: 1.1rem;
        transition: color 0.2s ease;
        z-index: 1;
        background: none;
        border: none;
        padding: 4px;
    }

    .password-toggle:hover {
        color: #28a745;
    }

    .error-message {
        color: #ef4444;
        font-size: 0.75rem;
        margin-top: 6px;
        padding-left: 4px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .error-message::before {
        content: "⚠";
        font-size: 0.875rem;
    }

    /* Password Strength */
    .password-strength {
        margin-top: 8px;
        display: flex;
        align-items: center;
        gap: 12px;
        height: 20px;
    }

    .strength-bar {
        flex: 1;
        height: 6px;
        background: #e2e8f0;
        border-radius: 3px;
        overflow: hidden;
    }

    .strength-fill {
        height: 100%;
        width: 0%;
        border-radius: 3px;
        transition: all 0.3s ease;
    }

    .strength-text {
        font-size: 0.75rem;
        font-weight: 600;
        min-width: 60px;
        text-align: right;
    }

    .password-match {
        margin-top: 6px;
        font-size: 0.75rem;
        font-weight: 500;
        min-height: 20px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    /* Register Button */
    .form-actions {
        margin-top: 32px;
    }

    .btn-register {
        width: 100%;
        padding: 16px;
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.2);
        height: 52px;
    }

    .btn-register:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(40, 167, 69, 0.3);
        background: linear-gradient(135deg, #23923d 0%, #1db489 100%);
    }

    .btn-register:active {
        transform: translateY(0);
    }

    /* Divider */
    .divider {
        display: flex;
        align-items: center;
        margin: 28px 0;
        color: #94a3b8;
        font-size: 0.875rem;
    }

    .divider::before,
    .divider::after {
        content: "";
        flex: 1;
        height: 1px;
        background: #e2e8f0;
    }

    .divider span {
        padding: 0 16px;
    }

    /* Social Login */
    .social-login {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-bottom: 28px;
    }

    .social-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        padding: 14px;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        background: white;
        color: #475569;
        font-weight: 600;
        font-size: 0.95rem;
        text-decoration: none;
        transition: all 0.2s ease;
        height: 52px;
    }

    .social-btn:hover {
        border-color: #28a745;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .social-btn i {
        font-size: 1.2rem;
    }

    .social-btn.google:hover {
        border-color: #4285f4;
        color: #4285f4;
    }

    .social-btn.facebook:hover {
        border-color: #1877f2;
        color: #1877f2;
    }

    /* Form Footer */
    .form-footer {
        text-align: center;
        padding-top: 24px;
        border-top: 1px solid #e2e8f0;
    }

    .form-footer p {
        color: #64748b;
        font-size: 0.875rem;
        line-height: 1.5;
    }

    .form-footer .terms {
        margin-top: 12px;
        font-size: 0.75rem;
        color: #94a3b8;
    }

    .login-link {
        color: #28a745;
        font-weight: 600;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .login-link:hover {
        color: #1e7e34;
        text-decoration: underline;
    }

    .form-footer a {
        color: #28a745;
        text-decoration: none;
    }

    .form-footer a:hover {
        text-decoration: underline;
    }

    /* Brand Panel */
    .brand-panel {
        flex: 1;
        background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
        position: relative;
        overflow: hidden;
        padding: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 400px;
    }

    .brand-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%2328a745' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
    }

    .brand-content {
        position: relative;
        z-index: 2;
        color: white;
        width: 100%;
        max-width: 380px;
    }

    .brand-quote {
        text-align: center;
        margin-bottom: 48px;
    }

    .brand-quote i {
        font-size: 2.5rem;
        color: #28a745;
        opacity: 0.8;
        margin-bottom: 20px;
        display: block;
    }

    .brand-quote h3 {
        font-size: 1.8rem;
        font-weight: 600;
        margin-bottom: 16px;
        line-height: 1.3;
        color: #ffffff;
    }

    .brand-quote p {
        font-size: 1rem;
        opacity: 0.8;
        line-height: 1.5;
        color: #cbd5e1;
    }

    .brand-features {
        margin-bottom: 48px;
    }

    .feature {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 24px;
        padding: 16px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 12px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
    }

    .feature:hover {
        background: rgba(255, 255, 255, 0.08);
        transform: translateX(8px);
    }

    .feature-icon {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .feature-icon i {
        font-size: 1.5rem;
        color: white;
    }

    .feature-text h4 {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 4px;
        color: white;
    }

    .feature-text p {
        font-size: 0.875rem;
        opacity: 0.8;
        color: #cbd5e1;
        line-height: 1.4;
    }

    .testimonial {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 16px;
        padding: 24px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .testimonial-content {
        margin-bottom: 20px;
    }

    .testimonial-content p {
        font-style: italic;
        line-height: 1.6;
        color: #e2e8f0;
        font-size: 0.95rem;
        position: relative;
        padding-left: 20px;
    }

    .testimonial-content p::before {
        content: "''";
        position: absolute;
        left: 0;
        top: -8px;
        font-size: 3rem;
        color: #28a745;
        opacity: 0.3;
        font-family: serif;
        line-height: 1;
    }

    .testimonial-author {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .testimonial-author img {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        border: 2px solid #28a745;
    }

    .testimonial-author h5 {
        font-size: 1rem;
        font-weight: 600;
        color: white;
        margin-bottom: 2px;
    }

    .testimonial-author span {
        font-size: 0.75rem;
        color: #94a3b8;
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .register-container {
            max-width: 900px;
        }
        
        .register-card {
            max-width: 850px;
        }
        
        .form-panel {
            min-width: 420px;
            padding: 40px;
        }
        
        .brand-panel {
            min-width: 380px;
            padding: 40px;
        }
    }

    @media (max-width: 880px) {
        .register-card {
            flex-direction: column;
            max-width: 480px;
            min-height: auto;
        }
        
        .form-panel,
        .brand-panel {
            min-width: 100%;
            padding: 40px 32px;
        }
        
        .brand-panel {
            padding-top: 60px;
            padding-bottom: 60px;
        }
        
        .brand-content {
            max-width: 420px;
            margin: 0 auto;
        }
        
        body {
            padding: 16px;
        }
    }

    @media (max-width: 480px) {
        .register-container {
            padding: 0;
        }
        
        .register-card {
            border-radius: 16px;
            margin: 8px;
        }
        
        .form-panel,
        .brand-panel {
            padding: 32px 24px;
        }
        
        .form-header h3 {
            font-size: 1.75rem;
        }
        
        .form-header p {
            font-size: 0.95rem;
        }
        
        .brand-quote h3 {
            font-size: 1.5rem;
        }
        
        .social-btn {
            font-size: 0.9rem;
        }
        
        .feature {
            padding: 12px;
        }
        
        .testimonial {
            padding: 20px;
        }
    }

    @media (max-width: 360px) {
        .form-panel {
            padding: 24px 20px;
        }
        
        .input-with-icon input {
            padding: 12px 16px 12px 44px;
            height: 48px;
        }
        
        .btn-register,
        .social-btn {
            height: 48px;
        }
    }

    /* Animation Delays */
    .form-group:nth-child(1) { animation-delay: 0.1s; }
    .form-group:nth-child(2) { animation-delay: 0.2s; }
    .form-group:nth-child(3) { animation-delay: 0.3s; }
    .form-group:nth-child(4) { animation-delay: 0.4s; }
    .form-actions { animation: slideUp 0.5s ease 0.5s forwards; opacity: 0; transform: translateY(10px); }
    .divider { animation: slideUp 0.5s ease 0.6s forwards; opacity: 0; transform: translateY(10px); }
    .social-login { animation: slideUp 0.5s ease 0.7s forwards; opacity: 0; transform: translateY(10px); }
    .form-footer { animation: slideUp 0.5s ease 0.8s forwards; opacity: 0; transform: translateY(10px); }

    /* Success/Error States */
    .match-success {
        color: #28a745;
        font-weight: 600;
    }

    .match-success::before {
        content: "✓";
        display: inline-block;
        margin-right: 4px;
    }

    .match-error {
        color: #ef4444;
        font-weight: 600;
    }

    .match-error::before {
        content: "✗";
        display: inline-block;
        margin-right: 4px;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Password visibility toggles
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('passwordInput');
        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
        const confirmPasswordInput = document.getElementById('confirmPasswordInput');
        
        // Toggle main password
        if (togglePassword && passwordInput) {
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.classList.toggle('ti-eye');
                this.classList.toggle('ti-eye-off');
            });
        }
        
        // Toggle confirm password
        if (toggleConfirmPassword && confirmPasswordInput) {
            toggleConfirmPassword.addEventListener('click', function() {
                const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                confirmPasswordInput.setAttribute('type', type);
                this.classList.toggle('ti-eye');
                this.classList.toggle('ti-eye-off');
            });
        }
        
        // Password strength checker
        if (passwordInput) {
            const strengthFill = document.getElementById('strengthFill');
            const strengthText = document.getElementById('strengthText');
            
            passwordInput.addEventListener('input', function() {
                const password = this.value;
                let strength = 0;
                
                // Length check
                if (password.length >= 8) strength += 20;
                if (password.length >= 12) strength += 20;
                
                // Lowercase check
                if (/[a-z]/.test(password)) strength += 20;
                
                // Uppercase check
                if (/[A-Z]/.test(password)) strength += 20;
                
                // Number/Special char check
                if (/[0-9]/.test(password)) strength += 20;
                if (/[^A-Za-z0-9]/.test(password)) strength += 20;
                
                // Cap at 100
                strength = Math.min(strength, 100);
                
                // Update strength bar
                strengthFill.style.width = strength + '%';
                
                // Update strength text and color
                if (strength < 40) {
                    strengthFill.style.background = '#ef4444';
                    strengthText.textContent = 'Faible';
                    strengthText.style.color = '#ef4444';
                } else if (strength < 70) {
                    strengthFill.style.background = '#f59e0b';
                    strengthText.textContent = 'Moyen';
                    strengthText.style.color = '#f59e0b';
                } else {
                    strengthFill.style.background = '#28a745';
                    strengthText.textContent = 'Fort';
                    strengthText.style.color = '#28a745';
                }
            });
        }
        
        // Password match checker
        if (passwordInput && confirmPasswordInput) {
            const passwordMatch = document.getElementById('passwordMatch');
            
            confirmPasswordInput.addEventListener('input', checkPasswordMatch);
            passwordInput.addEventListener('input', checkPasswordMatch);
            
            function checkPasswordMatch() {
                const password = passwordInput.value;
                const confirm = confirmPasswordInput.value;
                
                if (confirm === '') {
                    passwordMatch.textContent = '';
                    passwordMatch.className = 'password-match';
                    return;
                }
                
                if (password === confirm) {
                    passwordMatch.textContent = 'Les mots de passe correspondent';
                    passwordMatch.className = 'password-match match-success';
                } else {
                    passwordMatch.textContent = 'Les mots de passe ne correspondent pas';
                    passwordMatch.className = 'password-match match-error';
                }
            }
        }
        
        // Form submission loading state
        const registerForm = document.querySelector('.register-form');
        if (registerForm) {
            registerForm.addEventListener('submit', function(e) {
                const submitBtn = this.querySelector('.btn-register');
                if (submitBtn) {
                    submitBtn.innerHTML = '<i class="ti-loader spinner"></i><span>Création du compte...</span>';
                    submitBtn.disabled = true;
                    submitBtn.style.opacity = '0.8';
                }
            });
        }
        
        // Add loading spinner style
        const style = document.createElement('style');
        style.textContent = `
            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
            .ti-loader.spinner {
                animation: spin 1s linear infinite;
                display: inline-block;
            }
        `;
        document.head.appendChild(style);
        
        // Input focus effects
        const inputs = document.querySelectorAll('.input-with-icon input');
        inputs.forEach((input, index) => {
            // Set animation delay based on index
            input.parentElement.parentElement.style.animationDelay = `${0.1 + (index * 0.1)}s`;
            
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateY(-1px)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'translateY(0)';
            });
        });
        
        // Feature hover animations
        const features = document.querySelectorAll('.feature');
        features.forEach(feature => {
            feature.addEventListener('mouseenter', function() {
                this.style.transform = 'translateX(8px)';
            });
            
            feature.addEventListener('mouseleave', function() {
                this.style.transform = 'translateX(0)';
            });
        });
        
        // Add subtle pulse animation to register button
        const registerBtn = document.querySelector('.btn-register');
        if (registerBtn) {
            setInterval(() => {
                if (!registerBtn.disabled) {
                    registerBtn.style.boxShadow = '0 4px 20px rgba(40, 167, 69, 0.25)';
                    setTimeout(() => {
                        registerBtn.style.boxShadow = '0 4px 15px rgba(40, 167, 69, 0.2)';
                    }, 1000);
                }
            }, 3000);
        }
    });
</script>
@endpush
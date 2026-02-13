@extends('frontend.layouts.master')

@section('title','Khayrat || Contactez-nous')

@section('main-content')
    <!-- Contact Header -->
    <section class="contact-hero">
        <div class="container">
            <div class="hero-content">
                <h1>Contactez-nous</h1>
                <p>Nous sommes là pour vous aider. Faites-nous part de vos questions, suggestions ou préoccupations.</p>
                <div class="hero-breadcrumb">
                    <a href="{{route('home')}}">Accueil</a>
                    <i class="ti-arrow-right"></i>
                    <span>Contact</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="container">
            <div class="contact-container">
                <!-- Left Contact Form -->
                <div class="contact-form-card">
                    <div class="form-header">
                        <div class="header-icon">
                            <i class="ti-email"></i>
                        </div>
                        <h2>Envoyez-nous un message</h2>
                        <p>Remplissez le formulaire ci-dessous et nous vous répondrons dans les plus brefs délais</p>
                        @auth 
                        @else
                        <div class="login-alert">
                            <i class="ti-info-alt"></i>
                            <span>Vous devez vous connecter pour nous contacter</span>
                        </div>
                        @endauth
                    </div>
                    
                    <form class="contact-form" method="post" action="{{route('contact.store')}}" id="contactForm">
                        @csrf
                        <div class="form-grid">
                            <div class="form-group">
                                <label>Votre Nom <span class="required">*</span></label>
                                <div class="input-with-icon">
                                    <i class="ti-user"></i>
                                    <input name="name" id="name" type="text" placeholder="Votre nom complet" @guest disabled @endguest>
                                </div>
                                <div class="error-message" id="nameError"></div>
                            </div>
                            
                            <div class="form-group">
                                <label>Votre Email <span class="required">*</span></label>
                                <div class="input-with-icon">
                                    <i class="ti-email"></i>
                                    <input name="email" type="email" id="email" placeholder="votre@email.com" @guest disabled @endguest>
                                </div>
                                <div class="error-message" id="emailError"></div>
                            </div>
                            
                            <div class="form-group">
                                <label>Objet <span class="required">*</span></label>
                                <div class="input-with-icon">
                                    <i class="ti-bookmark"></i>
                                    <input name="subject" type="text" id="subject" placeholder="Sujet de votre message" @guest disabled @endguest>
                                </div>
                                <div class="error-message" id="subjectError"></div>
                            </div>
                            
                            <div class="form-group">
                                <label>Téléphone <span class="required">*</span></label>
                                <div class="input-with-icon">
                                    <i class="ti-mobile"></i>
                                    <input id="phone" name="phone" type="tel" placeholder="Votre numéro de téléphone" @guest disabled @endguest>
                                </div>
                                <div class="error-message" id="phoneError"></div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>Votre Message <span class="required">*</span></label>
                            <div class="textarea-wrapper">
                                <i class="ti-comment-alt"></i>
                                <textarea name="message" id="message" cols="30" rows="6" placeholder="Décrivez-nous votre demande en détail..." @guest disabled @endguest></textarea>
                            </div>
                            <div class="error-message" id="messageError"></div>
                            <div class="char-counter">
                                <span id="charCount">0</span> / 500 caractères
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            @auth
                            <button type="submit" class="btn-send">
                                <i class="ti-email"></i>
                                <span>Envoyer le message</span>
                            </button>
                            @else
                            <a href="{{route('login.form')}}" class="btn-login-first">
                                <i class="ti-lock"></i>
                                <span>Se connecter pour envoyer</span>
                            </a>
                            @endauth
                        </div>
                    </form>
                </div>
                
                <!-- Right Contact Info -->
                <div class="contact-info-card">
                    <div class="info-header">
                        <div class="header-icon">
                            <i class="ti-headphone-alt"></i>
                        </div>
                        <h2>Informations de contact</h2>
                        <p>Nous sommes disponibles pour vous aider de plusieurs façons</p>
                    </div>
                    
                    <div class="contact-methods">
                        @php
                            $settings=DB::table('settings')->first();
                        @endphp
                        
                        <div class="contact-method">
                            <div class="method-icon">
                                <i class="ti-mobile"></i>
                            </div>
                            <div class="method-content">
                                <h4>Téléphone</h4>
                                <p>Appelez-nous pour une assistance rapide</p>
                                <a href="tel:{{$settings->phone}}" class="contact-link">{{$settings->phone}}</a>
                            </div>
                        </div>
                        
                        <div class="contact-method">
                            <div class="method-icon">
                                <i class="ti-email"></i>
                            </div>
                            <div class="method-content">
                                <h4>Email</h4>
                                <p>Écrivez-nous pour toute question</p>
                                <a href="mailto:{{$settings->email}}" class="contact-link">{{$settings->email}}</a>
                            </div>
                        </div>
                        
                        <div class="contact-method">
                            <div class="method-icon">
                                <i class="ti-location-pin"></i>
                            </div>
                            <div class="method-content">
                                <h4>Adresse</h4>
                                <p>Visitez-nous à notre bureau principal</p>
                                <span class="contact-address">{{$settings->address}}</span>
                            </div>
                        </div>
                        
                        <div class="contact-method">
                            <div class="method-icon">
                                <i class="ti-time"></i>
                            </div>
                            <div class="method-content">
                                <h4>Horaires d'ouverture</h4>
                                <p>Nous sommes disponibles pour vous aider</p>
                                <div class="hours-list">
                                    <div class="hour-item">
                                        <span>Lun - Ven</span>
                                        <span>9h00 - 18h00</span>
                                    </div>
                                    <div class="hour-item">
                                        <span>Samedi</span>
                                        <span>10h00 - 16h00</span>
                                    </div>
                                    <div class="hour-item">
                                        <span>Dimanche</span>
                                        <span>Fermé</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="social-contact">
                        <h4>Suivez-nous sur les réseaux</h4>
                        <div class="social-links">
                            <a href="#" class="social-link facebook">
                                <i class="ti-facebook"></i>
                            </a>
                            <a href="#" class="social-link twitter">
                                <i class="ti-twitter-alt"></i>
                            </a>
                            <a href="#" class="social-link instagram">
                                <i class="ti-instagram"></i>
                            </a>
                            <a href="#" class="social-link linkedin">
                                <i class="ti-linkedin"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="map-section">
        <div class="container">
            <div class="section-header">
                <h2>Où nous trouver</h2>
                <p>Visitez notre bureau ou suivez les directions</p>
            </div>
            <div class="map-container">
                <div class="map-wrapper">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d14130.857353934944!2d85.36529494999999!3d27.6952226!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sne!2snp!4v1595323330171!5m2!1sne!2snp" 
                        width="100%" 
                        height="450" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                <div class="map-actions">
                    <a href="https://maps.google.com/?q={{urlencode($settings->address)}}" target="_blank" class="btn-directions">
                        <i class="ti-direction-alt"></i>
                        <span>Obtenir l'itinéraire</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="container">
            <div class="section-header">
                <h2>Questions fréquentes</h2>
                <p>Trouvez rapidement des réponses à vos questions</p>
            </div>
            <div class="faq-grid">
                <div class="faq-item">
                    <div class="faq-question">
                        <i class="ti-truck"></i>
                        <h4>Quels sont les délais de livraison ?</h4>
                    </div>
                    <div class="faq-answer">
                        <p>Les délais de livraison varient entre 2 et 5 jours ouvrables selon votre localisation. Pour les commandes express, contactez notre service client.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <i class="ti-shield"></i>
                        <h4>Comment retourner un produit ?</h4>
                    </div>
                    <div class="faq-answer">
                        <p>Vous avez 30 jours pour retourner un produit. Contactez notre service client pour obtenir un bon de retour et les instructions.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <i class="ti-credit-card"></i>
                        <h4>Quels modes de paiement acceptez-vous ?</h4>
                    </div>
                    <div class="faq-answer">
                        <p>Nous acceptons les cartes bancaires (Visa, Mastercard), PayPal, et les virements bancaires.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <i class="ti-headphone-alt"></i>
                        <h4>Comment contacter le support technique ?</h4>
                    </div>
                    <div class="faq-answer">
                        <p>Notre support technique est disponible par téléphone du lundi au vendredi, de 9h à 18h, ou par email à tout moment.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    @include('frontend.layouts.newsletter')

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content success-modal">
                <div class="modal-body">
                    <div class="success-icon">
                        <i class="ti-check"></i>
                    </div>
                    <h3>Message envoyé !</h3>
                    <p>Votre message a été envoyé avec succès. Nous vous répondrons dans les plus brefs délais.</p>
                    <button type="button" class="btn-close-modal" data-dismiss="modal">Continuer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content error-modal">
                <div class="modal-body">
                    <div class="error-icon">
                        <i class="ti-close"></i>
                    </div>
                    <h3>Erreur d'envoi</h3>
                    <p>Une erreur s'est produite lors de l'envoi de votre message. Veuillez réessayer.</p>
                    <button type="button" class="btn-close-modal" data-dismiss="modal">Réessayer</button>
                </div>
            </div>
        </div>
    </div>
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
        color: #334155;
        background: #f8fafc;
    }

    /* Contact Hero */
    .contact-hero {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        padding: 80px 0 60px;
        color: white;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .contact-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M50 50c0-5.523 4.477-10 10-10s10 4.477 10 10-4.477 10-10 10c0 5.523-4.477 10-10 10s-10-4.477-10-10 4.477-10 10-10zM10 10c0-5.523 4.477-10 10-10s10 4.477 10 10-4.477 10-10 10c0 5.523-4.477 10-10 10S0 25.523 0 20s4.477-10 10-10zm10 8c4.418 0 8-3.582 8-8s-3.582-8-8-8-8 3.582-8 8 3.582 8 8 8zm40 40c4.418 0 8-3.582 8-8s-3.582-8-8-8-8 3.582-8 8 3.582 8 8 8z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }

    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 800px;
        margin: 0 auto;
    }

    .contact-hero h1 {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 20px;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .contact-hero p {
        font-size: 1.2rem;
        opacity: 0.95;
        line-height: 1.6;
        margin-bottom: 30px;
    }

    .hero-breadcrumb {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        font-size: 1rem;
    }

    .hero-breadcrumb a {
        color: white;
        text-decoration: none;
        opacity: 0.9;
        transition: opacity 0.2s ease;
    }

    .hero-breadcrumb a:hover {
        opacity: 1;
        text-decoration: underline;
    }

    .hero-breadcrumb i {
        font-size: 0.8rem;
        opacity: 0.7;
    }

    .hero-breadcrumb span {
        color: rgba(255, 255, 255, 0.9);
        font-weight: 500;
    }

    /* Contact Section */
    .contact-section {
        padding: 80px 0;
        background: #f8fafc;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .contact-container {
        display: flex;
        gap: 40px;
        max-width: 1200px;
        margin: 0 auto;
    }

    @media (max-width: 992px) {
        .contact-container {
            flex-direction: column;
        }
    }

    /* Contact Form Card */
    .contact-form-card {
        flex: 1.2;
        background: white;
        border-radius: 24px;
        padding: 48px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .contact-form-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.08);
    }

    .form-header {
        margin-bottom: 40px;
    }

    .header-icon {
        width: 64px;
        height: 64px;
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 24px;
    }

    .header-icon i {
        font-size: 1.8rem;
        color: white;
    }

    .form-header h2 {
        font-size: 2rem;
        color: #1e293b;
        margin-bottom: 12px;
        font-weight: 700;
    }

    .form-header p {
        color: #64748b;
        font-size: 1rem;
        line-height: 1.6;
        margin-bottom: 16px;
    }

    .login-alert {
        display: flex;
        align-items: center;
        gap: 10px;
        background: #fef3c7;
        border: 1px solid #fbbf24;
        border-radius: 12px;
        padding: 12px 16px;
        color: #92400e;
        font-size: 0.9rem;
    }

    .login-alert i {
        color: #f59e0b;
        font-size: 1.2rem;
    }

    /* Contact Form */
    .contact-form {
        width: 100%;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 24px;
        margin-bottom: 24px;
    }

    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
    }

    .form-group {
        margin-bottom: 24px;
    }

    .form-group label {
        display: block;
        color: #475569;
        font-weight: 600;
        font-size: 0.875rem;
        margin-bottom: 8px;
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

    .input-with-icon i {
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

    .input-with-icon input:disabled {
        background: #f1f5f9;
        border-color: #cbd5e1;
        color: #94a3b8;
        cursor: not-allowed;
    }

    .input-with-icon input::placeholder {
        color: #94a3b8;
    }

    .textarea-wrapper {
        position: relative;
    }

    .textarea-wrapper i {
        position: absolute;
        left: 16px;
        top: 20px;
        color: #28a745;
        font-size: 1.1rem;
        z-index: 1;
    }

    .textarea-wrapper textarea {
        width: 100%;
        padding: 16px 20px 16px 48px;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 0.95rem;
        color: #1e293b;
        background: #f8fafc;
        transition: all 0.2s ease;
        font-family: inherit;
        resize: vertical;
    }

    .textarea-wrapper textarea:focus {
        outline: none;
        border-color: #28a745;
        background: white;
        box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.1);
    }

    .textarea-wrapper textarea:disabled {
        background: #f1f5f9;
        border-color: #cbd5e1;
        color: #94a3b8;
        cursor: not-allowed;
    }

    .error-message {
        color: #ef4444;
        font-size: 0.75rem;
        margin-top: 6px;
        padding-left: 4px;
        display: flex;
        align-items: center;
        gap: 4px;
        min-height: 20px;
    }

    .error-message::before {
        content: "⚠";
        font-size: 0.875rem;
    }

    .char-counter {
        text-align: right;
        font-size: 0.75rem;
        color: #64748b;
        margin-top: 6px;
    }

    /* Form Actions */
    .form-actions {
        margin-top: 32px;
    }

    .btn-send {
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

    .btn-send:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(40, 167, 69, 0.3);
        background: linear-gradient(135deg, #23923d 0%, #1db489 100%);
    }

    .btn-login-first {
        width: 100%;
        padding: 16px;
        background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
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
        box-shadow: 0 4px 15px rgba(30, 41, 59, 0.2);
        text-decoration: none;
        height: 52px;
    }

    .btn-login-first:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(30, 41, 59, 0.3);
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
    }

    /* Contact Info Card */
    .contact-info-card {
        flex: 1;
        background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
        border-radius: 24px;
        padding: 48px;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .contact-info-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%2328a745' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
    }

    .info-header {
        position: relative;
        z-index: 2;
        margin-bottom: 40px;
    }

    .contact-info-card .header-icon {
        background: rgba(255, 255, 255, 0.1);
    }

    .contact-info-card .header-icon i {
        color: #28a745;
    }

    .contact-info-card h2 {
        font-size: 1.8rem;
        margin-bottom: 12px;
        font-weight: 600;
    }

    .contact-info-card p {
        font-size: 1rem;
        opacity: 0.8;
        line-height: 1.6;
    }

    /* Contact Methods */
    .contact-methods {
        position: relative;
        z-index: 2;
        margin-bottom: 40px;
    }

    .contact-method {
        display: flex;
        align-items: flex-start;
        gap: 20px;
        margin-bottom: 30px;
        padding: 20px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 16px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
    }

    .contact-method:hover {
        background: rgba(255, 255, 255, 0.08);
        transform: translateX(5px);
    }

    .method-icon {
        width: 56px;
        height: 56px;
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .method-icon i {
        font-size: 1.5rem;
        color: white;
    }

    .method-content {
        flex: 1;
    }

    .method-content h4 {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 8px;
        color: white;
    }

    .method-content p {
        font-size: 0.9rem;
        opacity: 0.8;
        margin-bottom: 8px;
        color: #cbd5e1;
    }

    .contact-link {
        display: block;
        color: #28a745;
        font-weight: 600;
        text-decoration: none;
        transition: color 0.2s ease;
        font-size: 1rem;
    }

    .contact-link:hover {
        color: #20c997;
        text-decoration: underline;
    }

    .contact-address {
        display: block;
        color: #cbd5e1;
        font-size: 1rem;
        line-height: 1.5;
    }

    .hours-list {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .hour-item {
        display: flex;
        justify-content: space-between;
        font-size: 0.9rem;
        color: #cbd5e1;
    }

    .hour-item span:first-child {
        opacity: 0.8;
    }

    /* Social Contact */
    .social-contact {
        position: relative;
        z-index: 2;
        padding-top: 30px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .social-contact h4 {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 20px;
        color: white;
        text-align: center;
    }

    .social-links {
        display: flex;
        justify-content: center;
        gap: 16px;
    }

    .social-link {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-decoration: none;
        font-size: 1.3rem;
        transition: all 0.3s ease;
    }

    .social-link.facebook {
        background: #1877f2;
    }

    .social-link.twitter {
        background: #1da1f2;
    }

    .social-link.instagram {
        background: linear-gradient(45deg, #405de6, #5851db, #833ab4, #c13584, #e1306c, #fd1d1d);
    }

    .social-link.linkedin {
        background: #0a66c2;
    }

    .social-link:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    /* Map Section */
    .map-section {
        padding: 80px 0;
        background: white;
    }

    .section-header {
        text-align: center;
        margin-bottom: 48px;
    }

    .section-header h2 {
        font-size: 2.5rem;
        color: #1e293b;
        margin-bottom: 12px;
        font-weight: 700;
    }

    .section-header p {
        color: #64748b;
        font-size: 1.1rem;
        line-height: 1.6;
    }

    .map-container {
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
    }

    .map-wrapper {
        width: 100%;
        height: 450px;
    }

    .map-actions {
        padding: 24px;
        background: #f8fafc;
        text-align: center;
    }

    .btn-directions {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 14px 32px;
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.2);
    }

    .btn-directions:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(40, 167, 69, 0.3);
        background: linear-gradient(135deg, #23923d 0%, #1db489 100%);
    }

    /* FAQ Section */
    .faq-section {
        padding: 80px 0;
        background: #f8fafc;
    }

    .faq-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 30px;
        max-width: 1000px;
        margin: 0 auto;
    }

    @media (max-width: 768px) {
        .faq-grid {
            grid-template-columns: 1fr;
        }
    }

    .faq-item {
        background: white;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .faq-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    .faq-question {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 20px;
    }

    .faq-question i {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.3rem;
        flex-shrink: 0;
    }

    .faq-question h4 {
        font-size: 1.2rem;
        color: #1e293b;
        font-weight: 600;
        line-height: 1.4;
    }

    .faq-answer p {
        color: #64748b;
        line-height: 1.6;
        font-size: 0.95rem;
    }

    /* Modals */
    .success-modal, .error-modal {
        border: none;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
    }

    .success-modal .modal-body {
        padding: 48px;
        text-align: center;
    }

    .error-modal .modal-body {
        padding: 48px;
        text-align: center;
    }

    .success-icon, .error-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px;
        font-size: 2.5rem;
    }

    .success-icon {
        background: #d1fae5;
        color: #10b981;
    }

    .error-icon {
        background: #fee2e2;
        color: #ef4444;
    }

    .success-modal h3 {
        font-size: 1.8rem;
        color: #1e293b;
        margin-bottom: 16px;
        font-weight: 600;
    }

    .error-modal h3 {
        font-size: 1.8rem;
        color: #1e293b;
        margin-bottom: 16px;
        font-weight: 600;
    }

    .success-modal p {
        color: #64748b;
        line-height: 1.6;
        margin-bottom: 32px;
    }

    .error-modal p {
        color: #64748b;
        line-height: 1.6;
        margin-bottom: 32px;
    }

    .btn-close-modal {
        padding: 12px 32px;
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-close-modal:hover {
        background: linear-gradient(135deg, #23923d 0%, #1db489 100%);
        transform: translateY(-2px);
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .contact-container {
            max-width: 100%;
        }
    }

    @media (max-width: 992px) {
        .contact-container {
            gap: 30px;
        }
        
        .contact-form-card,
        .contact-info-card {
            padding: 40px 32px;
        }
        
        .contact-hero h1 {
            font-size: 2.8rem;
        }
        
        .section-header h2 {
            font-size: 2rem;
        }
    }

    @media (max-width: 768px) {
        .contact-hero {
            padding: 60px 0 40px;
        }
        
        .contact-hero h1 {
            font-size: 2.2rem;
        }
        
        .contact-hero p {
            font-size: 1.1rem;
        }
        
        .contact-section {
            padding: 60px 0;
        }
        
        .contact-form-card,
        .contact-info-card {
            padding: 32px 24px;
            border-radius: 20px;
        }
        
        .form-header h2 {
            font-size: 1.6rem;
        }
        
        .header-icon {
            width: 56px;
            height: 56px;
        }
        
        .header-icon i {
            font-size: 1.5rem;
        }
        
        .map-section,
        .faq-section {
            padding: 60px 0;
        }
        
        .section-header h2 {
            font-size: 1.8rem;
        }
        
        .faq-item {
            padding: 24px;
        }
    }

    @media (max-width: 480px) {
        .contact-hero h1 {
            font-size: 1.8rem;
        }
        
        .contact-hero p {
            font-size: 1rem;
        }
        
        .hero-breadcrumb {
            font-size: 0.9rem;
        }
        
        .contact-form-card,
        .contact-info-card {
            padding: 24px 20px;
            border-radius: 16px;
        }
        
        .btn-send,
        .btn-login-first {
            padding: 14px;
            font-size: 0.95rem;
            height: 48px;
        }
        
        .contact-method {
            padding: 16px;
            gap: 16px;
        }
        
        .method-icon {
            width: 48px;
            height: 48px;
        }
        
        .method-icon i {
            font-size: 1.2rem;
        }
        
        .social-link {
            width: 44px;
            height: 44px;
            font-size: 1.2rem;
        }
    }

    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .contact-form-card {
        animation: fadeInUp 0.6s ease;
    }

    .contact-info-card {
        animation: fadeInUp 0.6s ease 0.2s both;
    }

    .faq-item:nth-child(1) { animation: fadeInUp 0.6s ease 0.3s both; }
    .faq-item:nth-child(2) { animation: fadeInUp 0.6s ease 0.4s both; }
    .faq-item:nth-child(3) { animation: fadeInUp 0.6s ease 0.5s both; }
    .faq-item:nth-child(4) { animation: fadeInUp 0.6s ease 0.6s both; }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Character counter for message textarea
        const messageTextarea = document.getElementById('message');
        const charCount = document.getElementById('charCount');
        
        if (messageTextarea && charCount) {
            messageTextarea.addEventListener('input', function() {
                const count = this.value.length;
                charCount.textContent = count;
                
                if (count > 500) {
                    charCount.style.color = '#ef4444';
                } else if (count > 400) {
                    charCount.style.color = '#f59e0b';
                } else {
                    charCount.style.color = '#28a745';
                }
            });
        }
        
        // Form validation
        const contactForm = document.getElementById('contactForm');
        const inputs = contactForm.querySelectorAll('input, textarea');
        
        inputs.forEach(input => {
            // Add focus effects
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateY(-1px)';
                this.style.borderColor = '#28a745';
                this.style.backgroundColor = '#ffffff';
                this.style.boxShadow = '0 0 0 3px rgba(40, 167, 69, 0.1)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'translateY(0)';
                this.style.boxShadow = 'none';
                
                // Validate input
                validateField(this);
            });
            
            // Real-time validation for email
            if (input.type === 'email') {
                input.addEventListener('input', function() {
                    validateField(this);
                });
            }
            
            // Real-time validation for phone
            if (input.type === 'tel' || input.name === 'phone') {
                input.addEventListener('input', function() {
                    validateField(this);
                });
            }
        });
        
        function validateField(field) {
            const errorElement = document.getElementById(field.name + 'Error');
            if (!errorElement) return;
            
            let isValid = true;
            let errorMessage = '';
            
            // Check if field is required
            if (field.hasAttribute('required') && field.value.trim() === '') {
                isValid = false;
                errorMessage = 'Ce champ est obligatoire';
                field.style.borderColor = '#ef4444';
                field.style.backgroundColor = '#fef2f2';
            }
            // Email validation
            else if (field.type === 'email' && field.value.trim() !== '') {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(field.value)) {
                    isValid = false;
                    errorMessage = 'Veuillez entrer une adresse email valide';
                    field.style.borderColor = '#f59e0b';
                    field.style.backgroundColor = '#fffbeb';
                } else {
                    field.style.borderColor = '#28a745';
                    field.style.backgroundColor = '#f0fdf4';
                }
            }
            // Phone validation
            else if ((field.type === 'tel' || field.name === 'phone') && field.value.trim() !== '') {
                const phoneRegex = /^[+]?[0-9\s\-\(\)]{10,}$/;
                if (!phoneRegex.test(field.value)) {
                    isValid = false;
                    errorMessage = 'Veuillez entrer un numéro de téléphone valide';
                    field.style.borderColor = '#f59e0b';
                    field.style.backgroundColor = '#fffbeb';
                } else {
                    field.style.borderColor = '#28a745';
                    field.style.backgroundColor = '#f0fdf4';
                }
            }
            // Other fields
            else if (field.value.trim() !== '') {
                field.style.borderColor = '#28a745';
                field.style.backgroundColor = '#f0fdf4';
            } else {
                field.style.borderColor = '#e2e8f0';
                field.style.backgroundColor = '#f8fafc';
            }
            
            // Update error message
            if (isValid) {
                errorElement.textContent = '';
                errorElement.style.display = 'none';
            } else {
                errorElement.textContent = errorMessage;
                errorElement.style.display = 'flex';
            }
        }
        
        // Form submission
        if (contactForm) {
            contactForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Validate all fields
                let isValid = true;
                inputs.forEach(input => {
                    validateField(input);
                    const errorElement = document.getElementById(input.name + 'Error');
                    if (errorElement && errorElement.style.display === 'flex') {
                        isValid = false;
                    }
                });
                
                if (!isValid) {
                    return;
                }
                
                // Show loading state
                const submitBtn = this.querySelector('.btn-send');
                if (submitBtn) {
                    submitBtn.innerHTML = '<i class="ti-loader spinner"></i><span>Envoi en cours...</span>';
                    submitBtn.disabled = true;
                }
                
                // Submit form via AJAX
                const formData = new FormData(this);
                
                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (submitBtn) {
                        submitBtn.innerHTML = '<i class="ti-email"></i><span>Envoyer le message</span>';
                        submitBtn.disabled = false;
                    }
                    
                    if (data.success) {
                        // Show success modal
                        $('#successModal').modal('show');
                        contactForm.reset();
                        charCount.textContent = '0';
                        charCount.style.color = '#64748b';
                        
                        // Reset all fields
                        inputs.forEach(input => {
                            input.style.borderColor = '#e2e8f0';
                            input.style.backgroundColor = '#f8fafc';
                            const errorElement = document.getElementById(input.name + 'Error');
                            if (errorElement) {
                                errorElement.textContent = '';
                                errorElement.style.display = 'none';
                            }
                        });
                    } else {
                        // Show error modal
                        $('#errorModal').modal('show');
                    }
                })
                .catch(error => {
                    if (submitBtn) {
                        submitBtn.innerHTML = '<i class="ti-email"></i><span>Envoyer le message</span>';
                        submitBtn.disabled = false;
                    }
                    $('#errorModal').modal('show');
                });
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
        
        // Contact method hover effects
        const contactMethods = document.querySelectorAll('.contact-method');
        contactMethods.forEach(method => {
            method.addEventListener('mouseenter', function() {
                this.style.transform = 'translateX(5px)';
            });
            
            method.addEventListener('mouseleave', function() {
                this.style.transform = 'translateX(0)';
            });
        });
        
        // FAQ item hover effects
        const faqItems = document.querySelectorAll('.faq-item');
        faqItems.forEach(item => {
            item.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
            });
            
            item.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
        
        // Auto-focus first input if user is logged in
        const firstInput = contactForm.querySelector('input:not([disabled])');
        if (firstInput) {
            setTimeout(() => {
                firstInput.focus();
            }, 500);
        }
    });
</script>
@endpush
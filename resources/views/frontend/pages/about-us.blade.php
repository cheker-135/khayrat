@extends('frontend.layouts.master')

@section('title','Khayrat || À Propos')

@section('main-content')

    <!-- Hero Header -->
    <section class="about-hero">
        <div class="container">
            <div class="hero-content">
                <h1>Notre Histoire</h1>
                <p>Découvrez la passion et l'engagement qui guident chaque étape de notre parcours chez Khayrat</p>
                <div class="hero-breadcrumb">
                    <a href="{{route('home')}}">Accueil</a>
                    <i class="ti-arrow-right"></i>
                    <span>À Propos</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="mission-section">
        <div class="container">
            <div class="mission-container">
                <div class="mission-content">
                    @php
                        $settings=DB::table('settings')->first();
                    @endphp
                    <div class="section-tag">
                        <span>Notre Mission</span>
                    </div>
                    <h2>Bienvenue chez <span class="highlight">Khayrat</span></h2>
                    <div class="mission-text">
                        <p>{{$settings->description}}</p>
                        <p>Depuis notre création, nous nous engageons à fournir des produits de qualité exceptionnelle accompagnés d'un service client inégalé. Notre passion pour l'excellence nous pousse à innover constamment et à créer des expériences shopping mémorables.</p>
                    </div>
                    <div class="mission-stats">
                        <div class="stat-item">
                            <h3>10K+</h3>
                            <p>Clients Satisfaits</p>
                        </div>
                        <div class="stat-item">
                            <h3>5+</h3>
                            <p>Années d'Expérience</p>
                        </div>
                        <div class="stat-item">
                            <h3>500+</h3>
                            <p>Produits Premium</p>
                        </div>
                        <div class="stat-item">
                            <h3>24/7</h3>
                            <p>Support Client</p>
                        </div>
                    </div>
                    <div class="mission-actions">
                        <a href="{{route('blog')}}" class="btn-secondary">
                            <i class="ti-book"></i>
                            <span>Notre Blog</span>
                        </a>
                        <a href="{{route('contact')}}" class="btn-primary">
                            <i class="ti-email"></i>
                            <span>Nous Contacter</span>
                        </a>
                    </div>
                </div>
                <div class="mission-image">
                    <div class="image-wrapper">
                        <img src="{{$settings->photo}}" alt="Équipe Khayrat">
                        <div class="image-overlay">
                            <div class="play-button">
                                <i class="ti-control-play"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="values-section">
        <div class="container">
            <div class="section-header">
                <div class="section-tag">
                    <span>Nos Valeurs</span>
                </div>
                <h2>Les Principes qui Nous Guident</h2>
                <p>Notre succès repose sur des valeurs fondamentales qui définissent notre identité</p>
            </div>
            <div class="values-grid">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="ti-heart"></i>
                    </div>
                    <h3>Passion</h3>
                    <p>Nous sommes passionnés par ce que nous faisons et nous mettons tout notre cœur à créer des produits exceptionnels pour vous.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">
                        <i class="ti-shield"></i>
                    </div>
                    <h3>Intégrité</h3>
                    <p>Nous croyons en la transparence et l'honnêteté dans toutes nos interactions avec nos clients et partenaires.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">
                        <i class="ti-light-bulb"></i>
                    </div>
                    <h3>Innovation</h3>
                    <p>Nous innovons constamment pour améliorer nos produits et services, restant toujours à la pointe des tendances.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">
                        <i class="ti-user"></i>
                    </div>
                    <h3>Engagement Client</h3>
                    <p>Votre satisfaction est notre priorité absolue. Nous écoutons, nous apprenons et nous nous améliorons pour vous.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="team-section">
        <div class="container">
            <div class="section-header">
                <div class="section-tag">
                    <span>Notre Équipe</span>
                </div>
                <h2>Rencontrez Notre Équipe</h2>
                <p>Des professionnels passionnés dédiés à votre satisfaction</p>
            </div>
            <div class="team-grid">
                <div class="team-member">
                    <div class="member-image">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Jean Martin">
                        <div class="member-social">
                            <a href="#" class="social-link"><i class="ti-linkedin"></i></a>
                            <a href="#" class="social-link"><i class="ti-twitter-alt"></i></a>
                        </div>
                    </div>
                    <div class="member-info">
                        <h3>Jean Martin</h3>
                        <p class="position">PDG & Fondateur</p>
                        <p class="bio">Visionnaire avec plus de 15 ans d'expérience dans le e-commerce.</p>
                    </div>
                </div>
                <div class="team-member">
                    <div class="member-image">
                        <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Marie Dubois">
                        <div class="member-social">
                            <a href="#" class="social-link"><i class="ti-linkedin"></i></a>
                            <a href="#" class="social-link"><i class="ti-twitter-alt"></i></a>
                        </div>
                    </div>
                    <div class="member-info">
                        <h3>Marie Dubois</h3>
                        <p class="position">Directrice Marketing</p>
                        <p class="bio">Spécialiste en stratégie digitale et expérience client.</p>
                    </div>
                </div>
                <div class="team-member">
                    <div class="member-image">
                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Pierre Lambert">
                        <div class="member-social">
                            <a href="#" class="social-link"><i class="ti-linkedin"></i></a>
                            <a href="#" class="social-link"><i class="ti-twitter-alt"></i></a>
                        </div>
                    </div>
                    <div class="member-info">
                        <h3>Pierre Lambert</h3>
                        <p class="position">Responsable Technique</p>
                        <p class="bio">Expert en développement web et sécurité des données.</p>
                    </div>
                </div>
                <div class="team-member">
                    <div class="member-image">
                        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Sophie Bernard">
                        <div class="member-social">
                            <a href="#" class="social-link"><i class="ti-linkedin"></i></a>
                            <a href="#" class="social-link"><i class="ti-twitter-alt"></i></a>
                        </div>
                    </div>
                    <div class="member-info">
                        <h3>Sophie Bernard</h3>
                        <p class="position">Chef de Produit</p>
                        <p class="bio">Passionnée par la création de produits innovants et utiles.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services-section">
        <div class="container">
            <div class="section-header">
                <div class="section-tag">
                    <span>Nos Services</span>
                </div>
                <h2>Pourquoi Choisir Khayrat</h2>
                <p>Nous nous engageons à vous offrir la meilleure expérience shopping possible</p>
            </div>
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="ti-rocket"></i>
                    </div>
                    <div class="service-content">
                        <h3>Livraison Express</h3>
                        <p>Livraison gratuite pour toutes les commandes supérieures à 100€</p>
                        <span class="service-tag">Gratuit</span>
                    </div>
                </div>
                <div class="service-card">
                    <div class="service-icon">
                        <i class="ti-reload"></i>
                    </div>
                    <div class="service-content">
                        <h3>Retours Faciles</h3>
                        <p>Retours gratuits sous 30 jours pour tous nos produits</p>
                        <span class="service-tag">30 Jours</span>
                    </div>
                </div>
                <div class="service-card">
                    <div class="service-icon">
                        <i class="ti-lock"></i>
                    </div>
                    <div class="service-content">
                        <h3>Paiement Sécurisé</h3>
                        <p>Transactions 100% sécurisées avec cryptage SSL</p>
                        <span class="service-tag">Sécurisé</span>
                    </div>
                </div>
                <div class="service-card">
                    <div class="service-icon">
                        <i class="ti-tag"></i>
                    </div>
                    <div class="service-content">
                        <h3>Meilleur Prix</h3>
                        <p>Garantie du meilleur prix sur tous nos produits</p>
                        <span class="service-tag">Garanti</span>
                    </div>
                </div>
                <div class="service-card">
                    <div class="service-icon">
                        <i class="ti-headphone-alt"></i>
                    </div>
                    <div class="service-content">
                        <h3>Support 24/7</h3>
                        <p>Notre équipe est disponible pour vous aider à tout moment</p>
                        <span class="service-tag">Toujours</span>
                    </div>
                </div>
                <div class="service-card">
                    <div class="service-icon">
                        <i class="ti-gift"></i>
                    </div>
                    <div class="service-content">
                        <h3>Programme Fidélité</h3>
                        <p>Gagnez des points et profitez d'avantages exclusifs</p>
                        <span class="service-tag">Exclusif</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Timeline Section -->
    <section class="timeline-section">
        <div class="container">
            <div class="section-header">
                <div class="section-tag">
                    <span>Notre Parcours</span>
                </div>
                <h2>Notre Histoire en Dates</h2>
                <p>Découvrez les moments clés de notre croissance et évolution</p>
            </div>
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-year">2018</div>
                    <div class="timeline-content">
                        <h3>Fondation de Khayrat</h3>
                        <p>Lancement de notre boutique en ligne avec une sélection soignée de 50 produits.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-year">2019</div>
                    <div class="timeline-content">
                        <h3>Expansion des Produits</h3>
                        <p>Notre catalogue s'agrandit à plus de 200 produits et nous atteignons 1000 clients.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-year">2020</div>
                    <div class="timeline-content">
                        <h3>Lancement Mobile</h3>
                        <p>Développement de notre application mobile et expansion internationale.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-year">2021</div>
                    <div class="timeline-content">
                        <h3>Programme Fidélité</h3>
                        <p>Mise en place de notre programme de fidélité avec plus de 5000 membres.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-year">2022</div>
                    <div class="timeline-content">
                        <h3>Innovation Technologique</h3>
                        <p>Intégration de l'IA pour des recommandations personnalisées et amélioration de l'expérience utilisateur.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-year">2023</div>
                    <div class="timeline-content">
                        <h3>Objectifs Durables</h3>
                        <p>Engagement envers la durabilité avec des emballages écologiques et des partenariats responsables.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section">
        <div class="container">
            <div class="section-header">
                <div class="section-tag">
                    <span>Témoignages</span>
                </div>
                <h2>Ce que Disent Nos Clients</h2>
                <p>Découvrez les expériences de ceux qui nous font confiance</p>
            </div>
            <div class="testimonials-slider">
                <div class="testimonial-card">
                    <div class="testimonial-content">
                        <div class="quote-icon">
                            <i class="ti-quote-left"></i>
                        </div>
                        <p>"Une expérience shopping exceptionnelle ! Les produits sont de qualité et le service client est toujours disponible pour aider."</p>
                    </div>
                    <div class="testimonial-author">
                        <img src="https://ui-avatars.com/api/?name=Claire+M&background=28a745&color=fff" alt="Claire M.">
                        <div>
                            <h4>Claire Martin</h4>
                            <span>Cliente depuis 2020</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-content">
                        <div class="quote-icon">
                            <i class="ti-quote-left"></i>
                        </div>
                        <p>"La livraison est toujours rapide et les produits correspondent parfaitement à la description. Je recommande vivement !"</p>
                    </div>
                    <div class="testimonial-author">
                        <img src="https://ui-avatars.com/api/?name=Thomas+L&background=28a745&color=fff" alt="Thomas L.">
                        <div>
                            <h4>Thomas Leroy</h4>
                            <span>Cliente depuis 2021</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-content">
                        <div class="quote-icon">
                            <i class="ti-quote-left"></i>
                        </div>
                        <p>"Le programme de fidélité est génial ! J'ai pu économiser beaucoup grâce aux points accumulés. Service impeccable."</p>
                    </div>
                    <div class="testimonial-author">
                        <img src="https://ui-avatars.com/api/?name=Julie+B&background=28a745&color=fff" alt="Julie B.">
                        <div>
                            <h4>Julie Bernard</h4>
                            <span>Cliente depuis 2022</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2>Prêt à Découvrir l'Expérience Khayrat ?</h2>
                <p>Rejoignez notre communauté de clients satisfaits et découvrez la différence Khayrat</p>
                <div class="cta-actions">
                    <a href="{{route('product-grids')}}" class="btn-primary">
                        <i class="ti-shopping-cart"></i>
                        <span>Voir Nos Produits</span>
                    </a>
                    <a href="{{route('contact')}}" class="btn-secondary">
                        <i class="ti-email"></i>
                        <span>Nous Contacter</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    @include('frontend.layouts.newsletter')

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
        background: #ffffff;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .section-tag {
        display: inline-block;
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        padding: 8px 20px;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        margin-bottom: 20px;
    }

    .highlight {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Hero Header */
    .about-hero {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        padding: 100px 0 60px;
        color: white;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .about-hero::before {
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

    .about-hero h1 {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 20px;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .about-hero p {
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

    /* Mission Section */
    .mission-section {
        padding: 100px 0;
        background: #ffffff;
    }

    .mission-container {
        display: flex;
        align-items: center;
        gap: 60px;
        max-width: 1200px;
        margin: 0 auto;
    }

    @media (max-width: 992px) {
        .mission-container {
            flex-direction: column;
            gap: 40px;
        }
    }

    .mission-content {
        flex: 1;
    }

    .mission-content h2 {
        font-size: 2.5rem;
        color: #1e293b;
        margin-bottom: 24px;
        font-weight: 700;
        line-height: 1.2;
    }

    .mission-text {
        margin-bottom: 40px;
    }

    .mission-text p {
        color: #64748b;
        line-height: 1.8;
        margin-bottom: 16px;
        font-size: 1.1rem;
    }

    .mission-stats {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 30px;
        margin-bottom: 40px;
    }

    @media (max-width: 768px) {
        .mission-stats {
            grid-template-columns: 1fr;
        }
    }

    .stat-item {
        text-align: center;
        padding: 20px;
        background: #f8fafc;
        border-radius: 16px;
        border: 2px solid #e2e8f0;
        transition: all 0.3s ease;
    }

    .stat-item:hover {
        transform: translateY(-5px);
        border-color: #28a745;
        box-shadow: 0 10px 30px rgba(40, 167, 69, 0.1);
    }

    .stat-item h3 {
        font-size: 2.5rem;
        color: #28a745;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .stat-item p {
        color: #64748b;
        font-size: 0.9rem;
        font-weight: 500;
    }

    .mission-actions {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }

    .btn-primary, .btn-secondary {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 16px 32px;
        border-radius: 12px;
        font-size: 1rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .btn-primary {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.2);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(40, 167, 69, 0.3);
        background: linear-gradient(135deg, #23923d 0%, #1db489 100%);
    }

    .btn-secondary {
        background: white;
        color: #1e293b;
        border: 2px solid #e2e8f0;
    }

    .btn-secondary:hover {
        transform: translateY(-2px);
        border-color: #28a745;
        color: #28a745;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .mission-image {
        flex: 1;
    }

    .image-wrapper {
        position: relative;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    .image-wrapper img {
        width: 100%;
        height: auto;
        display: block;
    }

    .image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .image-wrapper:hover .image-overlay {
        opacity: 1;
    }

    .play-button {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2rem;
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .play-button:hover {
        transform: scale(1.1);
    }

    /* Values Section */
    .values-section {
        padding: 100px 0;
        background: #f8fafc;
    }

    .section-header {
        text-align: center;
        margin-bottom: 60px;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
    }

    .section-header h2 {
        font-size: 2.5rem;
        color: #1e293b;
        margin-bottom: 16px;
        font-weight: 700;
    }

    .section-header p {
        color: #64748b;
        font-size: 1.1rem;
        line-height: 1.6;
    }

    .values-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .value-card {
        background: white;
        border-radius: 20px;
        padding: 40px 30px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .value-card:hover {
        transform: translateY(-10px);
        border-color: #28a745;
        box-shadow: 0 20px 40px rgba(40, 167, 69, 0.1);
    }

    .value-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px;
        font-size: 2rem;
        color: white;
    }

    .value-card h3 {
        font-size: 1.5rem;
        color: #1e293b;
        margin-bottom: 16px;
        font-weight: 600;
    }

    .value-card p {
        color: #64748b;
        line-height: 1.6;
        font-size: 0.95rem;
    }

    /* Team Section */
    .team-section {
        padding: 100px 0;
        background: white;
    }

    .team-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .team-member {
        background: #f8fafc;
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .team-member:hover {
        transform: translateY(-10px);
        border-color: #28a745;
        box-shadow: 0 20px 40px rgba(40, 167, 69, 0.1);
    }

    .member-image {
        position: relative;
        height: 300px;
        overflow: hidden;
    }

    .member-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .team-member:hover .member-image img {
        transform: scale(1.05);
    }

    .member-social {
        position: absolute;
        bottom: 20px;
        left: 0;
        right: 0;
        display: flex;
        justify-content: center;
        gap: 10px;
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.3s ease;
    }

    .team-member:hover .member-social {
        opacity: 1;
        transform: translateY(0);
    }

    .social-link {
        width: 40px;
        height: 40px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #28a745;
        text-decoration: none;
        font-size: 1.2rem;
        transition: all 0.3s ease;
    }

    .social-link:hover {
        background: #28a745;
        color: white;
        transform: scale(1.1);
    }

    .member-info {
        padding: 30px;
        text-align: center;
    }

    .member-info h3 {
        font-size: 1.5rem;
        color: #1e293b;
        margin-bottom: 8px;
        font-weight: 600;
    }

    .position {
        color: #28a745;
        font-weight: 500;
        margin-bottom: 12px;
        font-size: 0.9rem;
    }

    .bio {
        color: #64748b;
        line-height: 1.6;
        font-size: 0.9rem;
    }

    /* Services Section */
    .services-section {
        padding: 100px 0;
        background: #f8fafc;
    }

    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .service-card {
        background: white;
        border-radius: 20px;
        padding: 40px 30px;
        display: flex;
        gap: 24px;
        align-items: flex-start;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .service-card:hover {
        transform: translateY(-10px);
        border-color: #28a745;
        box-shadow: 0 20px 40px rgba(40, 167, 69, 0.1);
    }

    .service-icon {
        width: 64px;
        height: 64px;
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        color: white;
        flex-shrink: 0;
    }

    .service-content {
        flex: 1;
    }

    .service-content h3 {
        font-size: 1.5rem;
        color: #1e293b;
        margin-bottom: 12px;
        font-weight: 600;
    }

    .service-content p {
        color: #64748b;
        line-height: 1.6;
        margin-bottom: 16px;
        font-size: 0.95rem;
    }

    .service-tag {
        display: inline-block;
        background: #d1fae5;
        color: #065f46;
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    /* Timeline Section */
    .timeline-section {
        padding: 100px 0;
        background: white;
    }

    .timeline {
        max-width: 800px;
        margin: 0 auto;
        position: relative;
    }

    .timeline::before {
        content: '';
        position: absolute;
        left: 50%;
        top: 0;
        bottom: 0;
        width: 2px;
        background: linear-gradient(to bottom, #28a745, #20c997);
        transform: translateX(-50%);
    }

    @media (max-width: 768px) {
        .timeline::before {
            left: 30px;
        }
    }

    .timeline-item {
        position: relative;
        margin-bottom: 60px;
        display: flex;
        align-items: center;
        gap: 40px;
    }

    @media (max-width: 768px) {
        .timeline-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 20px;
            margin-left: 60px;
        }
    }

    .timeline-year {
        flex: 0 0 120px;
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        padding: 12px 24px;
        border-radius: 30px;
        font-size: 1.2rem;
        font-weight: 700;
        text-align: center;
        position: relative;
        z-index: 2;
    }

    @media (max-width: 768px) {
        .timeline-year {
            position: absolute;
            left: -60px;
            top: 0;
        }
    }

    .timeline-content {
        flex: 1;
        background: #f8fafc;
        padding: 30px;
        border-radius: 16px;
        border-left: 4px solid #28a745;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }

    .timeline-content h3 {
        font-size: 1.5rem;
        color: #1e293b;
        margin-bottom: 12px;
        font-weight: 600;
    }

    .timeline-content p {
        color: #64748b;
        line-height: 1.6;
        font-size: 0.95rem;
    }

    /* Testimonials Section */
    .testimonials-section {
        padding: 100px 0;
        background: #f8fafc;
    }

    .testimonials-slider {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 30px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .testimonial-card {
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .testimonial-card:hover {
        transform: translateY(-10px);
        border-color: #28a745;
        box-shadow: 0 20px 40px rgba(40, 167, 69, 0.1);
    }

    .quote-icon {
        font-size: 2.5rem;
        color: #28a745;
        opacity: 0.3;
        margin-bottom: 20px;
    }

    .testimonial-content p {
        color: #475569;
        font-size: 1.1rem;
        line-height: 1.8;
        font-style: italic;
        margin-bottom: 30px;
    }

    .testimonial-author {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .testimonial-author img {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        border: 2px solid #28a745;
    }

    .testimonial-author h4 {
        font-size: 1.1rem;
        color: #1e293b;
        margin-bottom: 4px;
        font-weight: 600;
    }

    .testimonial-author span {
        color: #64748b;
        font-size: 0.875rem;
    }

    /* CTA Section */
    .cta-section {
        padding: 100px 0;
        background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
        color: white;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .cta-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%2328a745' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
    }

    .cta-content {
        position: relative;
        z-index: 2;
        max-width: 800px;
        margin: 0 auto;
    }

    .cta-section h2 {
        font-size: 2.5rem;
        margin-bottom: 20px;
        font-weight: 700;
    }

    .cta-section p {
        font-size: 1.2rem;
        opacity: 0.9;
        line-height: 1.6;
        margin-bottom: 40px;
    }

    .cta-actions {
        display: flex;
        gap: 20px;
        justify-content: center;
        flex-wrap: wrap;
    }

    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .mission-container {
        animation: fadeInUp 0.6s ease;
    }

    .values-grid > * {
        animation: fadeInUp 0.6s ease;
    }

    .team-grid > * {
        animation: fadeInUp 0.6s ease;
    }

    .services-grid > * {
        animation: fadeInUp 0.6s ease;
    }

    .timeline-item {
        animation: fadeInUp 0.6s ease;
    }

    .testimonial-card {
        animation: fadeInUp 0.6s ease;
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .container {
            max-width: 100%;
        }
    }

    @media (max-width: 992px) {
        .about-hero h1 {
            font-size: 2.8rem;
        }
        
        .mission-content h2,
        .section-header h2,
        .cta-section h2 {
            font-size: 2rem;
        }
        
        .mission-stats {
            gap: 20px;
        }
        
        .stat-item h3 {
            font-size: 2rem;
        }
    }

    @media (max-width: 768px) {
        .about-hero {
            padding: 80px 0 40px;
        }
        
        .about-hero h1 {
            font-size: 2.2rem;
        }
        
        .about-hero p {
            font-size: 1.1rem;
        }
        
        .mission-section,
        .values-section,
        .team-section,
        .services-section,
        .timeline-section,
        .testimonials-section,
        .cta-section {
            padding: 80px 0;
        }
        
        .mission-content h2,
        .section-header h2,
        .cta-section h2 {
            font-size: 1.8rem;
        }
        
        .mission-actions {
            flex-direction: column;
        }
        
        .btn-primary, .btn-secondary {
            width: 100%;
            justify-content: center;
        }
        
        .cta-actions {
            flex-direction: column;
        }
        
        .timeline::before {
            left: 30px;
        }
    }

    @media (max-width: 480px) {
        .about-hero h1 {
            font-size: 1.8rem;
        }
        
        .about-hero p {
            font-size: 1rem;
        }
        
        .hero-breadcrumb {
            font-size: 0.9rem;
        }
        
        .mission-content h2,
        .section-header h2,
        .cta-section h2 {
            font-size: 1.6rem;
        }
        
        .section-header p,
        .cta-section p {
            font-size: 1rem;
        }
        
        .value-card,
        .service-card,
        .testimonial-card {
            padding: 30px 20px;
        }
        
        .timeline-content {
            padding: 20px;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animate stats on scroll
        const statItems = document.querySelectorAll('.stat-item h3');
        
        function animateValue(element, start, end, duration) {
            let startTimestamp = null;
            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                const value = Math.floor(progress * (end - start) + start);
                element.textContent = value + (element.textContent.includes('+') ? '+' : '');
                if (progress < 1) {
                    window.requestAnimationFrame(step);
                }
            };
            window.requestAnimationFrame(step);
        }
        
        // Play button click handler
        const playButton = document.querySelector('.play-button');
        if (playButton) {
            playButton.addEventListener('click', function() {
                // In a real implementation, this would open a video modal
                alert('Fonctionnalité vidéo à venir !');
            });
        }
        
        // Team member hover effects
        const teamMembers = document.querySelectorAll('.team-member');
        teamMembers.forEach(member => {
            member.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px)';
            });
            
            member.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
        
        // Value card hover effects
        const valueCards = document.querySelectorAll('.value-card');
        valueCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
        
        // Service card hover effects
        const serviceCards = document.querySelectorAll('.service-card');
        serviceCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
        
        // Testimonial card hover effects
        const testimonialCards = document.querySelectorAll('.testimonial-card');
        testimonialCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
        
        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // Animate stats when mission section is visible
                    if (entry.target.classList.contains('mission-stats')) {
                        statItems.forEach((item, index) => {
                            const value = parseInt(item.textContent);
                            setTimeout(() => {
                                animateValue(item, 0, value, 1000);
                            }, index * 200);
                        });
                    }
                    
                    // Add animation class to elements
                    entry.target.classList.add('animated');
                }
            });
        }, observerOptions);
        
        // Observe mission stats
        const missionStats = document.querySelector('.mission-stats');
        if (missionStats) {
            observer.observe(missionStats);
        }
        
        // Add hover effect to buttons
        const buttons = document.querySelectorAll('.btn-primary, .btn-secondary');
        buttons.forEach(btn => {
            btn.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
            });
            
            btn.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
        
        // Add smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
        
        // Add loading animation to page
        window.addEventListener('load', function() {
            document.body.classList.add('loaded');
        });
    });
</script>
@endpush
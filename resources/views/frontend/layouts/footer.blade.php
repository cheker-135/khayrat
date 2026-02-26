<!-- Start Footer Area -->
<footer class="footer">
    <!-- Footer Top -->
    <div class="footer-top section">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-6 col-12">
                    <!-- Single Widget -->
                    <div class="single-footer about">
                        <div class="logo">
                            <a href="{{route('home')}}"><img src="{{asset('backend/img/khayrat.png')}}" alt="{{config('app.name')}}" class="footer-logo-img"></a>
                        </div>
                        @php
                            $settings=DB::table('settings')->first();
                        @endphp
                        <p class="text">{{ $settings->short_des ?? '' }}</p>
                        <div class="contact-call">
                            <i class="ti-headphone-alt"></i>
                            <div class="call-content">
                                <p class="call-text">Une question ? Appelez-nous 24h/24 et 7j/7</p>
                                <a href="tel:{{ $settings->phone ?? '' }}" class="call-number">
                                    {{ $settings->phone ?? '' }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Widget -->
                </div>
                <div class="col-lg-2 col-md-6 col-12">
                    <!-- Single Widget -->
                    <div class="single-footer links">
                        <h4><i class="ti-info-alt"></i> Informations</h4>
                        <ul>
                            <li><a href="{{route('about-us')}}"><i class="ti-angle-right"></i> À Propos</a></li>
                            <li><a href="#"><i class="ti-angle-right"></i> FAQ</a></li>
                            <li><a href="#"><i class="ti-angle-right"></i> Conditions Générales</a></li>
                            <li><a href="{{route('contact')}}"><i class="ti-angle-right"></i> Contactez-nous</a></li>
                            <li><a href="#"><i class="ti-angle-right"></i> Centre d'Aide</a></li>
                        </ul>
                    </div>
                    <!-- End Single Widget -->
                </div>
                <div class="col-lg-2 col-md-6 col-12">
                    <!-- Single Widget -->
                    <div class="single-footer links">
                        <h4><i class="ti-headphone-alt"></i> Service Client</h4>
                        <ul>
                            <li><a href="#"><i class="ti-angle-right"></i> Méthodes de Paiement</a></li>
                            <li><a href="#"><i class="ti-angle-right"></i> Remboursement Garanti</a></li>
                            <li><a href="#"><i class="ti-angle-right"></i> Retours & Échanges</a></li>
                            <li><a href="#"><i class="ti-angle-right"></i> Livraison & Expédition</a></li>
                            <li><a href="#"><i class="ti-angle-right"></i> Politique de Confidentialité</a></li>
                        </ul>
                    </div>
                    <!-- End Single Widget -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Single Widget -->
                    <div class="single-footer social">
                        <h4><i class="ti-email"></i> Contactez-nous</h4>
                        <!-- Single Widget -->
                        <div class="contact">
                            <ul>
                                <li><i class="ti-location-pin"></i> {{ $settings->address ?? '' }}</li>
                                <li><i class="ti-email"></i> {{ $settings->email ?? '' }}</li>
                                <li><i class="ti-mobile"></i> {{ $settings->phone ?? '' }}</li>
                            </ul>
                        </div>
                        <!-- End Single Widget -->
                        <div class="social-links">
                            <p class="social-title">Suivez-nous :</p>
                            <div class="social-icons">
                                <a href="#" class="social-icon" aria-label="Facebook"><i class="ti-facebook"></i></a>
                                <a href="#" class="social-icon" aria-label="Twitter"><i class="ti-twitter-alt"></i></a>
                                <a href="#" class="social-icon" aria-label="Instagram"><i class="ti-instagram"></i></a>
                                <a href="#" class="social-icon" aria-label="LinkedIn"><i class="ti-linkedin"></i></a>
                                <a href="#" class="social-icon" aria-label="YouTube"><i class="ti-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Widget -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer Top -->
    <div class="copyright">
        <div class="container">
            <div class="inner">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-12">
                        <div class="left">
                            <p>Copyright © {{date('Y')}} <a href="https://github.com/ouni-cheker365" target="_blank">Aouni Chaker</a> - Tous droits réservés.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="right">
                            <img src="{{asset('backend/img/payments.png')}}" alt="Méthodes de paiement acceptées" class="payment-methods">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- /End Footer Area -->

<style>
/* =============================================
   FOOTER ENHANCED STYLES
   Matching the green color palette from header
   ============================================= */

/* Color Variables matching your header */
:root {
    --footer-primary: #27ae60;       /* Main green */
    --footer-secondary: #2ecc71;     /* Light green */
    --footer-accent: #16a085;        /* Teal accent */
    --footer-dark: #222;             /* Dark background */
    --footer-light: #fff;            /* White */
    --footer-text: #333;             /* Dark text */
    --footer-gray: #666;             /* Gray text */
    --footer-light-gray: #f8f9fa;    /* Light background */
    --footer-border: #e5e5e5;        /* Borders */
    --footer-shadow: rgba(0, 0, 0, 0.1);
    --footer-transition: 0.3s ease;
    --footer-radius: 8px;
}

/* Footer Base */
.footer {
    background: var(--footer-dark);
    color: rgba(255, 255, 255, 0.8);
    position: relative;
    overflow: hidden;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
}

/* Animated Top Border */
.footer::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--footer-primary), var(--footer-secondary), var(--footer-accent));
    background-size: 200% 200%;
    animation: gradientFlow 15s ease infinite;
}

@keyframes gradientFlow {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* Footer Top Section */
.footer-top {
    padding: 70px 0 50px;
    background: var(--footer-dark);
}

/* Logo Styling */


.footer-logo {
    max-height: 100px;
    width: auto;
    border-radius: 30%;
    transition: all var(--footer-transition);
    display: block;
	
}

.footer .logo a:hover .footer-logo-img {
    transform: translateY(-3px);
    scale:1.2;
	border-radius: var(--footer-radius);
	
}

/* About Section */
.single-footer.about .text {
    color: rgba(255, 255, 255, 0.7);
    line-height: 1.8;
    margin-bottom: 25px;
    font-size: 15px;
    position: relative;
    padding-left: 20px;
}

.single-footer.about .text::before {
    content: '';
    position: absolute;
    left: 0;
    top: 5px;
    bottom: 5px;
    width: 3px;
    background: var(--footer-primary);
    border-radius: 2px;
}

/* Contact Call Styling */
.contact-call {
    display: flex;
    align-items: flex-start;
    gap: 15px;
    background: rgba(255, 255, 255, 0.05);
    padding: 20px;
    border-radius: var(--footer-radius);
    border-left: 4px solid var(--footer-primary);
    transition: all var(--footer-transition);
}

.contact-call:hover {
    background: rgba(255, 255, 255, 0.08);
    transform: translateX(5px);
}

.contact-call i {
    color: var(--footer-secondary);
    font-size: 24px;
    margin-top: 2px;
    flex-shrink: 0;
}

.call-content {
    flex: 1;
}

.call-text {
    color: rgba(255, 255, 255, 0.6);
    font-size: 13px;
    margin-bottom: 5px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.call-number {
    color: var(--footer-light);
    font-size: 18px;
    font-weight: 600;
    text-decoration: none;
    transition: color var(--footer-transition);
    display: block;
}

.call-number:hover {
    color: var(--footer-secondary);
    text-decoration: underline;
}

/* Links Sections */
.single-footer.links h4 {
    color: var(--footer-light);
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 25px;
    padding-bottom: 12px;
    position: relative;
    display: flex;
    align-items: center;
    gap: 10px;
}

.single-footer.links h4::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 40px;
    height: 3px;
    background: var(--footer-primary);
    border-radius: 2px;
}

.single-footer.links h4 i {
    color: var(--footer-secondary);
}

.single-footer.links ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.single-footer.links li {
    margin-bottom: 12px;
}

.single-footer.links li:last-child {
    margin-bottom: 0;
}

.single-footer.links a {
    color: rgba(255, 255, 255, 0.7);
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 10px;
    transition: all var(--footer-transition);
    padding: 8px 0;
    font-size: 15px;
}

.single-footer.links a i {
    color: var(--footer-secondary);
    font-size: 12px;
    transition: transform var(--footer-transition);
}

.single-footer.links a:hover {
    color: var(--footer-secondary);
    padding-left: 8px;
}

.single-footer.links a:hover i {
    transform: translateX(4px);
}

/* Contact Section */
.single-footer.social h4 {
    color: var(--footer-light);
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 25px;
    padding-bottom: 12px;
    position: relative;
    display: flex;
    align-items: center;
    gap: 10px;
}

.single-footer.social h4::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 40px;
    height: 3px;
    background: var(--footer-primary);
    border-radius: 2px;
}

.single-footer.social h4 i {
    color: var(--footer-secondary);
}

.contact ul {
    list-style: none;
    padding: 0;
    margin: 0 0 25px 0;
}

.contact li {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 15px;
    color: rgba(255, 255, 255, 0.7);
    line-height: 1.6;
    font-size: 15px;
}

.contact li:last-child {
    margin-bottom: 0;
}

.contact li i {
    color: var(--footer-secondary);
    font-size: 16px;
    margin-top: 3px;
    min-width: 20px;
}

/* Social Links */
.social-links {
    margin-top: 25px;
}

.social-title {
    color: rgba(255, 255, 255, 0.6);
    font-size: 14px;
    margin-bottom: 12px;
    font-weight: 500;
}

.social-icons {
    display: flex;
    gap: 10px;
}

.social-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.1);
    color: var(--footer-light);
    border-radius: 50%;
    text-decoration: none;
    transition: all var(--footer-transition);
    position: relative;
    overflow: hidden;
}

.social-icon::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: var(--footer-primary);
    opacity: 0;
    transition: opacity var(--footer-transition);
    z-index: 1;
}

.social-icon i {
    position: relative;
    z-index: 2;
    font-size: 18px;
}

.social-icon:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
}

.social-icon:hover::before {
    opacity: 1;
}

.social-icon:hover i {
    color: var(--footer-light);
}

/* Copyright Section */
.copyright {
    background: rgba(0, 0, 0, 0.3);
    padding: 20px 0;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.copyright .inner {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.copyright .left p {
    color: rgba(255, 255, 255, 0.6);
    margin: 0;
    font-size: 14px;
    line-height: 1.6;
}

.copyright a {
    color: var(--footer-secondary);
    text-decoration: none;
    transition: color var(--footer-transition);
    font-weight: 500;
}

.copyright a:hover {
    color: var(--footer-light);
    text-decoration: underline;
}

.payment-methods {
    max-height: 30px;
    width: auto;
    opacity: 0.8;
    transition: all var(--footer-transition);
}

.payment-methods:hover {
    opacity: 1;
    transform: translateY(-2px);
}

/* =============================================
   RESPONSIVE DESIGN
   ============================================= */

/* Large Devices (Desktops) */
@media (min-width: 992px) {
    .footer-top {
        padding: 80px 0 60px;
    }
    
    .footer-logo-img {
        max-height: 70px;
    }
    
    .copyright .inner {
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
    }
    
    .copyright .left {
        text-align: left;
    }
    
    .copyright .right {
        text-align: right;
    }
}

/* Medium Devices (Tablets) */
@media (max-width: 991.98px) {
    .footer-top {
        padding: 50px 0 30px;
    }
    
    .single-footer {
        margin-bottom: 40px;
    }
    
    .footer-logo-img {
        max-height: 55px;
    }
    
    .contact-call {
        max-width: 400px;
    }
}

/* Small Devices (Mobile) */
@media (max-width: 767.98px) {
    .footer-top {
        padding: 40px 0 20px;
    }
    
    .footer-logo-img {
        max-height: 45px;
    }
    
    .single-footer.links h4,
    .single-footer.social h4 {
        font-size: 16px;
    }
    
    .contact-call {
        padding: 15px;
    }
    
    .call-number {
        font-size: 16px;
    }
    
    .single-footer.links a {
        font-size: 14px;
    }
    
    .contact li {
        font-size: 14px;
    }
    
    .copyright .left p {
        font-size: 13px;
        text-align: center;
    }
    
    .payment-methods {
        max-height: 25px;
    }
}

/* Extra Small Devices */
@media (max-width: 575.98px) {
    .footer-top {
        padding: 30px 0 15px;
    }
    
    .footer-logo-img {
        max-height: 40px;
    }
    
    .single-footer {
        text-align: center;
    }
    
    .single-footer.links h4,
    .single-footer.social h4 {
        justify-content: center;
    }
    
    .single-footer.links h4::after,
    .single-footer.social h4::after {
        left: 50%;
        transform: translateX(-50%);
    }
    
    .single-footer.about .text::before {
        display: none;
    }
    
    .single-footer.about .text {
        padding-left: 0;
    }
    
    .contact-call {
        flex-direction: column;
        text-align: center;
        gap: 10px;
    }
    
    .single-footer.links a {
        justify-content: center;
    }
    
    .contact li {
        justify-content: center;
    }
    
    .social-icons {
        justify-content: center;
    }
    
    .copyright .inner {
        gap: 15px;
    }
    
    .payment-methods {
        max-height: 20px;
    }
}

/* Animation for page load */
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

.footer > * {
    animation: fadeInUp 0.6s ease forwards;
}

.footer-top { animation-delay: 0.1s; }
.copyright { animation-delay: 0.2s; }

/* Print Styles */
@media print {
    .footer {
        display: none;
    }
}

/* Accessibility Improvements */
.footer a:focus-visible {
    outline: 2px solid var(--footer-primary);
    outline-offset: 2px;
}

/* Reduced Motion Support */
@media (prefers-reduced-motion: reduce) {
    .footer::before,
    .footer-logo-img,
    .contact-call,
    .single-footer.links a,
    .social-icon,
    .payment-methods,
    .footer > * {
        animation: none;
        transition: none;
    }
}

/* Dark Mode Support */
@media (prefers-color-scheme: dark) {
    .footer {
        background: #1a1a1a;
    }
    
    .copyright {
        background: rgba(0, 0, 0, 0.5);
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Smooth hover effects for links
    const footerLinks = document.querySelectorAll('.footer a');
    footerLinks.forEach(link => {
        link.addEventListener('mouseenter', function() {
            this.style.transition = 'all 0.3s ease';
        });
    });
    
    // Current year update
    const yearElements = document.querySelectorAll('.current-year');
    if (yearElements.length === 0) {
        // Add current year to copyright if not already present
        const copyrightText = document.querySelector('.copyright .left p');
        if (copyrightText && !copyrightText.textContent.includes('2024')) {
            const currentYear = new Date().getFullYear();
            copyrightText.innerHTML = copyrightText.innerHTML.replace('{{date("Y")}}', currentYear);
        }
    }
    
    // Logo hover enhancement
    const footerLogo = document.querySelector('.footer .logo a');
    if (footerLogo) {
        footerLogo.addEventListener('mouseenter', function() {
            const img = this.querySelector('img');
            if (img) {
                img.style.transition = 'transform 0.3s ease, filter 0.3s ease';
            }
        });
    }
    
    // Payment methods image error handling
    const paymentImage = document.querySelector('.payment-methods');
    if (paymentImage) {
        paymentImage.addEventListener('error', function() {
            console.log('Payment methods image failed to load');
            this.style.display = 'none';
        });
        
        // Lazy loading
        paymentImage.loading = 'lazy';
    }
    
    // Mobile touch improvements
    if ('ontouchstart' in window) {
        const touchElements = document.querySelectorAll('.footer a');
        touchElements.forEach(el => {
            el.style.minHeight = '44px';
            el.style.minWidth = '44px';
            el.style.display = 'flex';
            el.style.alignItems = 'center';
        });
    }
    
    console.log('Enhanced French Footer Loaded');
});
</script>

<!-- Keep your existing scripts - they remain unchanged -->
<!-- Jquery -->
<script src="{{asset('frontend/js/jquery.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery-migrate-3.0.0.js')}}"></script>
<script src="{{asset('frontend/js/jquery-ui.min.js')}}"></script>
<!-- Popper JS -->
<script src="{{asset('frontend/js/popper.min.js')}}"></script>
<!-- Bootstrap JS -->
<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
<!-- Color JS -->
<script src="{{asset('frontend/js/colors.js')}}"></script>
<!-- Slicknav JS -->
<script src="{{asset('frontend/js/slicknav.min.js')}}"></script>
<!-- Owl Carousel JS -->
<script src="{{asset('frontend/js/owl-carousel.js')}}"></script>
<!-- Magnific Popup JS -->
<script src="{{asset('frontend/js/magnific-popup.js')}}"></script>
<!-- Waypoints JS -->
<script src="{{asset('frontend/js/waypoints.min.js')}}"></script>
<!-- Countdown JS -->
<script src="{{asset('frontend/js/finalcountdown.min.js')}}"></script>
<!-- Nice Select JS -->
<script src="{{asset('frontend/js/nicesellect.js')}}"></script>
<!-- Flex Slider JS -->
<script src="{{asset('frontend/js/flex-slider.js')}}"></script>
<!-- ScrollUp JS -->
<script src="{{asset('frontend/js/scrollup.js')}}"></script>
<!-- Onepage Nav JS -->
<script src="{{asset('frontend/js/onepage-nav.min.js')}}"></script>
{{-- Isotope --}}
<script src="{{asset('frontend/js/isotope/isotope.pkgd.min.js')}}"></script>
<!-- Easing JS -->
<script src="{{asset('frontend/js/easing.js')}}"></script>
<!-- Active JS -->
<script src="{{asset('frontend/js/active.js')}}"></script>

@stack('scripts')
<script>
setTimeout(function(){
    $('.alert').slideUp();
},5000);
$(function() {
    // Multi Level dropdowns
    $("ul.dropdown-menu [data-toggle='dropdown']").on("click", function(event) {
        event.preventDefault();
        event.stopPropagation();

        $(this).siblings().toggleClass("show");

        if (!$(this).next().hasClass('show')) {
            $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
        }
        $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
            $('.dropdown-submenu .show').removeClass("show");
        });
    });
});
</script>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" 
      data-bs-theme="{{ Auth::check() && isset(Auth::user()->settings['theme']) && Auth::user()->settings['theme'] === 'dark' ? 'dark' : 'light' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Scripts and Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    
    <!-- Prevent duplicate JavaScript initializations -->
    <script>
        // Ensure any global variables are properly scoped to avoid conflicts
        window.appConfig = window.appConfig || {};
    </script>
</head>
<body>
    <nav class="navbar navbar-expand-lg {{ Auth::check() && isset(Auth::user()->settings['theme']) && Auth::user()->settings['theme'] === 'dark' ? 'navbar-dark bg-dark' : 'navbar-light bg-light' }}">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.index') }}">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about.index') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact.index') }}">Contact</a>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('dashboard') }}">
                                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                                    </a>
                                </li>
                                @if(Auth::user()->is_admin)
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                        <i class="bi bi-shield-lock me-2"></i> Admin Panel
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.products.index') }}">
                                        <i class="bi bi-box-seam me-2"></i> Manage Products
                                    </a>
                                </li>
                                @endif
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile') }}">
                                        <i class="bi bi-person me-2"></i> Profile
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </a>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="footer-area position-relative">
        <!-- Wave Decoration -->
        <div class="footer-wave">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none" class="w-100">
                <path fill="currentColor" fill-opacity="1" d="M0,128L48,144C96,160,192,192,288,186.7C384,181,480,139,576,149.3C672,160,768,224,864,234.7C960,245,1056,203,1152,186.7C1248,171,1344,181,1392,186.7L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
        </div>

        <!-- Main Footer Content -->
        <div class="footer-content pt-5">
            <div class="container">
                <div class="row">
                    <!-- Company Info Column -->
                    <div class="col-lg-4 col-md-6 mb-5">
                        <div class="footer-logo mb-4">
                            <h2>{{ config('app.name', 'Laravel') }}</h2>
                        </div>
                        <p class="mb-4">Experience the art of mixology with our premium collection of handcrafted cocktails and mocktails. Perfect for any occasion.</p>
                        <div class="footer-social">
                            <a href="#" class="social-circle"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="social-circle"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="social-circle"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="social-circle"><i class="bi bi-pinterest"></i></a>
                        </div>
                    </div>

                    <!-- Links Column -->
                    <div class="col-lg-2 col-md-6 mb-5">
                        <h5 class="footer-heading">Quick Links</h5>
                        <ul class="footer-links">
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="{{ route('products.index') }}">Shop</a></li>
                            <li><a href="{{ route('products.index', ['type' => 'alcoholic']) }}">Cocktails</a></li>
                            <li><a href="{{ route('products.index', ['type' => 'non-alcoholic']) }}">Mocktails</a></li>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </div>

                    <!-- Contact Info Column -->
                    <div class="col-lg-3 col-md-6 mb-5">
                        <h5 class="footer-heading">Contact</h5>
                        <ul class="footer-contact">
                            <li><i class="bi bi-geo-alt-fill"></i> 123 Cocktail Street, City, Country</li>
                            <li><i class="bi bi-telephone-fill"></i> +1 (555) 123-4567</li>
                            <li><i class="bi bi-envelope-fill"></i> info@example.com</li>
                            <li><i class="bi bi-clock-fill"></i> Mon-Sat: 9AM - 11PM</li>
                        </ul>
                    </div>

                    <!-- Newsletter Column -->
                    <div class="col-lg-3 col-md-6 mb-5">
                        <h5 class="footer-heading">Newsletter</h5>
                        <p>Subscribe for exclusive offers, recipes, and updates.</p>
                        <form class="footer-newsletter mt-3">
                            <div class="input-group">
                                <input type="email" class="form-control" placeholder="Email Address" aria-label="Email Address">
                                <button class="btn btn-primary" type="button"><i class="bi bi-send-fill"></i></button>
                            </div>
                        </form>
                        <div class="mt-4">
                            <div class="drink-decor">
                                <i class="bi bi-cup-straw"></i>
                                <i class="bi bi-cup"></i>
                                <i class="bi bi-cup-hot-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright Bar -->
        <div class="footer-copyright py-3">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="mb-0">&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <div class="footer-payment">
                            <span class="me-3">Payment Options:</span>
                            <i class="bi bi-credit-card me-2"></i>
                            <i class="bi bi-paypal me-2"></i>
                            <i class="bi bi-wallet2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <style>
    /* Custom Footer Styling */
    .footer-area {
        background: {{ Auth::check() && isset(Auth::user()->settings['theme']) && Auth::user()->settings['theme'] === 'dark' ? '#1a1a1a' : '#f8f9fa' }};
        color: {{ Auth::check() && isset(Auth::user()->settings['theme']) && Auth::user()->settings['theme'] === 'dark' ? '#e0e0e0' : '#444' }};
        overflow: hidden;
    }

    .footer-wave {
        position: absolute;
        top: -100px;
        left: 0;
        width: 100%;
        height: 100px;
        color: {{ Auth::check() && isset(Auth::user()->settings['theme']) && Auth::user()->settings['theme'] === 'dark' ? '#1a1a1a' : '#f8f9fa' }};
    }

    .footer-wave svg {
        display: block;
        height: 100%;
    }

    .footer-heading {
        position: relative;
        font-weight: 600;
        margin-bottom: 1.5rem;
        color: {{ Auth::check() && isset(Auth::user()->settings['theme']) && Auth::user()->settings['theme'] === 'dark' ? '#ffffff' : '#333' }};
    }

    .footer-heading:after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 50px;
        height: 2px;
        background: var(--bs-primary);
    }

    .footer-content {
        padding-bottom: 2rem;
    }

    /* Quick Links Styling */
    .footer-links {
        list-style: none;
        padding-left: 0;
    }

    .footer-links li {
        margin-bottom: 0.75rem;
    }

    .footer-links a {
        text-decoration: none;
        color: {{ Auth::check() && isset(Auth::user()->settings['theme']) && Auth::user()->settings['theme'] === 'dark' ? '#bdbdbd' : '#666' }};
        transition: all 0.3s;
        position: relative;
        padding-left: 0;
    }

    .footer-links a:hover {
        color: var(--bs-primary);
        padding-left: 5px;
    }

    .footer-links a:before {
        content: '→';
        opacity: 0;
        position: absolute;
        left: -15px;
        transition: all 0.3s;
    }

    .footer-links a:hover:before {
        opacity: 1;
        left: -10px;
    }

    /* Contact Info Styling */
    .footer-contact {
        list-style: none;
        padding-left: 0;
    }

    .footer-contact li {
        margin-bottom: 1rem;
        display: flex;
        align-items: flex-start;
    }

    .footer-contact li i {
        margin-right: 10px;
        color: var(--bs-primary);
    }

    /* Social Media Icons */
    .footer-social {
        display: flex;
        gap: 10px;
    }

    .social-circle {
        width: 40px;
        height: 40px;
        background: {{ Auth::check() && isset(Auth::user()->settings['theme']) && Auth::user()->settings['theme'] === 'dark' ? 'rgba(255,255,255,0.1)' : 'rgba(0,0,0,0.05)' }};
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        color: {{ Auth::check() && isset(Auth::user()->settings['theme']) && Auth::user()->settings['theme'] === 'dark' ? '#ffffff' : '#333' }};
        text-decoration: none;
        transition: all 0.3s;
    }

    .social-circle:hover {
        background: var(--bs-primary);
        color: #fff;
        transform: translateY(-3px);
    }

    /* Newsletter Form */
    .footer-newsletter .form-control {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
        background: {{ Auth::check() && isset(Auth::user()->settings['theme']) && Auth::user()->settings['theme'] === 'dark' ? '#333' : '#fff' }};
        color: {{ Auth::check() && isset(Auth::user()->settings['theme']) && Auth::user()->settings['theme'] === 'dark' ? '#e0e0e0' : '#333' }};
        border-color: {{ Auth::check() && isset(Auth::user()->settings['theme']) && Auth::user()->settings['theme'] === 'dark' ? '#444' : '#ddd' }};
    }

    .footer-newsletter .form-control:focus {
        box-shadow: none;
        border-color: var(--bs-primary);
    }

    .footer-newsletter .btn {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }

    /* Copyright Bar */
    .footer-copyright {
        background: {{ Auth::check() && isset(Auth::user()->settings['theme']) && Auth::user()->settings['theme'] === 'dark' ? '#111' : '#e9ecef' }};
    }

    /* Drink Icon Decor */
    .drink-decor {
        display: flex;
        gap: 15px;
        font-size: 24px;
    }

    .drink-decor i {
        color: var(--bs-primary);
        animation: float 3s ease-in-out infinite;
    }

    .drink-decor i:nth-child(2) {
        animation-delay: 0.5s;
    }

    .drink-decor i:nth-child(3) {
        animation-delay: 1s;
    }

    @keyframes float {
        0% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
        100% { transform: translateY(0); }
    }

    @media (max-width: 767.98px) {
        .footer-copyright .text-md-end {
            text-align: center !important;
            margin-top: 1rem;
        }
    }
    </style>

    <script>
        // Initialize theme from localStorage or user settings
        (function() { // Use IIFE to avoid global scope pollution
            function initTheme() {
                @if(Auth::check())
                    @if(isset(Auth::user()->settings['theme']))
                        const userTheme = "{{ Auth::user()->settings['theme'] }}";
                        if (userTheme === 'system') {
                            const prefersDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
                            document.documentElement.setAttribute('data-bs-theme', prefersDarkMode ? 'dark' : 'light');
                        } else {
                            document.documentElement.setAttribute('data-bs-theme', userTheme);
                        }
                    @endif
                @endif
            }
            
            // Call on page load
            initTheme();
        })(); // Immediately invoke the function
    </script>
</body>
</html>

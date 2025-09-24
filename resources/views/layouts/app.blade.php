<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Keshari Laminates - Premium Quality Laminates')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary-orange: #ff6b35;
            --secondary-orange: #f7941d;
            --light-orange: #fff5f2;
            --dark-orange: #cc5529;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: 76px; /* Account for fixed navbar */
        }

        .navbar {
            background: linear-gradient(135deg, var(--primary-orange) 0%, var(--secondary-orange) 100%);
            box-shadow: 0 2px 10px rgba(255, 107, 53, 0.3);
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: white !important;
        }

        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            margin: 0 10px;
            transition: all 0.3s;
        }

        .navbar-nav .nav-link:hover, .navbar-nav .nav-link.active {
            color: white !important;
            transform: translateY(-2px);
        }

        .btn-primary {
            background-color: var(--primary-orange);
            border-color: var(--primary-orange);
        }

        .btn-primary:hover {
            background-color: var(--secondary-orange);
            border-color: var(--secondary-orange);
        }

        .text-primary {
            color: var(--primary-orange) !important;
        }

        .footer {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: white;
            padding: 60px 0 20px;
            margin-top: 80px;
        }

        .footer h5 {
            color: var(--primary-orange);
            font-weight: bold;
            margin-bottom: 20px;
        }

        .footer a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer a:hover {
            color: var(--primary-orange);
        }

        .breadcrumb-item a {
            color: var(--primary-orange);
            text-decoration: none;
        }

        .breadcrumb-item a:hover {
            color: var(--secondary-orange);
        }

        .breadcrumb-item.active {
            color: #6c757d;
        }

        @yield('styles')
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="bi bi-building"></i> Keshari Laminates
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('products*') ? 'active' : '' }}" href="{{ route('products') }}">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5><i class="bi bi-building me-2"></i>Keshari Laminates</h5>
                    <p>Your trusted partner for premium quality laminates. We provide wholesale distribution of laminates, bells, promica, and decor plys.</p>
                    <div class="d-flex gap-3">
                        <a href="#"><i class="bi bi-facebook fs-4"></i></a>
                        <a href="#"><i class="bi bi-instagram fs-4"></i></a>
                        <a href="#"><i class="bi bi-twitter fs-4"></i></a>
                        <a href="#"><i class="bi bi-linkedin fs-4"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 mb-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('products') }}">Products</a></li>
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 mb-4">
                    <h5>Product Categories</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('products') }}?category=solid">Plain/Solid Laminates</a></li>
                        <li><a href="{{ route('products') }}?category=wooden">Wooden Laminates</a></li>
                        <li><a href="{{ route('products') }}?category=abstract">Abstract Laminates</a></li>
                        <li><a href="{{ route('products') }}?category=decor">Decor Plys</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 mb-4">
                    <h5>Contact Info</h5>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-geo-alt me-2"></i>Business Address, City</li>
                        <li><i class="bi bi-telephone me-2"></i>+91 9876543210</li>
                        <li><i class="bi bi-envelope me-2"></i>info@kesharilaminates.com</li>
                        <li><i class="bi bi-clock me-2"></i>Mon-Sat: 9AM-6PM</li>
                    </ul>
                </div>
            </div>
            <hr class="my-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0">&copy; 2025 Keshari Laminates. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0">Designed with <i class="bi bi-heart-fill text-danger"></i> for better business</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
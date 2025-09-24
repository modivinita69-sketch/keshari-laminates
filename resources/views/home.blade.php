<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keshari Laminates - Premium Quality Laminates</title>
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

        .navbar-nav .nav-link:hover {
            color: white !important;
            transform: translateY(-2px);
        }

        .hero-section {
            background: linear-gradient(135deg, var(--primary-orange) 0%, var(--secondary-orange) 100%);
            color: white;
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="rgba(255,255,255,0.1)"><polygon points="0,100 1000,0 1000,100"/></svg>') no-repeat bottom;
            background-size: cover;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .btn-primary-orange {
            background-color: white;
            border-color: white;
            color: var(--primary-orange);
            font-weight: 600;
            padding: 12px 30px;
            border-radius: 50px;
            transition: all 0.3s;
        }

        .btn-primary-orange:hover {
            background-color: var(--light-orange);
            border-color: var(--light-orange);
            color: var(--dark-orange);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .section-title {
            color: var(--primary-orange);
            font-weight: bold;
            margin-bottom: 3rem;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: linear-gradient(135deg, var(--primary-orange), var(--secondary-orange));
            border-radius: 2px;
        }

        .category-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 5px 25px rgba(255, 107, 53, 0.1);
            transition: all 0.3s;
            border: 1px solid rgba(255, 107, 53, 0.1);
        }

        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(255, 107, 53, 0.2);
            border-color: var(--primary-orange);
        }

        .category-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-orange), var(--secondary-orange));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: white;
            font-size: 2rem;
        }

        .product-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
            border: none;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .product-image {
            height: 200px;
            background: var(--light-orange);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-orange);
            font-size: 4rem;
        }

        .product-badge {
            background: var(--primary-orange);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .footer {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: white;
            padding: 4rem 0 2rem;
        }

        .footer h5 {
            color: var(--secondary-orange);
            margin-bottom: 1rem;
        }

        .footer a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer a:hover {
            color: var(--secondary-orange);
        }

        .stats-section {
            background: var(--light-orange);
            padding: 4rem 0;
        }

        .stat-item {
            text-align: center;
            padding: 2rem;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: bold;
            color: var(--primary-orange);
            display: block;
        }

        .stat-label {
            color: #666;
            font-weight: 600;
            margin-top: 0.5rem;
        }
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
                        <a class="nav-link active" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products') }}">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container hero-content">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">
                        {{ $company_info['hero_title'] ?? 'Premium Quality Laminates' }}
                    </h1>
                    <p class="lead mb-4">
                        {{ $company_info['hero_subtitle'] ?? 'Wholesale distributor of premium laminates, bells, promica, and decor plys for all your interior design needs.' }}
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ route('products') }}" class="btn btn-primary-orange btn-lg">
                            <i class="bi bi-box me-2"></i>View Products
                        </a>
                        <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg">
                            <i class="bi bi-telephone me-2"></i>Get Quote
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <div class="hero-image">
                        <i class="bi bi-layers" style="font-size: 15rem; opacity: 0.3;"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Our Product Categories</h2>
                <p class="lead text-muted">Explore our wide range of premium laminate categories</p>
            </div>
            <div class="row g-4">
                @forelse($categories ?? [] as $category)
                <div class="col-md-6 col-lg-4">
                    <div class="category-card">
                        <div class="category-icon">
                            <i class="bi bi-layers"></i>
                        </div>
                        <h4>{{ $category->name }}</h4>
                        <p class="text-muted">{{ $category->description }}</p>
                        <a href="{{ route('products', ['category' => $category->slug]) }}" class="btn btn-outline-primary">
                            View Products <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center">
                    <p class="text-muted">Categories will be displayed here</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Featured Products</h2>
                <p class="lead text-muted">Discover our most popular laminate products</p>
            </div>
            <div class="row g-4">
                @forelse($featured_products ?? [] as $product)
                <div class="col-md-6 col-lg-3">
                    <div class="card product-card">
                        <div class="product-image">
                            @if($product->primaryImage)
                                <img src="{{ asset('storage/' . $product->primaryImage->image_path) }}" alt="{{ $product->name }}" class="w-100 h-100 object-fit-cover">
                            @else
                                <i class="bi bi-image"></i>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <span class="product-badge">{{ $product->category->name ?? 'General' }}</span>
                                @if($product->product_code)
                                    <small class="text-muted">{{ $product->product_code }}</small>
                                @endif
                            </div>
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($product->description, 100) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('products.show', $product->slug) }}" class="btn btn-primary">
                                    View Details
                                </a>
                                @if($product->catalogs->count() > 0)
                                    <small class="text-success">
                                        <i class="bi bi-file-pdf"></i> Catalog Available
                                    </small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center">
                    <p class="text-muted">Featured products will be displayed here</p>
                </div>
                @endforelse
            </div>
            <div class="text-center mt-5">
                <a href="{{ route('products') }}" class="btn btn-primary-orange btn-lg">
                    View All Products <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <span class="stat-number">500+</span>
                        <div class="stat-label">Products</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <span class="stat-number">15+</span>
                        <div class="stat-label">Years Experience</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <span class="stat-number">1000+</span>
                        <div class="stat-label">Happy Clients</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <span class="stat-number">24/7</span>
                        <div class="stat-label">Support</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="section-title text-start">About Keshari Laminates</h2>
                    <p class="lead">
                        {{ $company_info['about_us'] ?? 'We are a leading wholesale distributor of premium quality laminates, serving customers with excellence for over a decade.' }}
                    </p>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Premium Quality Products</li>
                        <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Wholesale Pricing</li>
                        <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Expert Customer Support</li>
                        <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Quick Delivery</li>
                    </ul>
                    <a href="{{ route('about') }}" class="btn btn-primary-orange">
                        Learn More <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="col-lg-6 text-center">
                    <div class="p-5">
                        <i class="bi bi-award" style="font-size: 10rem; color: var(--primary-orange); opacity: 0.8;"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
                        <li><a href="#">Plain/Solid Laminates</a></li>
                        <li><a href="#">Wooden Laminates</a></li>
                        <li><a href="#">Abstract Laminates</a></li>
                        <li><a href="#">Decor Plys</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 mb-4">
                    <h5>Contact Info</h5>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-geo-alt me-2"></i>Business Address</li>
                        <li><i class="bi bi-telephone me-2"></i>+91 XXXXX XXXXX</li>
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
</body>
</html>
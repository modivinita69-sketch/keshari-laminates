@extends('layouts.app')

@section('title', 'Keshari Laminates - Premium Quality Laminates')

@section('styles')
<style>
        /* Remove padding-top on home page */
        body {
            padding-top: 0 !important;
        }

        /* Ensure navbar is over the hero */
        .navbar {
            background: transparent;
            box-shadow: none;
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            box-shadow: 0 2px 10px rgba(var(--primary-color-rgb), 0.3);
        }

        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
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
            color: var(--primary-color);
            font-weight: 600;
            padding: 12px 30px;
            border-radius: 50px;
            transition: all 0.3s;
        }

        .btn-primary-orange:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .section-title {
            color: var(--primary-color);
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
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 2px;
        }

        .category-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 5px 25px rgba(var(--primary-color-rgb), 0.1);
            transition: all 0.3s;
            border: 1px solid rgba(255, 107, 53, 0.1);
        }

        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(var(--primary-color-rgb), 0.2);
            border-color: var(--primary-color);
        }

        .category-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
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
            background: rgba(var(--primary-color-rgb), 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            font-size: 4rem;
        }

        .product-badge {
            background: var(--primary-color);
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
            color: var(--secondary-color);
            margin-bottom: 1rem;
        }

        .footer a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer a:hover {
            color: var(--secondary-color);
        }

        .stats-section {
            background: rgba(var(--primary-color-rgb), 0.1);
            padding: 4rem 0;
        }

        .stat-item {
            text-align: center;
            padding: 2rem;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: bold;
            color: var(--primary-color);
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


    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container hero-content">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">
                        {{ $company_info['hero_title'] ?? 'Premium Quality Laminatesss' }}
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
                        <i class="bi bi-award" style="font-size: 10rem; color: var(--primary-color); opacity: 0.8;"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script>
(function() {
    // Get navbar element
    var navbar = document.querySelector('.navbar');
    
    // Function to check scroll position and update navbar
    function checkScroll() {
        if (navbar) {
            if (window.pageYOffset > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        }
    }
    
    // Add scroll event listener
    if (window) {
        window.addEventListener('scroll', checkScroll, { passive: true });
        // Check initial position
        checkScroll();
    }
}());</script>
@endpush
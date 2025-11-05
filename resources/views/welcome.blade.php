@extends('layouts.app')

@section('title', 'Welcome to Keshari Laminates - Premium Quality Laminates')

@push('styles')
    <!-- Add Swiper's CSS and Animate.css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="{{ route('theme.css') }}?v={{ md5(serialize(\App\Models\ThemeSetting::getThemeColors())) }}">
    <link rel="stylesheet" href="{{ asset('css/sections.css') }}">
    <link rel="stylesheet" href="{{ asset('css/reveal.css') }}">
    <style>
        /* Hero Slider         <!-- Background Slider -->
        <div class="hero-slider swiper">
            <div class="swiper-wrapper">
                @forelse($hero_slides as $slide)
                    <div class="swiper-slide">
                        <img src="{{ asset('storage/' . $slide->image_path) }}" 
                             alt="{{ $slide->title }}"
                             @if($slide->title || $slide->subtitle)
                             title="{{ $slide->title }} - {{ $slide->subtitle }}"
                             @endif
                        >
                    </div>
                @empty
                    <div class="swiper-slide">
                        <div class="default-hero-image" 
                             style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-layers text-white" style="font-size: 8rem; opacity: 0.1;"></i>
                        </div>
                    </div>
                @endforelse
            </div>
            @if(count($hero_slides) > 1)
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
            @endif
        </div>     .hero-slider {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        .hero-slider .swiper-slide {
            width: 100%;
            height: 100%;
        }

        .hero-slider .swiper-slide img {
            width: 100%;
            max-width: 100%;
            height: auto;
            opacity: 0.6;
            display: block;
        }

        @media (max-width: 768px) {
            .hero-slider .swiper-slide img {
                object-position: center;
                height: 100vh;
                width: 100%;
                object-fit: cover;
            }
            .hero-slider {
                height: 100vh;
            }
            .hero-section {
                height: 100vh;
            }
        }

        .hero-slider::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, 
                rgba(0, 0, 0, 0.8) 0%, 
                rgba(0, 0, 0, 0.6) 100%);
            z-index: 1;
        }

        /* Swiper Navigation Styles */
        .hero-slider .swiper-button-next,
        .hero-slider .swiper-button-prev {
            color: white;
            background: rgba(0, 0, 0, 0.3);
            width: 50px;
            height: 50px;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .hero-slider .swiper-button-next:hover,
        .hero-slider .swiper-button-prev:hover {
            background: rgba(var(--primary-color-rgb), 0.8);
        }

        .hero-slider .swiper-button-next:after,
        .hero-slider .swiper-button-prev:after {
            font-size: 1.5rem;
        }

        .hero-slider .swiper-pagination-bullet {
            width: 12px;
            height: 12px;
            background: white;
            opacity: 0.5;
        }

        .hero-slider .swiper-pagination-bullet-active {
            opacity: 1;
            background: var(--primary-color);
        }

        .default-hero-image {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        /* Animation Keyframes */
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

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
            100% {
                transform: translateY(0px);
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }

        /* Animate on scroll utility classes */
        .animate {
            opacity: 0;
            transition: all 0.5s;
        }

        .animate.active {
            opacity: 1;
        }

        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }
        .delay-4 { animation-delay: 0.4s; }

        .hero-section {
            position: relative;
            overflow: hidden;
            margin-top: 0;
            height: 80vh;
            min-height: 400px;
            background: #000;
        }

        @media (max-width: 768px) {
            .hero-section {
                height: auto;
                min-height: auto;
            }
            
            .hero-slider,
            .hero-slider .swiper-wrapper,
            .hero-slider .swiper-slide {
                height: auto !important;
            }
            
            .hero-slider .swiper-slide img {
                height: auto;
                width: 100%;
                object-fit: contain;
                object-position: center;
                aspect-ratio: 4/3;
            }

            .hero-slider::after {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
            }
        }

        .hero-content-section {
            position: relative;
            z-index: 2;
            background: var(--primary-color);
        }

        @media (max-width: 768px) {
            .hero-content-section {
                padding: 2rem 0;
                position: relative;
                z-index: 3;
                background: var(--primary-color);
            }
            
            .hero-content-section .container {
                padding: 1rem;
            }

            .btn-group-horizontal {
                flex-wrap: wrap;
                justify-content: center;
                padding: 0.5rem;
            }

            .btn-group-horizontal .btn {
                width: auto;
                min-width: 200px;
                margin: 0.5rem;
            }

            .hero-content h1 {
                font-size: 1.8rem;
                margin-bottom: 1rem;
            }

            .hero-content p {
                font-size: 1rem;
                margin-bottom: 1.5rem;
            }
        }

        .btn-group-horizontal {
            display: flex;
            gap: 1rem;
            padding: 0.5rem;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .btn-group-horizontal::-webkit-scrollbar {
            display: none;
        }

        .btn-group-horizontal .btn {
            flex: 0 0 auto;
            white-space: nowrap;
            padding: 0.8rem 1.5rem;
        }

        @media (min-width: 768px) {
            .hero-content {
                padding: 3rem 2rem;
                margin: 0 auto;
                max-width: 800px;
            }

            .btn-group-horizontal {
                justify-content: center;
                overflow: visible;
            }
        }

        .hero-content h1 {
            animation: fadeInRight 1s ease-out;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            font-size: calc(1.8rem + 2vw);
            line-height: 1.2;
            margin-bottom: 1rem;
        }

        .hero-content p {
            animation: fadeInRight 1s ease-out 0.2s backwards;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
            font-size: calc(1rem + 0.5vw);
            line-height: 1.5;
        }

        .hero-content .btn {
            animation: fadeInRight 1s ease-out 0.4s backwards;
            margin: 0.5rem;
        }

        @media (max-width: 576px) {
            .hero-content h1 {
                font-size: 1.8rem;
            }
            .hero-content p {
                font-size: 1rem;
            }
            .hero-content .btn {
                width: 100%;
                margin: 0.5rem 0;
            }
        }

        .hero-image {
            animation: float 6s ease-in-out infinite;
            display: none;
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
            background-color: rgba(var(--primary-color-rgb), 0.1);
            border-color: var(--primary-color);
            color: var(--primary-color);
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
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(var(--primary-color-rgb), 0.1);
            margin-bottom: 2rem;
            opacity: 0;
            transform: translateY(20px);
        }

        .category-card.active {
            opacity: 1;
            transform: translateY(0);
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

        .stats-section {
            background: rgba(var(--primary-color-rgb), 0.1);
            padding: 4rem 0;
        }

        .stat-item {
            text-align: center;
            padding: 2rem;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .stat-item.active {
            opacity: 1;
            transform: translateY(0);
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

        .bg-primary-light {
            background-color: rgba(var(--primary-color-rgb), 0.1);
        }

        .badge {
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        .rounded-pill {
            border-radius: 50rem !important;
        }
    </style>
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <!-- Full Width Slider -->
        <div class="hero-slider swiper">
            <div class="swiper-wrapper">
                @forelse($hero_slides as $slide)
                    <div class="swiper-slide">
                        <img src="{{ asset($slide->image_path) }}" 
                             alt="{{ $slide->title }}"
                             @if($slide->title || $slide->subtitle)
                             title="{{ $slide->title }} - {{ $slide->subtitle }}"
                             @endif
                        >
                    </div>
                @empty
                    <div class="swiper-slide">
                        <div class="default-hero-image">
                            <i class="bi bi-layers text-white" style="font-size: 8rem; opacity: 0.1;"></i>
                        </div>
                    </div>
                @endforelse
            </div>
            @if(count($hero_slides) > 1)
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
            @endif
        </div>
    </section>

    <!-- Hero Content Section -->
    <section class="hero-content-section py-5 bg-primary text-white">
        <div class="container">
            <div class="text-center">
                <h1 class="fw-bold mb-4 animate__animated animate__fadeInUp">
                    {{ $company_info['hero_title'] ?? 'Premium Quality Laminates' }}
                </h1>
                <p class="lead mb-4 animate__animated animate__fadeInUp animate__delay-1s">
                    {{ $company_info['hero_subtitle'] ?? 'Wholesale distributor of premium laminates, bells, promica, and decor plys for all your interior design needs.' }}
                </p>
                <div class="btn-group-horizontal animate__animated animate__fadeInUp animate__delay-2s">
                    <a href="/products" class="btn btn-light btn-lg hover-scale">
                        <i class="bi bi-box me-2"></i>View Products
                    </a>
                    <a href="/contact" class="btn btn-outline-light btn-lg hover-scale">
                        <i class="bi bi-telephone me-2"></i>Get Quote
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Catalogs Section -->
    <section id="catalogs" class="py-5 reveal-section bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <span class="badge bg-primary-light text-primary mb-2 px-3 py-2 rounded-pill">Product Catalogs</span>
                <h2 class="section-title">Download Our Catalogs</h2>
                <p class="lead text-muted">Browse through our comprehensive product catalogs</p>
            </div>

            @if($catalogs && count($catalogs) > 0)
                <div class="row g-4">
                    @foreach($catalogs as $catalog)
                        <div class="col-md-6 col-lg-4">
                            <div class="catalog-card section-fade-up stagger-animation">
                                <div class="card h-100">
                                    <div class="catalog-thumbnail">
                                        @if($catalog->thumbnail_path)
                                            <img src="{{ asset('storage/' . $catalog->thumbnail_path) }}" 
                                                 class="card-img-top" 
                                                 alt="{{ $catalog->title }}"
                                                 style="height: 200px; object-fit: cover;">
                                        @else
                                            <div class="text-center p-4 bg-light">
                                                <i class="bi bi-file-pdf text-primary" style="font-size: 4rem;"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $catalog->title }}</h5>
                                        @if($catalog->description)
                                            <p class="card-text text-muted">{{ $catalog->description }}</p>
                                        @endif
                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                            <span class="text-muted small">
                                                <i class="bi bi-download"></i> 
                                                {{ $catalog->download_count }} downloads
                                            </span>
                                            <a href="{{ route('catalogs.download', $catalog) }}" 
                                               class="btn btn-primary"
                                               target="_blank">
                                                <i class="bi bi-download me-2"></i>Download
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center">
                    <div class="mb-4">
                        <i class="bi bi-file-pdf" style="font-size: 4rem; color: var(--primary-orange); opacity: 0.5;"></i>
                    </div>
                    <h4>Catalogs Coming Soon</h4>
                    <p class="lead text-muted">Our product catalogs will be available for download soon.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Categories Section -->
    <section class="pt-5 pb-5 reveal-section" style="margin-top: -20px;">
        <div class="container">
            <div class="text-center mb-5">
                <span class="badge bg-primary-light text-primary mb-2 px-3 py-2 rounded-pill">Shop by Categories</span>
                <h2 class="section-title">Our Product Categories</h2>
                <p class="lead text-muted">Explore our wide range of premium laminate categories</p>
            </div>
            
            @if($leaf_categories && count($leaf_categories) > 0)
                <div class="row g-4">
                    @foreach($leaf_categories as $category)
                        <div class="col-md-6 col-lg-4">
                            <div class="category-card section-fade-up stagger-animation">
                                <div class="category-image">
                                    @if($category->image)
                                        <img src="{{ asset($category->image) }}" 
                                             alt="{{ $category->name }}" 
                                             class="img-fluid"
                                             onerror="this.onerror=null; this.src='{{ asset('images/placeholder.jpg') }}';">
                                    @else
                                        <div class="category-icon">
                                            @switch(strtolower($category->name))
                                                @case('plain/solid laminates')
                                                @case('plain/solid')
                                                    <i class="bi bi-square"></i>
                                                    @break
                                                @case('wooden laminates')
                                                @case('wooden')
                                                    <i class="bi bi-tree"></i>
                                                    @break
                                                @case('abstract laminates')
                                                @case('abstract')
                                                    <i class="bi bi-palette"></i>
                                                    @break
                                                @case('decor plys')
                                                    <i class="bi bi-layers"></i>
                                                    @break
                                                @case('bell laminates')
                                                @case('bell')
                                                    <i class="bi bi-bell"></i>
                                                    @break
                                                @case('promica laminates')
                                                @case('promica')
                                                    <i class="bi bi-award"></i>
                                                    @break
                                                @default
                                                    <i class="bi bi-grid"></i>
                                            @endswitch
                                        </div>
                                    @endif
                                </div>
                                <div class="category-content p-4">
                                    <h4>{{ $category->name }}</h4>
                                    @if($category->parent)
                                        <small class="text-muted d-block mb-2">{{ $category->getFullName() }}</small>
                                    @endif
                                    <p class="text-muted mb-4">{{ $category->description ?? 'Premium quality ' . strtolower($category->name) }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-success">
                                            <i class="bi bi-box me-1"></i>{{ $category->products()->count() }} Products
                                        </span>
                                        <a href="{{ route('products', ['category' => $category->path ?: $category->slug]) }}" 
                                           class="btn btn-outline-primary btn-sm">
                                            View Products <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="col-12 text-center">
                    <p class="lead text-muted">Categories will be displayed here once they are added to the database.</p>
                    <a href="/admin/login" class="btn btn-primary-orange">Access Admin Panel</a>
                </div>
            @endif
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="py-5 bg-light reveal-section">
        <div class="container">
            <div class="text-center mb-5">
                <span class="badge bg-primary-light text-primary mb-2 px-3 py-2 rounded-pill">Featured Collection</span>
                <h2 class="section-title">Featured Products</h2>
                <p class="lead text-muted">Discover our most popular and premium laminate products</p>
            </div>
            @if($featured_products && count($featured_products) > 0)
                <div class="row g-4">
                    @foreach($featured_products->take(8) as $product)
                        <div class="col-md-6 col-lg-3">
                            <div class="product-card section-fade-up stagger-animation">
                                <div class="product-image-wrapper">
                                    @if($product->images && count($product->images) > 0)
                                        <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" 
                                             class="product-image" 
                                             alt="{{ $product->name }}">
                                    @else
                                        <div class="product-image bg-light d-flex align-items-center justify-content-center">
                                            <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                                        </div>
                                    @endif
                                    <div class="product-overlay"></div>
                                    @if($product->is_featured)
                                        <span class="position-absolute top-0 start-0 badge bg-warning m-2">
                                            <i class="bi bi-star-fill"></i> Featured
                                        </span>
                                    @endif
                                </div>
                                <div class="card-body p-4">
                                    <div class="mb-2">
                                        <span class="badge bg-light text-primary">{{ $product->category->name ?? 'Laminate' }}</span>
                                    </div>
                                    <h5 class="card-title mb-3">{{ $product->name }}</h5>
                                    <p class="card-text text-muted small mb-4">
                                        {{ Str::limit($product->description, 60) }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center mt-auto">
                                        @if($product->price)
                                            <span class="h6 mb-0 text-primary">₹{{ number_format($product->price, 2) }}</span>
                                        @else
                                            <span class="text-muted">Price on request</span>
                                        @endif
                                        <a href="{{ route('products.show', $product->slug) }}" 
                                           class="btn btn-outline-primary btn-sm">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-5">
                    <a href="{{ route('products') }}" class="btn btn-primary-orange btn-lg">
                        View All Products <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            @else
                <div class="text-center">
                    <div class="mb-4">
                        <i class="bi bi-box" style="font-size: 4rem; color: var(--primary-orange); opacity: 0.5;"></i>
                    </div>
                    <h4>Products Coming Soon</h4>
                    <p class="lead text-muted">Featured products will be displayed here once they are added to the database.</p>
                    <a href="/admin/login" class="btn btn-primary-orange">Access Admin Panel</a>
                </div>
            @endif
        </div>
    </section>

    <!-- Brands Section -->
    <section class="py-5 reveal-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Our Trusted Brands</h2>
                <p class="lead text-muted">We partner with the best laminate manufacturers in the industry</p>
            </div>
            @if($brands && count($brands) > 0)
                <div class="row g-4 justify-content-center align-items-center">
                    @foreach($brands as $brand)
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="brand-card section-fade-up stagger-animation">
                                <div class="text-center">
                                    @if($brand->logo)
                                        <img src="{{ asset($brand->logo) }}" 
                                             alt="{{ $brand->name }}" 
                                             class="brand-logo img-fluid mb-4"
                                             style="max-height: 80px; object-fit: contain;">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center mb-4" 
                                             style="height: 80px;">
                                            <i class="bi bi-building text-muted" style="font-size: 2rem;"></i>
                                        </div>
                                    @endif
                                    <h5 class="brand-name mb-3">{{ $brand->name }}</h5>
                                    <p class="brand-description text-muted mb-3">{{ Str::limit($brand->description, 100) }}</p>
                                    <div class="badge bg-light text-primary">
                                        <i class="bi bi-box me-1"></i> {{ $brand->products->count() }} Products
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center">
                    <div class="mb-4">
                        <i class="bi bi-building" style="font-size: 4rem; color: var(--primary-orange); opacity: 0.5;"></i>
                    </div>
                    <h4>Brands Coming Soon</h4>
                    <p class="text-muted">Our brand partners will be displayed here soon.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section reveal-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <span class="stat-number">2000+</span>
                        <div class="stat-label">designs</div>
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
                        <span class="stat-number">1080+</span>
                        <div class="stat-label">Happy vendors accross india</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <span class="stat-number">24 hours</span>
                        <div class="stat-label">Support / Uninterrupted help</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-5 reveal-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="section-title text-start">About Keshari Laminates</h2>
                    <p class="lead">
                        We are a leading wholesale distributor of premium quality laminates, serving customers with excellence for over a decade.
                    </p>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Premium Quality Products</li>
                        <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Wholesale Pricing</li>
                        <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Expert Customer Support</li>
                        <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Quick Delivery</li>
                    </ul>
                    <a href="/about" class="btn btn-primary-orange">
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

    <!-- Add Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intersection-observer/1.0.0/intersection-observer.min.js" defer></script>
    
    <!-- Animation JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Background Slider
            const heroSlider = new Swiper('.hero-slider', {
                effect: 'fade',
                speed: 1500,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                loop: true,
                fadeEffect: {
                    crossFade: true
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev'
                }
            });

            // Initialize Hero Content Slider
            const heroContentSlider = new Swiper('.hero-slides', {
                direction: 'horizontal',
                slidesPerView: 'auto',
                freeMode: true,
                grabCursor: true,
                mousewheel: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true
                }
            });

            // Section Reveal Animation
            const revealSection = (entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                        
                        // Trigger animations for children after parent section is revealed
                        setTimeout(() => {
                            const animatedElements = entry.target.querySelectorAll(
                                '.section-fade-up, .category-card, .product-card, .brand-card, .stat-item'
                            );
                            
                            animatedElements.forEach((el, index) => {
                                el.style.transitionDelay = `${index * 0.1}s`;
                                setTimeout(() => {
                                    el.classList.add('active');
                                }, 100);
                            });

                            // Animate section title
                            const sectionTitle = entry.target.querySelector('.section-title');
                            if (sectionTitle) {
                                setTimeout(() => {
                                    sectionTitle.classList.add('active');
                                }, 200);
                            }
                        }, 300);

                        // Start counter animation if it's the stats section
                        if (entry.target.classList.contains('stats-section')) {
                            animateCounters(entry.target);
                        }

                        // Unobserve after animation
                        observer.unobserve(entry.target);
                    }
                });
            };

            // Create the observer
            const sectionObserver = new IntersectionObserver(revealSection, {
                root: null,
                rootMargin: '-50px',
                threshold: 0.15
            });

            // Observe all sections
            document.querySelectorAll('.reveal-section').forEach(section => {
                sectionObserver.observe(section);
            });

            // Counter animation function
            function animateCounters(section) {
                section.querySelectorAll('.stat-number').forEach(stat => {
                    const target = parseFloat(stat.textContent);
                    const suffix = stat.textContent.replace(/[0-9.+]/g, '');
                    let current = 0;
                    
                    const updateCounter = () => {
                        const increment = target / 50;
                        if (current < target) {
                            current += increment;
                            if (current > target) current = target;
                            stat.textContent = Math.floor(current) + suffix;
                            requestAnimationFrame(updateCounter);
                        }
                    };

                    setTimeout(updateCounter, 400);
                });
            }

            // Add smooth scroll for navigation
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
        });
    </script>
@endsection
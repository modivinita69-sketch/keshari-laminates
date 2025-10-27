@extends('layouts.app')

@section('title', 'Welcome to Keshari Laminates - Premium Quality Laminates')

@push('styles')
    <!-- Add Swiper's CSS and Animate.css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
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
            height: 100%;
            object-fit: cover;
            opacity: 0.6;
        }

        .hero-slider::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, 
                rgba(0, 0, 0, 0.7) 0%, 
                rgba(0, 0, 0, 0.5) 100%);
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
            color: white;
            padding: 100px 0;
            position: relative;
            overflow: hidden;
            margin-top: 0;
            min-height: 600px;
            display: flex;
            align-items: center;
            background: #000;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-content h1 {
            animation: fadeInRight 1s ease-out;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .hero-content p {
            animation: fadeInRight 1s ease-out 0.2s backwards;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        .hero-content .btn {
            animation: fadeInRight 1s ease-out 0.4s backwards;
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
    </style>
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <!-- Background Slider -->
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
                        <div class="slide-content">
                            <div class="container">
                                <h2 class="slide-title">{{ $slide->title }}</h2>
                                <p class="slide-subtitle">{{ $slide->subtitle }}</p>
                            </div>
                        </div>
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

        <div class="container hero-content">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h1 class="display-3 fw-bold mb-4 animate__animated animate__fadeInUp">
                        {{ $company_info['hero_title'] ?? 'Premium Quality Laminates' }}
                    </h1>
                    <p class="lead mb-4 animate__animated animate__fadeInUp animate__delay-1s">
                        {{ $company_info['hero_subtitle'] ?? 'Wholesale distributor of premium laminates, bells, promica, and decor plys for all your interior design needs.' }}
                    </p>
                    <div class="d-flex flex-wrap gap-3 justify-content-center animate__animated animate__fadeInUp animate__delay-2s">
                        <a href="/products" class="btn btn-primary-orange btn-lg hover-scale px-4 py-3">
                            <i class="bi bi-box me-2"></i>View Products
                        </a>
                        <a href="/contact" class="btn btn-outline-light btn-lg hover-scale px-4 py-3">
                            <i class="bi bi-telephone me-2"></i>Get Quote
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5 animate">
                <h2 class="section-title">Our Product Categories</h2>
                <p class="lead text-muted">Explore our wide range of premium laminate categories</p>
            </div>
            
            @if($leaf_categories && count($leaf_categories) > 0)
                <div class="row g-4">
                    @foreach($leaf_categories as $category)
                        <div class="col-md-6 col-lg-4">
                            <div class="category-card">
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
                                <h4>{{ $category->name }}</h4>
                                @if($category->parent)
                                    <small class="text-muted d-block mb-2">{{ $category->getFullName() }}</small>
                                @endif
                                <p class="text-muted">{{ $category->description ?? 'Premium quality ' . strtolower($category->name) }}</p>
                                <div class="mb-3">
                                    <span class="badge bg-success">{{ $category->products()->count() }} Products</span>
                                </div>
                                <a href="{{ route('products', ['category' => $category->path ?: $category->slug]) }}" class="btn btn-outline-primary">
                                    View Products <i class="bi bi-arrow-right"></i>
                                </a>
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
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Featured Products</h2>
                <p class="lead text-muted">Discover our most popular and premium laminate products</p>
            </div>
            @if($featured_products && count($featured_products) > 0)
                <div class="row g-4">
                    @foreach($featured_products->take(8) as $product)
                        <div class="col-md-6 col-lg-3">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="position-relative">
                                    @if($product->images && count($product->images) > 0)
                                        <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" 
                                             class="card-img-top" 
                                             alt="{{ $product->name }}" 
                                             style="height: 200px; object-fit: cover;">
                                    @else
                                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" 
                                             style="height: 200px;">
                                            <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                                        </div>
                                    @endif
                                    @if($product->is_featured)
                                        <span class="position-absolute top-0 start-0 badge bg-warning m-2">
                                            <i class="bi bi-star-fill"></i> Featured
                                        </span>
                                    @endif
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <div class="mb-2">
                                        <small class="text-muted">{{ $product->category->name ?? 'Laminate' }}</small>
                                    </div>
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text text-muted small flex-grow-1">
                                        {{ Str::limit($product->description, 60) }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center mt-auto">
                                        @if($product->price)
                                            <span class="h6 mb-0 text-primary">₹{{ number_format($product->price, 2) }}</span>
                                        @else
                                            <span class="text-muted">Price on request</span>
                                        @endif
                                        <small class="text-muted">{{ $product->product_code }}</small>
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
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Our Trusted Brands</h2>
                <p class="lead text-muted">We partner with the best laminate manufacturers in the industry</p>
            </div>
            @if($brands && count($brands) > 0)
                <div class="row g-4 justify-content-center align-items-center">
                    @foreach($brands as $brand)
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body text-center p-4">
                                    @if($brand->logo)
                                        <img src="{{ asset('storage/' . $brand->logo) }}" 
                                             alt="{{ $brand->name }}" 
                                             class="img-fluid mb-3"
                                             style="max-height: 80px; object-fit: contain;">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center mb-3" 
                                             style="height: 80px;">
                                            <i class="bi bi-building text-muted" style="font-size: 2rem;"></i>
                                        </div>
                                    @endif
                                    <h5 class="card-title">{{ $brand->name }}</h5>
                                    <p class="card-text small text-muted mb-3">{{ Str::limit($brand->description, 100) }}</p>
                                    <div class="small text-muted">
                                        <i class="bi bi-box"></i> {{ $brand->products->count() }} Products
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
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    
    <!-- Animation JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Swiper
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
            // Animate elements when they enter the viewport
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                    }
                });
            }, {
                threshold: 0.1
            });

            // Observe all elements with animate class
            document.querySelectorAll('.animate, .category-card, .stat-item').forEach((el) => {
                observer.observe(el);
            });

            // Add stagger delay to category cards
            document.querySelectorAll('.category-card').forEach((card, index) => {
                card.style.transitionDelay = `${index * 0.1}s`;
            });

            // Add stagger delay to stat items
            document.querySelectorAll('.stat-item').forEach((stat, index) => {
                stat.style.transitionDelay = `${index * 0.1}s`;
            });
        });
    </script>
@endsection
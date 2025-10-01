@extends('layouts.app')

@section('title', 'Welcome to Keshari Laminates - Premium Quality Laminates')

@section('styles')
<style>
        .hero-section {
            background: linear-gradient(135deg, var(--primary-orange) 0%, var(--secondary-orange) 100%);
            color: white;
            padding: 100px 0;
            position: relative;
            overflow: hidden;
            margin-top: 0;
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
            transition: all 0.3s;
            border: 1px solid rgba(var(--primary-color-rgb), 0.1);
            margin-bottom: 2rem;
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
</head>
<body>

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
                        <a href="/products" class="btn btn-primary-orange btn-lg">
                            <i class="bi bi-box me-2"></i>View Products
                        </a>
                        <a href="/contact" class="btn btn-outline-light btn-lg">
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
                
                <!-- Category Tree Navigation -->
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-light">
                                <h5 class="mb-0"><i class="bi bi-diagram-3 me-2"></i>Complete Category Structure</h5>
                            </div>
                            <div class="card-body">
                                @foreach($categories as $rootCategory)
                                    <div class="category-tree mb-3">
                                        <div class="fw-bold text-primary mb-2">
                                            <i class="bi bi-folder me-1"></i>
                                            <a href="{{ route('products', ['category' => $rootCategory->path ?: $rootCategory->slug]) }}" 
                                               class="text-decoration-none">{{ $rootCategory->name }}</a>
                                        </div>
                                        @if($rootCategory->children && count($rootCategory->children) > 0)
                                            @foreach($rootCategory->children as $child)
                                                <div class="ms-4 mb-2">
                                                    <i class="bi bi-folder-fill me-1 text-secondary"></i>
                                                    <a href="{{ route('products', ['category' => $child->path ?: $child->slug]) }}" 
                                                       class="text-decoration-none">{{ $child->name }}</a>
                                                    @if($child->children && count($child->children) > 0)
                                                        @foreach($child->children as $grandchild)
                                                            <div class="ms-4">
                                                                <i class="bi bi-file-earmark me-1 text-muted"></i>
                                                                <a href="{{ route('products', ['category' => $grandchild->path ?: $grandchild->slug]) }}" 
                                                                   class="text-decoration-none small">{{ $grandchild->name }}</a>
                                                                <small class="text-muted">({{ $grandchild->products()->count() }} products)</small>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <small class="text-muted ms-3">({{ $child->products()->count() }} products)</small>
                                                    @endif
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
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

@endsection
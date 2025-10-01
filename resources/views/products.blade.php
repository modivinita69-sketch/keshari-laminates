@extends('layouts.app')

@section('title', isset($selected_category) ? $selected_category->name : (isset($category) ? $category->name : 'Products'))

@section('styles')
<style>
    .product-card {
        border: none;
        box-shadow: 0 5px 15px rgba(var(--primary-color-rgb), 0.1);
        transition: all 0.3s ease;
        border-radius: 15px;
        overflow: hidden;
    }
    
    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(var(--primary-color-rgb), 0.15);
    }
    
    .product-image {
        height: 200px;
        background: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    
    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .filter-section {
        background: rgba(var(--primary-color-rgb), 0.1);
        padding: 2rem 0;
        margin-bottom: 2rem;
    }
    
    .btn-outline-orange {
        color: var(--primary-color);
        border-color: var(--primary-color);
    }
    
    .btn-outline-orange:hover {
        color: white;
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }
    
    .btn-orange {
        color: white;
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }
    
    .btn-orange:hover {
        color: white;
        background-color: var(--secondary-color);
        border-color: var(--secondary-color);
    }
    
    .badge-category {
        background-color: var(--secondary-color);
        color: white;
    }
    
    .pagination .page-link {
        color: var(--primary-color);
    }
    
    .pagination .page-item.active .page-link {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }
</style>
@endsection

@section('content')

    <!-- Hero Section -->
    <div class="bg-light py-5">
        <div class="container">
            <div class="text-center mb-4">
                <h1 class="section-title">
                    @if(isset($selected_category))
                        {{ $selected_category->name }}
                    @elseif(isset($category))
                        {{ $category->name }}
                    @else
                        Our Products
                    @endif
                </h1>
                <p class="lead text-muted">
                    @if(isset($selected_category))
                        {{ $selected_category->description ?? 'Browse our ' . strtolower($selected_category->name) . ' collection' }}
                    @elseif(isset($category))
                        {{ $category->description ?? 'Browse our ' . strtolower($category->name) . ' collection' }}
                    @else
                        Premium quality laminates for all your interior design needs
                    @endif
                </p>
            </div>

            <!-- Breadcrumbs -->
            @if(isset($breadcrumbs) && count($breadcrumbs) > 0)
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center bg-white rounded shadow-sm py-2 px-3">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}" class="text-decoration-none">
                                <i class="bi bi-house-door me-1"></i>Home
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('products') }}" class="text-decoration-none">Products</a>
                        </li>
                        @foreach($breadcrumbs as $breadcrumb)
                            @if($loop->last)
                                <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb->name }}</li>
                            @else
                                <li class="breadcrumb-item">
                                    <a href="{{ route('products', ['category' => $breadcrumb->path ?: $breadcrumb->slug]) }}" 
                                       class="text-decoration-none">{{ $breadcrumb->name }}</a>
                                </li>
                            @endif
                        @endforeach
                    </ol>
                </nav>
            @endif
        </div>
    </div>

    <!-- Filter Section -->
    <div class="filter-section">
        <div class="container">
            <form method="GET" action="{{ route('products') }}" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="category" class="form-label fw-semibold">Category</label>
                    <select name="category" id="category" class="form-select">
                        <option value="">All Categories</option>
                        @if($categories && count($categories) > 0)
                            @foreach(collect($categories)->groupBy(function($cat) { return $cat->parent ? $cat->parent->name : 'Other'; }) as $groupName => $groupCategories)
                                @if($groupName !== 'Other')
                                    <optgroup label="{{ $groupName }}">
                                @endif
                                @foreach($groupCategories as $cat)
                                    <option value="{{ $cat->path ?: $cat->slug }}" 
                                            {{ request('category') === ($cat->path ?: $cat->slug) ? 'selected' : '' }}>
                                        @if($cat->parent)
                                            {{ $cat->name }} ({{ $cat->products()->count() }} products)
                                        @else
                                            {{ $cat->name }}
                                        @endif
                                    </option>
                                @endforeach
                                @if($groupName !== 'Other')
                                    </optgroup>
                                @endif
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="search" class="form-label fw-semibold">Search</label>
                    <input type="text" 
                           name="search" 
                           id="search" 
                           class="form-control" 
                           placeholder="Search products..."
                           value="{{ request('search') }}">
                </div>
                <div class="col-md-2">
                    <label for="sort" class="form-label fw-semibold">Sort By</label>
                    <select name="sort" id="sort" class="form-select">
                        <option value="">Default</option>
                        <option value="price_low" {{ request('sort') === 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="price_high" {{ request('sort') === 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-orange w-100">
                        <i class="bi bi-search"></i> Filter
                    </button>
                </div>
            </form>

            <!-- Category Quick Navigation -->
            @if(isset($root_categories) && count($root_categories) > 0)
                <div class="mt-4">
                    <h6 class="text-muted mb-3">Quick Category Navigation:</h6>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($root_categories as $rootCat)
                            @if($rootCat->children && count($rootCat->children) > 0)
                                @foreach($rootCat->children as $child)
                                    @if($child->products()->count() > 0 || $child->children()->whereHas('products')->count() > 0)
                                        <a href="{{ route('products', ['category' => $child->path ?: $child->slug]) }}" 
                                           class="btn btn-outline-secondary btn-sm">
                                            {{ $child->name }}
                                            <span class="badge bg-secondary ms-1">
                                                {{ $child->getAllProducts()->count() }}
                                            </span>
                                        </a>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Products Section -->
    <div class="container py-5">
        @if($products && count($products) > 0)
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>
                            Products 
                            <span class="text-muted fs-6">
                                ({{ $products->total() }} {{ Str::plural('product', $products->total()) }} found)
                            </span>
                        </h4>
                        @if(request()->hasAny(['category', 'search', 'sort']))
                            <a href="{{ route('products') }}" class="btn btn-outline-secondary btn-sm">
                                <i class="bi bi-x"></i> Clear Filters
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row g-4">
                @foreach($products as $product)
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="card product-card h-100">
                            <div class="product-image position-relative">
                                @if($product->images && count($product->images) > 0)
                                    <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" 
                                         alt="{{ $product->name }}" 
                                         class="card-img-top">
                                @else
                                    <div class="d-flex align-items-center justify-content-center h-100">
                                        <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                                    </div>
                                @endif
                                @if($product->is_featured)
                                    <span class="position-absolute top-0 end-0 badge bg-warning m-2">
                                        <i class="bi bi-star-fill"></i> Featured
                                    </span>
                                @endif
                            </div>
                            
                            <div class="card-body d-flex flex-column">
                                <div class="mb-2">
                                    <span class="badge badge-category">{{ $product->category->name ?? 'Laminate' }}</span>
                                    @if($product->product_code)
                                        <small class="text-muted ms-2">{{ $product->product_code }}</small>
                                    @endif
                                </div>
                                
                                <h5 class="card-title">{{ $product->name }}</h5>
                                
                                @if($product->description)
                                    <p class="card-text text-muted small flex-grow-1">
                                        {{ Str::limit($product->description, 80) }}
                                    </p>
                                @endif
                                
                                <div class="mt-auto">
                                    @if($product->price)
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <span class="h5 mb-0 text-primary">₹{{ number_format($product->price, 2) }}</span>
                                            @if($product->specifications && is_array($product->specifications))
                                                <small class="text-muted">
                                                    @if(isset($product->specifications['thickness']))
                                                        {{ $product->specifications['thickness'] }}mm
                                                    @endif
                                                </small>
                                            @endif
                                        </div>
                                    @else
                                        <div class="mb-3">
                                            <span class="text-muted">Price on request</span>
                                        </div>
                                    @endif
                                    
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('products.show', $product->slug) }}" class="btn btn-orange btn-sm">
                                            <i class="bi bi-eye"></i> View Details
                                        </a>
                                        <a href="{{ route('contact') }}" class="btn btn-outline-orange btn-sm">
                                            <i class="bi bi-telephone"></i> Get Quote
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($products->hasPages())
                <div class="d-flex justify-content-center mt-5">
                    {{ $products->links() }}
                </div>
            @endif

        @else
            <!-- No Products Found -->
            <div class="text-center py-5">
                <div class="mb-4">
                    <i class="bi bi-search" style="font-size: 4rem; color: var(--primary-color); opacity: 0.5;"></i>
                </div>
                <h4>No Products Found</h4>
                @if(request()->hasAny(['category', 'search', 'sort']))
                    <p class="lead text-muted">Try adjusting your filters or search terms.</p>
                    <a href="{{ route('products') }}" class="btn btn-orange">
                        <i class="bi bi-arrow-left"></i> View All Products
                    </a>
                @else
                    <p class="lead text-muted">Products will be displayed here once they are added to the database.</p>
                    <a href="/admin/login" class="btn btn-orange">Access Admin Panel</a>
                @endif
            </div>
        @endif
    </div>

@endsection
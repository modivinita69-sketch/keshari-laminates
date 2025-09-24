@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="container my-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products') }}" class="text-decoration-none">Products</a></li>
            @if($product->category)
                @php
                    $breadcrumbs = $product->category->getBreadcrumb();
                @endphp
                @foreach($breadcrumbs as $crumb)
                    <li class="breadcrumb-item">
                        <a href="{{ route('products.category', $crumb['slug']) }}" class="text-decoration-none">
                            {{ $crumb['name'] }}
                        </a>
                    </li>
                @endforeach
            @endif
            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Product Images -->
        <div class="col-lg-6 mb-4">
            @if($product->images->count() > 0)
                <!-- Main Image Carousel -->
                <div id="productCarousel" class="carousel slide mb-3" data-bs-ride="carousel">
                    <div class="carousel-inner rounded">
                        @foreach($product->images as $index => $image)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . $image->image_path) }}" 
                                     class="d-block w-100" 
                                     alt="{{ $product->name }}"
                                     style="height: 400px; object-fit: cover; cursor: zoom-in;"
                                     onclick="openImageModal('{{ asset('storage/' . $image->image_path) }}')">
                            </div>
                        @endforeach
                    </div>
                    @if($product->images->count() > 1)
                        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    @endif
                </div>

                <!-- Thumbnail Images -->
                @if($product->images->count() > 1)
                    <div class="row g-2">
                        @foreach($product->images as $index => $image)
                            <div class="col-3">
                                <img src="{{ asset('storage/' . $image->image_path) }}" 
                                     class="img-thumbnail w-100 {{ $index === 0 ? 'border-primary' : '' }}" 
                                     style="height: 80px; object-fit: cover; cursor: pointer;" 
                                     onclick="goToSlide({{ $index }})"
                                     id="thumb-{{ $index }}">
                            </div>
                        @endforeach
                    </div>
                @endif
            @else
                <!-- No Image Placeholder -->
                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 400px;">
                    <div class="text-center text-muted">
                        <i class="bi bi-image display-1"></i>
                        <p class="mt-2">No images available</p>
                    </div>
                </div>
            @endif
        </div>

        <!-- Product Information -->
        <div class="col-lg-6">
            <div class="product-info">
                <h1 class="display-5 fw-bold text-primary mb-3">{{ $product->name }}</h1>
                
                @if($product->category)
                    <div class="mb-3">
                        <span class="badge bg-secondary fs-6">{{ $product->category->name }}</span>
                        @if($product->is_featured)
                            <span class="badge bg-warning text-dark fs-6 ms-1">Featured</span>
                        @endif
                    </div>
                @endif

                @if($product->price)
                    <div class="mb-4">
                        <h2 class="text-success fw-bold">₹{{ number_format($product->price, 2) }}</h2>
                        <small class="text-muted">Price per piece</small>
                    </div>
                @else
                    <div class="mb-4">
                        <h3 class="text-primary">Price on Request</h3>
                        <small class="text-muted">Contact us for pricing information</small>
                    </div>
                @endif

                @if($product->description)
                    <div class="mb-4">
                        <h5 class="fw-bold">Description</h5>
                        <p class="text-muted">{{ $product->description }}</p>
                    </div>
                @endif

                <!-- Product Details -->
                <div class="row mb-4">
                    @if($product->product_code)
                        <div class="col-sm-6 mb-2">
                            <strong>Product Code:</strong><br>
                            <span class="text-muted">{{ $product->product_code }}</span>
                        </div>
                    @endif
                    
                    @if($product->sku)
                        <div class="col-sm-6 mb-2">
                            <strong>SKU:</strong><br>
                            <span class="text-muted">{{ $product->sku }}</span>
                        </div>
                    @endif
                    
                    @if($product->thickness)
                        <div class="col-sm-6 mb-2">
                            <strong>Thickness:</strong><br>
                            <span class="text-muted">{{ $product->thickness }}</span>
                        </div>
                    @endif
                    
                    @if($product->dimension)
                        <div class="col-sm-6 mb-2">
                            <strong>Dimension:</strong><br>
                            <span class="text-muted">{{ $product->dimension }}</span>
                        </div>
                    @endif
                    
                    @if($product->grade)
                        <div class="col-sm-6 mb-2">
                            <strong>Grade:</strong><br>
                            <span class="text-muted">{{ $product->grade }}</span>
                        </div>
                    @endif
                </div>

                <!-- Action Buttons -->
                <div class="d-grid gap-2 d-md-flex mb-4">
                    <a href="tel:+919876543210" class="btn btn-primary btn-lg flex-fill">
                        <i class="bi bi-telephone"></i> Call for Quote
                    </a>
                    <a href="https://wa.me/919876543210?text=Hi, I'm interested in {{ urlencode($product->name) }}" 
                       target="_blank" class="btn btn-success btn-lg flex-fill">
                        <i class="bi bi-whatsapp"></i> WhatsApp
                    </a>
                </div>

                <!-- Share Buttons -->
                <div class="mb-4">
                    <h6 class="fw-bold">Share this product:</h6>
                    <div class="btn-group" role="group">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" 
                           target="_blank" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?text={{ urlencode($product->name) }}&url={{ urlencode(request()->fullUrl()) }}" 
                           target="_blank" class="btn btn-outline-info btn-sm">
                            <i class="bi bi-twitter"></i>
                        </a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->fullUrl()) }}&title={{ urlencode($product->name) }}" 
                           target="_blank" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-linkedin"></i>
                        </a>
                        <button onclick="copyToClipboard('{{ request()->fullUrl() }}')" class="btn btn-outline-dark btn-sm">
                            <i class="bi bi-link"></i>
                        </button>
                    </div>
                </div>

                <!-- Download Catalogs -->
                @if($product->catalogs->count() > 0)
                    <div class="mb-4">
                        <h6 class="fw-bold">Download Catalogs:</h6>
                        @foreach($product->catalogs as $catalog)
                            <a href="{{ route('catalog.download', $catalog->id) }}" 
                               class="btn btn-outline-primary btn-sm me-2 mb-2">
                                <i class="bi bi-download"></i> {{ $catalog->catalog_name }}
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Specifications Tab -->
    @if($product->specifications)
        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5><i class="bi bi-list-check"></i> Technical Specifications</h5>
                    </div>
                    <div class="card-body">
                        @if(is_array($product->specifications))
                            <div class="row">
                                @foreach($product->specifications as $key => $value)
                                    <div class="col-md-6 mb-2">
                                        <strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong>
                                        <span class="text-muted">{{ $value }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <pre class="mb-0">{{ $product->specifications }}</pre>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Related Products -->
    @if($related_products->count() > 0)
        <div class="row mt-5">
            <div class="col-12">
                <h3 class="fw-bold mb-4">Related Products</h3>
                <div class="row">
                    @foreach($related_products as $related)
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                            <div class="card h-100 shadow-sm">
                                @if($related->images->count() > 0)
                                    <img src="{{ asset('storage/' . $related->images->first()->image_path) }}" 
                                         class="card-img-top" 
                                         alt="{{ $related->name }}" 
                                         style="height: 200px; object-fit: cover;">
                                @else
                                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                        <i class="bi bi-image text-muted" style="font-size: 2rem;"></i>
                                    </div>
                                @endif
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $related->name }}</h5>
                                    @if($related->price)
                                        <p class="card-text text-success fw-bold">₹{{ number_format($related->price, 2) }}</p>
                                    @else
                                        <p class="card-text text-muted">Price on Request</p>
                                    @endif
                                    <div class="mt-auto">
                                        <a href="{{ route('products.show', $related->slug) }}" class="btn btn-primary btn-sm">View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $product->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <img id="modalImage" src="" class="w-100" alt="{{ $product->name }}">
            </div>
        </div>
    </div>
</div>

<script>
function goToSlide(index) {
    const carousel = new bootstrap.Carousel(document.getElementById('productCarousel'));
    carousel.to(index);
    
    // Update thumbnail borders
    document.querySelectorAll('[id^="thumb-"]').forEach(thumb => {
        thumb.classList.remove('border-primary');
    });
    document.getElementById('thumb-' + index).classList.add('border-primary');
}

function openImageModal(imageSrc) {
    document.getElementById('modalImage').src = imageSrc;
    new bootstrap.Modal(document.getElementById('imageModal')).show();
}

function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Show success message
        const btn = event.target.closest('button');
        const originalHTML = btn.innerHTML;
        btn.innerHTML = '<i class="bi bi-check"></i>';
        setTimeout(() => {
            btn.innerHTML = originalHTML;
        }, 2000);
    });
}

// Update thumbnail border on carousel slide
document.getElementById('productCarousel')?.addEventListener('slide.bs.carousel', function(e) {
    document.querySelectorAll('[id^="thumb-"]').forEach(thumb => {
        thumb.classList.remove('border-primary');
    });
    document.getElementById('thumb-' + e.to)?.classList.add('border-primary');
});
</script>
@endsection
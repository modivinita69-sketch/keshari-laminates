@extends('admin.layouts.app')

@section('title', 'View Product')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>{{ $product->name }}</h1>
    <div>
        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-primary">
            <i class="bi bi-pencil"></i> Edit
        </a>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Products
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        @if($product->images->count() > 0)
            <div class="card mb-4">
                <div class="card-header">
                    <h5><i class="bi bi-images"></i> Product Images</h5>
                </div>
                <div class="card-body">
                    <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($product->images as $index => $image)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" 
                                         class="d-block w-100 rounded" 
                                         alt="{{ $product->name }}"
                                         style="height: 400px; object-fit: cover;">
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

                    @if($product->images->count() > 1)
                        <div class="row mt-3">
                            @foreach($product->images as $index => $image)
                                <div class="col-2">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" 
                                         class="img-thumbnail w-100" 
                                         style="height: 60px; object-fit: cover; cursor: pointer;"
                                         onclick="document.querySelector('#productCarousel .carousel-item:nth-child({{ $index + 1 }})').classList.add('active'); document.querySelectorAll('#productCarousel .carousel-item').forEach((item, i) => { if(i !== {{ $index }}) item.classList.remove('active'); });">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        @else
            <div class="card mb-4">
                <div class="card-body text-center py-5">
                    <i class="bi bi-image display-1 text-muted"></i>
                    <h5 class="mt-3">No Images</h5>
                    <p class="text-muted">This product doesn't have any images yet.</p>
                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Add Images
                    </a>
                </div>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h5><i class="bi bi-info-circle"></i> Product Details</h5>
            </div>
            <div class="card-body">
                @if($product->description)
                    <div class="mb-4">
                        <h6>Description:</h6>
                        <p class="text-muted">{{ $product->description }}</p>
                    </div>
                @endif

                @if($product->specifications)
                    <div class="mb-4">
                        <h6>Specifications:</h6>
                        <div class="bg-light p-3 rounded">
                            <pre class="mb-0">{{ $product->specifications }}</pre>
                        </div>
                    </div>
                @endif

                <div class="row">
                    @if($product->price)
                        <div class="col-md-6 mb-3">
                            <h6>Price:</h6>
                            <h3 class="text-primary">₹{{ number_format($product->price, 2) }}</h3>
                        </div>
                    @endif

                    @if($product->sku)
                        <div class="col-md-6 mb-3">
                            <h6>SKU:</h6>
                            <p class="lead">{{ $product->sku }}</p>
                        </div>
                    @endif
                </div>

                @if($product->category)
                    <div class="mb-3">
                        <h6>Category:</h6>
                        <div>
                            <span class="badge bg-secondary fs-6">{{ $product->category->name }}</span>
                            @if($product->category->parent)
                                <br><small class="text-muted mt-1 d-block">Path: {{ $product->category->getBreadcrumb() }}</small>
                            @endif
                        </div>
                    </div>
                @endif

                <div class="mb-3">
                    <h6>Status:</h6>
                    @if($product->is_featured)
                        <span class="badge bg-success fs-6">Featured Product</span>
                    @else
                        <span class="badge bg-secondary fs-6">Regular Product</span>
                    @endif
                </div>

                @if($product->sort_order > 0)
                    <div class="mb-3">
                        <h6>Sort Order:</h6>
                        <p>{{ $product->sort_order }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5><i class="bi bi-gear"></i> Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-primary">
                        <i class="bi bi-pencil"></i> Edit Product
                    </a>
                    <a href="{{ route('products') }}?category={{ $product->category->id ?? '' }}" 
                       target="_blank" class="btn btn-outline-info">
                        <i class="bi bi-eye"></i> View on Website
                    </a>
                    <button class="btn btn-outline-danger" onclick="confirmDelete()">
                        <i class="bi bi-trash"></i> Delete Product
                    </button>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h5><i class="bi bi-clock"></i> Timestamps</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Created:</strong><br>
                    <small class="text-muted">{{ $product->created_at->format('M d, Y \a\t H:i A') }}</small>
                    <br><small class="text-muted">({{ $product->created_at->diffForHumans() }})</small>
                </div>
                <div class="mb-3">
                    <strong>Last Updated:</strong><br>
                    <small class="text-muted">{{ $product->updated_at->format('M d, Y \a\t H:i A') }}</small>
                    <br><small class="text-muted">({{ $product->updated_at->diffForHumans() }})</small>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h5><i class="bi bi-bar-chart"></i> Statistics</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Total Images:</strong>
                    <span class="badge bg-info">{{ $product->images->count() }}</span>
                </div>
                @if($product->category)
                    <div class="mb-3">
                        <strong>Category Products:</strong>
                        <span class="badge bg-secondary">{{ $product->category->products->count() }}</span>
                    </div>
                @endif
                <div class="mb-3">
                    <strong>Product ID:</strong>
                    <span class="text-muted">#{{ $product->id }}</span>
                </div>
            </div>
        </div>

        @if($product->category && $product->category->products->where('id', '!=', $product->id)->count() > 0)
            <div class="card mt-4">
                <div class="card-header">
                    <h5><i class="bi bi-collection"></i> Related Products</h5>
                </div>
                <div class="card-body">
                    @foreach($product->category->products->where('id', '!=', $product->id)->take(3) as $relatedProduct)
                        <div class="d-flex align-items-center mb-2">
                            @if($relatedProduct->images->count() > 0)
                                <img src="{{ asset('storage/' . $relatedProduct->images->first()->image_path) }}" 
                                     alt="{{ $relatedProduct->name }}" 
                                     class="me-2 rounded" 
                                     style="width: 40px; height: 40px; object-fit: cover;">
                            @else
                                <div class="me-2 bg-light rounded d-flex align-items-center justify-content-center" 
                                     style="width: 40px; height: 40px;">
                                    <i class="bi bi-image text-muted"></i>
                                </div>
                            @endif
                            <div class="flex-grow-1">
                                <a href="{{ route('admin.products.show', $relatedProduct) }}" 
                                   class="text-decoration-none">
                                    <small class="fw-semibold">{{ Str::limit($relatedProduct->name, 30) }}</small>
                                </a>
                            </div>
                        </div>
                    @endforeach
                    @if($product->category->products->where('id', '!=', $product->id)->count() > 3)
                        <small class="text-muted">
                            and {{ $product->category->products->where('id', '!=', $product->id)->count() - 3 }} more...
                        </small>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>

<form id="deleteForm" method="POST" action="{{ route('admin.products.destroy', $product) }}" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
function confirmDelete() {
    if (confirm('Are you sure you want to delete this product? This action cannot be undone.')) {
        document.getElementById('deleteForm').submit();
    }
}
</script>
@endsection
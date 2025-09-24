@extends('admin.layouts.app')

@section('title', 'Products')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Products</h1>
    <div>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Product
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col">
                <h5><i class="bi bi-box-seam"></i> Product List ({{ $products->total() }})</h5>
            </div>
            <div class="col-auto">
                <form method="GET" class="d-flex gap-2">
                    <select name="category_id" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" 
                                    {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ str_repeat('— ', $category->level) }}{{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <input type="search" name="search" class="form-control form-control-sm" 
                           placeholder="Search products..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        @if($products->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock Status</th>
                            <th>Created</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>
                                @if($product->images->count() > 0)
                                    <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" 
                                         alt="{{ $product->name }}" 
                                         class="img-thumbnail" 
                                         style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                         style="width: 50px; height: 50px;">
                                        <i class="bi bi-image text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div>
                                    <div class="fw-semibold">{{ $product->name }}</div>
                                    @if($product->description)
                                        <small class="text-muted">{{ Str::limit($product->description, 50) }}</small>
                                    @endif
                                </div>
                            </td>
                            <td>
                                @if($product->category)
                                    <div class="category-data position-relative">
                                        <span class="badge bg-secondary">{{ $product->category->name }}</span>
                                        <a href="#" class="ms-2 text-info small view-json" data-bs-toggle="tooltip" title="View Category Data">
                                            <i class="bi bi-code-square"></i>
                                        </a>
                                        <div class="position-absolute bg-dark text-white p-2 rounded json-preview" style="display: none; z-index: 1000; min-width: 300px; max-width: 500px; white-space: pre-wrap;">
                                            <code>
                                                {{ json_encode([
                                                    'id' => $product->category->id,
                                                    'name' => $product->category->name,
                                                    'slug' => $product->category->slug,
                                                    'level' => $product->category->level,
                                                    'path' => $product->category->path,
                                                    'parent' => $product->category->parent ? [
                                                        'id' => $product->category->parent->id,
                                                        'name' => $product->category->parent->name
                                                    ] : null,
                                                    'breadcrumb' => $product->category->getBreadcrumb()->map(function($cat) {
                                                        return ['id' => $cat->id, 'name' => $cat->name];
                                                    })->toArray()
                                                ], JSON_PRETTY_PRINT) }}
                                            </code>
                                        </div>
                                    </div>
                                @else
                                    <span class="badge bg-warning">Uncategorized</span>
                                @endif
                            </td>
                            <td>
                                @if($product->price)
                                    <span class="fw-bold">₹{{ number_format($product->price, 2) }}</span>
                                @else
                                    <span class="text-muted">Price on request</span>
                                @endif
                            </td>
                            <td>
                                @if($product->is_featured)
                                    <span class="badge bg-success">Featured</span>
                                @else
                                    <span class="badge bg-outline-secondary">Regular</span>
                                @endif
                            </td>
                            <td>
                                <small class="text-muted">{{ $product->created_at->format('M d, Y') }}</small>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.products.show', $product) }}" 
                                       class="btn btn-outline-info" title="View">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.products.edit', $product) }}" 
                                       class="btn btn-outline-primary" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}" 
                                          class="d-inline" 
                                          onsubmit="return confirm('Are you sure you want to delete this product?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-box display-1 text-muted"></i>
                <h5 class="mt-3">No Products Found</h5>
                <p class="text-muted">
                    @if(request('search') || request('category_id'))
                        No products match your search criteria.
                        <a href="{{ route('admin.products.index') }}" class="btn btn-link">View All Products</a>
                    @else
                        Start by adding your first product.
                        <a href="{{ route('admin.products.create') }}" class="btn btn-link">Add Product</a>
                    @endif
                </p>
            </div>
        @endif
    </div>
    @if($products->hasPages())
        <div class="card-footer">
            {{ $products->links() }}
        </div>
    @endif
</div>

<div class="row mt-4">
    <div class="col-md-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6>Total Products</h6>
                        <h3>{{ \App\Models\Product::count() }}</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="bi bi-box-seam display-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6>Featured Products</h6>
                        <h3>{{ \App\Models\Product::where('is_featured', true)->count() }}</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="bi bi-star-fill display-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6>Categories</h6>
                        <h3>{{ \App\Models\Category::count() }}</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="bi bi-tags-fill display-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .json-preview {
        display: none;
        top: 100%;
        left: 0;
        background-color: #1e1e1e !important;
        font-family: 'Consolas', 'Monaco', monospace;
        font-size: 12px;
    }
    .json-preview code {
        color: #fff;
    }
    .category-data {
        position: relative;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Handle JSON preview
    document.querySelectorAll('.view-json').forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Hide all other previews
            document.querySelectorAll('.json-preview').forEach(function(preview) {
                if (preview !== button.nextElementSibling) {
                    preview.style.display = 'none';
                }
            });

            // Toggle this preview
            var preview = this.nextElementSibling;
            preview.style.display = preview.style.display === 'none' ? 'block' : 'none';
        });
    });

    // Close JSON preview when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.category-data')) {
            document.querySelectorAll('.json-preview').forEach(function(preview) {
                preview.style.display = 'none';
            });
        }
    });
});
</script>
@endpush
@endsection
@extends('admin.layouts.app')

@section('title', 'Edit Product')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Edit Product: {{ $product->name }}</h1>
    <div>
        <a href="{{ route('admin.products.show', $product) }}" class="btn btn-info">
            <i class="bi bi-eye"></i> View
        </a>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Products
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <h5>Please fix the following errors:</h5>
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5><i class="bi bi-info-circle"></i> Product Information</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name', $product->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="4">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Provide a detailed description of the product.</div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="price" class="form-label">Price (₹)</label>
                                <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                       id="price" name="price" value="{{ old('price', $product->price) }}" 
                                       min="0" step="0.01">
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Leave empty if price is on request.</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="sku" class="form-label">SKU</label>
                                <input type="text" class="form-control @error('sku') is-invalid @enderror" 
                                       id="sku" name="sku" value="{{ old('sku', $product->sku) }}">
                                @error('sku')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Unique product identifier.</div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="specifications" class="form-label">Specifications</label>
                        <textarea class="form-control @error('specifications') is-invalid @enderror" 
                                  id="specifications" name="specifications" rows="3">{{ old('specifications', $product->specifications) }}</textarea>
                        @error('specifications')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Technical specifications and features.</div>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h5><i class="bi bi-images"></i> Product Images</h5>
                </div>
                <div class="card-body">
                    @if($product->images->count() > 0)
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6>Current Images:</h6>
                                <div class="row">
                                    @foreach($product->images as $image)
                                        <div class="col-md-3 mb-3">
                                            <div class="position-relative">
                                                <img src="{{ asset('storage/' . $image->image_path) }}" 
                                                     alt="{{ $product->name }}" 
                                                     class="img-thumbnail w-100" 
                                                     style="height: 150px; object-fit: cover;">
                                                <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1" 
                                                        onclick="deleteImage({{ $image->id }})">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="images" class="form-label">Add New Images</label>
                        <input type="file" class="form-control @error('images.*') is-invalid @enderror" 
                               id="images" name="images[]" multiple accept="image/*">
                        @error('images.*')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            Select new images to add. Existing images will be kept unless deleted.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5><i class="bi bi-gear"></i> Settings</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                        <select class="form-select @error('category_id') is-invalid @enderror" 
                                id="category_id" name="category_id" required>
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" 
                                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ str_repeat('— ', $category->level) }}{{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" 
                                   id="is_featured" name="is_featured" value="1"
                                   {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_featured">
                                Featured Product
                            </label>
                        </div>
                        <div class="form-text">Featured products will be highlighted on the homepage.</div>
                    </div>

                    <div class="mb-3">
                        <label for="sort_order" class="form-label">Sort Order</label>
                        <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                               id="sort_order" name="sort_order" value="{{ old('sort_order', $product->sort_order) }}" 
                               min="0">
                        @error('sort_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Lower numbers appear first.</div>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h5><i class="bi bi-clock"></i> Product Info</h5>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <strong>Created:</strong><br>
                        <small class="text-muted">{{ $product->created_at->format('M d, Y \a\t H:i') }}</small>
                    </div>
                    <div class="mb-2">
                        <strong>Last Updated:</strong><br>
                        <small class="text-muted">{{ $product->updated_at->format('M d, Y \a\t H:i') }}</small>
                    </div>
                    <div class="mb-2">
                        <strong>Total Images:</strong><br>
                        <span class="badge bg-info">{{ $product->images->count() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="bi bi-check-circle"></i> Update Product
                </button>
                <a href="{{ route('admin.products.show', $product) }}" class="btn btn-info btn-lg">
                    <i class="bi bi-eye"></i> View Product
                </a>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-lg">
                    <i class="bi bi-x-circle"></i> Cancel
                </a>
            </div>
        </div>
    </div>
</form>

<script>
function deleteImage(imageId) {
    if (confirm('Are you sure you want to delete this image?')) {
        fetch(`/admin/products/images/${imageId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error deleting image');
            }
        })
        .catch(error => {
            alert('Error deleting image');
        });
    }
}
</script>
@endsection
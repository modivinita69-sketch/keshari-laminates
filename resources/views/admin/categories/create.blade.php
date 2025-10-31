@extends('admin.layouts.app')

@section('title', 'Create Category')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Create New Category</h1>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back to Categories
    </a>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5><i class="bi bi-plus-circle"></i> Category Details</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Category Name *</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="slug" class="form-label">URL Slug</label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" 
                               id="slug" name="slug" value="{{ old('slug') }}"
                               placeholder="Auto-generated if left empty">
                        <small class="form-text text-muted">URL-friendly version of the name. Leave empty to auto-generate.</small>
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="parent_id" class="form-label">Parent Category</label>
                        <select class="form-select @error('parent_id') is-invalid @enderror" 
                                id="parent_id" name="parent_id">
                            <option value="">None (Root Category)</option>
                            @foreach($parentCategories as $category)
                                <option value="{{ $category->id }}" {{ old('parent_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }} (Level {{ $category->level }})
                                </option>
                                @if($category->children && count($category->children) > 0)
                                    @foreach($category->children as $child)
                                        <option value="{{ $child->id }}" {{ old('parent_id') == $child->id ? 'selected' : '' }}>
                                            &nbsp;&nbsp;&nbsp;&nbsp;└─ {{ $child->name }} (Level {{ $child->level }})
                                        </option>
                                    @endforeach
                                @endif
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Select a parent category to create a sub-category.</small>
                        @error('parent_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="3">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Category Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" 
                               id="image" name="image" accept="image/*">
                        <small class="form-text text-muted">Upload a representative image for this category (JPEG, PNG, GIF up to 2MB)</small>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="sort_order" class="form-label">Sort Order</label>
                        <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                               id="sort_order" name="sort_order" value="{{ old('sort_order', 1) }}" min="0">
                        <small class="form-text text-muted">Lower numbers appear first.</small>
                        @error('sort_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active" 
                                   name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Active (visible on frontend)
                            </label>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Create Category
                        </button>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h6><i class="bi bi-info-circle"></i> Category Guidelines</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <i class="bi bi-check-circle text-success"></i>
                        <strong>Root Categories:</strong> Main category groups (e.g., "Laminates")
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-check-circle text-success"></i>
                        <strong>Sub Categories:</strong> Organize products within main categories
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-check-circle text-success"></i>
                        <strong>Leaf Categories:</strong> Categories that directly contain products
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-exclamation-triangle text-warning"></i>
                        <strong>Nesting Limit:</strong> Maximum 3-4 levels deep recommended
                    </li>
                </ul>
            </div>
        </div>

        @if($parentCategories && count($parentCategories) > 0)
        <div class="card mt-3">
            <div class="card-header">
                <h6><i class="bi bi-diagram-3"></i> Current Structure</h6>
            </div>
            <div class="card-body">
                @foreach($parentCategories as $category)
                    <div class="mb-2">
                        <strong>{{ $category->name }}</strong> (Level {{ $category->level }})
                        @if($category->children && count($category->children) > 0)
                            <div class="ms-3 mt-1">
                                @foreach($category->children as $child)
                                    <small class="d-block text-muted">
                                        └─ {{ $child->name }} (Level {{ $child->level }})
                                    </small>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
// Auto-generate slug from name
document.getElementById('name').addEventListener('input', function() {
    const name = this.value;
    const slug = name.toLowerCase()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-')
                    .trim('-');
    document.getElementById('slug').value = slug;
});
</script>
@endpush
@endsection
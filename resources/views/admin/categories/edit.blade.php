@extends('admin.layouts.app')

@section('title', 'Edit Category')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Edit Category: {{ $category->name }}</h1>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back to Categories
    </a>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5><i class="bi bi-pencil"></i> Category Details</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.categories.update', $category->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Category Name *</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name', $category->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="slug" class="form-label">URL Slug</label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" 
                               id="slug" name="slug" value="{{ old('slug', $category->slug) }}"
                               placeholder="Auto-generated if left empty">
                        <small class="form-text text-muted">URL-friendly version of the name.</small>
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="parent_id" class="form-label">Parent Category</label>
                        <select class="form-select @error('parent_id') is-invalid @enderror" 
                                id="parent_id" name="parent_id">
                            <option value="">None (Root Category)</option>
                            @foreach($parentCategories as $parent)
                                <option value="{{ $parent->id }}" 
                                    {{ old('parent_id', $category->parent_id) == $parent->id ? 'selected' : '' }}>
                                    {{ $parent->name }} (Level {{ $parent->level }})
                                </option>
                                @if($parent->children && count($parent->children) > 0)
                                    @foreach($parent->children as $child)
                                        @if($child->id !== $category->id)
                                            <option value="{{ $child->id }}" 
                                                {{ old('parent_id', $category->parent_id) == $child->id ? 'selected' : '' }}>
                                                &nbsp;&nbsp;&nbsp;&nbsp;└─ {{ $child->name }} (Level {{ $child->level }})
                                            </option>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Select a parent category to make this a sub-category.</small>
                        @error('parent_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="3">{{ old('description', $category->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Category Image</label>
                        @if($category->image)
                            <div class="mb-2">
                                <img src="{{ asset($category->image) }}" 
                                     alt="{{ $category->name }}"
                                     class="img-thumbnail"
                                     style="max-height: 100px;">
                            </div>
                        @endif
                        <input type="file" class="form-control @error('image') is-invalid @enderror" 
                               id="image" name="image" accept="image/*">
                        <small class="form-text text-muted">Upload a new image to replace the existing one (JPEG, PNG, GIF up to 2MB)</small>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="sort_order" class="form-label">Sort Order</label>
                        <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                               id="sort_order" name="sort_order" value="{{ old('sort_order', $category->sort_order) }}" min="0">
                        <small class="form-text text-muted">Lower numbers appear first.</small>
                        @error('sort_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active" 
                                   name="is_active" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Active (visible on frontend)
                            </label>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Update Category
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
                <h6><i class="bi bi-info-circle"></i> Category Information</h6>
            </div>
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-sm-4">Created</dt>
                    <dd class="col-sm-8">{{ $category->created_at->format('M d, Y H:i') }}</dd>

                    <dt class="col-sm-4">Updated</dt>
                    <dd class="col-sm-8">{{ $category->updated_at->format('M d, Y H:i') }}</dd>

                    <dt class="col-sm-4">Level</dt>
                    <dd class="col-sm-8">{{ $category->level }}</dd>

                    @if($category->parent)
                        <dt class="col-sm-4">Parent</dt>
                        <dd class="col-sm-8">{{ $category->parent->name }}</dd>
                    @endif

                    <dt class="col-sm-4">Products</dt>
                    <dd class="col-sm-8">{{ $category->products()->count() }}</dd>

                    <dt class="col-sm-4">Children</dt>
                    <dd class="col-sm-8">{{ $category->children()->count() }}</dd>
                </dl>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h6><i class="bi bi-exclamation-triangle"></i> Important Notes</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <i class="bi bi-info-circle text-info"></i>
                        Changing the parent category will affect all child categories
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-exclamation-circle text-warning"></i>
                        Maximum nesting depth is 3 levels
                    </li>
                    <li>
                        <i class="bi bi-shield-check text-success"></i>
                        URLs will update automatically when slug is changed
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Auto-generate slug from name if slug is empty
document.getElementById('name').addEventListener('input', function() {
    const slugInput = document.getElementById('slug');
    if (!slugInput.value) {
        const name = this.value;
        const slug = name.toLowerCase()
                        .replace(/[^a-z0-9\s-]/g, '')
                        .replace(/\s+/g, '-')
                        .replace(/-+/g, '-')
                        .trim('-');
        slugInput.value = slug;
    }
});
</script>
@endpush
@endsection
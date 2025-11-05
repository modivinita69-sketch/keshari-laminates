@extends('admin.layouts.app')

@section('title', 'Edit Brand')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Brand</h1>
        <a href="{{ route('admin.brands.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back to Brands
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.brands.update', $brand) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Brand Name <span class="text-danger">*</span></label>
                    <input type="text" 
                           class="form-control @error('name') is-invalid @enderror" 
                           id="name" 
                           name="name" 
                           value="{{ old('name', $brand->name) }}" 
                           required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" 
                              name="description" 
                              rows="3">{{ old('description', $brand->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="logo" class="form-label">Logo</label>
                    @if($brand->logo)
                        <div class="mb-2">
                            <img src="{{ asset($brand->logo) }}" 
                                 alt="{{ $brand->name }}" 
                                 class="img-thumbnail"
                                 style="max-height: 100px;">
                        </div>
                    @endif
                    <input type="file" 
                           class="form-control @error('logo') is-invalid @enderror" 
                           id="logo" 
                           name="logo" 
                           accept="image/*">
                    <small class="text-muted">Recommended size: 200x200px. Max file size: 1MB</small>
                    @error('logo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="categories" class="form-label">Categories <span class="text-danger">*</span></label>
                    <select class="form-select @error('categories') is-invalid @enderror" 
                            id="categories" 
                            name="categories[]" 
                            multiple 
                            required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" 
                                    {{ in_array($category->id, old('categories', $selectedCategories)) ? 'selected' : '' }}>
                                {{ str_repeat('— ', $category->level) }}{{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('categories')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Hold Ctrl/Cmd to select multiple categories</small>
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input type="checkbox" 
                               class="form-check-input" 
                               id="is_active" 
                               name="is_active" 
                               value="1" 
                               {{ old('is_active', $brand->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.brands.index') }}" class="btn btn-light">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Update Brand
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#categories').select2({
            placeholder: 'Select categories',
            width: '100%'
        });
    });
</script>
@endpush
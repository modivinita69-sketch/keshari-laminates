@extends('admin.layouts.app')

@section('title', 'Add New Catalog')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Add New Catalog</h1>
    
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('admin.catalogs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" 
                           class="form-control @error('title') is-invalid @enderror" 
                           id="title" 
                           name="title" 
                           value="{{ old('title') }}" 
                           required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" 
                              name="description" 
                              rows="3">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="catalog_file" class="form-label">PDF File <span class="text-danger">*</span></label>
                    <input type="file" 
                           class="form-control @error('catalog_file') is-invalid @enderror" 
                           id="catalog_file" 
                           name="catalog_file"
                           accept=".pdf"
                           required>
                    <small class="text-muted">Max file size: 10MB</small>
                    @error('catalog_file')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="thumbnail" class="form-label">Thumbnail Image</label>
                    <input type="file" 
                           class="form-control @error('thumbnail') is-invalid @enderror" 
                           id="thumbnail" 
                           name="thumbnail"
                           accept="image/*">
                    <small class="text-muted">Max file size: 2MB</small>
                    @error('thumbnail')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input type="checkbox" 
                               class="form-check-input" 
                               id="is_active" 
                               name="is_active" 
                               value="1" 
                               {{ old('is_active', '1') == '1' ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.catalogs.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Back to List
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Save Catalog
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@extends('admin.layouts.app')

@section('title', isset($slider) ? 'Edit Slider Image' : 'Add New Slider Image')

@section('styles')
<style>
    .image-preview {
        max-width: 100%;
        height: 300px;
        object-fit: cover;
        border-radius: 8px;
    }
    .preview-container {
        display: none;
        margin-top: 1rem;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">{{ isset($slider) ? 'Edit Slider Image' : 'Add New Slider Image' }}</h1>
        <a href="{{ route('admin.hero-slider.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-1"></i>Back to List
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.hero-slider.store') }}" 
                  method="POST" 
                  enctype="multipart/form-data">
                @csrf
                @if(isset($slider))
                    @method('PUT')
                @endif

                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="image" class="form-label">Slider Image</label>
                            <input type="file" 
                                   class="form-control @error('image') is-invalid @enderror" 
                                   id="image" 
                                   name="image" 
                                   accept="image/*"
                                   {{ !isset($slider) ? 'required' : '' }}
                                   onchange="previewImage(this)">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Recommended size: 1920x1080 pixels. Max file size: 2MB</div>
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title', $slider->title ?? '') }}">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="subtitle" class="form-label">Subtitle</label>
                            <input type="text" 
                                   class="form-control @error('subtitle') is-invalid @enderror" 
                                   id="subtitle" 
                                   name="subtitle" 
                                   value="{{ old('subtitle', $slider->subtitle ?? '') }}">
                            @error('subtitle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="sort_order" class="form-label">Sort Order</label>
                            <input type="number" 
                                   class="form-control @error('sort_order') is-invalid @enderror" 
                                   id="sort_order" 
                                   name="sort_order" 
                                   value="{{ old('sort_order', $slider->sort_order ?? 0) }}">
                            @error('sort_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       id="is_active" 
                                       name="is_active"
                                       {{ (old('is_active', $slider->is_active ?? true) ? 'checked' : '') }}>
                                <label class="form-check-label" for="is_active">Active</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="preview-container" id="imagePreviewContainer">
                            <label class="form-label">Image Preview</label>
                            <img src="{{ isset($slider) ? asset($slider->image_path) : '' }}" 
                                 alt="Preview" 
                                 class="image-preview" 
                                 id="imagePreview">
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        {{ isset($slider) ? 'Update Slide' : 'Add Slide' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function previewImage(input) {
    const container = document.getElementById('imagePreviewContainer');
    const preview = document.getElementById('imagePreview');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            container.style.display = 'block';
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}

// Show preview container if editing
@if(isset($slider))
document.getElementById('imagePreviewContainer').style.display = 'block';
@endif
</script>
@endsection
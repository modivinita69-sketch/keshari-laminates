@extends('layouts.app')

@section('title', 'Product Catalogs - Keshari Laminates')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Catalogs</li>
            </ol>
        </nav>
        <h1 class="section-title">Our Product Catalogs</h1>
        <p class="lead text-muted">Download our comprehensive product catalogs</p>
    </div>

    @if($catalogs && count($catalogs) > 0)
        <div class="row g-4">
            @foreach($catalogs as $catalog)
                <div class="col-md-6 col-lg-4">
                    <div class="catalog-card">
                        <div class="card h-100">
                            <div class="catalog-thumbnail">
                                @if($catalog->thumbnail_path)
                                    <img src="{{ asset('storage/' . $catalog->thumbnail_path) }}" 
                                         class="card-img-top" 
                                         alt="{{ $catalog->title }}"
                                         style="height: 200px; object-fit: cover;">
                                @else
                                    <div class="text-center p-4 bg-light">
                                        <i class="bi bi-file-pdf text-primary" style="font-size: 4rem;"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $catalog->title }}</h5>
                                @if($catalog->description)
                                    <p class="card-text text-muted">{{ $catalog->description }}</p>
                                @endif
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="text-muted small">
                                        <i class="bi bi-download"></i> 
                                        {{ $catalog->download_count }} downloads
                                    </span>
                                    <a href="{{ route('catalogs.download', $catalog) }}" 
                                       class="btn btn-primary"
                                       target="_blank">
                                        <i class="bi bi-download me-2"></i>Download
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center">
            <div class="mb-4">
                <i class="bi bi-file-pdf" style="font-size: 4rem; color: var(--primary-orange); opacity: 0.5;"></i>
            </div>
            <h4>Catalogs Coming Soon</h4>
            <p class="lead text-muted">Our product catalogs will be available for download soon.</p>
        </div>
    @endif
</div>
@endsection
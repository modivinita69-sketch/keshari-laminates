@extends('admin.layouts.app')

@section('title', 'Brands')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Brands</h1>
    <div>
        <a href="{{ route('admin.brands.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Brand
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
        <h5 class="mb-0"><i class="bi bi-tags"></i> Brand List</h5>
    </div>
    <div class="card-body p-0">
        @if($brands->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th width="80">Logo</th>
                            <th>Name</th>
                            <th>Categories</th>
                            <th>Products</th>
                            <th>Status</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($brands as $brand)
                        <tr>
                            <td>
                                @if($brand->logo)
                                    <img src="{{ asset($brand->logo) }}" 
                                         alt="{{ $brand->name }}" 
                                         class="img-thumbnail"
                                         style="width: 50px; height: 50px; object-fit: contain;">
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                         style="width: 50px; height: 50px;">
                                        <i class="bi bi-building text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="fw-semibold">{{ $brand->name }}</div>
                                @if($brand->description)
                                    <small class="text-muted">{{ Str::limit($brand->description, 50) }}</small>
                                @endif
                            </td>
                            <td>
                                @foreach($brand->categories as $category)
                                    <span class="badge bg-secondary">{{ $category->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $brand->products->count() }} products</span>
                            </td>
                            <td>
                                @if($brand->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.brands.edit', $brand) }}" 
                                       class="btn btn-outline-primary" 
                                       title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form method="POST" 
                                          action="{{ route('admin.brands.destroy', $brand) }}" 
                                          class="d-inline" 
                                          onsubmit="return confirm('Are you sure you want to delete this brand?')">
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
                <i class="bi bi-tags display-1 text-muted"></i>
                <h5 class="mt-3">No Brands Found</h5>
                <p class="text-muted">
                    Start by adding your first brand.
                    <a href="{{ route('admin.brands.create') }}" class="btn btn-link">Add Brand</a>
                </p>
            </div>
        @endif
    </div>
    @if($brands->hasPages())
        <div class="card-footer">
            {{ $brands->links() }}
        </div>
    @endif
</div>
@endsection
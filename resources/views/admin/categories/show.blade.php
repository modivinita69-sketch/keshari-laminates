@extends('admin.layouts.app')

@section('title', 'View Category')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>{{ $category->name }}</h1>
    <div>
        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-primary">
            <i class="bi bi-pencil"></i> Edit
        </a>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <!-- Category Details -->
        <div class="card mb-4">
            <div class="card-header">
                <h5><i class="bi bi-info-circle"></i> Category Details</h5>
            </div>
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-sm-3">Name</dt>
                    <dd class="col-sm-9">{{ $category->name }}</dd>

                    <dt class="col-sm-3">Slug</dt>
                    <dd class="col-sm-9">{{ $category->slug }}</dd>

                    <dt class="col-sm-3">Description</dt>
                    <dd class="col-sm-9">{{ $category->description ?: 'No description available' }}</dd>

                    <dt class="col-sm-3">Status</dt>
                    <dd class="col-sm-9">
                        @if($category->is_active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Inactive</span>
                        @endif
                    </dd>

                    <dt class="col-sm-3">Level</dt>
                    <dd class="col-sm-9">{{ $category->level }}</dd>

                    <dt class="col-sm-3">Sort Order</dt>
                    <dd class="col-sm-9">{{ $category->sort_order }}</dd>

                    <dt class="col-sm-3">Created</dt>
                    <dd class="col-sm-9">{{ $category->created_at->format('M d, Y H:i:s') }}</dd>

                    <dt class="col-sm-3">Last Updated</dt>
                    <dd class="col-sm-9">{{ $category->updated_at->format('M d, Y H:i:s') }}</dd>
                </dl>
            </div>
        </div>

        <!-- Products in this Category -->
        <div class="card">
            <div class="card-header">
                <h5><i class="bi bi-box"></i> Products in this Category</h5>
            </div>
            <div class="card-body">
                @if($category->products->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>SKU</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($category->products as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->sku }}</td>
                                        <td>
                                            @if($product->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.products.edit', $product->id) }}" 
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <a href="{{ route('admin.products.show', $product->id) }}" 
                                               class="btn btn-sm btn-outline-info">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="mb-0 text-muted">No products in this category yet.</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <!-- Parent Category -->
        @if($category->parent)
            <div class="card mb-4">
                <div class="card-header">
                    <h5><i class="bi bi-diagram-2"></i> Parent Category</h5>
                </div>
                <div class="card-body">
                    <h6>{{ $category->parent->name }}</h6>
                    <p class="text-muted mb-2">{{ $category->parent->description }}</p>
                    <a href="{{ route('admin.categories.show', $category->parent->id) }}" 
                       class="btn btn-sm btn-outline-primary">
                        View Parent Category
                    </a>
                </div>
            </div>
        @endif

        <!-- Child Categories -->
        @if($category->children && $category->children->count() > 0)
            <div class="card mb-4">
                <div class="card-header">
                    <h5><i class="bi bi-diagram-3"></i> Child Categories</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach($category->children as $child)
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-0">{{ $child->name }}</h6>
                                        <small class="text-muted">{{ $child->products->count() }} products</small>
                                    </div>
                                    <a href="{{ route('admin.categories.show', $child->id) }}" 
                                       class="btn btn-sm btn-outline-info">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <!-- Statistics -->
        <div class="card">
            <div class="card-header">
                <h5><i class="bi bi-graph-up"></i> Statistics</h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6 mb-3">
                        <h3>{{ $category->products->count() }}</h3>
                        <small class="text-muted">Products</small>
                    </div>
                    <div class="col-6 mb-3">
                        <h3>{{ $category->children->count() }}</h3>
                        <small class="text-muted">Sub-categories</small>
                    </div>
                    <div class="col-6">
                        <h3>{{ $category->level }}</h3>
                        <small class="text-muted">Level</small>
                    </div>
                    <div class="col-6">
                        <h3>{{ $category->sort_order }}</h3>
                        <small class="text-muted">Sort Order</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
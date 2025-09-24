@extends('admin.layouts.app')

@section('title', 'Categories Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Categories Management</h1>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add New Category
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<!-- Category Tree View -->
<div class="card mb-4">
    <div class="card-header">
        <h5><i class="bi bi-diagram-3"></i> Category Hierarchy</h5>
    </div>
    <div class="card-body">
        @if($categoryTree && count($categoryTree) > 0)
            @foreach($categoryTree as $rootCategory)
                <div class="category-tree-item">
                    <div class="d-flex justify-content-between align-items-center p-2 border-bottom">
                        <div>
                            <strong>{{ $rootCategory->name }}</strong>
                            <span class="badge bg-secondary">{{ $rootCategory->products()->count() }} products</span>
                            @if(!$rootCategory->is_active)
                                <span class="badge bg-warning">Inactive</span>
                            @endif
                        </div>
                        <div>
                            <a href="{{ route('admin.categories.show', $rootCategory) }}" class="btn btn-sm btn-outline-info">View</a>
                            <a href="{{ route('admin.categories.edit', $rootCategory) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                        </div>
                    </div>
                    @if($rootCategory->children && count($rootCategory->children) > 0)
                        <div class="ms-4">
                            @foreach($rootCategory->children as $child)
                                <div class="d-flex justify-content-between align-items-center p-2 border-bottom bg-light">
                                    <div>
                                        <i class="bi bi-arrow-right"></i> {{ $child->name }}
                                        <span class="badge bg-secondary">{{ $child->products()->count() }} products</span>
                                        @if(!$child->is_active)
                                            <span class="badge bg-warning">Inactive</span>
                                        @endif
                                    </div>
                                    <div>
                                        <a href="{{ route('admin.categories.show', $child) }}" class="btn btn-sm btn-outline-info">View</a>
                                        <a href="{{ route('admin.categories.edit', $child) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                    </div>
                                </div>
                                @if($child->children && count($child->children) > 0)
                                    <div class="ms-4">
                                        @foreach($child->children as $grandchild)
                                            <div class="d-flex justify-content-between align-items-center p-2 border-bottom bg-light">
                                                <div>
                                                    <i class="bi bi-arrow-right"></i><i class="bi bi-arrow-right"></i> {{ $grandchild->name }}
                                                    <span class="badge bg-secondary">{{ $grandchild->products()->count() }} products</span>
                                                    @if(!$grandchild->is_active)
                                                        <span class="badge bg-warning">Inactive</span>
                                                    @endif
                                                </div>
                                                <div>
                                                    <a href="{{ route('admin.categories.show', $grandchild) }}" class="btn btn-sm btn-outline-info">View</a>
                                                    <a href="{{ route('admin.categories.edit', $grandchild) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        @else
            <p class="text-muted">No categories found. <a href="{{ route('admin.categories.create') }}">Create the first category</a>.</p>
        @endif
    </div>
</div>

<!-- All Categories Table -->
<div class="card">
    <div class="card-header">
        <h5><i class="bi bi-list"></i> All Categories</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Parent</th>
                        <th>Level</th>
                        <th>Products</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>
                                @for($i = 0; $i < $category->level; $i++)
                                    <i class="bi bi-arrow-right text-muted"></i>
                                @endfor
                                {{ $category->name }}
                            </td>
                            <td><code>{{ $category->slug }}</code></td>
                            <td>{{ $category->parent ? $category->parent->name : '-' }}</td>
                            <td>{{ $category->level }}</td>
                            <td>{{ $category->products()->count() }}</td>
                            <td>
                                @if($category->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.categories.show', $category) }}" class="btn btn-sm btn-outline-info">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                onclick="return confirm('Are you sure you want to delete this category?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">No categories found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
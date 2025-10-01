@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Dashboard</h1>
                <span class="text-muted">Welcome back, {{ auth('admin')->user()->name ?? 'Admin' }}!</span>
            </div>

            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card stat-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h5 class="card-title">Total Products</h5>
                                    <h3 class="text-primary">{{ $stats['total_products'] ?? 0 }}</h3>
                                </div>
                                <i class="bi bi-box text-primary fs-1"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card stat-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h5 class="card-title">Active Products</h5>
                                    <h3 class="text-success">{{ $stats['active_products'] ?? 0 }}</h3>
                                </div>
                                <i class="bi bi-check-circle text-success fs-1"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card stat-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h5 class="card-title">Categories</h5>
                                    <h3 class="text-warning">{{ $stats['total_categories'] ?? 0 }}</h3>
                                </div>
                                <i class="bi bi-tags text-warning fs-1"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card stat-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h5 class="card-title">Admins</h5>
                                    <h3 class="text-info">{{ $stats['total_admins'] ?? 0 }}</h3>
                                </div>
                                <i class="bi bi-people text-info fs-1"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Products -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Recent Products</h5>
                </div>
                <div class="card-body">
                    @if(isset($recent_products) && $recent_products->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Product Code</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recent_products as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->category->name ?? 'N/A' }}</td>
                                        <td><code>{{ $product->product_code }}</code></td>
                                        <td>
                                            <span class="badge {{ $product->is_active ? 'bg-success' : 'bg-danger' }}">
                                                {{ $product->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>{{ $product->created_at->format('M d, Y') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted">No products found. <a href="#">Create your first product</a></p>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
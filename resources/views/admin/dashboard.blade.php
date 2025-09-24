<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Keshari Laminates Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #ff6b35;
            --secondary-color: #f7941d;
        }
        .sidebar {
            background: linear-gradient(180deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            min-height: 100vh;
            position: fixed;
            width: 250px;
        }
        .main-content {
            margin-left: 250px;
            background-color: #f8f9fa;
            min-height: 100vh;
        }
        .navbar-brand {
            color: white !important;
            font-weight: bold;
        }
        .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
            padding: 0.75rem 1rem;
            border-radius: 5px;
            margin: 2px 10px;
        }
        .nav-link:hover, .nav-link.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: white !important;
        }
        .stat-card {
            border-left: 4px solid var(--primary-color);
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="d-flex flex-column">
            <a class="navbar-brand p-3" href="#">
                <i class="bi bi-building"></i> Keshari Laminates
            </a>
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.products.index') }}"><i class="bi bi-box"></i> Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.categories.index') }}"><i class="bi bi-tags"></i> Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="bi bi-file-earmark-pdf"></i> Catalogs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.company-info.index') }}"><i class="bi bi-info-circle"></i> Company Info</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="bi bi-people"></i> Admins</a>
                </li>
            </ul>
            <div class="mt-auto p-3">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm w-100">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="main-content">
        <div class="container-fluid p-4">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
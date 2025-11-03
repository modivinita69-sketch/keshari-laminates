<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - Keshari Laminates</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ route('theme.css') }}" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            position: fixed;
            width: 250px;
            background: linear-gradient(180deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
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
            transition: all 0.3s ease;
        }
        .nav-link:hover, .nav-link.active {
            color: white !important;
            background: rgba(255, 255, 255, 0.1);
        }
        .nav-link .bi {
            margin-right: 8px;
        }
        .stat-card {
            border-left: 4px solid var(--primary-color);
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="sidebar">
        <div class="d-flex flex-column">
            <a class="navbar-brand p-3 d-flex align-items-center" href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('storage/images/logo.png') }}" alt="Keshari Laminates" class="me-2" style="height: 60px; width: auto;">
                <span class="d-none d-sm-inline">Admin Panel</span>
            </a>
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                       href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" 
                       href="{{ route('admin.products.index') }}">
                        <i class="bi bi-box"></i> Products
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.hero-slider.*') ? 'active' : '' }}" 
                       href="{{ route('admin.hero-slider.index') }}">
                        <i class="bi bi-images"></i> Hero Slider
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.brands.*') ? 'active' : '' }}" 
                       href="{{ route('admin.brands.index') }}">
                        <i class="bi bi-building"></i> Brands
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" 
                       href="{{ route('admin.categories.index') }}">
                        <i class="bi bi-tags"></i> Categories
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.catalogs.*') ? 'active' : '' }}" 
                       href="{{ route('admin.catalogs.index') }}">
                        <i class="bi bi-file-earmark-pdf"></i> Catalogs
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.company-info.*') ? 'active' : '' }}" 
                       href="{{ route('admin.company-info.index') }}">
                        <i class="bi bi-info-circle"></i> Company Info
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.theme-settings.*') ? 'active' : '' }}" 
                       href="{{ route('admin.theme-settings.index') }}">
                        <i class="bi bi-palette"></i> Theme Settings
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-people"></i> Admins
                    </a>
                </li>
            </ul>
            <div class="mt-auto p-3">
                <div class="text-center mb-2">
                    <small class="text-white-50">Logged in as:</small><br>
                    <span class="text-white">{{ auth('admin')->user()->name ?? 'Admin' }}</span>
                </div>
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
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
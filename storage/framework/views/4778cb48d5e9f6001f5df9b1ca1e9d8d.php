<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Admin Dashboard'); ?> - Keshari Laminates</title>
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
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        .text-primary {
            color: var(--primary-color) !important;
        }
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
    <div class="sidebar">
        <div class="d-flex flex-column">
            <a class="navbar-brand p-3" href="<?php echo e(route('admin.dashboard')); ?>">
                <i class="bi bi-building"></i> Keshari Laminates
            </a>
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>" 
                       href="<?php echo e(route('admin.dashboard')); ?>">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('admin.products.*') ? 'active' : ''); ?>" 
                       href="<?php echo e(route('admin.products.index')); ?>">
                        <i class="bi bi-box"></i> Products
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('admin.categories.*') ? 'active' : ''); ?>" 
                       href="<?php echo e(route('admin.categories.index')); ?>">
                        <i class="bi bi-tags"></i> Categories
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-file-earmark-pdf"></i> Catalogs
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('admin.company-info.*') ? 'active' : ''); ?>" 
                       href="<?php echo e(route('admin.company-info.index')); ?>">
                        <i class="bi bi-info-circle"></i> Company Info
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
                    <span class="text-white"><?php echo e(auth('admin')->user()->name ?? 'Admin'); ?></span>
                </div>
                <form action="<?php echo e(route('admin.logout')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-outline-light btn-sm w-100">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="main-content">
        <div class="container-fluid p-4">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH D:\xampp\htdocs\keshari\resources\views/admin/layouts/app.blade.php ENDPATH**/ ?>
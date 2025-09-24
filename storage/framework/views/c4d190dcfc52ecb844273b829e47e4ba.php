<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Keshari Laminates</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary-orange: #ff6b35;
            --secondary-orange: #f7941d;
            --light-orange: #fff5f2;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .navbar {
            background: linear-gradient(135deg, var(--primary-orange) 0%, var(--secondary-orange) 100%);
        }
        
        .navbar-brand, .navbar-nav .nav-link {
            color: white !important;
        }
        
        .navbar-nav .nav-link:hover {
            color: rgba(255, 255, 255, 0.8) !important;
        }
        
        .section-title {
            color: var(--primary-orange);
            font-weight: bold;
            margin-bottom: 3rem;
            position: relative;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: linear-gradient(135deg, var(--primary-orange), var(--secondary-orange));
            border-radius: 2px;
        }
        
        .product-card {
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            border-radius: 15px;
            overflow: hidden;
        }
        
        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }
        
        .product-image {
            height: 200px;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        
        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .filter-section {
            background: var(--light-orange);
            padding: 2rem 0;
            margin-bottom: 2rem;
        }
        
        .btn-outline-orange {
            color: var(--primary-orange);
            border-color: var(--primary-orange);
        }
        
        .btn-outline-orange:hover {
            color: white;
            background-color: var(--primary-orange);
            border-color: var(--primary-orange);
        }
        
        .btn-orange {
            color: white;
            background-color: var(--primary-orange);
            border-color: var(--primary-orange);
        }
        
        .btn-orange:hover {
            color: white;
            background-color: var(--secondary-orange);
            border-color: var(--secondary-orange);
        }
        
        .btn-outline-orange {
            color: var(--primary-orange);
            background-color: transparent;
            border-color: var(--primary-orange);
        }
        
        .btn-outline-orange:hover {
            color: white;
            background-color: var(--primary-orange);
            border-color: var(--primary-orange);
        }
        
        .badge-category {
            background-color: var(--secondary-orange);
            color: white;
        }
        
        .pagination .page-link {
            color: var(--primary-orange);
        }
        
        .pagination .page-item.active .page-link {
            background-color: var(--primary-orange);
            border-color: var(--primary-orange);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="<?php echo e(route('home')); ?>">
                <i class="bi bi-building"></i> Keshari Laminates
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('home')); ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo e(route('products')); ?>">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('about')); ?>">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('contact')); ?>">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/login">Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="bg-light py-5">
        <div class="container">
            <div class="text-center mb-4">
                <h1 class="section-title">
                    <?php if(isset($selected_category)): ?>
                        <?php echo e($selected_category->name); ?>

                    <?php elseif(isset($category)): ?>
                        <?php echo e($category->name); ?>

                    <?php else: ?>
                        Our Products
                    <?php endif; ?>
                </h1>
                <p class="lead text-muted">
                    <?php if(isset($selected_category)): ?>
                        <?php echo e($selected_category->description ?? 'Browse our ' . strtolower($selected_category->name) . ' collection'); ?>

                    <?php elseif(isset($category)): ?>
                        <?php echo e($category->description ?? 'Browse our ' . strtolower($category->name) . ' collection'); ?>

                    <?php else: ?>
                        Premium quality laminates for all your interior design needs
                    <?php endif; ?>
                </p>
            </div>

            <!-- Breadcrumbs -->
            <?php if(isset($breadcrumbs) && count($breadcrumbs) > 0): ?>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center bg-white rounded shadow-sm py-2 px-3">
                        <li class="breadcrumb-item">
                            <a href="<?php echo e(route('home')); ?>" class="text-decoration-none">
                                <i class="bi bi-house-door me-1"></i>Home
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?php echo e(route('products')); ?>" class="text-decoration-none">Products</a>
                        </li>
                        <?php $__currentLoopData = $breadcrumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $breadcrumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($loop->last): ?>
                                <li class="breadcrumb-item active" aria-current="page"><?php echo e($breadcrumb->name); ?></li>
                            <?php else: ?>
                                <li class="breadcrumb-item">
                                    <a href="<?php echo e(route('products', ['category' => $breadcrumb->path ?: $breadcrumb->slug])); ?>" 
                                       class="text-decoration-none"><?php echo e($breadcrumb->name); ?></a>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ol>
                </nav>
            <?php endif; ?>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="filter-section">
        <div class="container">
            <form method="GET" action="<?php echo e(route('products')); ?>" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="category" class="form-label fw-semibold">Category</label>
                    <select name="category" id="category" class="form-select">
                        <option value="">All Categories</option>
                        <?php if($categories && count($categories) > 0): ?>
                            <?php $__currentLoopData = collect($categories)->groupBy(function($cat) { return $cat->parent ? $cat->parent->name : 'Other'; }); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $groupName => $groupCategories): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($groupName !== 'Other'): ?>
                                    <optgroup label="<?php echo e($groupName); ?>">
                                <?php endif; ?>
                                <?php $__currentLoopData = $groupCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($cat->path ?: $cat->slug); ?>" 
                                            <?php echo e(request('category') === ($cat->path ?: $cat->slug) ? 'selected' : ''); ?>>
                                        <?php if($cat->parent): ?>
                                            <?php echo e($cat->name); ?> (<?php echo e($cat->products()->count()); ?> products)
                                        <?php else: ?>
                                            <?php echo e($cat->name); ?>

                                        <?php endif; ?>
                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php if($groupName !== 'Other'): ?>
                                    </optgroup>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="search" class="form-label fw-semibold">Search</label>
                    <input type="text" 
                           name="search" 
                           id="search" 
                           class="form-control" 
                           placeholder="Search products..."
                           value="<?php echo e(request('search')); ?>">
                </div>
                <div class="col-md-2">
                    <label for="sort" class="form-label fw-semibold">Sort By</label>
                    <select name="sort" id="sort" class="form-select">
                        <option value="">Default</option>
                        <option value="price_low" <?php echo e(request('sort') === 'price_low' ? 'selected' : ''); ?>>Price: Low to High</option>
                        <option value="price_high" <?php echo e(request('sort') === 'price_high' ? 'selected' : ''); ?>>Price: High to Low</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-orange w-100">
                        <i class="bi bi-search"></i> Filter
                    </button>
                </div>
            </form>

            <!-- Category Quick Navigation -->
            <?php if(isset($root_categories) && count($root_categories) > 0): ?>
                <div class="mt-4">
                    <h6 class="text-muted mb-3">Quick Category Navigation:</h6>
                    <div class="d-flex flex-wrap gap-2">
                        <?php $__currentLoopData = $root_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rootCat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($rootCat->children && count($rootCat->children) > 0): ?>
                                <?php $__currentLoopData = $rootCat->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($child->products()->count() > 0 || $child->children()->whereHas('products')->count() > 0): ?>
                                        <a href="<?php echo e(route('products', ['category' => $child->path ?: $child->slug])); ?>" 
                                           class="btn btn-outline-secondary btn-sm">
                                            <?php echo e($child->name); ?>

                                            <span class="badge bg-secondary ms-1">
                                                <?php echo e($child->getAllProducts()->count()); ?>

                                            </span>
                                        </a>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Products Section -->
    <div class="container py-5">
        <?php if($products && count($products) > 0): ?>
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>
                            Products 
                            <span class="text-muted fs-6">
                                (<?php echo e($products->total()); ?> <?php echo e(Str::plural('product', $products->total())); ?> found)
                            </span>
                        </h4>
                        <?php if(request()->hasAny(['category', 'search', 'sort'])): ?>
                            <a href="<?php echo e(route('products')); ?>" class="btn btn-outline-secondary btn-sm">
                                <i class="bi bi-x"></i> Clear Filters
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="card product-card h-100">
                            <div class="product-image position-relative">
                                <?php if($product->images && count($product->images) > 0): ?>
                                    <img src="<?php echo e(asset('storage/' . $product->images->first()->image_path)); ?>" 
                                         alt="<?php echo e($product->name); ?>" 
                                         class="card-img-top">
                                <?php else: ?>
                                    <div class="d-flex align-items-center justify-content-center h-100">
                                        <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                                    </div>
                                <?php endif; ?>
                                <?php if($product->is_featured): ?>
                                    <span class="position-absolute top-0 end-0 badge bg-warning m-2">
                                        <i class="bi bi-star-fill"></i> Featured
                                    </span>
                                <?php endif; ?>
                            </div>
                            
                            <div class="card-body d-flex flex-column">
                                <div class="mb-2">
                                    <span class="badge badge-category"><?php echo e($product->category->name ?? 'Laminate'); ?></span>
                                    <?php if($product->product_code): ?>
                                        <small class="text-muted ms-2"><?php echo e($product->product_code); ?></small>
                                    <?php endif; ?>
                                </div>
                                
                                <h5 class="card-title"><?php echo e($product->name); ?></h5>
                                
                                <?php if($product->description): ?>
                                    <p class="card-text text-muted small flex-grow-1">
                                        <?php echo e(Str::limit($product->description, 80)); ?>

                                    </p>
                                <?php endif; ?>
                                
                                <div class="mt-auto">
                                    <?php if($product->price): ?>
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <span class="h5 mb-0 text-primary">₹<?php echo e(number_format($product->price, 2)); ?></span>
                                            <?php if($product->specifications && is_array($product->specifications)): ?>
                                                <small class="text-muted">
                                                    <?php if(isset($product->specifications['thickness'])): ?>
                                                        <?php echo e($product->specifications['thickness']); ?>mm
                                                    <?php endif; ?>
                                                </small>
                                            <?php endif; ?>
                                        </div>
                                    <?php else: ?>
                                        <div class="mb-3">
                                            <span class="text-muted">Price on request</span>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="d-grid gap-2">
                                        <a href="<?php echo e(route('products.show', $product->slug)); ?>" class="btn btn-orange btn-sm">
                                            <i class="bi bi-eye"></i> View Details
                                        </a>
                                        <a href="<?php echo e(route('contact')); ?>" class="btn btn-outline-orange btn-sm">
                                            <i class="bi bi-telephone"></i> Get Quote
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Pagination -->
            <?php if($products->hasPages()): ?>
                <div class="d-flex justify-content-center mt-5">
                    <?php echo e($products->links()); ?>

                </div>
            <?php endif; ?>

        <?php else: ?>
            <!-- No Products Found -->
            <div class="text-center py-5">
                <div class="mb-4">
                    <i class="bi bi-search" style="font-size: 4rem; color: var(--primary-orange); opacity: 0.5;"></i>
                </div>
                <h4>No Products Found</h4>
                <?php if(request()->hasAny(['category', 'search', 'sort'])): ?>
                    <p class="lead text-muted">Try adjusting your filters or search terms.</p>
                    <a href="<?php echo e(route('products')); ?>" class="btn btn-orange">
                        <i class="bi bi-arrow-left"></i> View All Products
                    </a>
                <?php else: ?>
                    <p class="lead text-muted">Products will be displayed here once they are added to the database.</p>
                    <a href="/admin/login" class="btn btn-orange">Access Admin Panel</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH D:\xampp\htdocs\keshari\resources\views/products.blade.php ENDPATH**/ ?>
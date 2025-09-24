<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Keshari Laminates - Premium Quality Laminates</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary-orange: #ff6b35;
            --secondary-orange: #f7941d;
            --light-orange: #fff5f2;
            --dark-orange: #cc5529;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            background: linear-gradient(135deg, var(--primary-orange) 0%, var(--secondary-orange) 100%);
            box-shadow: 0 2px 10px rgba(255, 107, 53, 0.3);
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: white !important;
        }

        .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            margin: 0 10px;
            transition: all 0.3s;
        }

        .navbar-nav .nav-link:hover {
            color: white !important;
            transform: translateY(-2px);
        }

        .hero-section {
            background: linear-gradient(135deg, var(--primary-orange) 0%, var(--secondary-orange) 100%);
            color: white;
            padding: 100px 0;
            position: relative;
            overflow: hidden;
            margin-top: 76px;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="rgba(255,255,255,0.1)"><polygon points="0,100 1000,0 1000,100"/></svg>') no-repeat bottom;
            background-size: cover;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .btn-primary-orange {
            background-color: white;
            border-color: white;
            color: var(--primary-orange);
            font-weight: 600;
            padding: 12px 30px;
            border-radius: 50px;
            transition: all 0.3s;
        }

        .btn-primary-orange:hover {
            background-color: var(--light-orange);
            border-color: var(--light-orange);
            color: var(--dark-orange);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
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

        .category-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 5px 25px rgba(255, 107, 53, 0.1);
            transition: all 0.3s;
            border: 1px solid rgba(255, 107, 53, 0.1);
            margin-bottom: 2rem;
        }

        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(255, 107, 53, 0.2);
            border-color: var(--primary-orange);
        }

        .category-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-orange), var(--secondary-orange));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: white;
            font-size: 2rem;
        }

        .stats-section {
            background: var(--light-orange);
            padding: 4rem 0;
        }

        .stat-item {
            text-align: center;
            padding: 2rem;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: bold;
            color: var(--primary-orange);
            display: block;
        }

        .stat-label {
            color: #666;
            font-weight: 600;
            margin-top: 0.5rem;
        }

        .footer {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: white;
            padding: 4rem 0 2rem;
        }

        .footer h5 {
            color: var(--secondary-orange);
            margin-bottom: 1rem;
        }

        .footer a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer a:hover {
            color: var(--secondary-orange);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="bi bi-building"></i> Keshari Laminates
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/products">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/about">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/login">Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container hero-content">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">
                        <?php echo e($company_info['hero_title'] ?? 'Premium Quality Laminates'); ?>

                    </h1>
                    <p class="lead mb-4">
                        <?php echo e($company_info['hero_subtitle'] ?? 'Wholesale distributor of premium laminates, bells, promica, and decor plys for all your interior design needs.'); ?>

                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="/products" class="btn btn-primary-orange btn-lg">
                            <i class="bi bi-box me-2"></i>View Products
                        </a>
                        <a href="/contact" class="btn btn-outline-light btn-lg">
                            <i class="bi bi-telephone me-2"></i>Get Quote
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <div class="hero-image">
                        <i class="bi bi-layers" style="font-size: 15rem; opacity: 0.3;"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Our Product Categories</h2>
                <p class="lead text-muted">Explore our wide range of premium laminate categories</p>
            </div>
            
            <?php if($leaf_categories && count($leaf_categories) > 0): ?>
                <div class="row g-4">
                    <?php $__currentLoopData = $leaf_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="category-card">
                                <div class="category-icon">
                                    <?php switch(strtolower($category->name)):
                                        case ('plain/solid laminates'): ?>
                                        <?php case ('plain/solid'): ?>
                                            <i class="bi bi-square"></i>
                                            <?php break; ?>
                                        <?php case ('wooden laminates'): ?>
                                        <?php case ('wooden'): ?>
                                            <i class="bi bi-tree"></i>
                                            <?php break; ?>
                                        <?php case ('abstract laminates'): ?>
                                        <?php case ('abstract'): ?>
                                            <i class="bi bi-palette"></i>
                                            <?php break; ?>
                                        <?php case ('decor plys'): ?>
                                            <i class="bi bi-layers"></i>
                                            <?php break; ?>
                                        <?php case ('bell laminates'): ?>
                                        <?php case ('bell'): ?>
                                            <i class="bi bi-bell"></i>
                                            <?php break; ?>
                                        <?php case ('promica laminates'): ?>
                                        <?php case ('promica'): ?>
                                            <i class="bi bi-award"></i>
                                            <?php break; ?>
                                        <?php default: ?>
                                            <i class="bi bi-grid"></i>
                                    <?php endswitch; ?>
                                </div>
                                <h4><?php echo e($category->name); ?></h4>
                                <?php if($category->parent): ?>
                                    <small class="text-muted d-block mb-2"><?php echo e($category->getFullName()); ?></small>
                                <?php endif; ?>
                                <p class="text-muted"><?php echo e($category->description ?? 'Premium quality ' . strtolower($category->name)); ?></p>
                                <div class="mb-3">
                                    <span class="badge bg-success"><?php echo e($category->products()->count()); ?> Products</span>
                                </div>
                                <a href="<?php echo e(route('products', ['category' => $category->path ?: $category->slug])); ?>" class="btn btn-outline-primary">
                                    View Products <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                
                <!-- Category Tree Navigation -->
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-light">
                                <h5 class="mb-0"><i class="bi bi-diagram-3 me-2"></i>Complete Category Structure</h5>
                            </div>
                            <div class="card-body">
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rootCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="category-tree mb-3">
                                        <div class="fw-bold text-primary mb-2">
                                            <i class="bi bi-folder me-1"></i>
                                            <a href="<?php echo e(route('products', ['category' => $rootCategory->path ?: $rootCategory->slug])); ?>" 
                                               class="text-decoration-none"><?php echo e($rootCategory->name); ?></a>
                                        </div>
                                        <?php if($rootCategory->children && count($rootCategory->children) > 0): ?>
                                            <?php $__currentLoopData = $rootCategory->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="ms-4 mb-2">
                                                    <i class="bi bi-folder-fill me-1 text-secondary"></i>
                                                    <a href="<?php echo e(route('products', ['category' => $child->path ?: $child->slug])); ?>" 
                                                       class="text-decoration-none"><?php echo e($child->name); ?></a>
                                                    <?php if($child->children && count($child->children) > 0): ?>
                                                        <?php $__currentLoopData = $child->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grandchild): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="ms-4">
                                                                <i class="bi bi-file-earmark me-1 text-muted"></i>
                                                                <a href="<?php echo e(route('products', ['category' => $grandchild->path ?: $grandchild->slug])); ?>" 
                                                                   class="text-decoration-none small"><?php echo e($grandchild->name); ?></a>
                                                                <small class="text-muted">(<?php echo e($grandchild->products()->count()); ?> products)</small>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php else: ?>
                                                        <small class="text-muted ms-3">(<?php echo e($child->products()->count()); ?> products)</small>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="col-12 text-center">
                    <p class="lead text-muted">Categories will be displayed here once they are added to the database.</p>
                    <a href="/admin/login" class="btn btn-primary-orange">Access Admin Panel</a>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Featured Products</h2>
                <p class="lead text-muted">Discover our most popular and premium laminate products</p>
            </div>
            <?php if($featured_products && count($featured_products) > 0): ?>
                <div class="row g-4">
                    <?php $__currentLoopData = $featured_products->take(8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-6 col-lg-3">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="position-relative">
                                    <?php if($product->images && count($product->images) > 0): ?>
                                        <img src="<?php echo e(asset('storage/' . $product->images->first()->image_path)); ?>" 
                                             class="card-img-top" 
                                             alt="<?php echo e($product->name); ?>" 
                                             style="height: 200px; object-fit: cover;">
                                    <?php else: ?>
                                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" 
                                             style="height: 200px;">
                                            <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                                        </div>
                                    <?php endif; ?>
                                    <?php if($product->is_featured): ?>
                                        <span class="position-absolute top-0 start-0 badge bg-warning m-2">
                                            <i class="bi bi-star-fill"></i> Featured
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <div class="mb-2">
                                        <small class="text-muted"><?php echo e($product->category->name ?? 'Laminate'); ?></small>
                                    </div>
                                    <h5 class="card-title"><?php echo e($product->name); ?></h5>
                                    <p class="card-text text-muted small flex-grow-1">
                                        <?php echo e(Str::limit($product->description, 60)); ?>

                                    </p>
                                    <div class="d-flex justify-content-between align-items-center mt-auto">
                                        <?php if($product->price): ?>
                                            <span class="h6 mb-0 text-primary">₹<?php echo e(number_format($product->price, 2)); ?></span>
                                        <?php else: ?>
                                            <span class="text-muted">Price on request</span>
                                        <?php endif; ?>
                                        <small class="text-muted"><?php echo e($product->product_code); ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="text-center mt-5">
                    <a href="<?php echo e(route('products')); ?>" class="btn btn-primary-orange btn-lg">
                        View All Products <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            <?php else: ?>
                <div class="text-center">
                    <div class="mb-4">
                        <i class="bi bi-box" style="font-size: 4rem; color: var(--primary-orange); opacity: 0.5;"></i>
                    </div>
                    <h4>Products Coming Soon</h4>
                    <p class="lead text-muted">Featured products will be displayed here once they are added to the database.</p>
                    <a href="/admin/login" class="btn btn-primary-orange">Access Admin Panel</a>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <span class="stat-number">500+</span>
                        <div class="stat-label">Products</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <span class="stat-number">15+</span>
                        <div class="stat-label">Years Experience</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <span class="stat-number">1000+</span>
                        <div class="stat-label">Happy Clients</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <span class="stat-number">24/7</span>
                        <div class="stat-label">Support</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="section-title text-start">About Keshari Laminates</h2>
                    <p class="lead">
                        We are a leading wholesale distributor of premium quality laminates, serving customers with excellence for over a decade.
                    </p>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Premium Quality Products</li>
                        <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Wholesale Pricing</li>
                        <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Expert Customer Support</li>
                        <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Quick Delivery</li>
                    </ul>
                    <a href="/about" class="btn btn-primary-orange">
                        Learn More <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="col-lg-6 text-center">
                    <div class="p-5">
                        <i class="bi bi-award" style="font-size: 10rem; color: var(--primary-orange); opacity: 0.8;"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5><i class="bi bi-building me-2"></i>Keshari Laminates</h5>
                    <p>Your trusted partner for premium quality laminates. We provide wholesale distribution of laminates, bells, promica, and decor plys.</p>
                    <div class="d-flex gap-3">
                        <a href="#"><i class="bi bi-facebook fs-4"></i></a>
                        <a href="#"><i class="bi bi-instagram fs-4"></i></a>
                        <a href="#"><i class="bi bi-twitter fs-4"></i></a>
                        <a href="#"><i class="bi bi-linkedin fs-4"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 mb-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="/">Home</a></li>
                        <li><a href="/products">Products</a></li>
                        <li><a href="/about">About Us</a></li>
                        <li><a href="/contact">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 mb-4">
                    <h5>Product Categories</h5>
                    <ul class="list-unstyled">
                        <li><a href="/products">Plain/Solid Laminates</a></li>
                        <li><a href="/products">Wooden Laminates</a></li>
                        <li><a href="/products">Abstract Laminates</a></li>
                        <li><a href="/products">Decor Plys</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 mb-4">
                    <h5>Contact Info</h5>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-geo-alt me-2"></i>Industrial Area, Your City</li>
                        <li><i class="bi bi-telephone me-2"></i>+91 98765 43210</li>
                        <li><i class="bi bi-envelope me-2"></i>info@kesharilaminates.com</li>
                        <li><i class="bi bi-clock me-2"></i>Mon-Sat: 9AM-6PM</li>
                    </ul>
                </div>
            </div>
            <hr class="my-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0">&copy; 2025 Keshari Laminates. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0">Designed with <i class="bi bi-heart-fill text-danger"></i> for better business</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH D:\xampp\htdocs\keshari\resources\views/welcome.blade.php ENDPATH**/ ?>
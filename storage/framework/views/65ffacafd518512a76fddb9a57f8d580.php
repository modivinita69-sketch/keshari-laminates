<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Keshari Laminates</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary-orange: #ff6b35;
            --secondary-orange: #f7941d;
        }
        .navbar {
            background: linear-gradient(135deg, var(--primary-orange) 0%, var(--secondary-orange) 100%);
        }
        .navbar-brand, .navbar-nav .nav-link {
            color: white !important;
        }
        .section-title {
            color: var(--primary-orange);
            font-weight: bold;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="/"><i class="bi bi-building"></i> Keshari Laminates</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="/">Home</a>
                <a class="nav-link" href="/products">Products</a>
                <a class="nav-link active" href="/about">About Us</a>
                <a class="nav-link" href="/contact">Contact</a>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <div class="bg-light py-5">
        <div class="container text-center">
            <h1 class="section-title">About Keshari Laminates</h1>
            <p class="lead">Your trusted partner for premium quality laminates</p>
        </div>
    </div>

    <!-- About Content -->
    <div class="container py-5">
        <div class="row align-items-center mb-5">
            <div class="col-lg-6">
                <h3 class="section-title">Our Story</h3>
                <p><?php echo e($company_info['about_us'] ?? 'Keshari Laminates has been a leading wholesale distributor of premium quality laminates for over 15 years. We specialize in providing high-quality laminates, bells, promica, and decorative plywood to distributors and retailers across the region.'); ?></p>
                <p><?php echo e($company_info['experience'] ?? 'Our commitment to quality and customer satisfaction has made us a trusted name in the laminate industry. We work directly with manufacturers to ensure our customers receive the best products at competitive wholesale prices.'); ?></p>
            </div>
            <div class="col-lg-6 text-center">
                <i class="bi bi-award" style="font-size: 8rem; color: var(--primary-orange);"></i>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-4 text-center">
                <i class="bi bi-bullseye" style="font-size: 4rem; color: var(--primary-orange);"></i>
                <h4 class="mt-3">Our Mission</h4>
                <p><?php echo e($company_info['mission'] ?? 'To provide premium quality laminates at competitive wholesale prices while maintaining the highest standards of customer service and product excellence.'); ?></p>
            </div>
            <div class="col-md-4 text-center">
                <i class="bi bi-eye" style="font-size: 4rem; color: var(--primary-orange);"></i>
                <h4 class="mt-3">Our Vision</h4>
                <p><?php echo e($company_info['vision'] ?? 'To be the most trusted and preferred wholesale distributor of laminates in the region, known for quality, reliability, and customer satisfaction.'); ?></p>
            </div>
            <div class="col-md-4 text-center">
                <i class="bi bi-heart" style="font-size: 4rem; color: var(--primary-orange);"></i>
                <h4 class="mt-3">Our Values</h4>
                <p>Quality, integrity, customer focus, and continuous improvement drive everything we do in our business relationships.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h3 class="section-title text-center mb-4">Why Choose Us?</h3>
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="d-flex">
                            <i class="bi bi-check-circle text-success me-3" style="font-size: 2rem;"></i>
                            <div>
                                <h5>Premium Quality</h5>
                                <p>All our products meet international quality standards and come with manufacturer warranties.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex">
                            <i class="bi bi-currency-dollar text-success me-3" style="font-size: 2rem;"></i>
                            <div>
                                <h5>Wholesale Pricing</h5>
                                <p>Competitive wholesale rates for bulk orders and established business relationships.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex">
                            <i class="bi bi-truck text-success me-3" style="font-size: 2rem;"></i>
                            <div>
                                <h5>Quick Delivery</h5>
                                <p>Efficient logistics and delivery system to ensure timely product delivery.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex">
                            <i class="bi bi-headset text-success me-3" style="font-size: 2rem;"></i>
                            <div>
                                <h5>Expert Support</h5>
                                <p>Knowledgeable team to help you choose the right products for your requirements.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <h4>Ready to Partner with Us?</h4>
            <p>Contact us today to discuss your laminate requirements and get a competitive quote.</p>
            <a href="/contact" class="btn btn-primary btn-lg">Get in Touch</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH D:\xampp\htdocs\keshari\resources\views/about.blade.php ENDPATH**/ ?>
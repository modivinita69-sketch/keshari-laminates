<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Keshari Laminates</title>
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
        .contact-card {
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
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
                <a class="nav-link" href="/about">About Us</a>
                <a class="nav-link active" href="/contact">Contact</a>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <div class="bg-light py-5">
        <div class="container text-center">
            <h1 class="section-title">Contact Us</h1>
            <p class="lead">Get in touch for wholesale inquiries and product information</p>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="container py-5">
        <div class="row g-4">
            <!-- Contact Form -->
            <div class="col-lg-8">
                <div class="card contact-card">
                    <div class="card-body p-4">
                        <h3 class="section-title mb-4">Send us a Message</h3>
                        <form>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Full Name *</label>
                                    <input type="text" class="form-control" id="name" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email Address *</label>
                                    <input type="email" class="form-control" id="email" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone">
                                </div>
                                <div class="col-md-6">
                                    <label for="company" class="form-label">Company Name</label>
                                    <input type="text" class="form-control" id="company">
                                </div>
                                <div class="col-12">
                                    <label for="subject" class="form-label">Subject *</label>
                                    <select class="form-select" id="subject" required>
                                        <option value="">Select Inquiry Type</option>
                                        <option value="wholesale">Wholesale Inquiry</option>
                                        <option value="product">Product Information</option>
                                        <option value="pricing">Pricing Request</option>
                                        <option value="partnership">Partnership Opportunity</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="message" class="form-label">Message *</label>
                                    <textarea class="form-control" id="message" rows="5" placeholder="Please provide details about your requirements, quantity needed, delivery location, etc." required></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="bi bi-send me-2"></i>Send Message
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="col-lg-4">
                <div class="card contact-card h-100">
                    <div class="card-body p-4">
                        <h3 class="section-title mb-4">Contact Information</h3>
                        
                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-geo-alt text-primary me-3" style="font-size: 1.5rem;"></i>
                                <div>
                                    <h6 class="mb-1">Address</h6>
                                    <p class="mb-0 text-muted"><?php echo e($contact_info['address'] ?? 'Industrial Area, Your City, State - 123456, India'); ?></p>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-telephone text-primary me-3" style="font-size: 1.5rem;"></i>
                                <div>
                                    <h6 class="mb-1">Phone</h6>
                                    <p class="mb-0 text-muted"><?php echo e($contact_info['phone'] ?? '+91 98765 43210'); ?></p>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-envelope text-primary me-3" style="font-size: 1.5rem;"></i>
                                <div>
                                    <h6 class="mb-1">Email</h6>
                                    <p class="mb-0 text-muted"><?php echo e($contact_info['email'] ?? 'info@kesharilaminates.com'); ?></p>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center mb-4">
                                <i class="bi bi-clock text-primary me-3" style="font-size: 1.5rem;"></i>
                                <div>
                                    <h6 class="mb-1">Business Hours</h6>
                                    <p class="mb-0 text-muted"><?php echo e($contact_info['business_hours'] ?? 'Monday - Saturday, 9:00 AM - 6:00 PM'); ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="border-top pt-4">
                            <h6 class="mb-3">Follow Us</h6>
                            <div class="d-flex gap-3">
                                <a href="#" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-facebook"></i>
                                </a>
                                <a href="#" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-instagram"></i>
                                </a>
                                <a href="#" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-linkedin"></i>
                                </a>
                                <a href="#" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-whatsapp"></i>
                                </a>
                            </div>
                        </div>

                        <div class="border-top pt-4 mt-4">
                            <div class="alert alert-info">
                                <h6><i class="bi bi-info-circle me-2"></i>Wholesale Inquiries</h6>
                                <small>For bulk orders and wholesale pricing, please provide your business details and required quantities for a customized quote.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Information -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="text-center">
                    <h4 class="section-title">Ready to Get Started?</h4>
                    <p class="lead">We're here to help you find the perfect laminate solutions for your projects.</p>
                    <div class="row g-3 mt-4">
                        <div class="col-md-4 text-center">
                            <i class="bi bi-clock text-primary" style="font-size: 3rem;"></i>
                            <h5 class="mt-3">Quick Response</h5>
                            <p>We respond to all inquiries within 24 hours</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <i class="bi bi-shield-check text-primary" style="font-size: 3rem;"></i>
                            <h5 class="mt-3">Quality Assured</h5>
                            <p>All products come with quality guarantees</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <i class="bi bi-truck text-primary" style="font-size: 3rem;"></i>
                            <h5 class="mt-3">Reliable Delivery</h5>
                            <p>Timely delivery across the region</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Simple form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Thank you for your message! We will get back to you soon.\n\nNote: This is a demo form. In production, this would be connected to a backend service.');
        });
    </script>
</body>
</html><?php /**PATH D:\xampp\htdocs\keshari\resources\views/contact.blade.php ENDPATH**/ ?>
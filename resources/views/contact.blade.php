@extends('layouts.app')

@section('title', 'Contact Us')

@section('styles')
<style>
    .contact-card {
        border: none;
        box-shadow: 0 5px 15px rgba(var(--primary-color-rgb), 0.1);
    }

    .branch-info {
        position: relative;
        padding: 1rem;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
    }

    .branch-info:hover {
        background-color: rgba(var(--primary-color-rgb), 0.05);
    }

    .branch-info h5 {
        font-weight: 600;
        position: relative;
        display: inline-block;
    }

    .branch-info h5::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 50px;
        height: 2px;
        background-color: var(--primary-color);
    }

    .common-info {
        background-color: rgba(var(--primary-color-rgb), 0.02);
        padding: 1rem;
        border-radius: 0.5rem;
        margin-top: 1rem;
    }

    @media (max-width: 768px) {
        .branch-info {
            padding: 0.5rem;
        }
    }
</style>
@endsection

@section('content')


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
                        <h3 class="section-title mb-4">Our Locations</h3>
                        
                        <!-- Branch 1 -->
                        <div class="branch-info mb-4">
                            <h5 class="text-primary mb-3">Main Branch</h5>
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-geo-alt text-primary me-3" style="font-size: 1.5rem;"></i>
                                <div>
                                    <h6 class="mb-1">Address</h6>
                                    <p class="mb-0 text-muted">{{ $branch1['address'] ?? '19- 20 dwarkesh soc, Udhana - Magdalla Rd, nr. Navjivan Circle, Surat, Gujarat 395017' }}</p>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-telephone text-primary me-3" style="font-size: 1.5rem;"></i>
                                <div>
                                    <h6 class="mb-1">Phone</h6>
                                    <p class="mb-0 text-muted">{{ $branch1['phone'] ?? '+91 98981 82013' }}</p>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-whatsapp text-primary me-3" style="font-size: 1.5rem;"></i>
                                <div>
                                    <h6 class="mb-1">WhatsApp</h6>
                                    <p class="mb-0 text-muted">{{ $branch1['whatsapp'] ?? '+91 98981 82013' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Branch 2 -->
                        <div class="branch-info mb-4">
                            <div class="border-top pt-4 mb-3"></div>
                            <h5 class="text-primary mb-3">Secondary Branch</h5>
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-geo-alt text-primary me-3" style="font-size: 1.5rem;"></i>
                                <div>
                                    <h6 class="mb-1">Address</h6>
                                    <p class="mb-0 text-muted">{{ $branch2['address'] ?? 'Plot no. 22, Ground floor, Shri ram nagar soc, Nr Rashi circle, Katargam, surat, 395004, Gujarat, India ' }}</p>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-telephone text-primary me-3" style="font-size: 1.5rem;"></i>
                                <div>
                                    <h6 class="mb-1">Phone</h6>
                                    <p class="mb-0 text-muted">{{ $branch2['phone'] ?? '+91 98981 82013' }}</p>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-whatsapp text-primary me-3" style="font-size: 1.5rem;"></i>
                                <div>
                                    <h6 class="mb-1">WhatsApp</h6>
                                    <p class="mb-0 text-muted">{{ $branch2['whatsapp'] ?? '+91 98981 82013' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Common Information -->
                        <div class="common-info border-top pt-4">
                            <div class="d-flex align-items-center mb-3">
                                <i class="bi bi-envelope text-primary me-3" style="font-size: 1.5rem;"></i>
                                <div>
                                    <h6 class="mb-1">Email</h6>
                                    <p class="mb-0 text-muted">{{ $contact_info['email'] ?? 'info@kesharilaminates.com' }}</p>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center mb-4">
                                <i class="bi bi-clock text-primary me-3" style="font-size: 1.5rem;"></i>
                                <div>
                                    <h6 class="mb-1">Business Hours</h6>
                                    <p class="mb-0 text-muted">{{ $contact_info['business_hours'] ?? 'Monday - Saturday, 9:00 AM - 6:00 PM' }}</p>
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

@endsection

@push('scripts')
<script>
    // Simple form validation
    document.querySelector('form').addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Thank you for your message! We will get back to you soon.\n\nNote: This is a demo form. In production, this would be connected to a backend service.');
    });
</script>
@endpush
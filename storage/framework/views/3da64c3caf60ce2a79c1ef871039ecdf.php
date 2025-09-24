

<?php $__env->startSection('title', $product->name); ?>

<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>" class="text-decoration-none">Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('products')); ?>" class="text-decoration-none">Products</a></li>
            <?php if($product->category): ?>
                <?php
                    $breadcrumbs = $product->category->getBreadcrumb();
                ?>
                <?php $__currentLoopData = $breadcrumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $crumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(route('products.category', $crumb['slug'])); ?>" class="text-decoration-none">
                            <?php echo e($crumb['name']); ?>

                        </a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            <li class="breadcrumb-item active" aria-current="page"><?php echo e($product->name); ?></li>
        </ol>
    </nav>

    <div class="row">
        <!-- Product Images -->
        <div class="col-lg-6 mb-4">
            <?php if($product->images->count() > 0): ?>
                <!-- Main Image Carousel -->
                <div id="productCarousel" class="carousel slide mb-3" data-bs-ride="carousel">
                    <div class="carousel-inner rounded">
                        <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="carousel-item <?php echo e($index === 0 ? 'active' : ''); ?>">
                                <img src="<?php echo e(asset('storage/' . $image->image_path)); ?>" 
                                     class="d-block w-100" 
                                     alt="<?php echo e($product->name); ?>"
                                     style="height: 400px; object-fit: cover; cursor: zoom-in;"
                                     onclick="openImageModal('<?php echo e(asset('storage/' . $image->image_path)); ?>')">
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php if($product->images->count() > 1): ?>
                        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    <?php endif; ?>
                </div>

                <!-- Thumbnail Images -->
                <?php if($product->images->count() > 1): ?>
                    <div class="row g-2">
                        <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-3">
                                <img src="<?php echo e(asset('storage/' . $image->image_path)); ?>" 
                                     class="img-thumbnail w-100 <?php echo e($index === 0 ? 'border-primary' : ''); ?>" 
                                     style="height: 80px; object-fit: cover; cursor: pointer;" 
                                     onclick="goToSlide(<?php echo e($index); ?>)"
                                     id="thumb-<?php echo e($index); ?>">
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <!-- No Image Placeholder -->
                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 400px;">
                    <div class="text-center text-muted">
                        <i class="bi bi-image display-1"></i>
                        <p class="mt-2">No images available</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Product Information -->
        <div class="col-lg-6">
            <div class="product-info">
                <h1 class="display-5 fw-bold text-primary mb-3"><?php echo e($product->name); ?></h1>
                
                <?php if($product->category): ?>
                    <div class="mb-3">
                        <span class="badge bg-secondary fs-6"><?php echo e($product->category->name); ?></span>
                        <?php if($product->is_featured): ?>
                            <span class="badge bg-warning text-dark fs-6 ms-1">Featured</span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?php if($product->price): ?>
                    <div class="mb-4">
                        <h2 class="text-success fw-bold">₹<?php echo e(number_format($product->price, 2)); ?></h2>
                        <small class="text-muted">Price per piece</small>
                    </div>
                <?php else: ?>
                    <div class="mb-4">
                        <h3 class="text-primary">Price on Request</h3>
                        <small class="text-muted">Contact us for pricing information</small>
                    </div>
                <?php endif; ?>

                <?php if($product->description): ?>
                    <div class="mb-4">
                        <h5 class="fw-bold">Description</h5>
                        <p class="text-muted"><?php echo e($product->description); ?></p>
                    </div>
                <?php endif; ?>

                <!-- Product Details -->
                <div class="row mb-4">
                    <?php if($product->product_code): ?>
                        <div class="col-sm-6 mb-2">
                            <strong>Product Code:</strong><br>
                            <span class="text-muted"><?php echo e($product->product_code); ?></span>
                        </div>
                    <?php endif; ?>
                    
                    <?php if($product->sku): ?>
                        <div class="col-sm-6 mb-2">
                            <strong>SKU:</strong><br>
                            <span class="text-muted"><?php echo e($product->sku); ?></span>
                        </div>
                    <?php endif; ?>
                    
                    <?php if($product->thickness): ?>
                        <div class="col-sm-6 mb-2">
                            <strong>Thickness:</strong><br>
                            <span class="text-muted"><?php echo e($product->thickness); ?></span>
                        </div>
                    <?php endif; ?>
                    
                    <?php if($product->dimension): ?>
                        <div class="col-sm-6 mb-2">
                            <strong>Dimension:</strong><br>
                            <span class="text-muted"><?php echo e($product->dimension); ?></span>
                        </div>
                    <?php endif; ?>
                    
                    <?php if($product->grade): ?>
                        <div class="col-sm-6 mb-2">
                            <strong>Grade:</strong><br>
                            <span class="text-muted"><?php echo e($product->grade); ?></span>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Action Buttons -->
                <div class="d-grid gap-2 d-md-flex mb-4">
                    <a href="tel:+919876543210" class="btn btn-primary btn-lg flex-fill">
                        <i class="bi bi-telephone"></i> Call for Quote
                    </a>
                    <a href="https://wa.me/919876543210?text=Hi, I'm interested in <?php echo e(urlencode($product->name)); ?>" 
                       target="_blank" class="btn btn-success btn-lg flex-fill">
                        <i class="bi bi-whatsapp"></i> WhatsApp
                    </a>
                </div>

                <!-- Share Buttons -->
                <div class="mb-4">
                    <h6 class="fw-bold">Share this product:</h6>
                    <div class="btn-group" role="group">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(request()->fullUrl())); ?>" 
                           target="_blank" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?text=<?php echo e(urlencode($product->name)); ?>&url=<?php echo e(urlencode(request()->fullUrl())); ?>" 
                           target="_blank" class="btn btn-outline-info btn-sm">
                            <i class="bi bi-twitter"></i>
                        </a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo e(urlencode(request()->fullUrl())); ?>&title=<?php echo e(urlencode($product->name)); ?>" 
                           target="_blank" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-linkedin"></i>
                        </a>
                        <button onclick="copyToClipboard('<?php echo e(request()->fullUrl()); ?>')" class="btn btn-outline-dark btn-sm">
                            <i class="bi bi-link"></i>
                        </button>
                    </div>
                </div>

                <!-- Download Catalogs -->
                <?php if($product->catalogs->count() > 0): ?>
                    <div class="mb-4">
                        <h6 class="fw-bold">Download Catalogs:</h6>
                        <?php $__currentLoopData = $product->catalogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $catalog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('catalog.download', $catalog->id)); ?>" 
                               class="btn btn-outline-primary btn-sm me-2 mb-2">
                                <i class="bi bi-download"></i> <?php echo e($catalog->catalog_name); ?>

                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Specifications Tab -->
    <?php if($product->specifications): ?>
        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5><i class="bi bi-list-check"></i> Technical Specifications</h5>
                    </div>
                    <div class="card-body">
                        <?php if(is_array($product->specifications)): ?>
                            <div class="row">
                                <?php $__currentLoopData = $product->specifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-6 mb-2">
                                        <strong><?php echo e(ucfirst(str_replace('_', ' ', $key))); ?>:</strong>
                                        <span class="text-muted"><?php echo e($value); ?></span>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php else: ?>
                            <pre class="mb-0"><?php echo e($product->specifications); ?></pre>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Related Products -->
    <?php if($related_products->count() > 0): ?>
        <div class="row mt-5">
            <div class="col-12">
                <h3 class="fw-bold mb-4">Related Products</h3>
                <div class="row">
                    <?php $__currentLoopData = $related_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                            <div class="card h-100 shadow-sm">
                                <?php if($related->images->count() > 0): ?>
                                    <img src="<?php echo e(asset('storage/' . $related->images->first()->image_path)); ?>" 
                                         class="card-img-top" 
                                         alt="<?php echo e($related->name); ?>" 
                                         style="height: 200px; object-fit: cover;">
                                <?php else: ?>
                                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                        <i class="bi bi-image text-muted" style="font-size: 2rem;"></i>
                                    </div>
                                <?php endif; ?>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title"><?php echo e($related->name); ?></h5>
                                    <?php if($related->price): ?>
                                        <p class="card-text text-success fw-bold">₹<?php echo e(number_format($related->price, 2)); ?></p>
                                    <?php else: ?>
                                        <p class="card-text text-muted">Price on Request</p>
                                    <?php endif; ?>
                                    <div class="mt-auto">
                                        <a href="<?php echo e(route('products.show', $related->slug)); ?>" class="btn btn-primary btn-sm">View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo e($product->name); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <img id="modalImage" src="" class="w-100" alt="<?php echo e($product->name); ?>">
            </div>
        </div>
    </div>
</div>

<script>
function goToSlide(index) {
    const carousel = new bootstrap.Carousel(document.getElementById('productCarousel'));
    carousel.to(index);
    
    // Update thumbnail borders
    document.querySelectorAll('[id^="thumb-"]').forEach(thumb => {
        thumb.classList.remove('border-primary');
    });
    document.getElementById('thumb-' + index).classList.add('border-primary');
}

function openImageModal(imageSrc) {
    document.getElementById('modalImage').src = imageSrc;
    new bootstrap.Modal(document.getElementById('imageModal')).show();
}

function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Show success message
        const btn = event.target.closest('button');
        const originalHTML = btn.innerHTML;
        btn.innerHTML = '<i class="bi bi-check"></i>';
        setTimeout(() => {
            btn.innerHTML = originalHTML;
        }, 2000);
    });
}

// Update thumbnail border on carousel slide
document.getElementById('productCarousel')?.addEventListener('slide.bs.carousel', function(e) {
    document.querySelectorAll('[id^="thumb-"]').forEach(thumb => {
        thumb.classList.remove('border-primary');
    });
    document.getElementById('thumb-' + e.to)?.classList.add('border-primary');
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\keshari\resources\views/product-detail.blade.php ENDPATH**/ ?>
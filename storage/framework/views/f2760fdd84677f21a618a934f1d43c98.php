

<?php $__env->startSection('title', 'Products'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Products</h1>
    <div>
        <a href="<?php echo e(route('admin.products.create')); ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Product
        </a>
    </div>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <?php echo e(session('success')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col">
                <h5><i class="bi bi-box-seam"></i> Product List (<?php echo e($products->total()); ?>)</h5>
            </div>
            <div class="col-auto">
                <form method="GET" class="d-flex gap-2">
                    <select name="category_id" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="">All Categories</option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category->id); ?>" 
                                    <?php echo e(request('category_id') == $category->id ? 'selected' : ''); ?>>
                                <?php echo e(str_repeat('— ', $category->level)); ?><?php echo e($category->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <input type="search" name="search" class="form-control form-control-sm" 
                           placeholder="Search products..." value="<?php echo e(request('search')); ?>">
                    <button type="submit" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <?php if($products->count() > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock Status</th>
                            <th>Created</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <?php if($product->images->count() > 0): ?>
                                    <img src="<?php echo e(asset('storage/' . $product->images->first()->image_path)); ?>" 
                                         alt="<?php echo e($product->name); ?>" 
                                         class="img-thumbnail" 
                                         style="width: 50px; height: 50px; object-fit: cover;">
                                <?php else: ?>
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                         style="width: 50px; height: 50px;">
                                        <i class="bi bi-image text-muted"></i>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div>
                                    <div class="fw-semibold"><?php echo e($product->name); ?></div>
                                    <?php if($product->description): ?>
                                        <small class="text-muted"><?php echo e(Str::limit($product->description, 50)); ?></small>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td>
                                <?php if($product->category): ?>
                                    <span class="badge bg-secondary"><?php echo e($product->category->name); ?></span>
                                    <?php if($product->category->parent): ?>
                                        <br><small class="text-muted"><?php echo e($product->category->getBreadcrumb()); ?></small>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <span class="badge bg-warning">Uncategorized</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($product->price): ?>
                                    <span class="fw-bold">₹<?php echo e(number_format($product->price, 2)); ?></span>
                                <?php else: ?>
                                    <span class="text-muted">Price on request</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($product->is_featured): ?>
                                    <span class="badge bg-success">Featured</span>
                                <?php else: ?>
                                    <span class="badge bg-outline-secondary">Regular</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <small class="text-muted"><?php echo e($product->created_at->format('M d, Y')); ?></small>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="<?php echo e(route('admin.products.show', $product)); ?>" 
                                       class="btn btn-outline-info" title="View">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="<?php echo e(route('admin.products.edit', $product)); ?>" 
                                       class="btn btn-outline-primary" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form method="POST" action="<?php echo e(route('admin.products.destroy', $product)); ?>" 
                                          class="d-inline" 
                                          onsubmit="return confirm('Are you sure you want to delete this product?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-outline-danger" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="bi bi-box display-1 text-muted"></i>
                <h5 class="mt-3">No Products Found</h5>
                <p class="text-muted">
                    <?php if(request('search') || request('category_id')): ?>
                        No products match your search criteria.
                        <a href="<?php echo e(route('admin.products.index')); ?>" class="btn btn-link">View All Products</a>
                    <?php else: ?>
                        Start by adding your first product.
                        <a href="<?php echo e(route('admin.products.create')); ?>" class="btn btn-link">Add Product</a>
                    <?php endif; ?>
                </p>
            </div>
        <?php endif; ?>
    </div>
    <?php if($products->hasPages()): ?>
        <div class="card-footer">
            <?php echo e($products->links()); ?>

        </div>
    <?php endif; ?>
</div>

<div class="row mt-4">
    <div class="col-md-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6>Total Products</h6>
                        <h3><?php echo e(\App\Models\Product::count()); ?></h3>
                    </div>
                    <div class="align-self-center">
                        <i class="bi bi-box-seam display-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6>Featured Products</h6>
                        <h3><?php echo e(\App\Models\Product::where('is_featured', true)->count()); ?></h3>
                    </div>
                    <div class="align-self-center">
                        <i class="bi bi-star-fill display-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6>Categories</h6>
                        <h3><?php echo e(\App\Models\Category::count()); ?></h3>
                    </div>
                    <div class="align-self-center">
                        <i class="bi bi-tags-fill display-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\keshari\resources\views/admin/products/index.blade.php ENDPATH**/ ?>
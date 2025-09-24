

<?php $__env->startSection('title', 'Categories Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Categories Management</h1>
    <a href="<?php echo e(route('admin.categories.create')); ?>" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add New Category
    </a>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <?php echo e(session('success')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php if(session('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show">
        <?php echo e(session('error')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<!-- Category Tree View -->
<div class="card mb-4">
    <div class="card-header">
        <h5><i class="bi bi-diagram-3"></i> Category Hierarchy</h5>
    </div>
    <div class="card-body">
        <?php if($categoryTree && count($categoryTree) > 0): ?>
            <?php $__currentLoopData = $categoryTree; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rootCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="category-tree-item">
                    <div class="d-flex justify-content-between align-items-center p-2 border-bottom">
                        <div>
                            <strong><?php echo e($rootCategory->name); ?></strong>
                            <span class="badge bg-secondary"><?php echo e($rootCategory->products()->count()); ?> products</span>
                            <?php if(!$rootCategory->is_active): ?>
                                <span class="badge bg-warning">Inactive</span>
                            <?php endif; ?>
                        </div>
                        <div>
                            <a href="<?php echo e(route('admin.categories.show', $rootCategory)); ?>" class="btn btn-sm btn-outline-info">View</a>
                            <a href="<?php echo e(route('admin.categories.edit', $rootCategory)); ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                        </div>
                    </div>
                    <?php if($rootCategory->children && count($rootCategory->children) > 0): ?>
                        <div class="ms-4">
                            <?php $__currentLoopData = $rootCategory->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="d-flex justify-content-between align-items-center p-2 border-bottom bg-light">
                                    <div>
                                        <i class="bi bi-arrow-right"></i> <?php echo e($child->name); ?>

                                        <span class="badge bg-secondary"><?php echo e($child->products()->count()); ?> products</span>
                                        <?php if(!$child->is_active): ?>
                                            <span class="badge bg-warning">Inactive</span>
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                        <a href="<?php echo e(route('admin.categories.show', $child)); ?>" class="btn btn-sm btn-outline-info">View</a>
                                        <a href="<?php echo e(route('admin.categories.edit', $child)); ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                                    </div>
                                </div>
                                <?php if($child->children && count($child->children) > 0): ?>
                                    <div class="ms-4">
                                        <?php $__currentLoopData = $child->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grandchild): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="d-flex justify-content-between align-items-center p-2 border-bottom bg-light">
                                                <div>
                                                    <i class="bi bi-arrow-right"></i><i class="bi bi-arrow-right"></i> <?php echo e($grandchild->name); ?>

                                                    <span class="badge bg-secondary"><?php echo e($grandchild->products()->count()); ?> products</span>
                                                    <?php if(!$grandchild->is_active): ?>
                                                        <span class="badge bg-warning">Inactive</span>
                                                    <?php endif; ?>
                                                </div>
                                                <div>
                                                    <a href="<?php echo e(route('admin.categories.show', $grandchild)); ?>" class="btn btn-sm btn-outline-info">View</a>
                                                    <a href="<?php echo e(route('admin.categories.edit', $grandchild)); ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <p class="text-muted">No categories found. <a href="<?php echo e(route('admin.categories.create')); ?>">Create the first category</a>.</p>
        <?php endif; ?>
    </div>
</div>

<!-- All Categories Table -->
<div class="card">
    <div class="card-header">
        <h5><i class="bi bi-list"></i> All Categories</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Parent</th>
                        <th>Level</th>
                        <th>Products</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($category->id); ?></td>
                            <td>
                                <?php for($i = 0; $i < $category->level; $i++): ?>
                                    <i class="bi bi-arrow-right text-muted"></i>
                                <?php endfor; ?>
                                <?php echo e($category->name); ?>

                            </td>
                            <td><code><?php echo e($category->slug); ?></code></td>
                            <td><?php echo e($category->parent ? $category->parent->name : '-'); ?></td>
                            <td><?php echo e($category->level); ?></td>
                            <td><?php echo e($category->products()->count()); ?></td>
                            <td>
                                <?php if($category->is_active): ?>
                                    <span class="badge bg-success">Active</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Inactive</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="<?php echo e(route('admin.categories.show', $category)); ?>" class="btn btn-sm btn-outline-info">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="<?php echo e(route('admin.categories.edit', $category)); ?>" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form method="POST" action="<?php echo e(route('admin.categories.destroy', $category)); ?>" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                onclick="return confirm('Are you sure you want to delete this category?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted">No categories found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\keshari\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>
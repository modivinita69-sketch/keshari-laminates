

<?php $__env->startSection('title', 'Company Information'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Company Information</h1>
    <small class="text-muted">Manage dynamic content for your website</small>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <?php echo e(session('success')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-header">
        <h5><i class="bi bi-info-circle"></i> Website Content Settings</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="<?php echo e(route('admin.company-info.update')); ?>">
            <?php echo csrf_field(); ?>

            <div class="row">
                <div class="col-md-6">
                    <h6 class="text-primary mb-3">Homepage Content</h6>
                    
                    <div class="mb-3">
                        <label for="hero_title" class="form-label">Hero Section Title</label>
                        <input type="text" class="form-control <?php $__errorArgs = ['hero_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               id="hero_title" name="hero_title" 
                               value="<?php echo e($companyInfo->get('hero_title')?->value ?? $fields['hero_title']['default']); ?>"
                               placeholder="<?php echo e($fields['hero_title']['default']); ?>">
                        <?php $__errorArgs = ['hero_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-3">
                        <label for="hero_subtitle" class="form-label">Hero Section Subtitle</label>
                        <textarea class="form-control <?php $__errorArgs = ['hero_subtitle'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                  id="hero_subtitle" name="hero_subtitle" rows="3"
                                  placeholder="<?php echo e($fields['hero_subtitle']['default']); ?>"><?php echo e($companyInfo->get('hero_subtitle')?->value ?? $fields['hero_subtitle']['default']); ?></textarea>
                        <?php $__errorArgs = ['hero_subtitle'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <h6 class="text-primary mb-3">About Us Content</h6>
                    
                    <div class="mb-3">
                        <label for="about_us" class="form-label">About Us Description</label>
                        <textarea class="form-control <?php $__errorArgs = ['about_us'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                  id="about_us" name="about_us" rows="4"
                                  placeholder="<?php echo e($fields['about_us']['default']); ?>"><?php echo e($companyInfo->get('about_us')?->value ?? $fields['about_us']['default']); ?></textarea>
                        <?php $__errorArgs = ['about_us'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-6">
                    <h6 class="text-primary mb-3">Mission & Vision</h6>
                    
                    <div class="mb-3">
                        <label for="mission" class="form-label">Mission Statement</label>
                        <textarea class="form-control <?php $__errorArgs = ['mission'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                  id="mission" name="mission" rows="3"
                                  placeholder="<?php echo e($fields['mission']['default']); ?>"><?php echo e($companyInfo->get('mission')?->value ?? $fields['mission']['default']); ?></textarea>
                        <?php $__errorArgs = ['mission'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-3">
                        <label for="vision" class="form-label">Vision Statement</label>
                        <textarea class="form-control <?php $__errorArgs = ['vision'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                  id="vision" name="vision" rows="3"
                                  placeholder="<?php echo e($fields['vision']['default']); ?>"><?php echo e($companyInfo->get('vision')?->value ?? $fields['vision']['default']); ?></textarea>
                        <?php $__errorArgs = ['vision'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-3">
                        <label for="experience" class="form-label">Experience Description</label>
                        <textarea class="form-control <?php $__errorArgs = ['experience'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                  id="experience" name="experience" rows="2"
                                  placeholder="<?php echo e($fields['experience']['default']); ?>"><?php echo e($companyInfo->get('experience')?->value ?? $fields['experience']['default']); ?></textarea>
                        <?php $__errorArgs = ['experience'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <h6 class="text-primary mb-3">Contact Information</h6>
                    
                    <div class="mb-3">
                        <label for="address" class="form-label">Business Address</label>
                        <textarea class="form-control <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                  id="address" name="address" rows="3"
                                  placeholder="<?php echo e($fields['address']['default']); ?>"><?php echo e($companyInfo->get('address')?->value ?? $fields['address']['default']); ?></textarea>
                        <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               id="phone" name="phone" 
                               value="<?php echo e($companyInfo->get('phone')?->value ?? $fields['phone']['default']); ?>"
                               placeholder="<?php echo e($fields['phone']['default']); ?>">
                        <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               id="email" name="email" 
                               value="<?php echo e($companyInfo->get('email')?->value ?? $fields['email']['default']); ?>"
                               placeholder="<?php echo e($fields['email']['default']); ?>">
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-3">
                        <label for="business_hours" class="form-label">Business Hours</label>
                        <input type="text" class="form-control <?php $__errorArgs = ['business_hours'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               id="business_hours" name="business_hours" 
                               value="<?php echo e($companyInfo->get('business_hours')?->value ?? $fields['business_hours']['default']); ?>"
                               placeholder="<?php echo e($fields['business_hours']['default']); ?>">
                        <?php $__errorArgs = ['business_hours'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>

            <hr>

            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="bi bi-check-circle"></i> Save Changes
                    </button>
                    <a href="<?php echo e(route('home')); ?>" target="_blank" class="btn btn-outline-secondary">
                        <i class="bi bi-eye"></i> Preview Website
                    </a>
                </div>
                <small class="text-muted">
                    <i class="bi bi-info-circle"></i>
                    Changes will be reflected immediately on your website
                </small>
            </div>
        </form>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-light">
                <h6><i class="bi bi-lightbulb"></i> Tips</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <i class="bi bi-check-circle text-success"></i>
                        Keep your hero title concise and impactful
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-check-circle text-success"></i>
                        Use your hero subtitle to explain your value proposition
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-check-circle text-success"></i>
                        Update contact information regularly
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-check-circle text-success"></i>
                        Make sure your mission and vision align with your business
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-light">
                <h6><i class="bi bi-gear"></i> Current Settings Status</h6>
            </div>
            <div class="card-body">
                <?php
                    $completedFields = $companyInfo->filter(function($info) { return !empty($info->value); })->count();
                    $totalFields = count($fields);
                    $percentage = $totalFields > 0 ? round(($completedFields / $totalFields) * 100) : 0;
                ?>
                
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <span>Profile Completion:</span>
                        <span class="fw-bold"><?php echo e($completedFields); ?>/<?php echo e($totalFields); ?> (<?php echo e($percentage); ?>%)</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: <?php echo e($percentage); ?>%"></div>
                    </div>
                </div>

                <small class="text-muted">
                    Complete all fields to maximize your website's effectiveness.
                </small>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\keshari\resources\views/admin/company-info/index.blade.php ENDPATH**/ ?>
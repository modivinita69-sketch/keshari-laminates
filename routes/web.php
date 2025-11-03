<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CompanyInfoController;

// Theme CSS
Route::get('/css/theme.css', [ThemeController::class, 'css'])
    ->name('theme.css')
    ->middleware('cache.headers:public;max_age=31536000;etag');

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/category/{path}', [ProductController::class, 'category'])->name('products.category');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// Product catalog download
Route::get('/download/catalog/{id}', [ProductController::class, 'downloadCatalog'])->name('catalog.download');

// Admin authentication routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    
    // Load catalog routes
require __DIR__ . '/web-catalogs.php';

// Protected admin routes (with auth:admin middleware)
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        
        // Category management
        Route::resource('categories', AdminCategoryController::class)->names([
            'index' => 'admin.categories.index',
            'create' => 'admin.categories.create',
            'store' => 'admin.categories.store',
            'show' => 'admin.categories.show',
            'edit' => 'admin.categories.edit',
            'update' => 'admin.categories.update',
            'destroy' => 'admin.categories.destroy',
        ]);
        Route::get('/categories/children', [AdminCategoryController::class, 'getChildren'])->name('admin.categories.children');
        
        // Product management
        Route::resource('products', AdminProductController::class)->names([
            'index' => 'admin.products.index',
            'create' => 'admin.products.create',
            'store' => 'admin.products.store',
            'show' => 'admin.products.show',
            'edit' => 'admin.products.edit',
            'update' => 'admin.products.update',
            'destroy' => 'admin.products.destroy',
        ]);
        Route::delete('/products/images/{image}', [AdminProductController::class, 'deleteImage'])->name('admin.products.images.destroy');
        
        // Brand management
        Route::resource('brands', \App\Http\Controllers\Admin\BrandController::class)->names([
            'index' => 'admin.brands.index',
            'create' => 'admin.brands.create',
            'store' => 'admin.brands.store',
            'show' => 'admin.brands.show',
            'edit' => 'admin.brands.edit',
            'update' => 'admin.brands.update',
            'destroy' => 'admin.brands.destroy',
        ]);

        // Company information
        Route::get('/company-info', [CompanyInfoController::class, 'index'])->name('admin.company-info.index');
        Route::post('/company-info', [CompanyInfoController::class, 'update'])->name('admin.company-info.update');

        // Theme settings
        Route::get('/theme-settings', [\App\Http\Controllers\Admin\ThemeSettingsController::class, 'index'])->name('admin.theme-settings.index');
        Route::post('/theme-settings', [\App\Http\Controllers\Admin\ThemeSettingsController::class, 'update'])->name('admin.theme-settings.update');

        // Hero Slider Management
        Route::resource('hero-slider', \App\Http\Controllers\Admin\HeroSliderController::class)->names([
            'index' => 'admin.hero-slider.index',
            'create' => 'admin.hero-slider.create',
            'store' => 'admin.hero-slider.store',
            'edit' => 'admin.hero-slider.edit',
            'update' => 'admin.hero-slider.update',
            'destroy' => 'admin.hero-slider.destroy'
        ])->parameters([
            'hero-slider' => 'slider'
        ]);
        Route::post('/hero-slider/update-order', [\App\Http\Controllers\Admin\HeroSliderController::class, 'updateOrder'])
            ->name('admin.hero-slider.update-order');
    });
});
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CompanyInfoController;

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
        
        // Company information
        Route::get('/company-info', [CompanyInfoController::class, 'index'])->name('admin.company-info.index');
        Route::post('/company-info', [CompanyInfoController::class, 'update'])->name('admin.company-info.update');
    });
});
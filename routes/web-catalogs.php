<?php

use App\Http\Controllers\Admin\CatalogController as AdminCatalogController;
use App\Http\Controllers\CatalogController;

// Public catalog routes
Route::get('/catalogs/{catalog}/download', [CatalogController::class, 'download'])->name('catalogs.download');

// Admin catalog routes
Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('catalogs', AdminCatalogController::class);
});
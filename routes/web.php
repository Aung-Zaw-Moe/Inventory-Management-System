<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Products
    Route::resource('products', ProductController::class);
    Route::post('products/{product}/adjust-stock', [ProductController::class, 'adjustStock'])
        ->name('products.adjust-stock');
    Route::get('products/export', [ProductController::class, 'export'])
        ->name('products.export');
    
    // Categories
    Route::resource('categories', CategoryController::class);
    Route::get('categories/export', [CategoryController::class, 'export'])
        ->name('categories.export');
    
    // Brands
    Route::resource('brands', BrandController::class);
    Route::get('brands/export', [BrandController::class, 'export'])
        ->name('brands.export');
});

require __DIR__.'/auth.php';
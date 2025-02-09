<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Admin Routes (Only Accessible by Admins)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/merchants', [AdminController::class, 'listMerchants'])->name('admin.merchants');
});

/*
|--------------------------------------------------------------------------
| Merchant Routes (Only Accessible by Merchants)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'merchant'])->group(function () {
    Route::get('/merchant/dashboard', [MerchantController::class, 'dashboard'])->name('merchant.dashboard');

    // Store Management
    Route::get('/merchant/stores', [StoreController::class, 'index'])->name('merchant.store.list');
    Route::get('/merchant/stores/create', [StoreController::class, 'create'])->name('merchant.store.create');
    Route::post('/merchant/stores', [StoreController::class, 'store'])->name('merchant.store.store');
    Route::get('/merchant/stores/{store}/edit', [StoreController::class, 'edit'])->name('merchant.store.edit');
    Route::put('/merchant/stores/{store}', [StoreController::class, 'update'])->name('merchant.store.update');
    Route::delete('/merchant/stores/{store}', [StoreController::class, 'destroy'])->name('merchant.store.destroy');

    // Category Management
    Route::get('/merchant/categories', [CategoryController::class, 'index'])->name('merchant.category.list');
    Route::get('/merchant/categories/create', [CategoryController::class, 'create'])->name('merchant.category.create');
    Route::post('/merchant/categories/create', [CategoryController::class, 'store'])->name('merchant.category.store');
    // Route::get('/merchant/categories/{category}/edit', [CategoryController::class, 'edit'])->name('merchant.category.edit');
    // Route::put('/merchant/categories/{category}', [CategoryController::class, 'update'])->name('merchant.category.update');
    Route::delete('/merchant/categories/{category}', [CategoryController::class, 'destroy'])->name('merchant.category.destroy');
    Route::get('/merchant/categories-by-store/{store_id}', [CategoryController::class, 'getCategoriesByStore']);

    // Product Management
    Route::get('/merchant/products', [ProductController::class, 'index'])->name('merchant.product.list');
    Route::get('/merchant/products/create', [ProductController::class, 'create'])->name('merchant.product.create');
    Route::post('/merchant/products/create', [ProductController::class, 'store'])->name('merchant.product.store');
    Route::get('/merchant/products/{product}/edit', [ProductController::class, 'edit'])->name('merchant.product.edit');
    Route::put('/merchant/products/{product}', [ProductController::class, 'update'])->name('merchant.product.update');
    Route::delete('/merchant/products/{product}', [ProductController::class, 'destroy'])->name('merchant.product.destroy');


});

/*
|--------------------------------------------------------------------------
| Multi-Tenant Storefront (Public Routes for Customers)
|--------------------------------------------------------------------------
*/
Route::get('/{shop}', [StoreController::class, 'showShop'])->name('shop.page');
// Route::get('/{shop}/category/{category}', [StoreController::class, 'showCategory'])->name('shop.category');
// Route::get('/{shop}/product/{product}', [StoreController::class, 'showProduct'])->name('shop.product');

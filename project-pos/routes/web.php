<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

// Simple routes for login and dashboard (migrated from design files)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/inventory', [App\Http\Controllers\ProductController::class, 'index'])->name('inventory');
Route::post('/inventory/restock', [App\Http\Controllers\ProductController::class, 'restock'])->name('inventory.restock');

Route::get('/sales', [App\Http\Controllers\SaleController::class, 'index'])->name('sales');
Route::post('/sales/process', [App\Http\Controllers\SaleController::class, 'process'])->name('sales.process');

// Product create/store
Route::get('/products/create', [App\Http\Controllers\ProductController::class, 'create'])->name('products.create');
Route::post('/products', [App\Http\Controllers\ProductController::class, 'store'])->name('products.store');
Route::get('/products/{product}/edit', [App\Http\Controllers\ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{product}', [App\Http\Controllers\ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{product}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('products.destroy');

// Placeholder for password reset route used in the login view
Route::get('/password/reset', function () {
    return 'Password reset not implemented yet.';
})->name('password.request');

Route::get('/', function () {
    return view('welcome');
});

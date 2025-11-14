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

Route::get('/inventory', function () {
    return view('inventory');
})->name('inventory');

Route::get('/sales', function () {
    return view('sales');
})->name('sales');

// Product create/store
Route::get('/products/create', [App\Http\Controllers\ProductController::class, 'create'])->name('products.create');
Route::post('/products', [App\Http\Controllers\ProductController::class, 'store'])->name('products.store');

// Placeholder for password reset route used in the login view
Route::get('/password/reset', function () {
    return 'Password reset not implemented yet.';
})->name('password.request');

Route::get('/', function () {
    return view('welcome');
});

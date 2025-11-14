<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\SalesHistoryController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ServiceController;

// Simple routes for login and dashboard (migrated from design files)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/inventory', [App\Http\Controllers\ProductController::class, 'index'])->name('inventory');
Route::post('/inventory/restock', [App\Http\Controllers\ProductController::class, 'restock'])->name('inventory.restock');

Route::get('/sales', [App\Http\Controllers\SaleController::class, 'index'])->name('sales');
Route::post('/sales/process', [App\Http\Controllers\SaleController::class, 'process'])->name('sales.process');

// Sales History (Riwayat Penjualan)
Route::get('/sales/history', [SalesHistoryController::class, 'index'])->name('sales.history');
Route::get('/sales/{id}/detail', [SalesHistoryController::class, 'show'])->name('sales.detail');

// Audit Log System
Route::get('/audit-log', [AuditLogController::class, 'index'])->name('audit-log');

// Reports
Route::get('/reports/profit', [ReportController::class, 'profit'])->name('reports.profit');

// Services Management (Manajemen Servis)
Route::resource('services', ServiceController::class);

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

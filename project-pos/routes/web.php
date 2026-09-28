<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SalesHistoryController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServicesHistoryController;
use App\Http\Controllers\UserController;

// Simple routes for login and dashboard (migrated from design files)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
 * Semua route di bawah ini wajib login (auth) dan dilindungi permission (can:).
 * Daftar permission ada di config/access.php.
 */
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('can:dashboard.view')->name('dashboard');

    // Manajemen Produk
    Route::get('/inventory', [ProductController::class, 'index'])
        ->middleware('can:products.view')->name('inventory');
    Route::post('/inventory/restock', [ProductController::class, 'restock'])
        ->middleware('can:products.restock')->name('inventory.restock');

    Route::middleware('can:products.create')->group(function () {
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    });
    Route::middleware('can:products.update')->group(function () {
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    });
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])
        ->middleware('can:products.delete')->name('products.destroy');

    // Kasir (POS) — autocomplete produk dipakai halaman kasir, jadi ikut permission sales.create
    Route::middleware('can:sales.create')->group(function () {
        Route::get('/products/autocomplete', [ProductController::class, 'autocomplete'])->name('products.autocomplete');
        Route::get('/sales', [SaleController::class, 'index'])->name('sales');
        Route::post('/sales/process', [SaleController::class, 'process'])->name('sales.process');
    });

    // Sales History (Riwayat Penjualan)
    Route::middleware('can:sales.history')->group(function () {
        Route::get('/sales/history', [SalesHistoryController::class, 'index'])->name('sales.history');
        Route::get('/sales/{id}/detail', [SalesHistoryController::class, 'show'])->name('sales.detail');
    });

    // Services History (Riwayat Servis) — harus didaftarkan sebelum resource services (/services/{service})
    Route::get('/services/history', [ServicesHistoryController::class, 'index'])
        ->middleware('can:services.history')->name('services.history');

    // Services Management (Manajemen Servis) — permission per aksi diatur di ServiceController::middleware()
    Route::resource('services', ServiceController::class);

    // Reports
    Route::middleware('can:reports.profit')->group(function () {
        Route::get('/reports/profit', [ReportController::class, 'profit'])->name('reports.profit');
        Route::get('/reports/profit/data', [ReportController::class, 'profitChartData'])->name('reports.profit.data');
    });

    // Audit Log System
    Route::get('/audit-log', [AuditLogController::class, 'index'])
        ->middleware('can:audit-log.view')->name('audit-log');

    // Manajemen User (user tidak dihapus, hanya dinonaktifkan)
    Route::middleware('can:users.manage')->group(function () {
        Route::resource('users', UserController::class)->except(['show', 'destroy']);
        Route::patch('/users/{user}/toggle-active', [UserController::class, 'toggleActive'])->name('users.toggle-active');
    });

    // Manajemen Role & hak akses
    Route::middleware('can:roles.manage')->group(function () {
        Route::resource('roles', RoleController::class)->except(['show']);
    });
});

// Placeholder for password reset route used in the login view
Route::get('/password/reset', function () {
    return 'Password reset not implemented yet.';
})->name('password.request');

Route::get('/', function () {
    return view('welcome');
});

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

// Placeholder for password reset route used in the login view
Route::get('/password/reset', function () {
    return 'Password reset not implemented yet.';
})->name('password.request');

Route::get('/', function () {
    return view('welcome');
});

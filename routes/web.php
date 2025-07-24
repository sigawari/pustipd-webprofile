<?php

// =====================
// This file is part of the Laravel framework.
// =====================
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Middleware\RoleMiddleware;

// =====================
// Define web routes for the application.
// =====================

// Auth groups route
Route::prefix('auth')->group(function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login')->middleware('guest');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
    Route::post('/logout', [LoginController::class, 'logout'])->name('login.logout');

});

// Admin routes
Route::prefix('admin')->middleware(['auth', 'admin:admin'])->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Add more admin routes here
});

// Public routes
Route::prefix('/')->group(function () {
    // PublicsController routes
    Route::get('/', [PublicsController::class, 'index'])->name('home');
    Route::get('/beranda', [PublicsController::class, 'index'])->name('home');
    Route::get('/about', [PublicsController::class, 'index'])->name('about');
    Route::get('/vision', [PublicsController::class, 'index'])->name('vision');
    Route::get('/structure', [PublicsController::class, 'index'])->name('structure');
    // PublicsController routes
    Route::get('/berita', [PublicsController::class, 'index'])->name('news');
    Route::get('/pengumuman', [PublicsController::class, 'index'])->name('announcements');
    Route::get('/tutorial', [PublicsController::class, 'index'])->name('tutorial');
    Route::get('/faq', [PublicsController::class, 'index'])->name('faq');
    
    // Add more public routes here
});

// Notification routes
// Add more notification routes here


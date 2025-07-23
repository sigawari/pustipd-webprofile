<?php

// =====================
// This file is part of the Laravel framework.
// =====================
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicsController;

// =====================
// Define web routes for the application.
// =====================

// Auth groups route
// Route::prefix('auth')->group(function () {
//     Route::get('/login', [LoginController::class, 'login'])->name('login')->middleware('guest');
//     Route::post('/login', [LoginController::class, 'authenticate']);
//     Route::post('/logout', [LoginController::class, 'logout']);
// });

// Admin routes
Route::prefix('admin')->middleware(['auth', 'can:admin'])->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Add more admin routes here
});

// Public routes
Route::prefix('/')->group(function () {
    // PublicsController routes
    Route::get('/', [PublicsController::class, 'index'])->name('home');
    
    // Add more public routes here
});

// Notification routes
// Add more notification routes here


<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ManageContentController;
use App\Http\Controllers\PublicsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

// Auth Routes
Route::prefix('auth')->group(function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login')->middleware('guest');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
    Route::post('/logout', [LoginController::class, 'logout'])->name('login.logout');
});

// Admin Routes - Menggunakan controller yang ada
Route::prefix('admin')->as('admin.')->middleware(['auth'])->group(function () {
    
    // Dashboard - sementara menggunakan closure
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Content Management Routes menggunakan ManageContentController
    Route::prefix('manage-content')->as('manage-content.')->group(function () {
        // Resource route untuk manage content
        Route::resource('/', ManageContentController::class)->except(['show']);
        
        // About Section Routes
        Route::prefix('about')->as('about.')->group(function () {
            Route::get('/profile', [ManageContentController::class, 'aboutProfile'])->name('profile');
            Route::get('/vision-mission', [ManageContentController::class, 'aboutVisionMission'])->name('vision-mission');
            Route::get('/organization', [ManageContentController::class, 'aboutOrganization'])->name('organization');
        });
        
        // Other content routes
        Route::get('/hero', [ManageContentController::class, 'hero'])->name('hero');
        Route::get('/news', [ManageContentController::class, 'news'])->name('news');
        Route::get('/announcements', [ManageContentController::class, 'announcements'])->name('announcements');
        Route::get('/tutorials', [ManageContentController::class, 'tutorials'])->name('tutorials');
        Route::get('/faq', [ManageContentController::class, 'faq'])->name('faq');
    });
    
    // Profile Routes - sementara menggunakan closure
    Route::prefix('profile')->as('profile.')->group(function () {
        Route::get('/', function() {
            return view('admin.profile.index');
        })->name('index');
        
        Route::get('/edit', function() {
            return view('admin.profile.edit');
        })->name('edit');
    });
});

// Public routes
Route::prefix('/')->group(function () {
    // PublicsController routes
    Route::get('/', [PublicsController::class, 'index'])->name('home');
    Route::get('/tentang', [PublicsController::class, 'index'])->name('about');
    Route::get('/visi', [PublicsController::class, 'index'])->name('vision');
    Route::get('/struktur', [PublicsController::class, 'index'])->name('structure');
    Route::get('/layanan', [PublicsController::class, 'index'])->name('services');
    Route::get('/berita/contohberita', [PublicsController::class, 'index'])->name('contohberita');
    Route::get('/pengumuman/contohpengumuman', [PublicsController::class, 'index'])->name('contohpengumuman');
    Route::get('/tutorial/contohtutorial', [PublicsController::class, 'index'])->name('contohtutorial');
    // PublicsController routes
    Route::get('/berita', [PublicsController::class, 'index'])->name('news');
    Route::get('/pengumuman', [PublicsController::class, 'index'])->name('announcements');
    Route::get('/info-publik', [PublicsController::class, 'index'])->name('info-publik');
    Route::get('/tutorial', [PublicsController::class, 'index'])->name('tutorial');
    Route::get('/sop', [PublicsController::class, 'index'])->name('sop');
    Route::get('/faq', [PublicsController::class, 'index'])->name('faq');
    
    // Add more public routes here
});
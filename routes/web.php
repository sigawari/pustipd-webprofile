<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ManageContentController;
use App\Http\Controllers\admin\DashboardController;

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

// Admin Routes - Protected by authentication
Route::prefix('admin')->as('admin.')->middleware(['auth'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Content Management Routes
    Route::prefix('manage-content')->as('manage-content.')->group(function () {
        
        // tentang Section Routes - PERBAIKAN DI SINI
        Route::prefix('tentang')->as('tentang.')->group(function () {
            Route::get('/profil', [ManageContentController::class, 'tentangProfil'])->name('profil');
            Route::put('/profil', [ManageContentController::class, 'tentangProfilUpdate'])->name('profil.update');
            Route::get('/profil/preview', [ManageContentController::class, 'tentangProfilPreview'])->name('profil.preview');
           
            Route::get('/galeri', [ManageContentController::class, 'tentangGaleri'])->name('galeri');
            
            Route::get('/visi-misi', [ManageContentController::class, 'tentangVisiMisi'])->name('visi-misi');
            Route::put('/visi-misi', [ManageContentController::class, 'tentangVisiMisiUpdate'])->name('visi-misi.update');
            
            Route::get('/organisasi', [ManageContentController::class, 'tentangOrganisasi'])->name('organisasi');
            Route::put('/organisasi', [ManageContentController::class, 'tentangOrganisasiUpdate'])->name('organisasi.update');

            Route::get('/galeri', [ManageContentController::class, 'tentangGaleri'])->name('galeri');

        });

        Route::prefix('beranda')->as('beranda.')->group(function () {
           // TAMBAHAN BARU - Beranda Routes
            Route::get('/pencapaian', [ManageContentController::class, 'berandaPencapaian'])->name('pencapaian');
            Route::get('/mitra', [ManageContentController::class, 'berandaMitra'])->name('mitra');
            Route::get('/layanan', [ManageContentController::class, 'berandaLayanan'])->name('layanan');
        });

        Route::prefix('layanan')->as('layanan.')->group(function () {
           // TAMBAHAN BARU - Beranda Routes
            Route::get('/applayanan', [ManageContentController::class, 'appLayanan'])->name('applayanan');
        });

        
        // Other content routes
        Route::get('/hero', [ManageContentController::class, 'hero'])->name('hero');
        Route::put('/hero', [ManageContentController::class, 'heroUpdate'])->name('hero.update');
        
        Route::get('/news', [ManageContentController::class, 'news'])->name('news');
        Route::get('/announcements', [ManageContentController::class, 'announcements'])->name('announcements');
        Route::get('/tutorials', [ManageContentController::class, 'tutorials'])->name('tutorials');
        Route::get('/faq', [ManageContentController::class, 'faq'])->name('faq');
    });
    
    // profil Routes (untuk admin profil, bukan profil organisasi)
    Route::prefix('profil')->as('profil.')->group(function () {
        Route::get('/', function() {
            return view('admin.profil.index');
        })->name('index');
        
        Route::get('/edit', function() {
            return view('admin.profil.edit');
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

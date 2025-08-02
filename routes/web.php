<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicsController;

use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\ManageContentController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\ManageUserController;

use App\Http\Controllers\admin\ManageContent\Beranda\MitraController;
use App\Http\Controllers\admin\ManageContent\Beranda\LayananController;
use App\Http\Controllers\admin\ManageContent\Beranda\PencapaianController;

use App\Http\Controllers\admin\ManageContent\Tentang\ProfileController;
use App\Http\Controllers\admin\ManageContent\Tentang\GalleryController;

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
        
        // Beranda Section Routes
        Route::prefix('beranda')->as('beranda.')->group(function () {

            // Pencapaian Routes
            Route::controller(PencapaianController::class)->group(function () {
                Route::get('/pencapaian', 'index')->name('pencapaian');
                Route::get('/pencapaian/create', 'create')->name('pencapaian.create');
                Route::post('/pencapaian', 'store')->name('pencapaian.store');
                Route::get('/pencapaian/{pencapaian}/edit', 'edit')->name('pencapaian.edit');
                Route::put('/pencapaian/{pencapaian}', 'update')->name('pencapaian.update');
                Route::delete('/pencapaian/{pencapaian}', 'destroy')->name('pencapaian.destroy');
                Route::get('/pencapaian/export', 'export')->name('pencapaian.export');
            });

            // Mitra Routes
            Route::controller(MitraController::class)->group(function(){
                Route::get('/mitra', 'index')->name('mitra');
                Route::get('/mitra/create', 'create')->name('mitra.create');
                Route::post('/mitra', 'store')->name('mitra.store');
                Route::get('/mitra/{mitra}/edit', 'edit')->name('mitra.edit');
                Route::put('/mitra/{mitra}', 'update')->name('mitra.update');
                Route::delete('/mitra/{mitra}', 'destroy')->name('mitra.destroy');
                Route::get('/mitra/export', 'export')->name('mitra.export');
            });

            // Layanan
            Route::controller(LayananController::class)->group(function(){
                Route::get('/layanan', 'index')->name('layanan');
                Route::get('/layanan/create', 'create')->name('layanan.create');
                Route::post('/layanan', 'store')->name('layanan.store');
                Route::get('/layanan/{layanan}/edit', 'edit')->name('layanan.edit');
                Route::put('/layanan/{layanan}', 'update')->name('layanan.update');
                Route::delete('/layanan/{layanan}', 'destroy')->name('layanan.destroy');
                Route::get('/layanan/export', 'export')->name('layanan.export');
            });
        });

        // tentang Section Routes - PERBAIKAN DI SINI
        Route::prefix('tentang')->as('tentang.')->group(function () {
            // Profile Routes
            Route::controller(ProfileController::class)->group(function(){
                Route::get('/profile', 'index')->name('profile');
                Route::get('/profile/create', 'create')->name('profile.create');
                Route::post('/profile', 'store')->name('profile.store');
                Route::get('/profile/{profile}/edit', 'edit')->name('profile.edit');
                Route::put('/profile/{profile}', 'update')->name('profile.update');
                Route::delete('/profile/{profile}', 'destroy')->name('profile.destroy');
                Route::get('/profile/export', 'export')->name('profile.export');
            });

            // Gallery Routes
            Route::controller(GalleryController::class)->group(function(){
                Route::get('/gallery', 'index')->name('gallery');
                Route::get('/gallery/create', 'create')->name('gallery.create');
                Route::post('/gallery', 'store')->name('gallery.store');
                Route::get('/gallery/{gallery}/edit', 'edit')->name('gallery.edit');
                Route::put('/gallery/{gallery}', 'update')->name('gallery.update');
                Route::delete('/gallery/{gallery}', 'destroy')->name('gallery.destroy');
                Route::get('/gallery/export', 'export')->name('gallery.export');

            });

            // Visi-Misi Routes


            // Oranization Routes




            // Route::get('/profil', [ManageContentController::class, 'tentangProfil'])->name('profil');
            // Route::put('/profil', [ManageContentController::class, 'tentangProfilUpdate'])->name('profil.update');
            // Route::get('/profil/preview', [ManageContentController::class, 'tentangProfilPreview'])->name('profil.preview');
           
            Route::get('/galeri', [ManageContentController::class, 'tentangGaleri'])->name('galeri');
            
            Route::get('/visi-misi', [ManageContentController::class, 'tentangVisiMisi'])->name('visi-misi');
            Route::put('/visi-misi', [ManageContentController::class, 'tentangVisiMisiUpdate'])->name('visi-misi.update');
            
            Route::get('/organisasi', [ManageContentController::class, 'tentangOrganisasi'])->name('organisasi');
            Route::put('/organisasi', [ManageContentController::class, 'tentangOrganisasiUpdate'])->name('organisasi.update');

            Route::get('/galeri', [ManageContentController::class, 'tentangGaleri'])->name('galeri');

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

    // Sistem Routes
    Route::prefix('sistem')->as('sistem.')->group(function () {
        // Manage Users
        Route::controller(ManageUserController::class)->name('users.')->group(function () {
            Route::get('/users', 'index')->name('index');
            Route::get('/users/create', 'create')->name('create');
            Route::post('/users', 'store')->name('store');
            Route::get('/users/{user}/edit', 'edit')->name('edit');
            Route::put('/users/{user}', 'update')->name('update');
            Route::delete('/users/{user}', 'destroy')->name('destroy');
            Route::get('/users/export', 'export')->name('export');
        });
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

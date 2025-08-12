<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicsController;

use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\ManageContentController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\Sistem\ReportsController;
use App\Http\Controllers\admin\Sistem\ManageUserController;

use App\Http\Controllers\admin\ManageContent\Faq\FaqController;
use App\Http\Controllers\admin\ManageContent\Dokumen\SopController;
use App\Http\Controllers\admin\ManageContent\Beranda\MitraController;

use App\Http\Controllers\Admin\ManageContent\KelolaBerita\KelolaBeritaController;
use App\Http\Controllers\admin\ManageContent\Beranda\LayananController;
use App\Http\Controllers\admin\ManageContent\Dokumen\PanduanController;

use App\Http\Controllers\admin\ManageContent\Tentang\GalleryController;
use App\Http\Controllers\admin\ManageContent\Tentang\ProfileController;
use App\Http\Controllers\admin\ManageContent\Dokumen\RegulasiController;
use App\Http\Controllers\admin\ManageContent\Tentang\VisiMisiController;
use App\Http\Controllers\admin\ManageContent\Dokumen\KetetapanController;

use App\Http\Controllers\admin\ManageContent\Tutorial\TutorialController;

use App\Http\Controllers\admin\ManageContent\Beranda\PencapaianController;
use App\Http\Controllers\admin\ManageContent\Tentang\StrukturOrganisasiController;
use App\Http\Controllers\admin\ManageContent\AppLayanan\AppLayananController;
use App\Http\Controllers\admin\ManageContent\Pengumuman\PengumumanController;

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

Route::get('/ketetapan/{ketetapan}/download', [PublicsController::class, 'downloadDokumen'])
    ->name('ketetapan.download');

Route::post('/ketetapan/bulk-download', [PublicsController::class, 'bulkDownloadDokumen'])
    ->name('public.ketetapan.bulk-download');

Route::get('/panduan/{panduan}/download', [PublicsController::class, 'downloadDokumen'])
    ->name('panduan.download');

Route::post('/panduan/bulk-download', [PublicsController::class, 'bulkDownloadDokumen'])
    ->name('public.panduan.bulk-download');

    Route::get('/regulasi/{regulasi}/download', [PublicsController::class, 'downloadDokumen'])
    ->name('regulasi.download');

Route::post('/regulasi/bulk-download', [PublicsController::class, 'bulkDownloadDokumen'])
    ->name('public.regulasi.bulk-download');

Route::get('/sop/{sop}/download', [PublicsController::class, 'downloadDokumen'])
    ->name('sop.download');

Route::post('/sop/bulk-download', [PublicsController::class, 'bulkDownloadDokumen'])
    ->name('public.sop.bulk-download');

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
                Route::post('/profile', 'store')->name('profile.store');
                Route::put('/profile/{profile}', 'update')->name('profile.update');
                Route::delete('/profile/{profile}', 'destroy')->name('profile.destroy');
                Route::get('/profile/export', 'export')->name('profile.export');
            });

            // Gallery Routes
            Route::controller(GalleryController::class)->group(function(){
                Route::get('/gallery', 'index')->name('gallery.index');
                Route::post('/gallery', 'store')->name('gallery.store');
                Route::put('/gallery/{gallery}', 'update')->name('gallery.update');
                Route::delete('/gallery/{gallery}', 'destroy')->name('gallery.destroy');
                Route::get('/gallery/export', 'export')->name('gallery.export');
                Route::post('/gallery/bulk-action', 'bulk')->name('gallery.bulk');
            });

            // Di routes - yang BENAR
            Route::controller(VisiMisiController::class)->group(function(){
                Route::get('/visi-misi', 'index')->name('visi-misi.index');
                Route::get('/visi-misi/create', 'create')->name('visi-misi.create');        
                Route::post('/visi-misi', 'store')->name('visi-misi.store');               
                Route::put('/visi-misi/update', 'updateVisi')->name('visi-misi.update');
                Route::get('/visi-misi/{index}/edit', 'edit')->name('visi-misi.edit');     
                Route::put('/visi-misi/{index}', 'updateMisi')->name('visi-misi.update-misi'); // ← INI untuk update misi
                Route::get('/visi-misi/{index}/delete', 'delete')->name('visi-misi.delete'); 
                Route::delete('/visi-misi/{index}', 'deleteMisi')->name('visi-misi.destroy'); // ← INI untuk hapus misi
            });

            // Struktur Routes
            Route::controller(StrukturOrganisasiController::class)->group(function(){
                Route::prefix('struktur-organisasi')->name('struktur-organisasi.')->group(function () {
                    Route::get('/', [StrukturOrganisasiController::class, 'index'])->name('index');
                    Route::get('/create', [StrukturOrganisasiController::class, 'create'])->name('create');
                    Route::post('/', [StrukturOrganisasiController::class, 'store'])->name('store');
                    Route::get('/{strukturOrganisasi}/edit', [StrukturOrganisasiController::class, 'edit'])->name('edit');
                    Route::put('/{strukturOrganisasi}', [StrukturOrganisasiController::class, 'update'])->name('update');
                    Route::delete('/{strukturOrganisasi}', [StrukturOrganisasiController::class, 'destroy'])->name('destroy');
                    Route::post('/reorder', [StrukturOrganisasiController::class, 'reorder'])->name('reorder');
                });
            });
        });
            
        Route::prefix('applayanan')->name('applayanan.')->group(function () {
            Route::controller(AppLayananController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('/{appLayanan}/edit', 'edit')->name('edit');
                Route::put('/{appLayanan}', 'update')->name('update');
                Route::delete('/{appLayanan}', 'destroy')->name('destroy');
                Route::post('/bulk-action', 'bulk')->name('bulk');
                Route::get('/{appLayanan}/delete', 'delete')->name('delete');
            });
        });

        Route::prefix('berita')->as('berita.')->group(function () {
           //Berita
            Route::controller(KelolaBeritaController::class)->group(function(){
                Route::get('/kelolaberita', 'index')->name('kelolaberita');
                Route::post('/kelolaberita', 'store')->name('kelolaberita.store');
                Route::put('/kelolaberita/{kelolaberita}', 'update')->name('kelolaberita.update');
                Route::delete('/kelolaberita/{kelolaberita}', 'destroy')->name('kelolaberita.destroy');
                Route::get('/kelolaberita/export', 'export')->name('kelolaberita.export');
                Route::post('/kelolaberita/bulk-action', 'bulk')->name('kelolaberita.bulk');
            });
        });

        Route::prefix('pengumuman')->as('pengumuman.')->group(function () {
           //pengumuman
            Route::controller(PengumumanController::class)->group(function(){
                Route::get('/kelolapengumuman', 'index')->name('kelolapengumuman'); 
        });       
        });

        Route::prefix('tutorial')->as('tutorial.')->group(function () {
           //pengumuman
            Route::controller(TutorialController::class)->group(function(){
                Route::get('/kelolatutorial', 'index')->name('kelolatutorial'); 
        });       
        });

        // Beranda Section Routes
        Route::prefix('dokumen')->as('dokumen.')->group(function () {
            Route::controller(KetetapanController::class)->group(function () {
                Route::get('/ketetapan', 'index')->name('ketetapan.index');
                Route::get('/ketetapan/create', 'create')->name('ketetapan.create');
                Route::post('/ketetapan', 'store')->name('ketetapan.store');
                Route::get('/ketetapan/{ketetapan}/edit', 'edit')->name('ketetapan.edit');
                Route::put('/ketetapan/{ketetapan}', 'update')->name('ketetapan.update');
                Route::delete('/ketetapan/{ketetapan}', 'destroy')->name('ketetapan.destroy');
                Route::post('/ketetapan/bulk', 'bulk')->name('ketetapan.bulk');
                Route::get('/ketetapan/export', 'export')->name('ketetapan.export');
                Route::get('/ketetapan/{ketetapan}/download', 'download')->name('ketetapan.download');
                Route::post('/ketetapan/bulk', [KetetapanController::class, 'bulk'])->name('ketetapan.bulk');
                Route::post('/ketetapan/bulk-download', [App\Http\Controllers\PublicsController::class, 'bulkDownload']) ->name('public.ketetapan.bulk-download');
            });
            
            // SOP Routes
            Route::controller(SopController::class)->group(function () {
                Route::get('/sop', 'index')->name('sop.index');
                Route::get('/sop/create', 'create')->name('sop.create');
                Route::post('/sop', 'store')->name('sop.store');
                Route::get('/sop/{sop}/edit', 'edit')->name('sop.edit');
                Route::put('/sop/{sop}', 'update')->name('sop.update');
                Route::delete('/sop/{sop}', 'destroy')->name('sop.destroy');
                Route::post('/sop/bulk', 'bulk')->name('sop.bulk');
                Route::get('/sop/export', 'export')->name('sop.export');
                Route::get('/sop/{sop}/download', 'download')->name('sop.download');
                Route::post('/sop/bulk', [sopController::class, 'bulk'])->name('sop.bulk');
                Route::post('/sop/bulk-download', [App\Http\Controllers\PublicsController::class, 'bulkDownload']) ->name('public.sop.bulk-download');
            });

            // Panduan
            Route::controller(PanduanController::class)->group(function () {
                Route::get('/panduan', 'index')->name('panduan.index');
                Route::get('/panduan/create', 'create')->name('panduan.create');
                Route::post('/panduan', 'store')->name('panduan.store');
                Route::get('/panduan/{panduan}/edit', 'edit')->name('panduan.edit');
                Route::put('/panduan/{panduan}', 'update')->name('panduan.update');
                Route::delete('/panduan/{panduan}', 'destroy')->name('panduan.destroy');
                Route::post('/panduan/bulk', 'bulk')->name('panduan.bulk');
                Route::get('/panduan/export', 'export')->name('panduan.export');
                Route::get('/panduan/{panduan}/download', 'download')->name('panduan.download');
                Route::post('/panduan/bulk', [PanduanController::class, 'bulk'])->name('panduan.bulk');
                Route::post('/panduan/bulk-download', [App\Http\Controllers\PublicsController::class, 'bulkDownload']) ->name('public.panduan.bulk-download');
            });

            // Regulasi
            Route::controller(RegulasiController::class)->group(function () {
                Route::get('/regulasi', 'index')->name('regulasi.index');
                Route::get('/regulasi/create', 'create')->name('regulasi.create');
                Route::post('/regulasi', 'store')->name('regulasi.store');
                Route::get('/regulasi/{regulasi}/edit', 'edit')->name('regulasi.edit');
                Route::put('/regulasi/{regulasi}', 'update')->name('regulasi.update');
                Route::delete('/regulasi/{regulasi}', 'destroy')->name('regulasi.destroy');
                Route::post('/regulasi/bulk', 'bulk')->name('regulasi.bulk');
                Route::get('/regulasi/export', 'export')->name('regulasi.export');
                Route::get('/regulasi/{regulasi}/download', 'download')->name('regulasi.download');
                Route::post('/regulasi/bulk', [RegulasiController::class, 'bulk'])->name('regulasi.bulk');
                Route::post('/regulasi/bulk-download', [App\Http\Controllers\PublicsController::class, 'bulkDownload']) ->name('public.regulasi.bulk-download');
            });
        });

        Route::prefix('faq')->as('faq.')->group(function () {
            Route::controller(FaqController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('/{faq}/edit', 'edit')->name('edit');
                Route::put('/{faq}', 'update')->name('update');
                Route::delete('/{faq}', 'destroy')->name('destroy');
                Route::post('/bulk-action', 'bulk')->name('bulk');
                Route::get('/{faq}/delete', 'delete')->name('delete');
            });
        });
        

        
        // Other content routes
        Route::get('/hero', [ManageContentController::class, 'hero'])->name('hero');
        Route::put('/hero', [ManageContentController::class, 'heroUpdate'])->name('hero.update');
        
        Route::get('/news', [ManageContentController::class, 'news'])->name('news');
        Route::get('/announcements', [ManageContentController::class, 'announcements'])->name('announcements');
        Route::get('/tutorials', [ManageContentController::class, 'tutorials'])->name('tutorials');
    
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
        
        Route::controller(ReportsController::class)->name('reports.')->group(function () {
            Route::get('/reports', 'index')->name('index');
            Route::get('/reports/create', 'create')->name('create');
            Route::post('/reports', 'store')->name('store');
            Route::get('/reports/{user}/edit', 'edit')->name('edit');
            Route::put('/reports/{user}', 'update')->name('update');
            Route::delete('/reports/{user}', 'destroy')->name('destroy');
            Route::get('/reports/export', 'export')->name('export');
        });
    });
});


// Public routes
Route::prefix('/')->group(function () {
    // PublicsController routes
    Route::get('/', [PublicsController::class, 'index'])->name('home');
    Route::get('/tentang', [PublicsController::class, 'index'])->name('about');
    Route::get('/visi-misi', [PublicsController::class, 'index'])->name('vision');
    Route::get('/struktur', [PublicsController::class, 'index'])->name('structure');
    Route::get('/applayanan', [PublicsController::class, 'index'])->name('applayanan');
    Route::get('/berita/contohberita', [PublicsController::class, 'index'])->name('contohberita');
    Route::get('/pengumuman/contohpengumuman', [PublicsController::class, 'index'])->name('contohpengumuman');
    Route::get('/tutorial/contohtutorial', [PublicsController::class, 'index'])->name('contohtutorial');
    // PublicsController routes
    Route::get('/berita', [PublicsController::class, 'index'])->name('news');
    Route::get('/pengumuman', [PublicsController::class, 'index'])->name('announcements');
    Route::get('/ketetapan', [PublicsController::class, 'index'])->name('ketetapan');
    Route::get('/panduan', [PublicsController::class, 'index'])->name('panduan');
    Route::get('/regulasi', [PublicsController::class, 'index'])->name('regulasi');
    Route::get('/sop', [PublicsController::class, 'index'])->name('sop');
    Route::get('/tutorial', [PublicsController::class, 'index'])->name('tutorial');
    Route::get('/faq', [PublicsController::class, 'index'])->name('faq');
    
    // Add more public routes here
});
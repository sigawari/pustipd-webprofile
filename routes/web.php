<?php

use App\Http\Controllers\Admin\AppLayanan\AppLayananController as AppLayananAppLayananController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\public\PublicsController;

// ==========================
// Auths
// ==========================
use App\Http\Controllers\Auth\LoginController;

// ==============================================================================

// ==========================
// Admins
// ==========================
// Dashboard
use App\Http\Controllers\admin\DashboardController;
// Beranda
use App\Http\Controllers\admin\Beranda\LayananController;
use App\Http\Controllers\admin\Beranda\MitraController;
use App\Http\Controllers\admin\Beranda\PencapaianController;

// Tentang Kami
use App\Http\Controllers\admin\TentangKami\GalleryController;
use App\Http\Controllers\admin\TentangKami\ProfilController;
use App\Http\Controllers\admin\TentangKami\VisiMisiController;
use App\Http\Controllers\admin\TentangKami\StrukturOrganisasiController;

// Aplikasi & Layanan
use App\Http\Controllers\admin\AppLayananController;

// Informasi Terkini
use App\Http\Controllers\admin\InformasiTerkini\KelolaBeritaController;
use App\Http\Controllers\admin\InformasiTerkini\KelolaPengumumanController;
use App\Http\Controllers\admin\InformasiTerkini\KelolaTutorialController;

// Dokumen & Regulasi
use App\Http\Controllers\admin\Dokumen\KetetapanController;
use App\Http\Controllers\admin\Dokumen\PanduanController;
use App\Http\Controllers\admin\Dokumen\RegulasiController;
use App\Http\Controllers\admin\Dokumen\SopController;

// FAQ
use App\Http\Controllers\admin\FaqController;

// Sistem
use App\Http\Controllers\admin\Sistem\ManageUserController;
use App\Http\Controllers\admin\Sistem\ReportsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Auth Routes
Route::prefix('auth')->group(function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login')->middleware('guest');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
    Route::post('/logout', [LoginController::class, 'logout'])->name('login.logout');
});

// Public Routes for downloading documents
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

    // Beranda
    Route::prefix('beranda')->as('beranda.')->group(function () {

        // Layanan
        Route::controller(LayananController::class)->group(function () {
            Route::get('/layanan', 'index')->name('layanan.index');
            Route::post('/layanan', 'store')->name('layanan.store');
            Route::put('/layanan/{layanan}', 'update')->name('layanan.update');
            Route::delete('/layanan/{layanan}', 'destroy')->name('layanan.destroy');
            Route::get('/layanan/export', 'export')->name('layanan.export');
            Route::post('/layanan/bulk', 'bulk')->name('layanan.bulk');
        });

        // Mitra Routes
        Route::controller(MitraController::class)->group(function () {
            Route::get('/mitra', 'index')->name('mitra.index');
            Route::post('/mitra', 'store')->name('mitra.store');
            Route::put('/mitra/{mitra}', 'update')->name('mitra.update');
            Route::delete('/mitra/{mitra}', 'destroy')->name('mitra.destroy');
            Route::get('/mitra/export', 'export')->name('mitra.export');
            Route::post('/mitra/bulk', 'bulk')->name('mitra.bulk');
        });

        // Pencapaian Routes
        Route::controller(PencapaianController::class)->group(function () {
            Route::get('/pencapaian', 'index')->name('pencapaian.index');
            Route::post('/pencapaian', 'store')->name('pencapaian.store');
            Route::put('/pencapaian/{mitra}', 'update')->name('pencapaian.update');
            Route::delete('/pencapaian/{mitra}', 'destroy')->name('pencapaian.destroy');
            Route::get('/pencapaian/export', 'export')->name('pencapaian.export');
            Route::post('/pencapaian/bulk', 'bulk')->name('pencapaian.bulk');
        });

    });


    // Tentang Kami
    Route::prefix('tentang-kami')->as('tentang-kami.')->group(function () {

        // Galleri Routes
        Route::controller(GalleryController::class)->group(function () {
            Route::get('/gallery', 'index')->name('gallery.index');
            Route::post('/gallery', 'store')->name('gallery.store');
            Route::put('/gallery/{gallery}', 'update')->name('gallery.update');
            Route::delete('/gallery/{gallery}', 'destroy')->name('gallery.destroy');
            Route::get('/gallery/export', 'export')->name('gallery.export');
            Route::post('/gallery/bulk-action', 'bulk')->name('gallery.bulk');
        });

        // Profil Routes
        Route::controller(ProfilController::class)->group(function () {
            Route::get('/profil', 'index')->name('profil.index');
            Route::post('/profil', 'store')->name('profil.store');
            Route::put('/profil/{profil}', 'update')->name('profil.update');
            Route::delete('/profil/{profil}', 'destroy')->name('profil.destroy');
            Route::get('/profil/export', 'export')->name('profil.export');
        });

        // Struktur Organisasi Routes
        Route::controller(StrukturOrganisasiController::class)->group(function () {
            Route::get('/struktur-organisasi', 'index')->name('struktur-organisasi.index');
            Route::post('/struktur-organisasi', 'store')->name('struktur-organisasi.store');
            Route::put('/struktur-organisasi/{strukturOrganisasi}', 'update')->name('struktur-organisasi.update');
            Route::delete('/struktur-organisasi/{strukturOrganisasi}', 'destroy')->name('struktur-organisasi.destroy');
            Route::get('/struktur-organisasi/export', 'export')->name('struktur-organisasi.export');
            Route::get('/struktur-organisasi/reorder', 'reorder')->name('struktur-organisasi.reorder');
        });

        // Visi Misi Routes
        Route::controller(VisiMisiController::class)->group(function () {
            Route::get('/visi-misi', 'index')->name('visi-misi.index');
            Route::post('/visi-misi', 'store')->name('visi-misi.store');
            Route::put('/visi-misi/update', 'updateVisi')->name('visi-misi.update');
            Route::put('/visi-misi/{index}', 'updateMisi')->name('visi-misi.update-misi'); // ← INI untuk update misi
            Route::delete('/visi-misi/{index}', 'deleteMisi')->name('visi-misi.destroy'); // ← INI untuk hapus misi
            Route::get('/visi-misi/export', 'export')->name('visi-misi.export');
        });

    });

    // Aplikasi & Layanan Routes
    Route::prefix('app-layanan')->as('app-layanan.')->controller(AppLayananController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::put('/{appLayanan}', 'update')->name('update');
        Route::delete('/{appLayanan}', 'destroy')->name('destroy');
        Route::post('/bulk-action', 'bulk')->name('bulk');
        Route::get('/export', 'export')->name('export');
    });

    // Informasi Terkini
    Route::prefix('informasi-terkini')->name('informasi-terkini.')->group(function(){

        //Berita Routes
        Route::controller(KelolaBeritaController::class)->group(function () {
            Route::get('/kelola-berita', 'index')->name('kelola-berita.index');
            Route::post('/kelola-berita', 'store')->name('kelola-berita.store');
            Route::put('/kelola-berita/{kelolaberita}', 'update')->name('kelola-berita.update');
            Route::delete('/kelola-berita/{kelolaberita}', 'destroy')->name('kelola-berita.destroy');
            Route::get('/kelola-berita/export', 'export')->name('kelola-berita.export');
            Route::post('/kelola-berita/bulk-action', 'bulk')->name('kelola-berita.bulk');
        });

        // Pengumuman Routes 
        Route::controller(KelolaPengumumanController::class)->group(function () {
            Route::get('/kelola-pengumuman', 'index')->name('kelola-pengumuman.index');
            Route::post('/kelola-pengumuman', 'store')->name('kelola-pengumuman.store');
            Route::put('/kelola-pengumuman/{kelolapengumuman}', 'update')->name('kelola-pengumuman.update');
            Route::delete('/kelola-pengumuman/{kelolapengumuman}', 'destroy')->name('kelola-pengumuman.destroy');
            Route::get('/kelola-pengumuman/export', 'export')->name('kelola-pengumuman.export');
            Route::post('/kelola-pengumuman/bulk-action', 'bulk')->name('kelola-pengumuman.bulk');
        });

        //Tutorial Routes
        Route::controller(KelolaTutorialController::class)->group(function () {
            Route::get('/kelola-tutorial', 'index')->name('kelola-tutorial.index');
            Route::post('/kelola-tutorial', 'store')->name('kelola-tutorial.store');
            Route::put('/kelola-tutorial/{kelolatutorial}', 'update')->name('kelola-tutorial.update');
            Route::delete('/kelola-tutorial/{kelolatutorial}', 'destroy')->name('kelola-tutorial.destroy');
            Route::get('/kelola-tutorial/export', 'export')->name('kelola-tutorial.export');
            Route::post('/kelola-tutorial/bulk', 'bulk')->name('kelola-tutorial.bulk');
            Route::post('/kelola-tutorial/{kelolatutorial}/featured', 'toggleFeatured')->name('kelola-tutorial.featured');
            Route::post('/kelola-tutorial/{kelolatutorial}/toggle-hide', 'toggleHide')->name('kelola-tutorial.toggle-hide');
        });
    });

    // Dokumen & Regulasi
    Route::prefix('dokumen')->as('dokumen.')->group(function () {

        // Ketetapan Routes
        Route::controller(KetetapanController::class)->group(function () {
            Route::get('/ketetapan', 'index')->name('ketetapan.index');
            Route::post('/ketetapan', 'store')->name('ketetapan.store');
            Route::put('/ketetapan/{ketetapan}', 'update')->name('ketetapan.update');
            Route::delete('/ketetapan/{ketetapan}', 'destroy')->name('ketetapan.destroy');
            Route::get('/ketetapan/export', 'export')->name('ketetapan.export');
            Route::get('/ketetapan/{ketetapan}/download', 'download')->name('ketetapan.download');
            Route::post('/ketetapan/bulk', 'bulk')->name('ketetapan.bulk');
            Route::post('/ketetapan/bulk-download', [PublicsController::class, 'bulkDownload'])->name('public.ketetapan.bulk-download');
        });

        // Panduan
        Route::controller(PanduanController::class)->group(function () {
            Route::get('/panduan', 'index')->name('panduan.index');
            Route::post('/panduan', 'store')->name('panduan.store');
            Route::put('/panduan/{panduan}', 'update')->name('panduan.update');
            Route::delete('/panduan/{panduan}', 'destroy')->name('panduan.destroy');
            Route::get('/panduan/export', 'export')->name('panduan.export');
            Route::get('/panduan/{panduan}/download', 'download')->name('panduan.download');
            Route::post('/panduan/bulk',  'bulk')->name('panduan.bulk');
            Route::post('/panduan/bulk-download', [PublicsController::class, 'bulkDownload'])->name('public.panduan.bulk-download');
        });

        // Regulasi
        Route::controller(RegulasiController::class)->group(function () {
            Route::get('/regulasi', 'index')->name('regulasi.index');
            Route::post('/regulasi', 'store')->name('regulasi.store');
            Route::put('/regulasi/{regulasi}', 'update')->name('regulasi.update');
            Route::delete('/regulasi/{regulasi}', 'destroy')->name('regulasi.destroy');
            Route::get('/regulasi/export', 'export')->name('regulasi.export');
            Route::get('/regulasi/{regulasi}/download', 'download')->name('regulasi.download');
            Route::post('/regulasi/bulk',  'bulk')->name('regulasi.bulk');
            Route::post('/regulasi/bulk-download', [PublicsController::class, 'bulkDownload'])->name('public.regulasi.bulk-download');
        });

        // SOP Routes
        Route::controller(SopController::class)->group(function () {
            Route::get('/sop', 'index')->name('sop.index');
            Route::post('/sop', 'store')->name('sop.store');
            Route::put('/sop/{sop}', 'update')->name('sop.update');
            Route::delete('/sop/{sop}', 'destroy')->name('sop.destroy');
            Route::get('/sop/export', 'export')->name('sop.export');
            Route::get('/sop/{sop}/download', 'download')->name('sop.download');
            Route::post('/sop/bulk', 'bulk')->name('sop.bulk');
            Route::post('/sop/bulk-download', [PublicsController::class, 'bulkDownload'])->name('public.sop.bulk-download');
        });

    });
    
    // FAQ
    Route::prefix('faq')->as('faq.')->controller(FaqController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{faq}/edit', 'edit')->name('edit');
        Route::put('/{faq}', 'update')->name('update');
        Route::delete('/{faq}', 'destroy')->name('destroy');
        Route::post('/bulk', 'bulk')->name('bulk');
        Route::put('/update-visibility', 'updateVisibility')->name('updateVisibility');  // Ubah jadi PUT
    });


    // Sistem
    Route::prefix('sistem')->as('sistem.')->group(function () {
        // Manage Users
        Route::controller(ManageUserController::class)->group(function () {
            Route::get('/manage-users', 'index')->name('manage-users.index');
            Route::post('/manage-users', 'store')->name('manage-users.store');
            Route::put('/manage-users/{user}', 'update')->name('manage-users.update');
            Route::delete('/manage-users/{user}', 'destroy')->name('manage-users.destroy');
            Route::get('/manage-users/export', 'export')->name('manage-users.export');
        });

        Route::controller(ReportsController::class)->group(function () {
            Route::get('/reports', 'index')->name('reports.index');
            Route::post('/reports', 'store')->name('reports.store');
            Route::put('/reports/{user}', 'update')->name('reports.update');
            Route::delete('/reports/{user}', 'destroy')->name('reports.destroy');
            Route::get('/reports/export', 'export')->name('reports.export');
        });
    });

});


// Public routes
Route::prefix('/')->group(function () {
    // PublicsController routes
    Route::get('/', [PublicsController::class, 'index'])->name('home');
    Route::get('/tentang', [PublicsController::class, 'tentang'])->name('about');
    Route::get('/visi-misi', [PublicsController::class, 'visi_misi'])->name('vision');
    Route::get('/struktur', [PublicsController::class, 'struktur'])->name('structure');
    Route::get('/applayanan', [PublicsController::class, 'applayanan'])->name('applayanan');
    Route::get('/berita', [PublicsController::class, 'berita'])->name('news');
    Route::get('/berita/{slug}', [PublicsController::class, 'newsDetail'])->name('news-detail');  
    Route::get('/pengumuman', [PublicsController::class, 'pengumuman'])->name('announcements');
    Route::get('/pengumuman/{slug}', [PublicsController::class, 'announcementsDetail'])->name('announcements-detail');
    Route::get('/tutorial', [PublicsController::class, 'tutorial'])->name('tutorials');
    Route::get('/tutorial/{slug}', [PublicsController::class, 'tutorialsDetail'])->name('tutorials-detail');
    
    // PublicsController routes
    Route::get('/ketetapan', [PublicsController::class, 'ketetapan'])->name('ketetapan');
    Route::get('/panduan', [PublicsController::class, 'panduan'])->name('panduan');
    Route::get('/regulasi', [PublicsController::class, 'regulasi'])->name('regulasi');
    Route::get('/sop', [PublicsController::class, 'sop'])->name('sop');
    Route::get('/faq', [PublicsController::class, 'faqs'])->name('faqs');

    // Add more public routes here
});
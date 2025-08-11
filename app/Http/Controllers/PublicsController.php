<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\ManageContent\Faq; 
use App\Models\ManageContent\AboutUs\VisiMisi;
use App\Models\ManageContent\AboutUs\Gallery;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

// Uncomment the following lines if you need to use Publics model or requests
// use App\Models\Publics;
// use App\Http\Requests\StorePublicsRequest;
// use App\Http\Requests\UpdatePublicsRequest;

class PublicsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->is('tentang')) {
            $title = 'Tentang PUSTIPD';
            $description = 'Apa itu PUSTIPD UIN Raden Fatah Palembang dan apa saja yang kami lakukan.';
            $keywords = 'tentang, news, pustipd';
        
            $galleries = Gallery::where('status', 'published')
                               ->orderBy('sort_order', 'asc')
                               ->orderBy('created_at', 'desc')
                               ->get();
        
            // Transform data di controller
            $galleriesData = $galleries->map(function ($gallery) {
                return [
                    'id' => $gallery->id,
                    'title' => $gallery->title ?? '',
                    'description' => $gallery->description ?? '',
                    'image' => $gallery->image_url ?? asset('assets/img/placeholder/dummy.png'),
                    'event_date' => $gallery->event_date ? $gallery->event_date->format('d M Y') : null,
                ];
            });
        
            return view('public.about', compact('title', 'description', 'keywords', 'galleries', 'galleriesData'));
        }
        

        if ($request->is('visi-misi')) {
            $title = 'Visi & Misi PUSTIPD UIN Raden Fatah Palembang';
            $description = 'Visi dan Misi PUSTIPD UIN Raden Fatah Palembang dalam mendukung transformasi digital perguruan tinggi';
            $keywords = 'visi, misi, pustipd, uin raden fatah, teknologi informasi';
        
            // Ambil data visi dan misi dari satu model
            $visiMisi = VisiMisi::firstOrCreate(['id' => 1], [
                'visi' => '',
                'misi' => [],
                'is_active' => true
            ]);
        
            return view('public.vision', compact('title', 'description', 'keywords', 'visiMisi'));
        }
        if ($request->is('struktur')) {
            $title = 'Struktur Organisasi PUSTIPD UIN Raden Fatah Palembang';
            $description = 'Struktur organisasi PUSTIPD UIN Raden Fatah Palembang yang mengelola teknologi informasi dan data.';
            $keywords = 'struktur, organisasi, pustipd';

            return view('public.structure', compact('title', 'description', 'keywords'));
        }
        if ($request->is('layanan')) {
            $title = 'Layanan dan Aplikasi yang Dikembangkan PUSTIPD';
            $description = 'Layanan dan aplikasi yang dikembangkan oleh PUSTIPD UIN Raden Fatah Palembang untuk mendukung civitas akademika.';
            $keywords = 'layanan, services, pustipd';

            return view('public.services', compact('title', 'description', 'keywords'));
        }
        if ($request->is('berita')) {
            $title = 'Berita';
            $description = 'Semua berita terbaru PUSTIPD UIN Raden Fatah Palembang';
            $keywords = 'berita, news, pustipd';

            $news = Announcement::where('category', 'Berita')
                ->orderBy('date', 'desc')
                ->paginate(5);
            return view('public.news', compact('title', 'description', 'keywords'));
        }
        
        if ($request->is('pengumuman')) {
            $title = 'Pengumuman';
            $description = 'Semua pengumuman terbaru PUSTIPD UIN Raden Fatah Palembang';
            $keywords = 'pengumuman, announcements, pustipd';
            
            $announcements = Announcement::orderBy('date', 'desc')->paginate(8);
            
            return view('public.announcements', compact('title', 'description', 'keywords', 'announcements'));
        }
        
        // FAQ Page
        if ($request->is('faq')) {
            $title = 'FAQ';
            $description = 'Pertanyaan yang sering diajukan tentang PUSTIPD UIN Raden Fatah Palembang';
            $keywords = 'faq, pertanyaan, pustipd';

            // Ambil FAQ yang published, urut berdasarkan sort_order
            $faqs = Faq::where('status', 'published')
                       ->orderBy('sort_order')
                       ->get()
                       ->map(function ($faq) {
                           return [
                               'question' => $faq->question,
                               'answer' => $faq->answer
                           ];
                       })
                       ->toArray();

            return view('public.faq', compact('title', 'description', 'keywords', 'faqs'));
        }

        if ($request->is('tutorial')) {
            $title = 'tutorial';
            $description = 'Tutorial terkait penggunaan teknologi informasi di kawasan civitas akademika UIN Raden Fatah Palembang';
            $keywords = 'tutorial, cara, pustipd';

            return view('public.tutorial', compact('title', 'description', 'keywords'));
        }
        if ($request->is('berita/contohberita')) {
            $title = 'contohberita';
            $description = 'Berita terkait PUSTIPD UIN Raden Fatah Palembang';
            $keywords = 'berita, cara, pustipd';

            return view('public.contohberita', compact('title', 'description', 'keywords'));
        }
        if ($request->is('pengumuman/contohpengumuman')) {
            $title = 'contohpengumuman';
            $description = 'Pengumuman terbaru terkait PUSTIPD UIN Raden Fatah Palembang';
            $keywords = 'pengumuman, terkait, pustipd';

            return view('public.contohpengumuman', compact('title', 'description', 'keywords'));
        }
        if ($request->is('tutorial/contohtutorial')) {
            $title = 'contohtutorial';
            $description = 'Tutorial teknologi dari PUSTIPD UIN Raden Fatah Palembang';
            $keywords = 'tutorial, teknik, pustipd';

            return view('public.contohtutorial', compact('title', 'description', 'keywords'));
        }
        if ($request->is('ketetapan')) {
            $title = 'Ketetapan';
            $description = 'Informasi Publik dan dokumen terkait PUSTIPD UIN Raden Fatah Palembang yang bisa didownload';
            $keywords = 'ketetapan, publik, pustipd';
        
            // Ambil parameter search dan per_page
            $search = $request->get('search');
            $perPage = $request->get('per_page', 10); // Default 10 per halaman
            
            // Validasi per_page
            $validPerPage = [10, 20, 50, 100];
            if (!in_array($perPage, $validPerPage)) {
                $perPage = 10;
            }
        
            // ✅ PERBAIKAN: Query yang benar untuk ketetapan published
            $query = \App\Models\Ketetapan::where('status', 'published')
                                        ->whereNotNull('file_path') // ✅ TAMBAHAN: Hanya yang ada filenya
                                        ->orderBy('year_published', 'desc')
                                        ->orderBy('created_at', 'desc');
        
            // Apply search filter jika ada
            if ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
                });
            }
        
            // Paginate results
            $ketetapans = $query->paginate($perPage);
        
            // Append search parameter ke pagination links
            $ketetapans->appends(request()->query());
        
            // ✅ TAMBAHAN: Total files yang bisa didownload untuk bulk download info
            $totalDownloadableFiles = \App\Models\Ketetapan::where('status', 'published')
                                                           ->whereNotNull('file_path')
                                                           ->count();
        
            return view('public.ketetapan', compact(
                'title', 
                'description', 
                'keywords', 
                'ketetapans',
                'totalDownloadableFiles' // ✅ TAMBAHAN
            ));
        }
        if ($request->is('panduan')) {
            $title = 'Panduan';
            $description = 'Informasi Publik dan dokumen terkait PUSTIPD UIN Raden Fatah Palembang yang bisa didownload';
            $keywords = 'panduan, publik, pustipd';
        
            // Ambil parameter search dan per_page
            $search = $request->get('search');
            $perPage = $request->get('per_page', 10); // Default 10 per halaman
            
            // Validasi per_page
            $validPerPage = [10, 20, 50, 100];
            if (!in_array($perPage, $validPerPage)) {
                $perPage = 10;
            }
        
            // ✅ PERBAIKAN: Query yang benar untuk panduan published
            $query = \App\Models\Panduan::where('status', 'published')
                                        ->whereNotNull('file_path') // ✅ TAMBAHAN: Hanya yang ada filenya
                                        ->orderBy('year_published', 'desc')
                                        ->orderBy('created_at', 'desc');
        
            // Apply search filter jika ada
            if ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
                });
            }
        
            // Paginate results
            $panduans = $query->paginate($perPage);
        
            // Append search parameter ke pagination links
            $panduans->appends(request()->query());
        
            // ✅ TAMBAHAN: Total files yang bisa didownload untuk bulk download info
            $totalDownloadableFiles = \App\Models\Panduan::where('status', 'published')
                                                           ->whereNotNull('file_path')
                                                           ->count();
        
            return view('public.panduan', compact(
                'title', 
                'description', 
                'keywords', 
                'panduans',
                'totalDownloadableFiles' // ✅ TAMBAHAN
            ));
        }
        if ($request->is('regulasi')) {
            $title = 'Regulasi';
            $description = 'Informasi Publik dan dokumen terkait PUSTIPD UIN Raden Fatah Palembang yang bisa didownload';
            $keywords = 'regulasi, publik, pustipd';
        
            // Ambil parameter search dan per_page
            $search = $request->get('search');
            $perPage = $request->get('per_page', 10); // Default 10 per halaman
            
            // Validasi per_page
            $validPerPage = [10, 20, 50, 100];
            if (!in_array($perPage, $validPerPage)) {
                $perPage = 10;
            }
        
            // ✅ PERBAIKAN: Query yang benar untuk regulasi published
            $query = \App\Models\Regulasi::where('status', 'published')
                                        ->whereNotNull('file_path') // ✅ TAMBAHAN: Hanya yang ada filenya
                                        ->orderBy('year_published', 'desc')
                                        ->orderBy('created_at', 'desc');
        
            // Apply search filter jika ada
            if ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
                });
            }
        
            // Paginate results
            $regulasis = $query->paginate($perPage);
        
            // Append search parameter ke pagination links
            $regulasis->appends(request()->query());
        
            // ✅ TAMBAHAN: Total files yang bisa didownload untuk bulk download info
            $totalDownloadableFiles = \App\Models\Regulasi::where('status', 'published')
                                                           ->whereNotNull('file_path')
                                                           ->count();
        
            return view('public.regulasi', compact(
                'title', 
                'description', 
                'keywords', 
                'regulasis',
                'totalDownloadableFiles' // ✅ TAMBAHAN
            ));
        }
        if ($request->is('sop')) {
            $title = 'SOP';
            $description = 'Informasi Publik dan dokumen terkait PUSTIPD UIN Raden Fatah Palembang yang bisa didownload';
            $keywords = 'sop, publik, pustipd';
        
            // Ambil parameter search dan per_page
            $search = $request->get('search');
            $perPage = $request->get('per_page', 10); // Default 10 per halaman
            
            // Validasi per_page
            $validPerPage = [10, 20, 50, 100];
            if (!in_array($perPage, $validPerPage)) {
                $perPage = 10;
            }
        
            // ✅ PERBAIKAN: Query yang benar untuk sop published
            $query = \App\Models\Sop::where('status', 'published')
                                        ->whereNotNull('file_path') // ✅ TAMBAHAN: Hanya yang ada filenya
                                        ->orderBy('year_published', 'desc')
                                        ->orderBy('created_at', 'desc');
        
            // Apply search filter jika ada
            if ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
                });
            }
        
            // Paginate results
            $sops = $query->paginate($perPage);
        
            // Append search parameter ke pagination links
            $sops->appends(request()->query());
        
            // ✅ TAMBAHAN: Total files yang bisa didownload untuk bulk download info
            $totalDownloadableFiles = \App\Models\Sop::where('status', 'published')
                                                           ->whereNotNull('file_path')
                                                           ->count();
        
            return view('public.sop', compact(
                'title', 
                'description', 
                'keywords', 
                'sops',
                'totalDownloadableFiles' // ✅ TAMBAHAN
            ));
        }

        // Default untuk beranda
        $title = 'Beranda';
        $description = 'Selamat datang di Website PUSTIPD UIN Raden Fatah Palembang';
        $keywords = 'home, welcome, application';

        return view('public.homepage', compact('title', 'description', 'keywords'));
    }

    public function downloadKetetapan(\App\Models\Ketetapan $ketetapan)
    {
        // Cek akses public: hanya file published yang bisa didownload
        if ($ketetapan->status !== 'published') {
            abort(404, 'Dokumen tidak tersedia untuk publik');
        }

        // Cek file exists
        if (!$ketetapan->file_path || !Storage::disk('public')->exists($ketetapan->file_path)) {
            abort(404, 'File tidak ditemukan');
        }

        $filePath = Storage::disk('public')->path($ketetapan->file_path);
        $downloadName = $ketetapan->original_filename ?? ($ketetapan->title . '.pdf');
        
        // Log download activity
        Log::info('Public file downloaded', [
            'ketetapan_id' => $ketetapan->id,
            'title' => $ketetapan->title,
            'user_ip' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);
        
        return response()->download($filePath, $downloadName);
    }

    /**
     * ✅ TAMBAHAN: Bulk download files ketetapan (untuk public)
     */
    public function bulkDownloadKetetapan(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:ketetapans,id'
        ]);

        $ids = $request->input('ids');
        
        // Ambil ketetapan yang published dan ada filenya (khusus untuk public)
        $ketetapans = \App\Models\Ketetapan::where('status', 'published')
                                           ->whereIn('id', $ids)
                                           ->whereNotNull('file_path')
                                           ->get();

        if ($ketetapans->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada file yang dapat didownload');
        }

        // Jika hanya 1 file, download langsung
        if ($ketetapans->count() === 1) {
            return $this->downloadKetetapan($ketetapans->first());
        }

        // Jika lebih dari 1 file, buat ZIP
        return $this->createZipDownload($ketetapans);
    }

    /**
     * ✅ TAMBAHAN: Create ZIP download
     */
    private function createZipDownload($ketetapans)
    {
        $zip = new \ZipArchive();
        $zipFileName = 'ketetapan_' . date('Y-m-d_H-i-s') . '.zip';
        $zipPath = storage_path('app/temp/' . $zipFileName);
        
        // Buat folder temp jika belum ada
        if (!File::exists(storage_path('app/temp'))) {
            File::makeDirectory(storage_path('app/temp'), 0755, true);
        }

        if ($zip->open($zipPath, \ZipArchive::CREATE) === TRUE) {
            $fileCount = 0;
            
            foreach ($ketetapans as $ketetapan) {
                if (Storage::disk('public')->exists($ketetapan->file_path)) {
                    $filePath = Storage::disk('public')->path($ketetapan->file_path);
                    $fileName = $ketetapan->original_filename ?? ($ketetapan->title . '.pdf');
                    
                    // Pastikan nama file unik dalam ZIP
                    $counter = 1;
                    $originalFileName = $fileName;
                    while ($zip->locateName($fileName) !== false) {
                        $pathInfo = pathinfo($originalFileName);
                        $extension = isset($pathInfo['extension']) ? '.' . $pathInfo['extension'] : '';
                        $fileName = $pathInfo['filename'] . '_' . $counter . $extension;
                        $counter++;
                    }
                    
                    $zip->addFile($filePath, $fileName);
                    $fileCount++;
                }
            }
            
            $zip->close();
            
            if ($fileCount === 0) {
                // Hapus ZIP kosong
                if (File::exists($zipPath)) {
                    File::delete($zipPath);
                }
                return redirect()->back()->with('error', 'Tidak ada file yang dapat didownload');
            }

            // Log bulk download activity
            Log::info('Public bulk download', [
                'file_count' => $fileCount,
                'ketetapan_ids' => $ketetapans->pluck('id')->toArray(),
                'user_ip' => request()->ip(),
                'user_agent' => request()->userAgent()
            ]);

            return response()->download($zipPath, $zipFileName)->deleteFileAfterSend(true);
        }

        return redirect()->back()->with('error', 'Gagal membuat file ZIP');
    }
    
}
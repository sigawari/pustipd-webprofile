<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Models\ManageContent\Faq; 
use App\Models\StrukturOrganisasi;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\ManageContent\AppLayanan;
use App\Models\ManageContent\AboutUs\Gallery;
use App\Models\ManageContent\AboutUs\VisiMisi;

class PublicsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Route: Home page
        if ($request->is('/')) {
            $title = 'PUSTIPD UIN Raden Fatah Palembang';
            $description = 'Pusat Sistem dan Teknologi Informasi dan Pangkalan Data UIN Raden Fatah Palembang';
            $keywords = 'pustipd, uin raden fatah, teknologi informasi';
            
            return view('public.homepage', compact('title', 'description', 'keywords'));
        }

        // Route: Tentang
        if ($request->is('tentang')) {
            $title = 'Tentang PUSTIPD';
            $description = 'Apa itu PUSTIPD UIN Raden Fatah Palembang dan apa saja yang kami lakukan.';
            $keywords = 'tentang, news, pustipd';
        
            $galleries = Gallery::where('status', 'published')
                               ->orderBy('sort_order', 'asc')
                               ->orderBy('created_at', 'desc')
                               ->get();
        
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

        // Route: Visi Misi
        if ($request->is('visi-misi')) {
            $title = 'Visi & Misi PUSTIPD UIN Raden Fatah Palembang';
            $description = 'Visi dan Misi PUSTIPD UIN Raden Fatah Palembang dalam mendukung transformasi digital perguruan tinggi';
            $keywords = 'visi, misi, pustipd, uin raden fatah, teknologi informasi';
        
            $visiMisi = VisiMisi::firstOrCreate(['id' => 1], [
                'visi' => '',
                'misi' => [],
                'is_active' => true
            ]);
        
            return view('public.vision', compact('title', 'description', 'keywords', 'visiMisi'));
        }

        //Struktur
        if ($request->is('struktur')) {
            $title = 'Struktur Organisasi PUSTIPD';
            $description = 'Struktur organisasi PUSTIPD UIN Raden Fatah Palembang';
            $keywords = 'struktur, organisasi, pustipd';
            
            // ✅ Data untuk tree structure
            $strukturData = StrukturOrganisasi::getTreeStructure();
            
            return view('public.structure', compact(
                'title', 'description', 'keywords', 'strukturData'
            ));
        }

        // Route: AppLayanan/Layanan Digital
        if ($request->is('applayanan') || $request->is('layanan-digital')) {
            return $this->handleAppLayanan($request);
        }

        // Route: Berita
        if ($request->is('berita')) {
            $title = 'Berita';
            $description = 'Semua berita terbaru PUSTIPD UIN Raden Fatah Palembang';
            $keywords = 'berita, news, pustipd';

            $news = Announcement::where('category', 'Berita')
                ->where('status', 'published')
                ->orderBy('date', 'desc')
                ->paginate(8);
            
            return view('public.news', compact('title', 'description', 'keywords', 'news'));
        }
        
        // Route: Pengumuman
        if ($request->is('pengumuman')) {
            $title = 'Pengumuman';
            $description = 'Semua pengumuman terbaru PUSTIPD UIN Raden Fatah Palembang';
            $keywords = 'pengumuman, announcements, pustipd';
            
            $announcements = Announcement::where('status', 'published')
                ->orderBy('date', 'desc')
                ->paginate(8);
            
            return view('public.announcements', compact('title', 'description', 'keywords', 'announcements'));
        }

        // Route: FAQ
        if ($request->is('faq')) {
            $title = 'FAQ - Frequently Asked Questions';
            $description = 'Pertanyaan yang sering diajukan tentang PUSTIPD UIN Raden Fatah Palembang';
            $keywords = 'faq, pertanyaan, pustipd';
            
            $faqs = Faq::where('status', 'published')
                ->orderBy('sort_order', 'asc')
                ->orderBy('created_at', 'desc')
                ->get();
            
            return view('public.faq', compact('title', 'description', 'keywords', 'faqs'));
        }

        // Route: Tutorial
        if ($request->is('tutorial')) {
            $title = 'Tutorial';
            $description = 'Tutorial terkait penggunaan teknologi informasi di kawasan civitas akademika UIN Raden Fatah Palembang';
            $keywords = 'tutorial, cara, pustipd';

            return view('public.tutorial', compact('title', 'description', 'keywords'));
        }

        // Route: Contoh Berita
        if ($request->is('berita/contohberita')) {
            $title = 'Contoh Berita';
            $description = 'Berita terkait PUSTIPD UIN Raden Fatah Palembang';
            $keywords = 'berita, cara, pustipd';

            return view('public.contohberita', compact('title', 'description', 'keywords'));
        }

        // Route: Contoh Pengumuman
        if ($request->is('pengumuman/contohpengumuman')) {
            $title = 'Contoh Pengumuman';
            $description = 'Pengumuman terbaru terkait PUSTIPD UIN Raden Fatah Palembang';
            $keywords = 'pengumuman, terkait, pustipd';

            return view('public.contohpengumuman', compact('title', 'description', 'keywords'));
        }

        // Route: Contoh Tutorial
        if ($request->is('tutorial/contohtutorial')) {
            $title = 'Contoh Tutorial';
            $description = 'Tutorial teknologi dari PUSTIPD UIN Raden Fatah Palembang';
            $keywords = 'tutorial, teknik, pustipd';

            return view('public.contohtutorial', compact('title', 'description', 'keywords'));
        }

        // Route: Ketetapan
        if ($request->is('ketetapan')) {
            return $this->handleKetetapan($request);
        }

        // Route: Panduan
        if ($request->is('panduan')) {
            return $this->handlePanduan($request);
        }

        // Route: Regulasi
        if ($request->is('regulasi')) {
            return $this->handleRegulasi($request);
        }

        // Route: SOP
        if ($request->is('sop')) {
            return $this->handleSop($request);
        }

        // Default untuk beranda
        $title = 'Beranda';
        $description = 'Selamat datang di Website PUSTIPD UIN Raden Fatah Palembang';
        $keywords = 'home, welcome, application';

        return view('public.homepage', compact('title', 'description', 'keywords'));
    }

    /**
     * Handle AppLayanan public page
     */
    private function handleAppLayanan(Request $request)
    {
        $title = 'Layanan Digital';
        $description = 'Akses berbagai aplikasi dan platform digital PUSTIPD UIN Raden Fatah Palembang untuk mendukung kegiatan akademik dan administratif.';
        $keywords = 'layanan digital, aplikasi, pustipd, uin raden fatah, sistem informasi';

        $query = AppLayanan::where('status', 'published')
                          ->whereNotNull('applink')
                          ->orderBy('category', 'asc')
                          ->orderBy('appname', 'asc');

        $search = $request->get('search');
        // Di PublicsController.php - method handleAppLayanan()
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('appname', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
                ->orWhere('category', 'like', "%{$search}%");
            });
        }
        $category = $request->get('category');
        if ($category && in_array($category, ['akademik', 'pegawai', 'pembelajaran', 'administrasi'])) {
            $query->where('category', $category);
        }

        $appLayanans = $query->paginate(9);
        $appLayanans->appends($request->query());

        $getCategoryIcon = function($category) {
            $icons = [
                'akademik' => [
                    'icon' => 'M12 14l9-5-9-5-9 5 9 5z M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z',
                    'color' => 'from-blue-500 to-blue-600',
                    'emoji' => '🎓'
                ],
                'pegawai' => [
                    'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
                    'color' => 'from-green-500 to-green-600',
                    'emoji' => '👥'
                ],
                'pembelajaran' => [
                    'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253',
                    'color' => 'from-orange-500 to-orange-600',
                    'emoji' => '📖'
                ],
                'administrasi' => [
                    'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
                    'color' => 'from-purple-500 to-purple-600',
                    'emoji' => '📋'
                ]
            ];
            
            return $icons[$category] ?? $icons['administrasi'];
        };

        return view('public.applayanan', compact(
            'title', 
            'description', 
            'keywords', 
            'appLayanans',
            'getCategoryIcon'
        ));
    }

    /**
     * Handle Ketetapan page
     */
    private function handleKetetapan(Request $request)
    {
        $title = 'Ketetapan';
        $description = 'Informasi Publik dan dokumen terkait PUSTIPD UIN Raden Fatah Palembang yang bisa didownload';
        $keywords = 'ketetapan, publik, pustipd';

        $search = $request->get('search');
        $perPage = $request->get('per_page', 10);
        
        $validPerPage = [10, 20, 50, 100];
        if (!in_array($perPage, $validPerPage)) {
            $perPage = 10;
        }

        $query = \App\Models\Ketetapan::where('status', 'published')
                                    ->whereNotNull('file_path')
                                    ->orderBy('year_published', 'desc')
                                    ->orderBy('created_at', 'desc');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $ketetapans = $query->paginate($perPage);
        $ketetapans->appends(request()->query());

        $totalDownloadableFiles = \App\Models\Ketetapan::where('status', 'published')
                                                       ->whereNotNull('file_path')
                                                       ->count();

        return view('public.ketetapan', compact(
            'title', 
            'description', 
            'keywords', 
            'ketetapans',
            'totalDownloadableFiles'
        ));
    }

    /**
     * Handle Panduan page
     */
    private function handlePanduan(Request $request)
    {
        $title = 'Panduan';
        $description = 'Informasi Publik dan dokumen terkait PUSTIPD UIN Raden Fatah Palembang yang bisa didownload';
        $keywords = 'panduan, publik, pustipd';

        $search = $request->get('search');
        $perPage = $request->get('per_page', 10);
        
        $validPerPage = [10, 20, 50, 100];
        if (!in_array($perPage, $validPerPage)) {
            $perPage = 10;
        }

        $query = \App\Models\Panduan::where('status', 'published')
                                   ->whereNotNull('file_path')
                                   ->orderBy('year_published', 'desc')
                                   ->orderBy('created_at', 'desc');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $panduans = $query->paginate($perPage);
        $panduans->appends(request()->query());

        $totalDownloadableFiles = \App\Models\Panduan::where('status', 'published')
                                                     ->whereNotNull('file_path')
                                                     ->count();

        return view('public.panduan', compact(
            'title', 
            'description', 
            'keywords', 
            'panduans',
            'totalDownloadableFiles'
        ));
    }

    /**
     * Handle Regulasi page
     */
    private function handleRegulasi(Request $request)
    {
        $title = 'Regulasi';
        $description = 'Informasi Publik dan dokumen terkait PUSTIPD UIN Raden Fatah Palembang yang bisa didownload';
        $keywords = 'regulasi, publik, pustipd';

        $search = $request->get('search');
        $perPage = $request->get('per_page', 10);
        
        $validPerPage = [10, 20, 50, 100];
        if (!in_array($perPage, $validPerPage)) {
            $perPage = 10;
        }

        $query = \App\Models\Regulasi::where('status', 'published')
                                    ->whereNotNull('file_path')
                                    ->orderBy('year_published', 'desc')
                                    ->orderBy('created_at', 'desc');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $regulasis = $query->paginate($perPage);
        $regulasis->appends(request()->query());

        $totalDownloadableFiles = \App\Models\Regulasi::where('status', 'published')
                                                      ->whereNotNull('file_path')
                                                      ->count();

        return view('public.regulasi', compact(
            'title', 
            'description', 
            'keywords', 
            'regulasis',
            'totalDownloadableFiles'
        ));
    }

    /**
     * Handle SOP page
     */
    private function handleSop(Request $request)
    {
        $title = 'SOP';
        $description = 'Informasi Publik dan dokumen terkait PUSTIPD UIN Raden Fatah Palembang yang bisa didownload';
        $keywords = 'sop, publik, pustipd';

        $search = $request->get('search');
        $perPage = $request->get('per_page', 10);
        
        $validPerPage = [10, 20, 50, 100];
        if (!in_array($perPage, $validPerPage)) {
            $perPage = 10;
        }

        $query = \App\Models\Sop::where('status', 'published')
                                ->whereNotNull('file_path')
                                ->orderBy('year_published', 'desc')
                                ->orderBy('created_at', 'desc');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $sops = $query->paginate($perPage);
        $sops->appends(request()->query());

        $totalDownloadableFiles = \App\Models\Sop::where('status', 'published')
                                                 ->whereNotNull('file_path')
                                                 ->count();

        return view('public.sop', compact(
            'title', 
            'description', 
            'keywords', 
            'sops',
            'totalDownloadableFiles'
        ));
    }

    /**
     * Download Ketetapan file
     */
    public function downloadKetetapan(\App\Models\Ketetapan $ketetapan)
    {
        if ($ketetapan->status !== 'published') {
            abort(404, 'Dokumen tidak tersedia untuk publik');
        }

        if (!$ketetapan->file_path || !Storage::disk('public')->exists($ketetapan->file_path)) {
            abort(404, 'File tidak ditemukan');
        }

        $filePath = Storage::disk('public')->path($ketetapan->file_path);
        $downloadName = $ketetapan->original_filename ?? ($ketetapan->title . '.pdf');
        
        Log::info('Public file downloaded', [
            'ketetapan_id' => $ketetapan->id,
            'title' => $ketetapan->title,
            'user_ip' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);
        
        return response()->download($filePath, $downloadName);
    }

    /**
     * Bulk download files ketetapan (untuk public)
     */
    public function bulkDownloadKetetapan(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:ketetapans,id'
        ]);

        $ids = $request->input('ids');
        
        $ketetapans = \App\Models\Ketetapan::where('status', 'published')
                                           ->whereIn('id', $ids)
                                           ->whereNotNull('file_path')
                                           ->get();

        if ($ketetapans->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada file yang dapat didownload');
        }

        if ($ketetapans->count() === 1) {
            return $this->downloadKetetapan($ketetapans->first());
        }

        return $this->createZipDownload($ketetapans);
    }

    /**
     * Create ZIP download
     */
    private function createZipDownload($ketetapans)
    {
        $zip = new \ZipArchive();
        $zipFileName = 'ketetapan_' . date('Y-m-d_H-i-s') . '.zip';
        $zipPath = storage_path('app/temp/' . $zipFileName);
        
        if (!File::exists(storage_path('app/temp'))) {
            File::makeDirectory(storage_path('app/temp'), 0755, true);
        }

        if ($zip->open($zipPath, \ZipArchive::CREATE) === TRUE) {
            $fileCount = 0;
            
            foreach ($ketetapans as $ketetapan) {
                if (Storage::disk('public')->exists($ketetapan->file_path)) {
                    $filePath = Storage::disk('public')->path($ketetapan->file_path);
                    $fileName = $ketetapan->original_filename ?? ($ketetapan->title . '.pdf');
                    
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
                if (File::exists($zipPath)) {
                    File::delete($zipPath);
                }
                return redirect()->back()->with('error', 'Tidak ada file yang dapat didownload');
            }

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

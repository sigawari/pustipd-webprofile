<?php

namespace App\Http\Controllers\public;

use ZipArchive;

use App\Models\Faq;
use App\Models\AppLayanan;
use App\Models\Dokumen\Sop;
use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Models\Dokumen\Panduan;
use App\Models\Dokumen\Regulasi;
use App\Models\Dokumen\Ketetapan;
use App\Models\TentangKami\Profil;
use App\Models\TentangKami\Gallery;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\TentangKami\VisiMisi;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\InformasiTerkini\KelolaBerita;
use App\Models\TentangKami\StrukturOrganisasi;
use App\Models\InformasiTerkini\KelolaTutorial;
use App\Models\InformasiTerkini\KelolaPengumuman;

class PublicsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'PUSTIPD UIN Raden Fatah Palembang';
        $description = 'Pusat Sistem dan Teknologi Informasi dan Pangkalan Data UIN Raden Fatah Palembang';
        $keywords = 'pustipd, uin raden fatah, teknologi informasi';

        $profil = Profil::latest()->first(); 

        $query = KelolaBerita::where('status', 'published');
    
        $newsList = $query->orderBy('publish_date', 'desc')
                  ->paginate(3)
                  ->withQueryString();

        return view('public.homepage', compact(
            'title', 'description', 'keywords', 'profil', 'newsList',
        ));
    }

    public function tentang(){
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

    public function visi_misi(){
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

    public function struktur(){
        $title = 'Struktur Organisasi PUSTIPD';
        $description = 'Struktur organisasi PUSTIPD UIN Raden Fatah Palembang';
        $keywords = 'struktur, organisasi, pustipd';
        
        // ✅ Data untuk tree structure
        $strukturData = StrukturOrganisasi::getTreeStructure();
        
        return view('public.structure', compact(
            'title', 'description', 'keywords', 'strukturData'
        ));
    }

    public function applayanan(Request $request)
    {
        $title = 'Layanan Digital';
        $description = 'Akses berbagai aplikasi dan platform digital PUSTIPD UIN Raden Fatah Palembang untuk mendukung kegiatan akademik dan administratif.';
        $keywords = 'layanan digital, aplikasi, pustipd, uin raden fatah, sistem informasi';

        $query = AppLayanan::where('status', 'published')
            ->whereNotNull('applink')
            ->orderBy('category', 'asc')
            ->orderBy('appname', 'asc');

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('appname', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
                ->orWhere('category', 'like', "%{$search}%");
            });
        }

        if ($category = $request->get('category')) {
            $allowed = ['akademik', 'pegawai', 'pembelajaran', 'administrasi'];
            if (in_array($category, $allowed)) {
                $query->where('category', $category);
            }
        }

        $appLayanans = $query->paginate(9);
        $appLayanans->appends($request->query());

        // Fungsi kategori icon sebagai closure/function lokal
        $getCategoryIcon = function($category) {
            $icons = [
                'akademik' => [
                    'icon' => 'M12 14l9-5-9-5-9 5 9 5z M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z',
                    'color' => 'from-blue-500 to-blue-600',
                    'emoji' => '🎓',
                ],
                'pegawai' => [
                    'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
                    'color' => 'from-green-500 to-green-600',
                    'emoji' => '👥',
                ],
                'pembelajaran' => [
                    'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253',
                    'color' => 'from-orange-500 to-orange-600',
                    'emoji' => '📖',
                ],
                'administrasi' => [
                    'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
                    'color' => 'from-purple-500 to-purple-600',
                    'emoji' => '📋',
                ],
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

    public function berita(Request $request)
    {
        $title = 'Berita';
        $description = 'Semua berita terbaru PUSTIPD UIN Raden Fatah Palembang';
        $keywords = 'berita, news, pustipd';
    
        $search = $request->query('search', '');
        $shareText = "Baca Berita Terbaru dari PUSTIPD UIN RF Palembang - Berita Terbaru";
        $url = url()->current();

    
        $query = KelolaBerita::where('status', 'published');
    
        // Search by title or content
        if ($search) {
            $query->where(function($q) use ($search){
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }
    
        $newsList = $query->orderBy('publish_date', 'desc')
                          ->paginate(6)
                          ->withQueryString();
    
        return view('public.news', compact('title', 'description', 'keywords', 'newsList', 'search', 'shareText', 'url'));
    }
    

    public function newsDetail($slug)
    {   
        $news = KelolaBerita::where('status', 'published')
            ->where('slug', $slug)
            ->firstOrFail();

        $title = $news->name;
        $description = \Str::limit(strip_tags($news->content), 155);
        $keywords = $news->tags ?? 'berita, pustipd';
        $url = url()->current();
        $shareText = "Baca Berita Terbaru dari PUSTIPD UIN RF Palembang - " . $news->name . " " . $url;
        return view('public.news-detail', compact('title', 'description', 'keywords', 'news', 'url', 'shareText'));
    }

    public function pengumuman(Request $request)
    {
        $title = 'Pengumuman';
        $description = 'Semua pengumuman terbaru PUSTIPD UIN Raden Fatah Palembang';
        $keywords = 'pengumuman, announcements, pustipd';

        $search = $request->query('search', '');
        $shareText = "Baca Pengumuman Terbaru dari PUSTIPD UIN RF Palembang - Pengumuman Terbaru";
        $url = url()->current();

        $query = KelolaPengumuman::where('status', 'published');

        // Search by title or content
        if ($search) {
            $query->where(function($q) use ($search){
                $q->where('title', 'like', "%{$search}%")
                ->orWhere('content', 'like', "%{$search}%")
                ->orWhere('category', 'like', "%{$search}%");
            });
        }

        // Urutkan berdasarkan prioritas urgency dulu, kemudian tanggal terbaru
        $announcementsList = $query->orderByRaw("
                                CASE 
                                    WHEN urgency = 'penting' THEN 1
                                    WHEN urgency = 'normal' THEN 2
                                    ELSE 3
                                END
                            ")
                            ->orderBy('date', 'desc')  // Atau 'created_at' jika pakai timestamp upload
                            ->paginate(6)
                            ->withQueryString();

        return view('public.announcements', compact(
            'title', 'description', 'keywords', 'announcementsList', 'search', 'shareText', 'url'
        ));
    }


    public function announcementsDetail($slug)
    {
        $announcement = KelolaPengumuman::where('status', 'published')
            ->where('slug', $slug)
            ->firstOrFail();
    
        $title = $announcement->title;
        $description = \Str::limit(strip_tags($announcement->content), 155);
        $keywords = $announcement->tags ?? 'pengumuman, pustipd';
        $url = url()->current();
        $shareText = "Baca Pengumuman dari PUSTIPD UIN RF Palembang - " . $announcement->name . " " . $url;
    
        return view('public.announcements-detail', compact(
            'title', 'description', 'keywords', 'announcement', 'url', 'shareText'
        ));
    }    

    public function tutorial(){
        $title = 'Tutorial';
        $description = 'Tutorial terkait penggunaan teknologi informasi di kawasan civitas akademika UIN Raden Fatah Palembang';
        $keywords = 'tutorial, cara, pustipd';

        $tutorials = KelolaTutorial::where('status', 'published')
            ->orderBy('date', 'desc')
            ->paginate(8);

        return view('public.tutorial', compact('title', 'description', 'keywords', 'tutorials'));
    }
    public function ketetapan(Request $request)
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
    
        $query = Ketetapan::where('status', 'published')
            ->whereNotNull('file_path')
            ->orderBy('year_published', 'desc')
            ->orderBy('created_at', 'desc');
    
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
    
        $ketetapans = $query->paginate($perPage);
        $ketetapans->appends($request->query());
    
        $totalDownloadableFiles = Ketetapan::where('status', 'published')
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

    public function panduan(Request $request)
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
    
        $query = Panduan::where('status', 'published')
            ->whereNotNull('file_path')
            ->orderBy('year_published', 'desc')
            ->orderBy('created_at', 'desc');
    
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
    
        $panduans = $query->paginate($perPage);
        $panduans->appends($request->query());
    
        $totalDownloadableFiles = Panduan::where('status', 'published')
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
    public function regulasi(Request $request)
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
    
        $query = Regulasi::where('status', 'published')
            ->whereNotNull('file_path')
            ->orderBy('year_published', 'desc')
            ->orderBy('created_at', 'desc');
    
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
    
        $regulasis = $query->paginate($perPage);
        $regulasis->appends($request->query());
    
        $totalDownloadableFiles = Regulasi::where('status', 'published')
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
    public function sop(Request $request)
    {
        $title = 'SOP';
        $description = 'Informasi Publik dan dokumen terkait PUSTIPD UIN Raden Fatah Palembang yang bisa didownload';
        $keywords = 'SOP, publik, pustipd';
    
        $search = $request->get('search');
        $perPage = $request->get('per_page', 10);
    
        $validPerPage = [10, 20, 50, 100];
        if (!in_array($perPage, $validPerPage)) {
            $perPage = 10;
        }
    
        $query = Sop::where('status', 'published')
            ->whereNotNull('file_path')
            ->orderBy('year_published', 'desc')
            ->orderBy('created_at', 'desc');
    
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
    
        $sops = $query->paginate($perPage);
        $sops->appends($request->query());
    
        $totalDownloadableFiles = Sop::where('status', 'published')
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
    
    public function faqs()
    {
        $title = 'FAQ - Frequently Asked Questions';
        $description = 'Pertanyaan yang sering diajukan tentang PUSTIPD UIN Raden Fatah Palembang';
        $keywords = 'faq, pertanyaan, pustipd';

        $faqs = Faq::published()->get();

        return view('public.faq', compact('title', 'description', 'keywords', 'faqs'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\ManageContent\Faq; 
use App\Models\ManageContent\AboutUs\VisiMisi;

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
        
            $galleries = \App\Models\ManageContent\AboutUs\Gallery::where('status', 'published')
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
        
            // Query untuk data ketetapan yang published dan active
            $query = \App\Models\Ketetapan::active() // Menggunakan scope active
                                         ->orderBy('sort_order', 'asc')
                                         ->orderBy('created_at', 'desc');
        
            // Apply search filter jika ada
            if ($search) {
                $query->search($search); // Menggunakan scope search
            }
        
            // Paginate results
            $ketetapans = $query->paginate($perPage);
        
            return view('public.ketetapan', compact(
                'title', 
                'description', 
                'keywords', 
                'ketetapans'
            ));
        }        
        if ($request->is('regulasi')) {
            $title = 'regulasi';
            $description = 'Informasi Publik dan dokumen terkait PUSTIPD UIN Raden Fatah Palembang yang bisa didownload';
            $keywords = 'info, publik, pustipd';

            return view('public.regulasi', compact('title', 'description', 'keywords'));
        }
        if ($request->is('panduan')) {
            $title = 'panduan';
            $description = 'Informasi Publik dan dokumen terkait PUSTIPD UIN Raden Fatah Palembang yang bisa didownload';
            $keywords = 'info, publik, pustipd';

            return view('public.panduan', compact('title', 'description', 'keywords'));
        }
        if ($request->is('sop')) {
            $title = 'sop';
            $description = 'Informasi Publik dan dokumen terkait PUSTIPD UIN Raden Fatah Palembang yang bisa didownload';
            $keywords = 'info, publik, pustipd';

            return view('public.sop', compact('title', 'description', 'keywords'));
        }

        // Default untuk beranda
        $title = 'Beranda';
        $description = 'Selamat datang di Website PUSTIPD UIN Raden Fatah Palembang';
        $keywords = 'home, welcome, application';

        return view('public.homepage', compact('title', 'description', 'keywords'));
    }
    

}

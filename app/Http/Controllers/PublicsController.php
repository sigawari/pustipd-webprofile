<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;

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

            return view('public.about', compact('title', 'description', 'keywords'));
        }
        if ($request->is('visi')) {
            $title = 'Visi Misi PUSTIPD UIN Raden Fatah Palembang';
            $description = 'Visi dan misi PUSTIPD UIN Raden Fatah Palembang dalam mengembangkan teknologi informasi dan data.';
            $keywords = 'visi, misi, pustipd';

            return view('public.vision', compact('title', 'description', 'keywords'));
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
        if ($request->is('faq')) {
            $title = 'FAQ';
            $description = 'Pertanyaan yang sering diajukan tentang PUSTIPD UIN Raden Fatah Palembang';
            $keywords = 'faq, pertanyaan, pustipd';

            return view('public.faq', compact('title', 'description', 'keywords'));
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
        if ($request->is('info-publik')) {
            $title = 'info-publik';
            $description = 'Informasi Publik dan dokumen terkait PUSTIPD UIN Raden Fatah Palembang yang bisa didownload';
            $keywords = 'info, publik, pustipd';

            return view('public.public-info', compact('title', 'description', 'keywords'));
        }

        // Default untuk beranda
        $title = 'Beranda';
        $description = 'Selamat datang di Website PUSTIPD UIN Raden Fatah Palembang';
        $keywords = 'home, welcome, application';

        return view('public.homepage', compact('title', 'description', 'keywords'));
    }
    

}

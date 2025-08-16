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
use App\Models\TentangKami\StrukturOrganisasi;

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

        return view('public.homepage', compact(
            'title', 'description', 'keywords', 'profil',
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

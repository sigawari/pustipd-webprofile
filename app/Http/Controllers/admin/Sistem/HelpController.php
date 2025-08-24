<?php

namespace App\Http\Controllers\admin\Sistem;

use App\Http\Controllers\Controller;

class HelpController extends Controller
{
    // Halaman bantuan yang siap jadi pahlawan for your CMS troubles
    public function index()
    {
        $title = 'Bantuan CMS';

        return view('admin.help', compact('title'));
    }
}

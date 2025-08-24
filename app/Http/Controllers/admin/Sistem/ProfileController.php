<?php

namespace App\Http\Controllers\admin\Sistem;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $title = 'Profil Saya';
        // Ambil data user yang login
        $user = Auth::user();

        return view('admin.profil', compact('title', 'user'));
    }
}

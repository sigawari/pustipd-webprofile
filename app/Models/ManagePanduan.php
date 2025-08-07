<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\ManagePanduan;

class PanduanPublicController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        // Query untuk data panduan yang published
        $query = Panduan::where('status', 'published')
                       ->orderBy('sort_order', 'asc')
                       ->orderBy('created_at', 'desc');

        // Apply search filter jika ada
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%')
                  ->orWhere('category', 'like', '%' . $search . '%');
            });
        }

        // Paginate results
        $panduans = $query->paginate(10);

        return view('public.panduan.index', [
            'title' => 'Panduan',
            'description' => 'Kumpulan panduan PUSTIPD UIN Raden Fatah Palembang',
            'keywords' => 'panduan, tutorial, manual, PUSTIPD, UIN Raden Fatah',
            'panduans' => $panduans
        ]);
    }
}

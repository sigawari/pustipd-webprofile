<?php
// app/Http/Controllers/Admin/ManageContent/KelolaPengumuman/KelolaPengumumanController.php

namespace App\Http\Controllers\Admin\InformasiTerkini;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\InformasiTerkini\KelolaPengumuman;

class KelolaPengumumanController extends Controller
{
    public function index(Request $request)
    {
        $title = "Pengumuman";
        $search = $request->input('search', '');
        $filter = $request->query('filter', 'all');
        $perPage = $request->input('perPage', 10);

        // Query builder awal
        $kelolaPengumumanQuery = KelolaPengumuman::query();

        // ✅ FIXED: Search dengan field yang benar
        if ($search) {
            $keywords = preg_split('/\s+/', trim($search));
            $kelolaPengumumanQuery->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->where(function ($q) use ($word) {
                        $q->where('title', 'like', "%{$word}%")          // ✅ FIXED: title bukan name
                          ->orWhere('content', 'like', "%{$word}%")       // ✅ FIXED: content bukan description
                          ->orWhere('category', 'like', "%{$word}%");
                    });
                }
            });
        }

        // Filter status
        if ($filter && $filter !== 'all') {
            $kelolaPengumumanQuery->where('status', $filter);
        }

        $kelolaPengumumanQuery->orderBy('created_at', 'desc');

        $merged = $kelolaPengumumanQuery->get();

        // Per-page logic tetap sama
        if ($perPage === 'all') {
            $perPage = max($merged->count(), 1);
        } else {
            $perPage = (int) $perPage;
            if ($perPage < 1) {
                $perPage = 1;
            }
        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $merged->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $kelolaPengumumans = new LengthAwarePaginator(
            $currentItems,
            $merged->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        // AJAX Response
        if ($request->ajax()) {
            return view('admin.InformasiTerkini.Pengumuman.partials.table_body', compact('kelolaPengumumans'));
        }

        return view('admin.InformasiTerkini.Pengumuman.index', compact('title', 'kelolaPengumumans'));
    }

    public function store(Request $request)
    {
        // Validasi sesuai dengan migration dan kategori PUSTIPD
        $request->validate([
            'category'     => 'required|in:maintenance,layanan,infrastruktur,administrasi,darurat', 
            'urgency'      => 'required|in:normal,penting',                      
            'title'        => 'required|string|max:255',                                             
            'slug'         => 'required|string|max:255|unique:kelola_pengumumans,slug',
            'date'         => 'required|date',                                                       
            'valid_until'  => 'nullable|date|after:date',                                          
            'status'       => 'required|in:draft,published',
            'content'      => 'required|string',
            'contact_email'=> 'nullable|email',                                                   
        ]);
            
        KelolaPengumuman::create([
            'title'        => $request->title,          
            'content'      => $request->input('content'),
            'category'     => $request->category,
            'urgency'      => $request->urgency,        
            'slug'         => $request->slug,
            'date'         => $request->date,          
            'valid_until'  => $request->valid_until,   
            'status'       => $request->status,
            'contact_email'=> $request->contact_email,  
        ]);

        return redirect()
            ->route('admin.informasi-terkini.kelola-pengumuman.index')
            ->with('success', 'Pengumuman berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        dd('Update pengumuman dengan ID: ' . $id);
        $pengumuman = KelolaPengumuman::findOrFail($id);

        // Validasi input
        $request->validate([
            'category'     => 'required|in:maintenance,layanan,infrastruktur,administrasi,darurat', 
            'urgency'      => 'required|in:normal,penting',                      
            'title'        => 'required|string|max:255',                                             
            'slug'         => 'required|string|max:255|unique:kelola_pengumumans,slug,' . $id,
            'date'         => 'required|date',                                                       
            'valid_until'  => 'nullable|date|after:date',                                          
            'status'       => 'required|in:draft,published',
            'content'      => 'required|string',
            'contact_email'=> 'nullable|email',                                                   
        ]);

        // Update data
        $pengumuman->update([
            'title'        => $request->title,          
            'content'      => $request->input('content'),
            'category'     => $request->category,
            'urgency'      => $request->urgency,        
            'slug'         => $request->slug,
            'date'         => $request->date,          
            'valid_until'  => $request->valid_until,   
            'status'       => $request->status,
            'contact_email'=> $request->contact_email,  
        ]);

        return redirect()
            ->route('admin.informasi-terkini.kelola-pengumuman.index')
            ->with('success', 'Pengumuman berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // dd('Hapus pengumuman dengan ID: ' . $id);
        $pengumuman = KelolaPengumuman::findOrFail($id);
        $pengumuman->delete();

        return redirect()
            ->route('admin.informasi-terkini.kelola-pengumuman.index')
            ->with('success', 'Pengumuman berhasil dihapus!');
    }

    public function show($id){
        $announcements = KelolaPengumuman::where('status', 'published')->findOrFail($id);

        $title = $announcements->name;
        $description = $announcements->description ?? '';
        $keywords = 'berita, news, pustipd';

        $url = url()->current(); // Dapatkan link halaman detail
        $shareText = "Baca Pengumuman Terbaru dari PUSTIPD UIN RF Palembang - " . $title . " " . $url;

        return view('public.announcements-detail', compact(
            'title', 'description', 'keywords',
            'announcements', 'url', 'shareText'
        ));
    }

    // ✅ ADDED: Bulk action method
    public function bulk(Request $request)
    {
        $request->validate([
            'action' => 'required|in:published,draft,delete',
            'ids' => 'required|array',
            'ids.*' => 'exists:kelola_pengumumans,id'
        ]);

        $ids = $request->ids;
        $action = $request->action;

        switch ($action) {
            case 'published':
            case 'draft':
            case 'delete':
                KelolaPengumuman::whereIn('id', $ids)->delete();
                break;
        }

        return response()->json([
            'success' => true,
            'message' => 'Bulk action berhasil dijalankan'
        ]);
    }

}

<?php

namespace App\Http\Controllers\Admin\ManageContent\KelolaBerita;

use App\Models\ManageContent\KelolaBerita\KelolaBerita;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class KelolaBeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = "Berita";
        $search = $request->input('search', '');
        $filter = $request->query('filter', 'all');
        $perPage = $request->input('perPage', 10);

        // Pisahkan multi keyword
        $keywords = !empty($search) ? preg_split('/\s+/', (string) $search) : [];

        // Query builder awal
        $kelolaBeritaQuery = KelolaBerita::query();

        // Apply search jika ada
        if ($search) {
            $kelolaBeritaQuery->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->where(function ($q) use ($word) {
                        $q->where('name', 'like', "%{$word}%")
                          ->orWhere('description', 'like', "%{$word}%");
                    });
                }
            });
        }

        // Filter status
        if ($filter && $filter !== 'all') {
            $kelolaBeritaQuery->where('status', $filter);
        }

        // Merge results
        $merged = $kelolaBeritaQuery->get();

        // Per-page validation
        if ($perPage === 'all') {
            $perPage = max($merged->count(), 1); // Kalau 0, set jadi 1
        } else {
            $perPage = (int) $perPage;
            if ($perPage < 1) {
                $perPage = 1;
            }
        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $merged->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $kelolaBeritas = new LengthAwarePaginator(
            $currentItems,
            $merged->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        // AJAX Response
        if ($request->ajax()) {
            return view('admin.manage-content.berita.kelolaberita', compact('kelolaBeritas', 'title'));
        }

        // Render view
        return view('admin.manage-content.berita.kelolaberita', compact('title', 'kelolaBeritas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all()); // Hapus ini setelah testing
        // Validasi input
        $request->validate([
            'category'    => 'required|in:academic_services,library_resources,student_information_system,administration,communication,research_development,other',
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'link'        => 'required|url|max:255',
            'status'      => 'required|in:draft,published,archived',
        ]);

        // Simpan ke database
        KelolaBerita::create([
            'category'    => $request->category,
            'name'        => $request->name,
            'description' => $request->description,
            'link'        => $request->link,
            'status'      => $request->status,
        ]);

        // Redirect atau tampilkan pesan sukses
        return redirect()->route('admin.manage-content.berita.kelolaberita')->with('success', 'Berita berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(KelolaBerita $kelolaBerita)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KelolaBerita $kelolaBerita)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KelolaBerita $kelolaBerita)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KelolaBerita $kelolaBerita)
    {
        //
    }
}

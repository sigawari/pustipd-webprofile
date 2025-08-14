<?php

namespace App\Http\Controllers\Admin\InformasiTerkini;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\InformasiTerkini\KelolaBerita;

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
            return view('admin.InformasiTerkini.Berita.partials.table_body', compact('kelolaBeritas', 'title'));
        }

        // Render view
        return view('admin.InformasiTerkini.Berita.index', compact('title', 'kelolaBeritas'));
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
            'category'     => 'required|in:academic_services,library_resources,student_information_system,administration,communication,research_development,other',
            'name'         => 'required|string|max:255',
            'slug'         => 'required|string|max:255|unique:kelola_beritas,slug',
            'tags'         => 'nullable|string|max:255',
            'publish_date' => 'nullable|date',
            'status'       => 'required|in:draft,published,archived',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'content'      => 'required|string',
        ]);

        // Simpan gambar jika ada
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('berita_images', 'public');
        }
        
       
        KelolaBerita::create([
            'category'     => $request->category,
            'name'         => $request->name,
            'slug'         => $request->slug, // Jika slug tidak ada, ambil dari nama
            'tags'         => $request->tags,
            'publish_date' => $request->publish_date,
            'status'       => $request->status,
            'image'        => $imagePath,
            'content'      => $request->input('content'),
        ]);

        // Redirect atau tampilkan pesan sukses
        return redirect()->route('admin.InformasiTerkini.Berita.index')->with('success', 'Berita berhasil ditambahkan!');
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

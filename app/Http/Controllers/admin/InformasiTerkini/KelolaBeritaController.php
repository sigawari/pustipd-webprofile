<?php

namespace App\Http\Controllers\Admin\InformasiTerkini;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\InformasiTerkini\KelolaBerita;
use Illuminate\Pagination\LengthAwarePaginator;

class KelolaBeritaController extends Controller
{
    public function index(Request $request)
    {
        DB::enableQueryLog();
        
        $title = "Berita";
        $search = $request->input('search', '');
        $status = $request->input('status', '');
        $category = $request->input('category', '');
        $perPage = $request->input('perPage', 10);
        $defaultPerPage = 10;

        // Query builder
        $kelolaBeritaQuery = KelolaBerita::query();

        // Search
        if ($search) {
            $keywords = array_slice(preg_split('/\s+/', trim($search)), 0, 5); // Batasi 5 kata
            $kelolaBeritaQuery->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->where(function ($subQ) use ($word) {
                        $subQ->where('name', 'like', "%{$word}%")
                            ->orWhere('content', 'like', "%{$word}%")
                            ->orWhere('tags', 'like', "%{$word}%");
                    });
                }
            });
        }

        // Filter status
        if ($status && $status !== '') {
            $kelolaBeritaQuery->where('status', $status);
        }

        // Filter category
        if ($category && $category !== '') {
            $kelolaBeritaQuery->where('category', $category);
        }

        // Order default
        $kelolaBeritaQuery->orderBy('created_at', 'desc');

        // PerPage - PERBAIKAN UNTUK MENCEGAH MEMORY EXHAUSTED
        if ($perPage === 'all') {
            // Batasi maksimal 1000 record untuk mencegah memory habis
            $maxRecords = 1000;
            $kelolaBeritas = $kelolaBeritaQuery->paginate($maxRecords);
            $kelolaBeritas->appends($request->query());
        } else {
            $perPage = (is_numeric($perPage) && $perPage > 0) ? min((int)$perPage, 100) : $defaultPerPage;
            $kelolaBeritas = $kelolaBeritaQuery->paginate($perPage);
            $kelolaBeritas->appends($request->query());
        }

        // ✅ Debug query di sini jika diperlukan
        $queries = DB::getQueryLog();
        // dd($queries); // Uncomment untuk debug

        if ($request->ajax()) {
            return response()->json([
                'table_html' => view('admin.InformasiTerkini.Berita.partials.table_body', compact('kelolaBeritas', 'title'))->render(),
                'pagination_html' => view('admin.InformasiTerkini.Berita.partials.pagination', compact('kelolaBeritas', 'title'))->render(),
                'success' => true
            ]);
        }

        return view('admin.InformasiTerkini.Berita.index', compact('title', 'kelolaBeritas'));
    }

    public function bulk(Request $request)
    {
        $ids = $request->input('ids', []);
        $action = $request->input('action');

        if (!$ids || !$action) {
            return response()->json(['success' => false, 'message' => 'Data atau aksi tidak valid.']);
        }

        try {
            switch ($action) {
                case 'permanent_delete':
                    $items = KelolaBerita::whereIn('id', $ids)->get();
                    foreach ($items as $item) {
                        if ($item->image && Storage::disk('public')->exists($item->image)) {
                            Storage::disk('public')->delete($item->image);
                        }
                        $item->delete();
                    }
                    $message = count($items) . ' Berita dihapus permanen.';
                    break;

                case 'published':
                case 'draft':
                case 'archived':
                    $count = KelolaBerita::whereIn('id', $ids)->update(['status' => $action]);
                    $message = "$count Berita diubah ke status $action.";
                    break;

                default:
                    return response()->json(['success' => false, 'message' => 'Aksi tidak valid.']);
            }
            return response()->json(['success' => true, 'message' => $message]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Kesalahan: ' . $e->getMessage()]);
        }
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

        // Validasi input
        $request->validate([
            'category'     => 'required|in:academic_services,library_resources,student_information_system,administration,communication,research_development,other',
            'name'         => 'required|string|max:255',
            'slug'         => 'required|string|max:255|unique:kelola_beritas,slug',
            'tags'         => 'nullable|string|max:255',
            'publish_date' => 'nullable|date',
            'status'       => 'required|in:draft,published',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10480',
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
        return redirect()->route('admin.informasi-terkini.kelola-berita.index')->with('success', 'Berita berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $news = KelolaBerita::where('status', 'published')->findOrFail($id);

        $title = $news->name;
        $description = $news->description ?? '';
        $keywords = 'berita, news, pustipd';

        $url = url()->current(); // Dapatkan link halaman detail
        $shareText = "Baca Berita Terbaru dari PUSTIPD UIN RF Palembang - " . $title . " " . $url;

        return view('public.news-detail', compact(
            'title', 'description', 'keywords',
            'news', 'url', 'shareText'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all()); // Hapus ini setelah testing
        $kelolaBerita = KelolaBerita::findOrFail($id);

        // Validasi input
        $request->validate([
            'category'     => 'required|in:academic_services,library_resources,student_information_system,administration,communication,research_development,other',
            'name'         => 'required|string|max:255',
            'slug'         => 'required|string|max:255|unique:kelola_beritas,slug,' . $kelolaBerita->id,
            'tags'         => 'nullable|string|max:255',
            'publish_date' => 'nullable|date',
            'status'       => 'required|in:draft,published',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10480',
            'content'      => 'required|string',
        ]);

        // Update gambar jika ada file baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($kelolaBerita->image && Storage::disk('public')->exists($kelolaBerita->image)) {
                Storage::disk('public')->delete($kelolaBerita->image);
            }
            $imagePath = $request->file('image')->store('berita_images', 'public');
        } else {
            $imagePath = $kelolaBerita->image;
        }

        // Update data
        $kelolaBerita->update([
            'category'     => $request->category,
            'name'         => $request->name,
            'slug'         => $request->slug,
            'tags'         => $request->tags,
            'publish_date' => $request->publish_date,
            'status'       => $request->status,
            'image'        => $imagePath,
            'content'      => $request->input('content'),
        ]);

        return redirect()->route('admin.informasi-terkini.kelola-berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // dd($id); // Hapus ini setelah testing
        $kelolaBerita = KelolaBerita::findOrFail($id);

        // Hapus gambar jika ada
        if ($kelolaBerita->image && Storage::disk('public')->exists($kelolaBerita->image)) {
            Storage::disk('public')->delete($kelolaBerita->image);
        }

        $kelolaBerita->delete();

        return redirect()->route('admin.informasi-terkini.kelola-berita.index')->with('success', 'Berita berhasil dihapus!');
    }
}

<?php

namespace App\Http\Controllers\admin\ManageContent\Beranda;

use App\Models\ManageContent\Homepage\Layanan;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLayananRequest;
use App\Http\Requests\UpdateLayananRequest;

class LayananController extends Controller
{
        public function index(Request $request)
    {
        $title = 'Layanan';
        $search = $request->input('search', '');
        $filter = $request->query('filter', 'all');
        $perPage = $request->input('perPage', 10);

        // Pisahkan multi keyword
        $keywords = !empty($search) ? preg_split('/\s+/', (string) $search) : [];

        // Query builder awal
        $layananQuery = Layanan::query();

        // Apply search jika ada
        if ($search) {
            $layananQuery->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->where(function ($q) use ($word) {
                        $q->where('question', 'like', "%{$word}%")
                          ->orWhere('answer', 'like', "%{$word}%");
                    });
                }
            });
        }

        // Filter status
        if ($filter && $filter !== 'all') {
            $layananQuery->where('status', $filter);
        }

        // Merge results
        $merged = $layananQuery->get();

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

        $layanans = new LengthAwarePaginator(
            $currentItems,
            $merged->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        // AJAX Response di controller
        if ($request->ajax()) {
            return view('admin.manage-content.beranda.layanan.partials.table_body', compact('title', 'layanans'))->render();
        } 

        // Render full view    
        return view('admin.manage-content.beranda.layanan.index', compact('title', 'layanans'));
    }

    /**
     * STORE : simpan Layanan baru
     */
    public function store(Request $request)
    {
        // dd($request->all());

        // Validasi dan ambil data dari request
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'status' => 'in:draft,published,archived',
        ]);

        // Siapkan data untuk disimpan
        Layanan::create([
            'question' => $request->input('question'),
            'answer' => $request->input('answer'),
            'status' => $request->input('status', 'draft'), // Default ke draft
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()
               ->route('admin.manage-content.beranda.layanan.index')
               ->with('success', 'Layanan berhasil ditambahkan sebagai draft!');
    }

    /**
     * UPDATE : perbarui Layanan
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all()); // Untuk debug, bisa dihapus nanti

        // Cari Layanan berdasarkan ID
        $layanan = Layanan::findOrFail($id);

        // Jika data tidak valid, kembalikan error
        if (!$layanan) {
            return redirect()
                   ->route('admin.manage-content.beranda.layanan.index')
                   ->withErrors(['error' => 'Layanan tidak ditemukan.']);
        }

        // Validasi data yang diterima
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'status' => 'in:draft,published,archived',
        ]);

        // Update data Layanan
        $layanan->update([
            'question' => $request->input('question'),
            'answer' => $request->input('answer'),
            'status' => $request->input('status', 'draft'), // Default ke draft
        ]);

        // Redirect ke halaman index dengan pesan sukses

        return redirect()
               ->route('admin.manage-content.beranda.layanan.index')
               ->with('success', 'Layanan berhasil diperbarui!');
    }

    /**
     * DESTROY : hapus satu Layanan (soft delete ke archived)
     */
    public function destroy($id)
    {
        dd($id); // uncomment untuk debug
        // Cari data berdasarkan ID
        $layanan = Layanan::findOrFail($id);
        // Jika data tidak valid, kembalikan error
        if (!$layanan) {
            return redirect()
                   ->route('admin.manage-content.beranda.layanan.index')
                   ->withErrors(['error' => 'Layanan tidak ditemukan.']);
        }
        // Delete Layanan
        $layanan->delete();
        // Redirect ke halaman index dengan pesan sukses
        return redirect()
               ->route('admin.manage-content.beranda.layanan.index')
               ->with('success', 'Layanan berhasil diarsipkan!');
    }
    
    // public function destroy(Layanan $layanan)
    // {
    //     $layanan->update(['status' => 'archived']);

    //     return redirect()
    //            ->route('admin.manage-content.beranda.layanan.index')
    //            ->with('success', 'Layanan berhasil diarsipkan!');
    // }

    /**
     * BULK ACTION : publish / draft / archived / delete / permanent_delete
     */
    public function bulk(Request $request)
    {
        $ids = $request->input('ids', []);
        $action = $request->input('action');

        if (!$ids || !$action) {
            return back()->with('error', 'Data atau aksi tidak valid.');
        }

        $count = count($ids);
        $message = '';
        
        switch ($action) {
            case 'permanent_delete':
                // Hard delete: hapus dari database
                $deletedCount = Layanan::whereIn('id', $ids)->delete();
                $message = "{$deletedCount} Layanan berhasil dihapus permanen.";
                break;
                
            case 'delete':
                // Soft delete: ubah status ke archived
                $archivedCount = Layanan::whereIn('id', $ids)->update(['status' => 'archived']);
                $message = "{$archivedCount} Layanan berhasil diarsipkan.";
                break;
                
            case 'published':
            case 'draft':
            case 'archived':
                $updatedCount = Layanan::whereIn('id', $ids)->update(['status' => $action]);
                $statusText = match($action) {
                    'published' => 'Published',
                    'draft' => 'Draft',
                    'archived' => 'Archived'
                };
                $message = "{$updatedCount} Layanan berhasil diubah ke status {$statusText}.";
                break;
                
            default:
                return back()->with('error', 'Aksi tidak valid.');
        }

        return back()->with('success', $message);
    }

    /**
     * OPTIONAL : halaman/partial konfirmasi delete
     */
    public function delete(Layanan $layanan)
    {
        $title = 'Hapus Layanan';
        return view('admin.manage-content.beranda.layanan.delete', compact('title', 'Layanan'));
    }
}

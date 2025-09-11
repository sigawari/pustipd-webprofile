<?php

namespace App\Http\Controllers\admin\Beranda;

use Exception;
use Illuminate\Http\Request;
use App\Exports\LayananExport;
use App\Models\Beranda\Layanan;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;

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
                        $q->where('name', 'like', "%{$word}%")
                          ->orWhere('description', 'like', "%{$word}%");
                    });
                }
            });
        }

        // Filter status
        if ($filter && $filter !== 'all') {
            $layananQuery->where('status', $filter);
        }

        // Order by latest
        $layananQuery->orderBy('created_at', 'desc');

        // Merge results
        $merged = $layananQuery->get();

        // Per-page validation
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

        $layanans = new LengthAwarePaginator(
            $currentItems,
            $merged->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        // AJAX Response
        if ($request->ajax()) {
            return view('admin.Beranda.Layanan.partials.table_body', compact('title', 'layanans'))->render();
        } 

        return view('admin.Beranda.Layanan.index', compact('title', 'layanans'));
    }

    /**
     * STORE : simpan Layanan baru
     */
    public function store(Request $request)
{
    try {
        // Ambil status dari input, kalau kosong default jadi draft
        $status = $request->input('status', 'draft');

        // Validasi
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'in:draft,published', // tidak perlu required
        ]);

        // Simpan data
        Layanan::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'status' => $status,
        ]);

        // Pesan sukses
        $statusMessage = $status === 'published' ? 'dipublish' : 'disimpan sebagai draft';

        return redirect()
            ->route('admin.beranda.layanan.index')
            ->with('success', "Layanan berhasil {$statusMessage}!");

    } catch (Exception $e) {
        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
    }


    /**
     * UPDATE : perbarui Layanan
     */
    public function update(Request $request, string $id)
    {
        try {
            $layanan = Layanan::findOrFail($id);

            // Validasi
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'status' => 'required|in:draft,published',
            ]);

            // Update data
            $layanan->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'status' => $request->input('status'),
            ]);

            $statusMessage = $request->input('status') === 'published' ? 'dipublish' : 'disimpan sebagai draft';

            return redirect()
                   ->route('admin.beranda.layanan.index')
                   ->with('success', "Layanan berhasil diperbarui dan {$statusMessage}!");

        } catch (Exception $e) {
            return redirect()
                   ->back()
                   ->withInput()
                   ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * DESTROY : hapus permanen
     */
   // Di controller, ganti method jadi:
    public function destroy(Layanan $layanan)
    {
        try {
            $layanan->delete();

            return redirect()
                ->route('admin.beranda.layanan.index')
                ->with('success', 'Layanan berhasil dihapus permanen!');

        } catch (Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * BULK ACTION
     */
    public function bulk(Request $request)
    {
        try {
            $ids = $request->input('ids', []);
            $action = $request->input('action');

            if (!$ids || !$action) {
                return back()->with('error', 'Data atau aksi tidak valid.');
            }

            $message = '';
            
            switch ($action) {
                case 'published':
                    $updatedCount = Layanan::whereIn('id', $ids)->update(['status' => 'published']);
                    $message = "{$updatedCount} Layanan berhasil dipublish.";
                    break;

                case 'draft':
                    $updatedCount = Layanan::whereIn('id', $ids)->update(['status' => 'draft']);
                    $message = "{$updatedCount} Layanan berhasil diubah ke draft.";
                    break;

                case 'delete':
                    $deletedCount = Layanan::whereIn('id', $ids)->delete();
                    $message = "{$deletedCount} Layanan berhasil dihapus permanen.";
                    break;
                    
                default:
                    return back()->with('error', 'Aksi tidak valid.');
            }

            return back()->with('success', $message);

        } catch (Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function toggleVisibility(Request $request, $id)
    {
        $layanan = Layanan::findOrFail($id);

        if ($layanan->status === 'published') {
            $layanan->status = 'draft';
            $message = 'Layanan disembunyikan';
        } else {
            $layanan->status = 'published';
            $message = 'Layanan ditampilkan';
        }

        $layanan->save();

        return response()->json([
            'success' => true,
            'message' => $message
        ]);
    }

    public function export(Request $request)
    {
        $status = $request->query('filter'); // visible / hidden / all
        $search = $request->query('search'); // keyword

        // Kalau "all" atau kosong → jadikan null
        if (empty($status) || $status === 'all') {
            $status = null;
        }

        // Panggil LayananExport dengan parameter
        return (new LayananExport($status, $search))->export();
    }
}
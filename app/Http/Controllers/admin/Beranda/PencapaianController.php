<?php

namespace App\Http\Controllers\admin\Beranda;

use Exception;
use Illuminate\Http\Request;
use App\Models\Beranda\Pencapaian;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;

class PencapaianController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Pencapaian';
        $search = $request->input('search', '');
        $filter = $request->query('filter', 'all');
        $perPage = $request->input('perPage', 10);

        // Pisahkan multi keyword
        $keywords = !empty($search) ? preg_split('/\s+/', (string) $search) : [];

        // Query builder awal
        $pencapaianQuery = Pencapaian::query();

        // Apply search jika ada
        if ($search) {
            $pencapaianQuery->where(function ($q) use ($keywords) {
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
            $pencapaianQuery->where('status', $filter);
        }

        // Get results
        $merged = $pencapaianQuery->get();

        // Pagination logic (sama seperti sebelumnya)
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

        $pencapaians = new LengthAwarePaginator(
            $currentItems,
            $merged->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        // AJAX Response
        if ($request->ajax()) {
            return view('admin.Beranda.Pencapaian.partials.table_body', compact('title', 'pencapaians'))->render();
        } 

        return view('admin.Beranda.Pencapaian.index', compact('title', 'pencapaians'));
    }

    public function store(Request $request)
    {
        try {
            $status = $request->input('status', 'draft');

            // Validasi dengan field baru
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'status' => 'in:draft,published',
            ]);

            // Simpan data
            Pencapaian::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'status' => $status,
            ]);

            $statusMessage = $status === 'published' ? 'dipublish' : 'disimpan sebagai draft';

            return redirect()
                ->route('admin.beranda.pencapaian.index')
                ->with('success', "Pencapaian berhasil {$statusMessage}!");

        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $pencapaian = Pencapaian::findOrFail($id);

            // Validasi dengan field baru
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'status' => 'required|in:draft,published',
            ]);

            // Update data
            $pencapaian->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'status' => $request->input('status'),
            ]);

            $statusMessage = $request->input('status') === 'published' ? 'dipublish' : 'disimpan sebagai draft';

            return redirect()
                   ->route('admin.beranda.pencapaian.index')
                   ->with('success', "Pencapaian berhasil diperbarui dan {$statusMessage}!");

        } catch (Exception $e) {
            return redirect()
                   ->back()
                   ->withInput()
                   ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Method destroy dan bulk tetap sama
    public function destroy(Pencapaian $pencapaian)
    {
        try {
            $pencapaian->delete();
            return redirect()
                ->route('admin.beranda.pencapaian.index')
                ->with('success', 'Pencapaian berhasil dihapus permanen!');
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

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
                    $updatedCount = Pencapaian::whereIn('id', $ids)->update(['status' => 'published']);
                    $message = "{$updatedCount} Pencapaian berhasil dipublish.";
                    break;

                case 'draft':
                    $updatedCount = Pencapaian::whereIn('id', $ids)->update(['status' => 'draft']);
                    $message = "{$updatedCount} Pencapaian berhasil diubah ke draft.";
                    break;

                case 'delete':
                    $deletedCount = Pencapaian::whereIn('id', $ids)->delete();
                    $message = "{$deletedCount} Pencapaian berhasil dihapus permanen.";
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
        $pencapaian = Pencapaian::findOrFail($id);

        if ($pencapaian->status === 'published') {
            $pencapaian->status = 'draft';
            $message = 'Pencapaian disembunyikan';
        } else {
            $pencapaian->status = 'published';
            $message = 'Pencapaian ditampilkan';
        }

        $pencapaian->save();

        return response()->json([
            'success' => true,
            'message' => $message
        ]);
    }
}

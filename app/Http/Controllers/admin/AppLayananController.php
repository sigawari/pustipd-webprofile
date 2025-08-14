<?php

namespace App\Http\Controllers\Admin;

use App\Models\AppLayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppLayananRequest;
use App\Http\Requests\UpdateAppLayananRequest;
use Illuminate\Pagination\LengthAwarePaginator;

class AppLayananController extends Controller
{
    /**
     * INDEX : daftar AppLayanan + search + filter + pagination
     */
    public function index(Request $request)
    {
        $title = 'Aplikasi Layanan';
        $search = $request->input('search', '');
        $filter = $request->query('filter', 'all');
        $perPage = $request->input('perPage', 10);

        // Pisahkan multi keyword
        $keywords = !empty($search) ? preg_split('/\s+/', (string) $search) : [];

        // Query builder awal
        $appLayananQuery = AppLayanan::query();

        // Apply search dengan field yang benar
        if ($search) {
            $appLayananQuery->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->where(function ($q) use ($word) {
                        $q->where('appname', 'like', "%{$word}%")
                          ->orWhere('description', 'like', "%{$word}%")
                          ->orWhere('category', 'like', "%{$word}%");
                    });
                }
            });
        }

        // Filter status
        if ($filter && $filter !== 'all') {
            $appLayananQuery->where('status', $filter);
        }

        // ✅ SIMPLIFIED: Sorting berdasarkan created_at (terbaru dulu)
        $appLayananQuery->orderBy('created_at', 'desc');

        // Pagination
        if ($perPage === 'all') {
            $appLayanans = $appLayananQuery->get();
            $perPage = max($appLayanans->count(), 1);
            
            // Manual pagination untuk 'all'
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $currentItems = $appLayanans->slice(($currentPage - 1) * $perPage, $perPage)->values();
            
            $appLayanans = new LengthAwarePaginator(
                $currentItems,
                $appLayanans->count(),
                $perPage,
                $currentPage,
                ['path' => LengthAwarePaginator::resolveCurrentPath()]
            );
        } else {
            $perPage = max((int) $perPage, 1);
            $appLayanans = $appLayananQuery->paginate($perPage);
        }

        // AJAX Response
        if ($request->ajax()) {
            return view('admin.AppLayanan.partials.table_body', compact('title', 'appLayanans'))->render();
        }

        return view('admin.AppLayanan.index', compact('title', 'appLayanans'));
    }

    /**
     * STORE : simpan AppLayanan baru
     */
   // Di AppLayananController.php
     public function store(Request $request)
    {
        // dd($request->all());
        // Validasi data
        $validated = $request->validate([
            'appname'     => 'required|string|max:255',
            'category'    => 'required|in:akademik,pegawai,pembelajaran,administrasi',
            'description' => 'required|string',
            'applink'     => 'nullable|url|max:500',
            'status'      => 'required|in:draft,published,archived',
        ]);

        try {
            AppLayanan::create($validated);

            return redirect()
                ->route('admin.app-layanan.index')
                ->with('success', 'Aplikasi berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.app-layanan.index')
                ->with('error', 'Terjadi kesalahan saat menyimpan aplikasi: ' . $e->getMessage());
        }
    }

    /**
     * UPDATE : perbarui AppLayanan
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        // Validasi data
        $validated = $request->validate([
            'appname'     => 'required|string|max:255',
            'category'    => 'required|in:akademik,pegawai,pembelajaran,administrasi',
            'description' => 'required|string',
            'applink'     => 'nullable|url|max:500',
            'status'      => 'required|in:draft,published,archived',
        ]);

        try {
            $appLayanan = AppLayanan::findOrFail($id);
            $appLayanan->update($validated);

            return redirect()
                ->route('admin.app-layanan.index')
                ->with('success', 'Aplikasi berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.app-layanan.index')
                ->with('error', 'Terjadi kesalahan saat memperbarui aplikasi: ' . $e->getMessage());
        }
    }

    /**
     * DESTROY : hapus satu AppLayanan (soft delete ke archived)
     */
    public function destroy($id)
    {
        // dd($id);
        try {
            $appLayanan = AppLayanan::findOrFail($id);
            $appLayanan->delete();

            return redirect()
                ->route('admin.app-layanan.index')
                ->with('success', 'Aplikasi berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.app-layanan.index')
                ->with('error', 'Terjadi kesalahan saat menghapus aplikasi: ' . $e->getMessage());
        }
    }

    /**
     * BULK ACTION : publish / draft / archived / delete / permanent_delete
     */
    public function bulk(Request $request)
    {
        $request->validate([
            'action' => 'required|in:published,draft,archived,delete,permanent_delete',
            'ids' => 'required|array',
            'ids.*' => 'exists:applayanans,id'
        ]);

        $ids = $request->input('ids', []);
        $action = $request->input('action');

        if (!$ids || !$action) {
            return back()->with('error', 'Data atau aksi tidak valid.');
        }

        try {
            $count = count($ids);
            $message = '';
            
            Log::info('Bulk action AppLayanan', [
                'action' => $action,
                'ids' => $ids,
                'count' => $count
            ]);
            
            switch ($action) {
                case 'permanent_delete':
                    $deletedCount = AppLayanan::whereIn('id', $ids)->delete();
                    $message = "{$deletedCount} Aplikasi Layanan berhasil dihapus permanen.";
                    break;
                    
                case 'delete':
                    $archivedCount = AppLayanan::whereIn('id', $ids)->update(['status' => 'archived']);
                    $message = "{$archivedCount} Aplikasi Layanan berhasil diarsipkan.";
                    break;
                    
                case 'published':
                case 'draft':
                case 'archived':
                    $updatedCount = AppLayanan::whereIn('id', $ids)->update(['status' => $action]);
                    $statusText = match($action) {
                        'published' => 'Published',
                        'draft' => 'Draft',
                        'archived' => 'Archived'
                    };
                    $message = "{$updatedCount} Aplikasi Layanan berhasil diubah ke status {$statusText}.";
                    break;
                    
                default:
                    return back()->with('error', 'Aksi tidak valid.');
            }

            return back()->with('success', $message);
            
        } catch (\Exception $e) {
            Log::error('Error bulk action AppLayanan: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Show detail AppLayanan
     */
    public function show(AppLayanan $appLayanan)
    {
        $title = 'Detail Aplikasi Layanan';
        return view('admin.AppLayanan.show', compact('title', 'appLayanan'));
    }

    /**
     * OPTIONAL : halaman/partial konfirmasi delete
     */
    public function delete(AppLayanan $appLayanan)
    {
        $title = 'Hapus Aplikasi Layanan';
        return view('admin.AppLayanan.delete', compact('title', 'appLayanan'));
    }
}


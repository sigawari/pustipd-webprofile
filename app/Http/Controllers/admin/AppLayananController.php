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
        $filter = $request->input('filter', 'all');
        $category = $request->input('category', '');
        $perPage = $request->input('perPage', 10);
    
        // PERBAIKAN: Validasi perPage untuk keamanan
        $allowedPerPage = [10, 25, 50, 100, 'all'];
        if (!in_array($perPage, $allowedPerPage)) {
            Log::warning('Invalid perPage, resetting to 10', ['perPage' => $perPage]);
            $perPage = 10;
        }
    
        // Pisahkan multi keyword
        $keywords = !empty($search) ? preg_split('/\s+/', (string) $search) : [];
    
        // Query builder awal
        $appLayananQuery = AppLayanan::query();
    
        // Apply search
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
    
        // Filter category
        if ($category && $category !== '') {
            $appLayananQuery->where('category', $category);
        }
    
        // Sorting
        $appLayananQuery->orderBy('created_at', 'desc');
    
        // PERBAIKAN: Pagination dengan handling perPage yang benar
        if ($perPage === 'all') {
            $allData = $appLayananQuery->get();
            $total = $allData->count();
            
            // PERBAIKAN: Hindari division by zero
            $perPageValue = $total > 0 ? $total : 1; // Minimal 1 untuk hindari division by zero
            
            // Untuk 'all', buat manual pagination
            $appLayanans = new LengthAwarePaginator(
                $allData,     // Semua data
                $total,       // Total items
                $perPageValue, // Items per page (minimal 1)
                1,            // Current page = 1
                [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => 'page',
                ]
            );
        } else {
            // Convert ke integer untuk pagination normal
            $perPage = (int) $perPage;
            $appLayanans = $appLayananQuery->paginate($perPage);
        }

    
        // PENTING: Preserve SEMUA query parameters
        $appLayanans->appends($request->all());
    
        // AJAX Response
        if ($request->ajax()) {
            return view('admin.AppLayanan.partials.table_body', compact('title', 'appLayanans'))->render();
        }
    
        return view('admin.AppLayanan.index', compact('title', 'appLayanans'));
    }
    
    

    /**
     * STORE : simpan AppLayanan baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'appname'     => 'required|string|max:255',
            'category'    => 'required|in:akademik,pegawai,pembelajaran,administrasi',
            'description' => 'required|string',
            'applink'     => 'nullable|url|max:500',
            'status'      => 'required|in:draft,published',
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
        $validated = $request->validate([
            'appname'     => 'required|string|max:255',
            'category'    => 'required|in:akademik,pegawai,pembelajaran,administrasi',
            'description' => 'required|string',
            'applink'     => 'nullable|url|max:500',
            'status'      => 'required|in:draft,published',
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
     * DESTROY : hapus satu AppLayanan (HARD DELETE)
     */
    public function destroy($id)
    {
        try {
            $appLayanan = AppLayanan::findOrFail($id);
            $appLayanan->delete(); // Hard delete

            return redirect()
                ->route('admin.app-layanan.index')
                ->with('success', 'Aplikasi berhasil dihapus permanen.');
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.app-layanan.index')
                ->with('error', 'Terjadi kesalahan saat menghapus aplikasi: ' . $e->getMessage());
        }
    }

    /**
     * BULK ACTION : publish / draft / delete
     */
    public function bulk(Request $request)
    {
        $request->validate([
            'action' => 'required|in:published,draft,delete',
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
                case 'delete':
                    $deletedCount = AppLayanan::whereIn('id', $ids)->delete();
                    $message = "{$deletedCount} Aplikasi Layanan berhasil dihapus permanen.";
                    break;
                    
                case 'published':
                case 'draft':
                    $updatedCount = AppLayanan::whereIn('id', $ids)->update(['status' => $action]);
                    $statusText = match($action) {
                        'published' => 'Published',
                        'draft' => 'Draft'
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
     * Halaman konfirmasi delete
     */
    public function delete(AppLayanan $appLayanan)
    {
        $title = 'Hapus Aplikasi Layanan';
        return view('admin.AppLayanan.delete', compact('title', 'appLayanan'));
    }

    public function toggleVisibility(Request $request, $id)
    {
        $appLayanan = AppLayanan::findOrFail($id);

        if ($appLayanan->status === 'published') {
            $appLayanan->status = 'draft';
            $message = 'appLayanan disembunyikan';
        } else {
            $appLayanan->status = 'published';
            $message = 'appLayanan ditampilkan';
        }

        $appLayanan->save();

        return response()->json([
            'success' => true,
            'message' => $message
        ]);
    }
}

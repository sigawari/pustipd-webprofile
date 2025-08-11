<?php

namespace App\Http\Controllers\Admin\ManageContent\AppLayanan;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppLayananRequest;
use App\Http\Requests\UpdateAppLayananRequest;
use App\Models\ManageContent\AppLayanan;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class AppLayananController extends Controller
{
    /**
     * INDEX : daftar AppLayanan + search + filter + pagination
     */
    public function index(Request $request)
    {
        $title = 'AppLayanan';
        $search = $request->input('search', '');
        $filter = $request->query('filter', 'all');
        $perPage = $request->input('perPage', 10);

        // Pisahkan multi keyword
        $keywords = !empty($search) ? preg_split('/\s+/', (string) $search) : [];

        // Query builder awal
        $applayananQuery = AppLayanan::query();

        // Apply search jika ada
        if ($search) {
            $applayananQuery->where(function ($q) use ($keywords) {
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
            $applayananQuery->where('status', $filter);
        }

        // Merge results
        $merged = $applayananQuery->get();

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

        $applayanans = new LengthAwarePaginator(
            $currentItems,
            $merged->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        // AJAX Response di controller
        if ($request->ajax()) {
            return view('admin.manage-content.AppLayanan.partials.table_body', compact('title', 'AppLayanans'))->render();
        } 

        // Render full view    
        return view('admin.manage-content.AppLayanan.index', compact('title', 'AppLayanans'));
    }    

    /**
     * CREATE : tampilkan form modal/page tambah
     */
    public function create()
    {
        $title = 'Tambah AppLayanan';
        return view('admin.manage-content.AppLayanan.create', compact('title'));
    }

    /**
     * STORE : simpan AppLayanan baru
     */
    public function store(StoreAppLayananRequest $request)
    {
        $data = $request->validated();
        
        // Jika sort_order kosong, buat otomatis (nomor paling akhir + 1)
        if (!isset($data['sort_order']) || $data['sort_order'] === null) {
            $data['sort_order'] = (AppLayanan::max('sort_order') ?? 0) + 1;
        }
        
        AppLayanan::create($data);

        return redirect()
               ->route('admin.manage-content.AppLayanan.index')
               ->with('success', 'AppLayanan berhasil ditambahkan sebagai draft!');
    }

    /**
     * EDIT : tampilkan form modal/page edit
     */
    public function edit(AppLayanan $applayanan)
    {
        $title = 'Edit AppLayanan';
        return view('admin.manage-content.AppLayanan.update', compact('title', 'AppLayanan'));
    }

    /**
     * UPDATE : perbarui AppLayanan
     */
    public function update(UpdateAppLayananRequest $request, AppLayanan $applayanan)
    {
        $data = $request->validated();
        
        // Jika sort_order kosong, pertahankan yang lama atau buat baru
        if (!isset($data['sort_order']) || $data['sort_order'] === null) {
            $data['sort_order'] = $applayanan->sort_order ?: ((AppLayanan::max('sort_order') ?? 0) + 1);
        }
        
        $applayanan->update($data);

        return redirect()
               ->route('admin.manage-content.AppLayanan.index')
               ->with('success', 'AppLayanan berhasil diperbarui!');
    }

    /**
     * DESTROY : hapus satu AppLayanan (soft delete ke archived)
     */
    public function destroy(AppLayanan $applayanan)
    {
        $applayanan->update(['status' => 'archived']);

        return redirect()
               ->route('admin.manage-content.AppLayanan.index')
               ->with('success', 'AppLayanan berhasil diarsipkan!');
    }

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
                $deletedCount = AppLayanan::whereIn('id', $ids)->delete();
                $message = "{$deletedCount} AppLayanan berhasil dihapus permanen.";
                break;
                
            case 'delete':
                // Soft delete: ubah status ke archived
                $archivedCount = AppLayanan::whereIn('id', $ids)->update(['status' => 'archived']);
                $message = "{$archivedCount} AppLayanan berhasil diarsipkan.";
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
                $message = "{$updatedCount} AppLayanan berhasil diubah ke status {$statusText}.";
                break;
                
            default:
                return back()->with('error', 'Aksi tidak valid.');
        }

        return back()->with('success', $message);
    }

    /**
     * OPTIONAL : halaman/partial konfirmasi delete
     */
    public function delete(AppLayanan $applayanan)
    {
        $title = 'Hapus AppLayanan';
        return view('admin.manage-content.AppLayanan.delete', compact('title', 'AppLayanan'));
    }
}

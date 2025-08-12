<?php

namespace App\Http\Controllers\Admin\ManageContent\AppLayanan;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppLayananRequest;
use App\Http\Requests\UpdateAppLayananRequest;
use App\Models\ManageContent\AppLayanan;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

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
            return view('admin.manage-content.applayanan.partials.table_body', compact('title', 'appLayanans'))->render();
        }

        return view('admin.manage-content.applayanan.index', compact('title', 'appLayanans'));
    }

    /**
     * CREATE : tampilkan form modal/page tambah
     */
    public function create()
    {
        $title = 'Tambah Aplikasi Layanan';
        
        $categories = [
            'akademik' => 'Akademik',
            'pegawai' => 'Pegawai', 
            'pembelajaran' => 'Pembelajaran',
            'administrasi' => 'Administrasi'
        ];
        
        return view('admin.manage-content.applayanan.create', compact('title', 'categories'));
    }

    /**
     * STORE : simpan AppLayanan baru
     */
   // Di AppLayananController.php
    public function store(StoreAppLayananRequest $request)
    {
        try {
            // ✅ FORCE: Status selalu draft untuk create
            $data = $request->validated();
            $data['status'] = 'draft'; // Override apapun input user
            
            $appLayanan = AppLayanan::create($data);
            
            return redirect()
                ->route('admin.manage-content.applayanan.index')
                ->with('success', 'Aplikasi berhasil ditambahkan sebagai Draft.');
                
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal menambahkan aplikasi: ' . $e->getMessage());
        }
    }

    /**
     * EDIT : tampilkan form modal/page edit
     */
    public function edit(AppLayanan $appLayanan)
    {
        $title = 'Edit Aplikasi Layanan';
        
        $categories = [
            'akademik' => 'Akademik',
            'pegawai' => 'Pegawai',
            'pembelajaran' => 'Pembelajaran', 
            'administrasi' => 'Administrasi'
        ];
        
        return view('admin.manage-content.applayanan.edit', compact('title', 'appLayanan', 'categories'));
    }

    /**
     * UPDATE : perbarui AppLayanan
     */
    public function update(UpdateAppLayananRequest $request, AppLayanan $appLayanan)
    {
        try {
            $data = $request->validated();
            
            $appLayanan->update($data);

            return redirect()
                   ->route('admin.manage-content.applayanan.index')
                   ->with('success', 'Aplikasi Layanan berhasil diperbarui!');
                   
        } catch (\Exception $e) {
            Log::error('Error updating AppLayanan: ' . $e->getMessage());
            return redirect()
                   ->back()
                   ->with('error', 'Gagal memperbarui aplikasi layanan: ' . $e->getMessage())
                   ->withInput();
        }
    }

    /**
     * DESTROY : hapus satu AppLayanan (soft delete ke archived)
     */
    public function destroy(AppLayanan $appLayanan)
    {
        try {
            $appLayanan->update(['status' => 'archived']);

            return redirect()
                   ->route('admin.manage-content.applayanan.index')
                   ->with('success', 'Aplikasi Layanan berhasil diarsipkan!');
                   
        } catch (\Exception $e) {
            Log::error('Error archiving AppLayanan: ' . $e->getMessage());
            return redirect()
                   ->back()
                   ->with('error', 'Gagal mengarsipkan aplikasi layanan.');
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
        return view('admin.manage-content.applayanan.show', compact('title', 'appLayanan'));
    }

    /**
     * OPTIONAL : halaman/partial konfirmasi delete
     */
    public function delete(AppLayanan $appLayanan)
    {
        $title = 'Hapus Aplikasi Layanan';
        return view('admin.manage-content.applayanan.delete', compact('title', 'appLayanan'));
    }
}


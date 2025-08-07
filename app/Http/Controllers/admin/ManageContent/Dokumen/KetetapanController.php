<?php

namespace App\Http\Controllers\Admin\ManageContent\Dokumen;

use App\Models\Ketetapan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request; // ✅ TAMBAHKAN INI
use App\Http\Requests\StoreKetetapanRequest;
use App\Http\Requests\UpdateKetetapanRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KetetapanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $filter = $request->get('filter', 'all');
        $perPage = $request->get('perPage', 10);
    
        // Validasi per_page
        $validPerPage = [10, 25, 50, 'all'];
        if (!in_array($perPage, $validPerPage)) {
            $perPage = 10;
        }
    
        // Query builder
        $query = Ketetapan::query();
    
        // Apply search filter
        if ($search) {
            $query->search($search);
        }
    
        // Apply status filter
        if ($filter && $filter !== 'all') {
            $query->where('status', $filter);
        }
    
        // ✅ AUTO SORTING: Tahun terbaru dulu, lalu tanggal dibuat terbaru
        $query->orderByRaw('year_published DESC NULLS LAST') // Tahun terbaru dulu, NULL di akhir
              ->orderBy('created_at', 'desc'); // Jika tahun sama, yang baru dibuat dulu
    
        // Paginate results
        if ($perPage === 'all') {
            $ketetapans = $query->paginate(1000);
        } else {
            $ketetapans = $query->paginate($perPage);
        }
    
        // Return response
        if ($request->wantsJson()) {
            return response()->json([
                'html' => view('admin.manage-content.dokumen.ketetapan.partials.table_body', compact('ketetapans'))->render(),
                'pagination' => [
                    'current_page' => $ketetapans->currentPage(),
                    'last_page' => $ketetapans->lastPage(),
                    'per_page' => $ketetapans->perPage(),
                    'total' => $ketetapans->total(),
                    'from' => $ketetapans->firstItem(),
                    'to' => $ketetapans->lastItem(),
                    'has_more_pages' => $ketetapans->hasMorePages(),
                    'on_first_page' => $ketetapans->onFirstPage(),
                ]
            ]);
        }
    
        return view('admin.manage-content.dokumen.ketetapan.index', [
            'title' => 'Ketetapan',
            'ketetapans' => $ketetapans
        ]);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.manage-content.dokumen.ketetapan.create', [
            'title' => 'Tambah Ketetapan'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKetetapanRequest $request)
    {
        if ($request->hasFile('file')) {
        $file = $request->file('file');
        
        \Log::info('File Upload Debug:', [
            'original_name' => $file->getClientOriginalName(),
            'size' => $file->getSize(),
            'mime_type' => $file->getMimeType(),
            'is_valid' => $file->isValid(),
            'error' => $file->getError(),
        ]);
        
        if (!$file->isValid()) {
            return back()->withErrors(['file' => 'File upload error: ' . $file->getErrorMessage()]);
        }
    }else {
            \Log::warning('No file received in request');
            return back()->withErrors(['file' => 'No file was uploaded']);
        }

        try {
            $data = $request->validated();

            // Handle file upload
            if ($request->hasFile('file')) {
                $fileData = $this->handleFileUpload($request->file('file'));
                $data = array_merge($data, $fileData);
            }

            // Set default values
            $data['status'] = $data['status'] ?? 'draft';
            $data['sort_order'] = $data['sort_order'] ?? 0;

            Ketetapan::create($data);

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Ketetapan berhasil ditambahkan!'
                ]);
            }

            return redirect()->route('admin.manage-content.dokumen.ketetapan.index')
                           ->with('success', 'Ketetapan berhasil ditambahkan!');

        } catch (\Exception $e) {
            \Log::error('Error creating ketetapan: ' . $e->getMessage());

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat menyimpan ketetapan.'
                ], 500);
            }

            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Terjadi kesalahan saat menyimpan ketetapan.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Ketetapan $ketetapan)
    {
        return view('admin.manage-content.dokumen.ketetapan.show', [
            'title' => 'Detail Ketetapan',
            'ketetapan' => $ketetapan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ketetapan $ketetapan)
    {
        return response()->json([
            'ketetapan' => $ketetapan,
            'title' => 'Edit Ketetapan'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKetetapanRequest $request, Ketetapan $ketetapan)
    {
        try {
            $data = $request->validated();
            $oldFilePath = $ketetapan->file_path;

            // Handle file upload if new file provided
            if ($request->hasFile('file')) {
                $fileData = $this->handleFileUpload($request->file('file'), $oldFilePath);
                $data = array_merge($data, $fileData);
            }

            $ketetapan->update($data);

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Ketetapan berhasil diperbarui!'
                ]);
            }

            return redirect()->route('admin.manage-content.dokumen.ketetapan.index')
                           ->with('success', 'Ketetapan berhasil diperbarui!');

        } catch (\Exception $e) {
            \Log::error('Error updating ketetapan: ' . $e->getMessage());

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat memperbarui ketetapan.'
                ], 500);
            }

            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Terjadi kesalahan saat memperbarui ketetapan.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ketetapan $ketetapan)
    {
        try {
            // Soft delete - pindah ke archived
            $ketetapan->update(['status' => 'archived']);

            return response()->json([
                'success' => true,
                'message' => 'Ketetapan berhasil diarsipkan!'
            ]);

        } catch (\Exception $e) {
            \Log::error('Error archiving ketetapan: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengarsipkan ketetapan.'
            ], 500);
        }
    }

    /**
     * Handle bulk actions
     */
    public function bulk(Request $request)
    {
        $request->validate([
            'action' => 'required|in:published,draft,archived,permanent_delete',
            'ids' => 'required|array',
            'ids.*' => 'exists:ketetapans,id'
        ]);

        try {
            $action = $request->action;
            $ids = $request->ids;
            $count = count($ids);

            switch ($action) {
                case 'published':
                    Ketetapan::whereIn('id', $ids)->update(['status' => 'published']);
                    $message = "{$count} ketetapan berhasil dipublish!";
                    break;

                case 'draft':
                    Ketetapan::whereIn('id', $ids)->update(['status' => 'draft']);
                    $message = "{$count} ketetapan berhasil dijadikan draft!";
                    break;

                case 'archived':
                    Ketetapan::whereIn('id', $ids)->update(['status' => 'archived']);
                    $message = "{$count} ketetapan berhasil diarsipkan!";
                    break;

                case 'permanent_delete':
                    $ketetapans = Ketetapan::whereIn('id', $ids)->get();
                    
                    // Delete files first
                    foreach ($ketetapans as $ketetapan) {
                        if ($ketetapan->file_path && Storage::disk('public')->exists($ketetapan->file_path)) {
                            Storage::disk('public')->delete($ketetapan->file_path);
                        }
                    }
                    
                    // Then delete records
                    Ketetapan::whereIn('id', $ids)->delete();
                    $message = "{$count} ketetapan berhasil dihapus permanen!";
                    break;
            }

            return redirect()->back()->with('success', $message);

        } catch (\Exception $e) {
            \Log::error('Error in bulk action: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Terjadi kesalahan saat melakukan aksi bulk.');
        }
    }

    /**
     * Export ketetapan data
     */
    public function export(Request $request)
    {
        // Implementation for export functionality
        // Could export to Excel, PDF, etc.
        
        $ketetapans = Ketetapan::when($request->status, function($query) use ($request) {
            $query->where('status', $request->status);
        })->get();

        // For now, return JSON
        return response()->json([
            'data' => $ketetapans,
            'exported_at' => now(),
            'total' => $ketetapans->count()
        ]);
    }

    /**
     * Handle file upload
     */
    private function handleFileUpload($file, $oldFilePath = null)
    {
        // Delete old file if exists
        if ($oldFilePath && Storage::disk('public')->exists($oldFilePath)) {
            Storage::disk('public')->delete($oldFilePath);
        }

        // Generate unique filename
        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '_' . Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $extension;

        // Store file
        $filePath = $file->storeAs('ketetapan', $filename, 'public');

        return [
            'file_path' => $filePath,
            'original_filename' => $originalName,
            'file_size' => $file->getSize(),
            'file_type' => $extension,
        ];
    }

    /**
     * Download file
     */
    public function download(Ketetapan $ketetapan)
    {
        if (!$ketetapan->file_path || !Storage::disk('public')->exists($ketetapan->file_path)) {
            abort(404, 'File tidak ditemukan');
        }

        return Storage::disk('public')->download(
            $ketetapan->file_path, 
            $ketetapan->original_filename ?? 'ketetapan.' . $ketetapan->file_type
        );
    }
}

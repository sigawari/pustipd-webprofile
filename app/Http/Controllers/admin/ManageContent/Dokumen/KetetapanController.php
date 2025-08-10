<?php

namespace App\Http\Controllers\Admin\ManageContent\Dokumen;

use App\Models\Ketetapan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class KetetapanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Ketetapan';
        $search = $request->get('search');
        $filter = $request->get('filter', 'all');
        $perPage = $request->get('perPage', 10);
        
        // Pisahkan multi keyword
        $keywords = !empty($search) ? preg_split('/\s+/', (string) $search) : [];

        // Query builder awal
        $ketetapanQuery = Ketetapan::query();

        // Apply search jika ada
        if ($search) {
            $ketetapanQuery->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->where(function ($q) use ($word) {
                        $q->where('title', 'like', "%{$word}%")
                          ->orWhere('description', 'like', "%{$word}%");
                    });
                }
            });
        }

        // Filter status
        if ($filter && $filter !== 'all') {
            $ketetapanQuery->where('status', $filter);
        }

        // Merge results
        $merged = $ketetapanQuery->get();

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
        $ketetapans = $ketetapanQuery->paginate($perPage);

        // ✅ AUTO SORTING: Tahun terbaru dulu, lalu tanggal dibuat terbaru
        $ketetapans->getCollection()->sortByDesc(function ($ketetapan) {
            return [$ketetapan->year_published ?? 0, $ketetapan->created_at];
        });

        $ketetapans = new LengthAwarePaginator(
            $ketetapans->getCollection()->slice(($currentPage - 1) * $perPage, $perPage)->values(),
            $ketetapans->total(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        // AJAX response
        if (request()->ajax()) {
            return view('admin.manage-content.dokumen.ketetapan.partials.table_body', compact('title', 'ketetapans'))->render();
        }
        // Render full view
        return view('admin.manage-content.dokumen.ketetapan.index', compact('title', 'ketetapans'));
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
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'title'          => 'required|string|max:255',
            'description'    => 'required|string',
            'file'           => 'required|file|mimes:pdf,doc,docx|max:10240', // 10MB
            'year_published' => 'nullable|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'status'         => 'required|in:published,draft,archived'
        ]);

        // Simpan file ke storage
        $file = $request->file('file');
        $path = $file->store('ketetapan_files', 'public'); // simpan di storage/app/public/ketetapan_files

        // Simpan ke database
        Ketetapan::create([
            'title'          => $request->input('title'),
            'description'    => $request->input('description'),
            'file_path'      => $path,
            'original_filename' => $file->getClientOriginalName(),
            'file_size'      => $file->getSize(),
            'file_type'      => $file->getClientOriginalExtension(),
            'year_published' => $request->input('year_published') ?? null,
            'status'         => $request->input('status'),
        ]);

        return redirect()
            ->back()
            ->with('success', 'Ketetapan berhasil ditambahkan sebagai Draft.');
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
    public function update(Request $request, $id)
    {
        // Ambil data ketetapan yang akan diupdate
        $ketetapan = Ketetapan::findOrFail($id);

        // Validasi input (file opsional saat update)
        $request->validate([
            'title'          => 'required|string|max:255',
            'description'    => 'required|string',
            'file'           => 'nullable|file|mimes:pdf,doc,docx|max:10240', // opsional
            'year_published' => 'nullable|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'status'         => 'required|in:published,draft,archived'
        ]);

        // Cek apakah ada file baru diupload
        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($ketetapan->file_path && Storage::disk('public')->exists($ketetapan->file_path)) {
                Storage::disk('public')->delete($ketetapan->file_path);
            }

            // Simpan file baru
            $file = $request->file('file');
            $path = $file->store('ketetapan_files', 'public');

            $ketetapan->file_path = $path;
            $ketetapan->original_filename = $file->getClientOriginalName();
            $ketetapan->file_size = $file->getSize();
            $ketetapan->file_type = $file->getClientOriginalExtension();
        }

        // Update field lainnya
        $ketetapan->title = $request->input('title');
        $ketetapan->description = $request->input('description');
        $ketetapan->year_published = $request->input('year_published') ?? null;
        $ketetapan->status = $request->input('status');

        $ketetapan->save();

        return redirect()
            ->back()
            ->with('success', 'Ketetapan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Cari data ketetapan
        $ketetapan = Ketetapan::findOrFail($id);

        // Hapus file di storage kalau ada
        if ($ketetapan->file_path && Storage::disk('public')->exists($ketetapan->file_path)) {
            Storage::disk('public')->delete($ketetapan->file_path);
        }

        // Hapus data dari database
        $ketetapan->delete();

        return redirect()
            ->back()
            ->with('success', 'Ketetapan berhasil dihapus.');
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
            Log::error('Error in bulk action: ' . $e->getMessage());

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

        $filePath = Storage::disk('public')->path($ketetapan->file_path);
        $downloadName = $ketetapan->original_filename ?? 'ketetapan.' . $ketetapan->file_type;
        return response()->download($filePath, $downloadName);
    }
}

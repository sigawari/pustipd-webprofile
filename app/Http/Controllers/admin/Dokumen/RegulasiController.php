<?php

namespace App\Http\Controllers\Admin\Dokumen;

use App\Models\Dokumen\Regulasi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class RegulasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Regulasi';
        $search = $request->get('search');
        $filter = $request->get('filter', 'all');
        $perPage = $request->get('perPage', 10);
        
        // Query builder awal
        $regulasiQuery = Regulasi::query();

        // Apply search jika ada
        if ($search) {
            $keywords = preg_split('/\s+/', trim($search));
            $regulasiQuery->where(function ($q) use ($keywords) {
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
            $regulasiQuery->where('status', $filter);
        }

        // Auto sorting: Tahun terbaru dulu, lalu tanggal dibuat terbaru
        $regulasiQuery->orderByDesc('year_published')
                       ->orderByDesc('created_at');

        // Per-page validation
        if ($perPage === 'all') {
            $regulasis = $regulasiQuery->get();
            $perPage = max($regulasis->count(), 1);
        } else {
            $perPage = max((int) $perPage, 1);
        }

        // Paginate
        $regulasis = $regulasiQuery->paginate($perPage);

        // AJAX response
        if ($request->ajax()) {
            return view('admin.Dokumen.Regulasi.partials.table_body', compact('title', 'regulasis'))->render();
        }

        // Render full view
        return view('admin.Dokumen.Regulasi.index', compact('title', 'regulasis'));
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

        try {
            // Handle file upload
            $fileData = $this->handleFileUpload($request->file('file'));

            // Simpan ke database
            Regulasi::create([
                'title'          => $request->input('title'),
                'description'    => $request->input('description'),
                'file_path'      => $fileData['file_path'],
                'original_filename' => $fileData['original_filename'],
                'file_size'      => $fileData['file_size'],
                'file_type'      => $fileData['file_type'],
                'year_published' => $request->input('year_published') ?? null,
                'status'         => $request->input('status'),
            ]);

            return redirect()
                ->back()
                ->with('success', 'Regulasi berhasil ditambahkan.');

        } catch (\Exception $e) {
            Log::error('Error storing Regulasi: ' . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Gagal menambahkan Regulasi: ' . $e->getMessage())
                ->withInput();
        }
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Regulasi $regulasi)
    {
        return view('admin.Dokumen.Regulasi.show', [
            'title' => 'Detail Regulasi',
            'Regulasi' => $regulasi
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($id);
        $regulasi = Regulasi::findOrFail($id);

        $request->validate([
            'title'          => 'required|string|max:255',
            'description'    => 'required|string',
            'file'           => 'nullable|file|mimes:pdf,doc,docx|max:10240', // opsional saat update
            'year_published' => 'nullable|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'status'         => 'required|in:published,draft,archived'
        ]);

        try {
            $fileData = [
                'file_path'         => $regulasi->file_path,
                'original_filename' => $regulasi->original_filename,
                'file_size'         => $regulasi->file_size,
                'file_type'         => $regulasi->file_type,
            ];

            // Jika ada file baru, hapus file lama lalu upload baru
            if ($request->hasFile('file')) {
                if ($regulasi->file_path && Storage::disk('public')->exists($regulasi->file_path)) {
                    Storage::disk('public')->delete($regulasi->file_path);
                }
                $fileData = $this->handleFileUpload($request->file('file'));
            }

            // Update data
            $regulasi->update([
                'title'             => $request->input('title'),
                'description'       => $request->input('description'),
                'file_path'         => $fileData['file_path'],
                'original_filename' => $fileData['original_filename'],
                'file_size'         => $fileData['file_size'],
                'file_type'         => $fileData['file_type'],
                'year_published'    => $request->input('year_published') ?? null,
                'status'            => $request->input('status'),
            ]);

            return redirect()
                ->back()
                ->with('success', 'Regulasi berhasil diperbarui.');

        } catch (\Exception $e) {
            Log::error('Error updating Regulasi: ' . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Gagal memperbarui Regulasi: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // dd($id);
        $regulasi = Regulasi::findOrFail($id);

        try {
            // Hapus file dari storage jika ada
            if ($regulasi->file_path && Storage::disk('public')->exists($regulasi->file_path)) {
                Storage::disk('public')->delete($regulasi->file_path);
            }

            $regulasi->delete();

            return redirect()
                ->back()
                ->with('success', 'Regulasi berhasil dihapus.');

        } catch (\Exception $e) {
            Log::error('Error deleting Regulasi: ' . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Gagal menghapus Regulasi: ' . $e->getMessage());
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
            'ids.*' => 'exists:Regulasis,id'
        ]);

        $action = $request->input('action');
        $ids = $request->input('ids');

        try {
            if ($action === 'permanent_delete') {
                $regulasis = Regulasi::whereIn('id', $ids)->get();
                
                foreach ($regulasis as $regulasi) {
                    // Delete file if exists
                    if ($regulasi->file_path && Storage::disk('public')->exists($regulasi->file_path)) {
                        Storage::disk('public')->delete($regulasi->file_path);
                    }
                    
                    // Delete record
                    $regulasi->delete();
                }
                
                $message = 'Regulasi berhasil dihapus permanen';
            } else {
                Regulasi::whereIn('id', $ids)->update(['status' => $action]);
                
                $message = match($action) {
                    'published' => 'Regulasi berhasil dipublish ke halaman publik',
                    'draft' => 'Regulasi berhasil disembunyikan dari halaman publik',
                };
            }

            return redirect()->back()->with('success', $message);

        } catch (\Exception $e) {
            Log::error('Error bulk action: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Download file
     */
    public function download(Regulasi $regulasi)
    {
        // Cek akses: jika user tidak login (public access), pastikan status published
        if (!Auth::check()) {
            if ($regulasi->status !== 'published') {
                abort(404, 'Dokumen tidak tersedia untuk publik');
            }
        }

        // Cek file exists
        if (!$regulasi->file_path || !Storage::disk('public')->exists($regulasi->file_path)) {
            abort(404, 'File tidak ditemukan');
        }

        $filePath = Storage::disk('public')->path($regulasi->file_path);
        $downloadName = $regulasi->original_filename ?? ($regulasi->title . '.' . ($regulasi->file_type ?? 'pdf'));
        
        // Log download activity
        Log::info('File downloaded', [
            'Regulasi_id' => $regulasi->id,
            'title' => $regulasi->title,
            'user_ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'user_type' => Auth::check() ? 'admin' : 'public'
        ]);
        
        return response()->download($filePath, $downloadName);
    }

    /**
     * Bulk download files
     */
    public function bulkDownload(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:Regulasis,id'
        ]);

        $ids = $request->input('ids');
        
        // Ambil Regulasi yang published dan ada filenya
        $query = Regulasi::whereIn('id', $ids)->whereNotNull('file_path');
        
        // Jika akses public, hanya yang published
        if (!Auth::check()) {
            $query->where('status', 'published');
        }
        
        $regulasis = $query->get();

        if ($regulasis->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada file yang dapat didownload');
        }

        // Jika hanya 1 file, download langsung
        if ($regulasis->count() === 1) {
            return $this->download($regulasis->first());
        }

        // Jika lebih dari 1 file, buat ZIP
        return $this->createZipDownload($regulasis);
    }

    /**
     * Create ZIP download
     */
    private function createZipDownload($regulasis)
    {
        $zip = new \ZipArchive();
        $zipFileName = 'Regulasi_' . date('Y-m-d_H-i-s') . '.zip';
        $zipPath = storage_path('app/temp/' . $zipFileName);
        
        // Buat folder temp jika belum ada
        if (!File::exists(storage_path('app/temp'))) {
            File::makeDirectory(storage_path('app/temp'), 0755, true);
        }

        if ($zip->open($zipPath, \ZipArchive::CREATE) === TRUE) {
            $fileCount = 0;
            
            foreach ($regulasis as $regulasi) {
                if (Storage::disk('public')->exists($regulasi->file_path)) {
                    $filePath = Storage::disk('public')->path($regulasi->file_path);
                    $fileName = $regulasi->original_filename ?? ($regulasi->title . '.pdf');
                    
                    // Pastikan nama file unik dalam ZIP
                    $counter = 1;
                    $originalFileName = $fileName;
                    while ($zip->locateName($fileName) !== false) {
                        $pathInfo = pathinfo($originalFileName);
                        $extension = isset($pathInfo['extension']) ? '.' . $pathInfo['extension'] : '';
                        $fileName = $pathInfo['filename'] . '_' . $counter . $extension;
                        $counter++;
                    }
                    
                    $zip->addFile($filePath, $fileName);
                    $fileCount++;
                }
            }
            
            $zip->close();
            
            if ($fileCount === 0) {
                // Hapus ZIP kosong
                if (File::exists($zipPath)) {
                    File::delete($zipPath);
                }
                return redirect()->back()->with('error', 'Tidak ada file yang dapat didownload');
            }

            // Log bulk download activity
            Log::info('Bulk download', [
                'file_count' => $fileCount,
                'Regulasi_ids' => $regulasis->pluck('id')->toArray(),
                'user_ip' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'user_type' => Auth::check() ? 'admin' : 'public'
            ]);

            return response()->download($zipPath, $zipFileName)->deleteFileAfterSend(true);
        }

        return redirect()->back()->with('error', 'Gagal membuat file ZIP');
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
        $filePath = $file->storeAs('Regulasi_files', $filename, 'public');

        return [
            'file_path' => $filePath,
            'original_filename' => $originalName,
            'file_size' => $file->getSize(),
            'file_type' => $extension,
        ];
    }

    /**
     * Export Regulasi data
     */
    public function export(Request $request)
    {
        $regulasis = Regulasi::when($request->status, function($query) use ($request) {
            $query->where('status', $request->status);
        })->get();

        return response()->json([
            'data' => $regulasis,
            'exported_at' => now(),
            'total' => $regulasis->count()
        ]);
    }
}

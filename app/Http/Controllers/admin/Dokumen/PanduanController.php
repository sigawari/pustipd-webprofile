<?php

namespace App\Http\Controllers\Admin\Dokumen;

use App\Models\Dokumen\Panduan;
use App\Http\Controllers\Controller;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PanduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Panduan';
        $search = $request->get('search');
        $filter = $request->get('filter', 'all');
        $perPage = $request->get('perPage', 10);
        
        // Query builder awal
        $panduanQuery = Panduan::query();

        // Apply search jika ada
        if ($search) {
            $keywords = preg_split('/\s+/', trim($search));
            $panduanQuery->where(function ($q) use ($keywords) {
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
            $panduanQuery->where('status', $filter);
        }

        // Auto sorting: Tahun terbaru dulu, lalu tanggal dibuat terbaru
        $panduanQuery->orderByDesc('year_published')
                       ->orderByDesc('created_at');

        // Per-page validation
        if ($perPage === 'all') {
            $panduans = $panduanQuery->get();
            $perPage = max($panduans->count(), 1);
        } else {
            $perPage = max((int) $perPage, 1);
        }

        // Paginate
        $panduans = $panduanQuery->paginate($perPage);

        // AJAX response
        if ($request->ajax()) {
            return view('admin.Dokumen.Panduan.partials.table_body', compact('title', 'panduans'))->render();
        }

        // Render full view
        return view('admin.Dokumen.Panduan.index', compact('title', 'panduans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.Dokumen.Panduan.create', [
            'title' => 'Tambah Panduan'
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

        try {
            // Handle file upload
            $fileData = $this->handleFileUpload($request->file('file'));

            // Simpan ke database
            Panduan::create([
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
                ->with('success', 'Panduan berhasil ditambahkan.');

        } catch (\Exception $e) {
            Log::error('Error storing Panduan: ' . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Gagal menambahkan Panduan: ' . $e->getMessage())
                ->withInput();
        }
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Panduan $panduan)
    {
        return view('admin.Dokumen.Panduan.show', [
            'title' => 'Detail Panduan',
            'panduan' => $panduan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Panduan $panduan)
    {
        return response()->json([
            'panduan' => $panduan,
            'title' => 'Edit Panduan'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Panduan $panduan)
    {
        // Validasi input (file opsional saat update)
        $request->validate([
            'title'          => 'required|string|max:255',
            'description'    => 'required|string',
            'file'           => 'nullable|file|mimes:pdf,doc,docx|max:10240', // opsional
            'year_published' => 'nullable|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'status'         => 'required|in:published,draft,archived'
        ]);

        try {
            // Cek apakah ada file baru diupload
            if ($request->hasFile('file')) {
                $fileData = $this->handleFileUpload($request->file('file'), $panduan->file_path);
                
                $panduan->file_path = $fileData['file_path'];
                $panduan->original_filename = $fileData['original_filename'];
                $panduan->file_size = $fileData['file_size'];
                $panduan->file_type = $fileData['file_type'];
            }

            // Update field lainnya
            $panduan->title = $request->input('title');
            $panduan->description = $request->input('description');
            $panduan->year_published = $request->input('year_published') ?? null;
            $panduan->status = $request->input('status');

            $panduan->save();

            return redirect()
                ->back()
                ->with('success', 'Panduan berhasil diperbarui.');

        } catch (\Exception $e) {
            Log::error('Error updating Panduan: ' . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Gagal memperbarui Panduan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Panduan $panduan)
    {
        try {
            // Hapus file di storage kalau ada
            if ($panduan->file_path && Storage::disk('public')->exists($panduan->file_path)) {
                Storage::disk('public')->delete($panduan->file_path);
            }

            // Hapus data dari database
            $panduan->delete();

            return redirect()
                ->back()
                ->with('success', 'Panduan berhasil dihapus.');

        } catch (\Exception $e) {
            Log::error('Error deleting Panduan: ' . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Gagal menghapus Panduan: ' . $e->getMessage());
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
            'ids.*' => 'exists:Panduans,id'
        ]);

        $action = $request->input('action');
        $ids = $request->input('ids');

        try {
            if ($action === 'permanent_delete') {
                $panduans = Panduan::whereIn('id', $ids)->get();
                
                foreach ($panduans as $panduan) {
                    // Delete file if exists
                    if ($panduan->file_path && Storage::disk('public')->exists($panduan->file_path)) {
                        Storage::disk('public')->delete($panduan->file_path);
                    }
                    
                    // Delete record
                    $panduan->delete();
                }
                
                $message = 'Panduan berhasil dihapus permanen';
            } else {
                Panduan::whereIn('id', $ids)->update(['status' => $action]);
                
                $message = match($action) {
                    'published' => 'Panduan berhasil dipublish ke halaman publik',
                    'draft' => 'Panduan berhasil disembunyikan dari halaman publik',
                    'archived' => 'Panduan berhasil diarsipkan'
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
    public function download(Panduan $panduan)
    {
        // Cek akses: jika user tidak login (public access), pastikan status published
        if (!Auth::check()) {
            if ($panduan->status !== 'published') {
                abort(404, 'Dokumen tidak tersedia untuk publik');
            }
        }

        // Cek file exists
        if (!$panduan->file_path || !Storage::disk('public')->exists($panduan->file_path)) {
            abort(404, 'File tidak ditemukan');
        }

        $filePath = Storage::disk('public')->path($panduan->file_path);
        $downloadName = $panduan->original_filename ?? ($panduan->title . '.' . ($panduan->file_type ?? 'pdf'));
        
        // Log download activity
        Log::info('File downloaded', [
            'Panduan_id' => $panduan->id,
            'title' => $panduan->title,
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
            'ids.*' => 'exists:Panduans,id'
        ]);

        $ids = $request->input('ids');
        
        // Ambil Panduan yang published dan ada filenya
        $query = Panduan::whereIn('id', $ids)->whereNotNull('file_path');
        
        // Jika akses public, hanya yang published
        if (!Auth::check()) {
            $query->where('status', 'published');
        }
        
        $panduans = $query->get();

        if ($panduans->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada file yang dapat didownload');
        }

        // Jika hanya 1 file, download langsung
        if ($panduans->count() === 1) {
            return $this->download($panduans->first());
        }

        // Jika lebih dari 1 file, buat ZIP
        return $this->createZipDownload($panduans);
    }

    /**
     * Create ZIP download
     */
    private function createZipDownload($panduans)
    {
        $zip = new \ZipArchive();
        $zipFileName = 'Panduan_' . date('Y-m-d_H-i-s') . '.zip';
        $zipPath = storage_path('app/temp/' . $zipFileName);
        
        // Buat folder temp jika belum ada
        if (!File::exists(storage_path('app/temp'))) {
            File::makeDirectory(storage_path('app/temp'), 0755, true);
        }

        if ($zip->open($zipPath, \ZipArchive::CREATE) === TRUE) {
            $fileCount = 0;
            
            foreach ($panduans as $panduan) {
                if (Storage::disk('public')->exists($panduan->file_path)) {
                    $filePath = Storage::disk('public')->path($panduan->file_path);
                    $fileName = $panduan->original_filename ?? ($panduan->title . '.pdf');
                    
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
                'Panduan_ids' => $panduans->pluck('id')->toArray(),
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
        $filePath = $file->storeAs('Panduan_files', $filename, 'public');

        return [
            'file_path' => $filePath,
            'original_filename' => $originalName,
            'file_size' => $file->getSize(),
            'file_type' => $extension,
        ];
    }

    /**
     * Export Panduan data
     */
    public function export(Request $request)
    {
        $panduans = Panduan::when($request->status, function($query) use ($request) {
            $query->where('status', $request->status);
        })->get();

        return response()->json([
            'data' => $panduans,
            'exported_at' => now(),
            'total' => $panduans->count()
        ]);
    }
}

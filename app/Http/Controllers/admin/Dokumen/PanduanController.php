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
use Illuminate\Pagination\LengthAwarePaginator;

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
        
        // Pisahkan Multi Keyword
        $keywords = !empty($search) ? preg_split('/\s+/', (string) $search) : [];
        
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
        
        $allPanduans = $panduanQuery->get();

        // Per-page validation
        if ($perPage === 'all') {
            $panduans = $panduanQuery->get();
            $perPage = max($panduans->count(), 1);
        } else {
            $perPage = max((int) $perPage, 1);
        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $allPanduans->slice(($currentPage - 1) * $perPage, $perPage)->values();

        // Paginate
        $panduans = new LengthAwarePaginator(
            $currentItems,
            $allPanduans->count(),
            $perPage,
            $currentPage,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );
        
        // AJAX response
        if ($request->ajax()) {
            return view('admin.Dokumen.Panduan.partials.table_body', compact('title', 'panduans'))->render();
        }

        // Render full view
        return view('admin.Dokumen.Panduan.index', compact('title', 'panduans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $panduan = Panduan::findOrFail($id);

        $request->validate([
            'title'          => 'required|string|max:255',
            'description'    => 'required|string',
            'file'           => 'nullable|file|mimes:pdf,doc,docx|max:10240', // opsional saat update
            'year_published' => 'nullable|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'status'         => 'required|in:published,draft,archived'
        ]);

        try {
            $fileData = [
                'file_path'         => $panduan->file_path,
                'original_filename' => $panduan->original_filename,
                'file_size'         => $panduan->file_size,
                'file_type'         => $panduan->file_type,
            ];

            // Jika ada file baru, hapus file lama lalu upload baru
            if ($request->hasFile('file')) {
                if ($panduan->file_path && Storage::disk('public')->exists($panduan->file_path)) {
                    Storage::disk('public')->delete($panduan->file_path);
                }
                $fileData = $this->handleFileUpload($request->file('file'));
            }

            // Update data
            $panduan->update([
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
    public function destroy($id)
    {
        // dd($id);
        $panduan = Panduan::findOrFail($id);

        try {
            // Hapus file dari storage jika ada
            if ($panduan->file_path && Storage::disk('public')->exists($panduan->file_path)) {
                Storage::disk('public')->delete($panduan->file_path);
            }

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
         if (!Auth::check() && $panduan->status !== 'published') {
             abort(404, 'Dokumen tidak tersedia untuk publik');
         }
 
         if (!$panduan->file_path || !Storage::disk('public')->exists($panduan->file_path)) {
             abort(404, 'File tidak ditemukan');
         }
 
         $filePath = Storage::disk('public')->path($panduan->file_path);
         $downloadName = $panduan->original_filename ?? ($panduan->title . '.' . ($panduan->file_type ?? 'pdf'));
 
         Log::info('File downloaded', [
             'Panduan_id' => $panduan->id,
             'title' => $panduan->title,
             'user_ip' => request()->ip(),
             'user_agent' => request()->userAgent(),
             'user_type' => Auth::check() ? 'admin' : 'user_public'
         ]);
 
         return response()->download($filePath, $downloadName);
     }
 
     public function bulkDownload(Request $request)
     {
         $request->validate([
             'ids' => 'required|array',
             'ids.*' => 'exists:Panduans,id'
         ]);
 
         $ids = $request->input('ids');
 
         $query = Panduan::whereIn('id', $ids)->whereNotNull('file_path');
 
         if (!Auth::check()) {
             $query->where('status', 'published');
         }
 
         $panduans = $query->get();
 
         if ($panduans->isEmpty()) {
             return redirect()->back()->with('error', 'Tidak ada file yang dapat didownload');
         }
 
         if ($panduans->count() === 1) {
             return $this->download($panduans->first());
         }
 
         return $this->createZipDownload($panduans);
     }
 
     private function createZipDownload($panduans)
     {
         $zip = new \ZipArchive();
         $zipFileName = 'Panduan_' . date('Y-m-d_H-i-s') . '.zip';
         $zipPath = storage_path('app/temp/' . $zipFileName);
 
         if (!File::exists(storage_path('app/temp'))) {
             File::makeDirectory(storage_path('app/temp'), 0755, true);
         }
 
         if ($zip->open($zipPath, \ZipArchive::CREATE) === TRUE) {
             $fileCount = 0;
 
             foreach ($panduans as $panduan) {
                 if (Storage::disk('public')->exists($panduan->file_path)) {
                     $filePath = Storage::disk('public')->path($panduan->file_path);
                     $fileName = $panduan->original_filename ?? ($panduan->title . '.pdf');
 
                     // Pastikan nama unik dalam ZIP
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
                 if (File::exists($zipPath)) {
                     File::delete($zipPath);
                 }
                 return redirect()->back()->with('error', 'Tidak ada file yang dapat didownload');
             }
 
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

    public function toggleVisibility(Request $request, $id)
    {
        $panduan = Panduan::findOrFail($id);

        if ($panduan->status === 'published') {
            $panduan->status = 'draft';
            $message = 'Panduan disembunyikan';
        } else {
            $panduan->status = 'published';
            $message = 'Regulasi ditampilkan';
        }

        $panduan->save();

        return response()->json([
            'success' => true,
            'message' => $message
        ]);
    }
}

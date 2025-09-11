<?php

namespace App\Http\Controllers\Admin\Dokumen;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Exports\KetetapanExport;
use App\Models\Dokumen\Ketetapan;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;

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
        
        // Pisahkan Multi Keyword
        $keywords = !empty($search) ? preg_split('/\s+/', (string) $search) : [];
        
        // Query builder awal
        $ketetapanQuery = Ketetapan::query();

        // Apply search jika ada
        if ($search) {
            $keywords = preg_split('/\s+/', trim($search));
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

        // Auto sorting: Tahun terbaru dulu, lalu tanggal dibuat terbaru
        $ketetapanQuery->orderByDesc('year_published')
                       ->orderByDesc('created_at');

        $allKetetapans = $ketetapanQuery->get();

        // Per-page validation
        if ($perPage === 'all') {
            $ketetapans = $ketetapanQuery->get();
            $perPage = max($ketetapans->count(), 1);
        } else {
            $perPage = max((int) $perPage, 1);
        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $allKetetapans->slice(($currentPage - 1) * $perPage, $perPage)->values();

        // Paginate
        $ketetapans = new LengthAwarePaginator(
            $currentItems,
            $allKetetapans->count(),
            $perPage,
            $currentPage,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );
        
        // AJAX response
        if ($request->ajax()) {
            return view('admin.Dokumen.Ketetapan.partials.table_body', compact('title', 'ketetapans'))->render();
        }

        // Render full view
        return view('admin.Dokumen.Ketetapan.index', compact('title', 'ketetapans'));
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
            'status'         => 'required|in:published,draft'
        ]);

        try {
            // Handle file upload
            $fileData = $this->handleFileUpload($request->file('file'));

            // Simpan ke database
            Ketetapan::create([
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
                ->with('success', 'Ketetapan berhasil ditambahkan.');

        } catch (\Exception $e) {
            Log::error('Error storing ketetapan: ' . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Gagal menambahkan ketetapan: ' . $e->getMessage())
                ->withInput();
        }
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Ketetapan $ketetapan)
    {
        return view('admin.Dokumen.Ketetapan.show', [
            'title' => 'Detail Ketetapan',
            'ketetapan' => $ketetapan
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($id);
        $ketetapan = Ketetapan::findOrFail($id);

        // Validasi input
        $request->validate([
            'title'          => 'required|string|max:255',
            'description'    => 'required|string',
            'file'           => 'nullable|file|mimes:pdf,doc,docx|max:10240', // opsional saat update
            'year_published' => 'nullable|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'status'         => 'required|in:published,draft,archived'
        ]);

        try {
            $fileData = [
                'file_path'         => $ketetapan->file_path,
                'original_filename' => $ketetapan->original_filename,
                'file_size'         => $ketetapan->file_size,
                'file_type'         => $ketetapan->file_type,
            ];

            // Jika ada file baru, hapus file lama dan simpan file baru
            if ($request->hasFile('file')) {
                if ($ketetapan->file_path && Storage::disk('public')->exists($ketetapan->file_path)) {
                    Storage::disk('public')->delete($ketetapan->file_path);
                }
                $fileData = $this->handleFileUpload($request->file('file'));
            }

            // Update data
            $ketetapan->update([
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
                ->with('success', 'Ketetapan berhasil diperbarui.');

        } catch (\Exception $e) {
            Log::error('Error updating ketetapan: ' . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Gagal memperbarui ketetapan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ketetapan = Ketetapan::findOrFail($id);

        try {
            if ($ketetapan->file_path && Storage::disk('public')->exists($ketetapan->file_path)) {
                Storage::disk('public')->delete($ketetapan->file_path);
            }

            $ketetapan->delete();

            return redirect()
                ->back()
                ->with('success', 'Ketetapan berhasil dihapus.');

        } catch (\Exception $e) {
            Log::error('Error deleting ketetapan: ' . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Gagal menghapus ketetapan: ' . $e->getMessage());
        }
    }

    /**
     * Handle bulk actions
     */
    public function bulk(Request $request)
    {
        $request->validate([
            'action' => 'required|in:published,draft,permanent_delete',
            'ids' => 'required|array',
            'ids.*' => 'exists:ketetapans,id'
        ]);

        $action = $request->input('action');
        $ids = $request->input('ids');

        try {
            if ($action === 'permanent_delete') {
                $ketetapans = Ketetapan::whereIn('id', $ids)->get();

                foreach ($ketetapans as $ketetapan) {
                    if ($ketetapan->file_path && Storage::disk('public')->exists($ketetapan->file_path)) {
                        Storage::disk('public')->delete($ketetapan->file_path);
                    }
                    $ketetapan->delete();
                }
                $message = 'Ketetapan berhasil dihapus permanen';
            } else {
                Ketetapan::whereIn('id', $ids)->update(['status' => $action]);

                $message = match ($action) {
                    'published' => 'Ketetapan berhasil dipublish ke halaman publik',
                    'draft' => 'Ketetapan berhasil disembunyikan dari halaman publik',
                    default => 'Status berhasil diubah',
                };
            }

            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            Log::error('Error bulk action: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function download(Ketetapan $ketetapan)
    {
        // Pastikan akses publik hanya untuk ketetapan published
        if (!Auth::check() && $ketetapan->status !== 'published') {
            abort(404, 'Dokumen tidak tersedia untuk publik');
        }

        if (!$ketetapan->file_path || !Storage::disk('public')->exists($ketetapan->file_path)) {
            abort(404, 'File tidak ditemukan');
        }

        $filePath = Storage::disk('public')->path($ketetapan->file_path);
        $downloadName = $ketetapan->original_filename ?? ($ketetapan->title . '.' . ($ketetapan->file_type ?? 'pdf'));

        Log::info('File downloaded', [
            'ketetapan_id' => $ketetapan->id,
            'title' => $ketetapan->title,
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
            'ids.*' => 'exists:ketetapans,id'
        ]);

        $ids = $request->input('ids');

        $query = Ketetapan::whereIn('id', $ids)->whereNotNull('file_path');

        if (!Auth::check()) {
            $query->where('status', 'published');
        }

        $ketetapans = $query->get();

        if ($ketetapans->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada file yang dapat didownload');
        }

        if ($ketetapans->count() === 1) {
            return $this->download($ketetapans->first());
        }

        return $this->createZipDownload($ketetapans);
    }

    private function createZipDownload($ketetapans)
    {
        $zip = new \ZipArchive();
        $zipFileName = 'ketetapan_' . date('Y-m-d_H-i-s') . '.zip';
        $zipPath = storage_path('app/temp/' . $zipFileName);

        if (!File::exists(storage_path('app/temp'))) {
            File::makeDirectory(storage_path('app/temp'), 0755, true);
        }

        if ($zip->open($zipPath, \ZipArchive::CREATE) === TRUE) {
            $fileCount = 0;

            foreach ($ketetapans as $ketetapan) {
                if (Storage::disk('public')->exists($ketetapan->file_path)) {
                    $filePath = Storage::disk('public')->path($ketetapan->file_path);
                    $fileName = $ketetapan->original_filename ?? ($ketetapan->title . '.pdf');

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
                'ketetapan_ids' => $ketetapans->pluck('id')->toArray(),
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
        $filePath = $file->storeAs('ketetapan_files', $filename, 'public');

        return [
            'file_path' => $filePath,
            'original_filename' => $originalName,
            'file_size' => $file->getSize(),
            'file_type' => $extension,
        ];
    }

    public function toggleVisibility(Request $request, $id)
    {
        $ketetapan = Ketetapan::findOrFail($id);

        if ($ketetapan->status === 'published') {
            $ketetapan->status = 'draft';
            $message = 'Ketetapan disembunyikan';
        } else {
            $ketetapan->status = 'published';
            $message = 'Ketetapan ditampilkan';
        }

        $ketetapan->save();

        return response()->json([
            'success' => true,
            'message' => $message
        ]);
    }

    public function export(Request $request)
    {
        $status = $request->query('filter'); // visible / hidden / all
        $search = $request->query('search'); // keyword

        // Kalau "all" atau kosong → jadikan null
        if (empty($status) || $status === 'all') {
            $status = null;
        }

        // Panggil KetetapanExport dengan parameter
        return (new KetetapanExport($status, $search))->export();
    }
}
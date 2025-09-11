<?php

namespace App\Http\Controllers\Admin\Dokumen;

use App\Exports\SopExport;
use App\Models\Dokumen\Sop;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;

class SopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'SOP';
        $search = $request->get('search');
        $filter = $request->get('filter', 'all');
        $perPage = $request->get('perPage', 10);

        // Pisahkan Multi Keyword
        $keywords = !empty($search) ? preg_split('/\s+/', (string) $search) : [];
        
        // Query builder awal
        $sopQuery = Sop::query();

        // Apply search jika ada
        if ($search) {
            $sopQuery->where(function ($q) use ($keywords) {
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
            $sopQuery->where('status', $filter);
        }

        // Auto sorting: Tahun terbaru dulu, lalu tanggal dibuat terbaru
        $sopQuery->orderByDesc('year_published')
                ->orderByDesc('created_at');

        // Ambil semua dulu untuk custom paginate
        $allSops = $sopQuery->get();

        // Per-page validation
        if ($perPage === 'all') {
            $perPage = max($allSops->count(), 1);
        } else {
            $perPage = max((int) $perPage, 1);
        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $allSops->slice(($currentPage - 1) * $perPage, $perPage)->values();

        // Paginate manual
        $sops = new LengthAwarePaginator(
            $currentItems,
            $allSops->count(),
            $perPage,
            $currentPage,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );

        // AJAX response
        if ($request->ajax()) {
            return view('admin.Dokumen.Sop.partials.table_body', compact('title', 'sops'))->render();
        }

        // Render full view
        return view('admin.Dokumen.Sop.index', compact('title', 'sops'));
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
            Sop::create([
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
                ->with('success', 'SOP berhasil ditambahkan.');

        } catch (\Exception $e) {
            Log::error('Error storing Sop: ' . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Gagal menambahkan SOP: ' . $e->getMessage())
                ->withInput();
        }
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Sop $sop)
    {
        return view('admin.Dokumen.Sop.show', [
            'title' => 'Detail Sop',
            'Sop' => $sop
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($id);
        $sop = Sop::findOrFail($id);

        $request->validate([
            'title'          => 'required|string|max:255',
            'description'    => 'required|string',
            'file'           => 'nullable|file|mimes:pdf,doc,docx|max:10240', // opsional saat update
            'year_published' => 'nullable|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'status'         => 'required|in:published,draft,archived'
        ]);

        try {
            $fileData = [
                'file_path'         => $sop->file_path,
                'original_filename' => $sop->original_filename,
                'file_size'         => $sop->file_size,
                'file_type'         => $sop->file_type,
            ];

            // Jika ada file baru, hapus file lama lalu upload baru
            if ($request->hasFile('file')) {
                if ($sop->file_path && Storage::disk('public')->exists($sop->file_path)) {
                    Storage::disk('public')->delete($sop->file_path);
                }
                $fileData = $this->handleFileUpload($request->file('file'));
            }

            // Update data
            $sop->update([
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
                ->with('success', 'SOP berhasil diperbarui.');

        } catch (\Exception $e) {
            Log::error('Error updating SOP: ' . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Gagal memperbarui SOP: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        // dd($request->all());
        // dd($id);
        $sop = Sop::findOrFail($id);
        $sop->delete();
        // Hapus file jika ada
        if ($sop->file_path && Storage::disk('public')->exists($sop->file_path)) {
            Storage::disk('public')->delete($sop->file_path);
        }
        return redirect()
            ->back()
            ->with('success', 'SOP berhasil dihapus.');
    }

    /**
     * Handle bulk actions
     */
    public function bulk(Request $request)
    {
        $request->validate([
            'action' => 'required|in:published,draft,archived,permanent_delete',
            'ids' => 'required|array',
            'ids.*' => 'exists:Sops,id'
        ]);

        $action = $request->input('action');
        $ids = $request->input('ids');

        try {
            if ($action === 'permanent_delete') {
                $sops = Sop::whereIn('id', $ids)->get();
                
                foreach ($sops as $sop) {
                    // Delete file if exists
                    if ($sop->file_path && Storage::disk('public')->exists($sop->file_path)) {
                        Storage::disk('public')->delete($sop->file_path);
                    }
                    
                    // Delete record
                    $sop->delete();
                }
                
                $message = 'Sop berhasil dihapus permanen';
            } else {
                Sop::whereIn('id', $ids)->update(['status' => $action]);
                
                $message = match($action) {
                    'published' => 'Sop berhasil dipublish ke halaman publik',
                    'draft' => 'Sop berhasil disembunyikan dari halaman publik',
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
    public function download(Sop $sop)
    {
        // Pastikan akses publik hanya untuk SOP published
        if (!Auth::check() && $sop->status !== 'published') {
            abort(404, 'Dokumen tidak tersedia untuk publik');
        }

        if (!$sop->file_path || !Storage::disk('public')->exists($sop->file_path)) {
            abort(404, 'File tidak ditemukan');
        }

        $filePath = Storage::disk('public')->path($sop->file_path);
        $downloadName = $sop->original_filename ?? ($sop->title . '.' . ($sop->file_type ?? 'pdf'));

        Log::info('File downloaded', [
            'sop_id' => $sop->id,
            'title' => $sop->title,
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
            'ids.*' => 'exists:sops,id'
        ]);

        $ids = $request->input('ids');

        $query = Sop::whereIn('id', $ids)->whereNotNull('file_path');

        if (!Auth::check()) {
            $query->where('status', 'published');
        }

        $sops = $query->get();

        if ($sops->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada file yang dapat didownload');
        }

        if ($sops->count() === 1) {
            return $this->download($sops->first());
        }

        return $this->createZipDownload($sops);
    }

    private function createZipDownload($sops)
    {
        $zip = new \ZipArchive();
        $zipFileName = 'sop_' . date('Y-m-d_H-i-s') . '.zip';
        $zipPath = storage_path('app/temp/' . $zipFileName);

        if (!File::exists(storage_path('app/temp'))) {
            File::makeDirectory(storage_path('app/temp'), 0755, true);
        }

        if ($zip->open($zipPath, \ZipArchive::CREATE) === TRUE) {
            $fileCount = 0;

            foreach ($sops as $sop) {
                if (Storage::disk('public')->exists($sop->file_path)) {
                    $filePath = Storage::disk('public')->path($sop->file_path);
                    $fileName = $sop->original_filename ?? ($sop->title . '.pdf');

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
                'sop_ids' => $sops->pluck('id')->toArray(),
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
        $filePath = $file->storeAs('Sop_files', $filename, 'public');

        return [
            'file_path' => $filePath,
            'original_filename' => $originalName,
            'file_size' => $file->getSize(),
            'file_type' => $extension,
        ];
    }

    public function toggleVisibility(Request $request, $id)
    {
        $sop = Sop::findOrFail($id);

        if ($sop->status === 'published') {
            $sop->status = 'draft';
            $message = 'SOP disembunyikan';
        } else {
            $sop->status = 'published';
            $message = 'SOP ditampilkan';
        }

        $sop->save();

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

        // Panggil SopExport dengan parameter
        return (new SopExport($status, $search))->export();
    }
}

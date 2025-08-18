<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class FaqController extends Controller
{
    /**
     * INDEX : daftar FAQ + search + filter + pagination
     */
    public function index(Request $request)
    {
        $title = 'FAQ';
        $search = $request->input('search', '');
        $filter = $request->query('filter', 'all');
        $perPage = $request->input('perPage', 10);

        // Pisahkan multi keyword
        $keywords = !empty($search) ? preg_split('/\s+/', (string) $search) : [];

        // Query builder awal
        $faqQuery = Faq::query();

        // Apply search jika ada
        if ($search) {
            $faqQuery->where(function ($q) use ($keywords) {
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
            $faqQuery->where('status', $filter);
        }

        // $faqQuery->where('visibility', true);

        // Merge results
        $merged = $faqQuery->get();

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

        $faqs = new LengthAwarePaginator(
            $currentItems,
            $merged->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        // AJAX Response di controller
        if ($request->ajax()) {
            return view('admin.faq.partials.table_body', compact('title', 'faqs'))->render();
        } 

        // Render full view    
        return view('admin.faq.index', compact('title', 'faqs'));
    }

    /**
     * STORE : simpan FAQ baru
     */
    public function store(Request $request)
    {
        // dd($request->all());

        // Validasi dan ambil data dari request
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'status' => 'in:draft,published,archived',
        ]);

        // Siapkan data untuk disimpan
        Faq::create([
            'question' => $request->input('question'),
            'answer' => $request->input('answer'),
            'status' => $request->input('status', 'draft'), // Default ke draft
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()
               ->route('admin.faq.index')
               ->with('success', 'FAQ berhasil ditambahkan sebagai draft!');
    }

    /**
     * UPDATE : perbarui FAQ
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all()); // Untuk debug, bisa dihapus nanti

        // Cari FAQ berdasarkan ID
        $faq = Faq::findOrFail($id);

        // Jika data tidak valid, kembalikan error
        if (!$faq) {
            return redirect()
                   ->route('admin.faq.index')
                   ->withErrors(['error' => 'FAQ tidak ditemukan.']);
        }

        // Validasi data yang diterima
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'status' => 'in:draft,published',
        ]);

        // Update data FAQ
        $faq->update([
            'question' => $request->input('question'),
            'answer' => $request->input('answer'),
            'status' => $request->input('status', 'draft'), // Default ke draft
        ]);

        // Redirect ke halaman index dengan pesan sukses

        return redirect()
               ->route('admin.faq.index')
               ->with('success', 'FAQ berhasil diperbarui!');
    }

    /**
     * DESTROY : hapus satu FAQ (soft delete ke archived)
     */
    public function destroy($id)
    {
        // dd($id); // uncomment untuk debug
        // Cari data berdasarkan ID
        $faq = Faq::findOrFail($id);
        // Jika data tidak valid, kembalikan error
        if (!$faq) {
            return redirect()
                   ->route('admin.faq.index')
                   ->withErrors(['error' => 'FAQ tidak ditemukan.']);
        }
        // Delete FAQ
        $faq->delete();
        // Redirect ke halaman index dengan pesan sukses
        return redirect()
               ->route('admin.faq.index')
               ->with('success', 'FAQ berhasil diarsipkan!');
    }
    
    // public function destroy(Faq $faq)
    // {
    //     $faq->update(['status' => 'archived']);

    //     return redirect()
    //            ->route('admin.faq.index')
    //            ->with('success', 'FAQ berhasil diarsipkan!');
    // }

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
                $deletedCount = Faq::whereIn('id', $ids)->delete();
                $message = "{$deletedCount} FAQ berhasil dihapus permanen.";
                break;
                
            case 'delete':
                // Soft delete: ubah status ke archived
                $archivedCount = Faq::whereIn('id', $ids)->update(['status' => 'archived']);
                $message = "{$archivedCount} FAQ berhasil diarsipkan.";
                break;
                
            case 'published':
            case 'draft':
            case 'archived':
                $updatedCount = Faq::whereIn('id', $ids)->update(['status' => $action]);
                $statusText = match($action) {
                    'published' => 'Published',
                    'draft' => 'Draft',
                    'archived' => 'Archived'
                };
                $message = "{$updatedCount} FAQ berhasil diubah ke status {$statusText}.";
                break;
                
            default:
                return back()->with('error', 'Aksi tidak valid.');
        }

        return back()->with('success', $message);
    }

    /**
     * OPTIONAL : halaman/partial konfirmasi delete
     */
    public function delete(Faq $faq)
    {
        $title = 'Hapus FAQ';
        return view('admin.faq.delete', compact('title', 'faq'));
    } 
    public function updateVisibility(Request $request)
    {
        $id = $request->input('id');
        $visibility = filter_var($request->input('visibility'), FILTER_VALIDATE_BOOLEAN);
    
        $faq = Faq::findOrFail($id);
        // Update visibility tanpa mengubah status
        $faq->visibility = $visibility;
        $faq->save();
    
        return redirect()->back()->with('success', 'Visibility FAQ berhasil diperbarui!');
    }
}

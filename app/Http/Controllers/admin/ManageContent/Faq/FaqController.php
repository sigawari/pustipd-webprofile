<?php

namespace App\Http\Controllers\Admin\ManageContent\Faq;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFaqRequest;
use App\Http\Requests\UpdateFaqRequest;
use App\Models\ManageContent\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * INDEX : daftar FAQ + search + filter + pagination
     */
    public function index(Request $request)
    {
        $title = 'FAQ';
        $query = Faq::query();
    
        // Search
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('question', 'like', "%{$search}%")
                  ->orWhere('answer', 'like', "%{$search}%");
            });
        }
    
        // Filter status
        if (($status = $request->input('filter')) && $status !== 'all') {
            $query->where('status', $status);
        }
    
        // Per-page validation
        $perPageOptions = ['10', '25', '50', 'all'];
        $perPageInput = $request->input('perPage', '10');
        
        if (!in_array($perPageInput, $perPageOptions)) {
            $perPageInput = '10';
        }
    
        // Calculate per page
        if ($perPageInput === 'all') {
            $perPage = max(1, (clone $query)->count());
        } else {
            $perPage = (int) $perPageInput;
        }
    
        // Get paginated results
        $faqs = $query->orderBy('sort_order')
                      ->paginate($perPage)
                      ->appends($request->all());
    
        // AJAX Response di controller
        if ($request->ajax()) {
            return response()->json([
                'html' => view('admin.manage-content.faq.partials.table_body', compact('faqs'))->render(),
                'pagination' => [
                    'current_page' => $faqs->currentPage(),
                    'last_page' => $faqs->lastPage(),
                    'total' => $faqs->total(),
                    'from' => $faqs->firstItem(),
                    'to' => $faqs->lastItem(),
                    'has_more_pages' => $faqs->hasMorePages(),
                    'on_first_page' => $faqs->onFirstPage(),
                ]
            ]);
        }
    
        return view('admin.manage-content.faq.index', compact('title', 'faqs'));
    }    

    /**
     * CREATE : tampilkan form modal/page tambah
     */
    public function create()
    {
        $title = 'Tambah FAQ';
        return view('admin.manage-content.faq.create', compact('title'));
    }

    /**
     * STORE : simpan FAQ baru
     */
    public function store(StoreFaqRequest $request)
    {
        $data = $request->validated();
        
        // Jika sort_order kosong, buat otomatis (nomor paling akhir + 1)
        if (!isset($data['sort_order']) || $data['sort_order'] === null) {
            $data['sort_order'] = (Faq::max('sort_order') ?? 0) + 1;
        }
        
        Faq::create($data);

        return redirect()
               ->route('admin.manage-content.faq.index')
               ->with('success', 'FAQ berhasil ditambahkan sebagai draft!');
    }

    /**
     * EDIT : tampilkan form modal/page edit
     */
    public function edit(Faq $faq)
    {
        $title = 'Edit FAQ';
        return view('admin.manage-content.faq.update', compact('title', 'faq'));
    }

    /**
     * UPDATE : perbarui FAQ
     */
    public function update(UpdateFaqRequest $request, Faq $faq)
    {
        $data = $request->validated();
        
        // Jika sort_order kosong, pertahankan yang lama atau buat baru
        if (!isset($data['sort_order']) || $data['sort_order'] === null) {
            $data['sort_order'] = $faq->sort_order ?: ((Faq::max('sort_order') ?? 0) + 1);
        }
        
        $faq->update($data);

        return redirect()
               ->route('admin.manage-content.faq.index')
               ->with('success', 'FAQ berhasil diperbarui!');
    }

    /**
     * DESTROY : hapus satu FAQ (soft delete ke archived)
     */
    public function destroy(Faq $faq)
    {
        $faq->update(['status' => 'archived']);

        return redirect()
               ->route('admin.manage-content.faq.index')
               ->with('success', 'FAQ berhasil diarsipkan!');
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
        return view('admin.manage-content.faq.delete', compact('title', 'faq'));
    }
}

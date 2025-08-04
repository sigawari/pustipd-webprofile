<?php

namespace App\Http\Controllers\Admin\ManageContent\Faq;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFaqRequest;
use App\Http\Requests\UpdateFaqRequest;
use App\Models\ManageContent\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /* =============================================================
     *  INDEX : daftar FAQ + pencarian + filter + pagination
     * =========================================================== */
    public function index(Request $request)
    {
        $title = 'FAQ';

        $query = Faq::query();

        /* ----- search ----- */
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('question', 'like', "%{$search}%")
                  ->orWhere('answer',   'like', "%{$search}%");
            });
        }

        /* ----- status filter ----- */
        if (($status = $request->input('filter')) && $status !== 'all') {
            $query->where('status', $status);
        }

        /* ----- pagination ----- */
        $perPage = $request->input('perPage') === 'all'
                   ? ($query->count() ?: 1)                // hindari 0
                   : (int) $request->input('perPage', 10);

        $faqs = $query->orderBy('sort_order')
                      ->paginate($perPage)
                      ->appends($request->all());

        return view('admin.manage-content.faq.index', compact('title', 'faqs'));
    }

    /* =============================================================
     *  CREATE : tampilkan modal / halaman tambah
     * =========================================================== */
    public function create()
    {
        $title = 'Tambah FAQ';
        return view('admin.manage-content.faq.create', compact('title'));
    }

    /* =============================================================
     *  STORE : simpan FAQ baru
     * =========================================================== */
    public function store(StoreFaqRequest $request)
    {
        Faq::create($request->validated());

        return redirect()
               ->route('admin.manage-content.faq.index')
               ->with('success', 'FAQ berhasil ditambahkan!');
    }

    /* =============================================================
     *  EDIT  : tampilkan form edit
     * =========================================================== */
    public function edit(Faq $faq)
    {
        $title = 'Edit FAQ';
        return view('admin.manage-content.faq.update', compact('title', 'faq'));
    }

    /* =============================================================
     *  UPDATE : perbarui data
     * =========================================================== */
    public function update(UpdateFaqRequest $request, Faq $faq)
    {
        $faq->update($request->validated());

        return redirect()
               ->route('admin.manage-content.faq.index')
               ->with('success', 'FAQ berhasil diperbarui!');
    }

    /* =============================================================
     *  DESTROY : hapus satu FAQ
     * =========================================================== */
    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()
               ->route('admin.manage-content.faq.index')
               ->with('success', 'FAQ berhasil dihapus!');
    }

    /* =============================================================
     *  BULK ACTION : publish / draft / archive / delete
     * =========================================================== */
    public function bulk(Request $request)
    {
        $ids    = $request->input('ids', []);
        $action = $request->input('action');

        if (!$ids || !$action) {
            return back()->with('error', 'Data atau aksi tidak valid.');
        }

        match ($action) {
            'delete'                    => Faq::whereIn('id', $ids)->delete(),
            'publish', 'draft', 'archive' => Faq::whereIn('id', $ids)->update(['status' => $action]),
            default                     => null,
        };

        return back()->with('success', 'Bulk action berhasil diproses!');
    }

    /* =============================================================
     *  OPTIONAL : halaman konfirmasi delete
     * =========================================================== */
    public function delete(Faq $faq)
    {
        $title = 'Hapus FAQ';
        return view('admin.manage-content.faq.delete', compact('title', 'faq'));
    }
}

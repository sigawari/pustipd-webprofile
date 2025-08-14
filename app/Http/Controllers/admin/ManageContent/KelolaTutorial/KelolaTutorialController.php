<?php
// app/Http/Controllers/Admin/ManageContent/KelolaTutorial/KelolaTutorialController.php

namespace App\Http\Controllers\Admin\ManageContent\KelolaTutorial;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\ManageContent\KelolaTutorial\KelolaTutorial;

class KelolaTutorialController extends Controller
{
    public function index(Request $request)
    {
        $title = "Tutorial";
        $search = $request->input('search', '');
        $filter = $request->query('filter', 'all');
        $perPage = $request->input('perPage', 10);

        // Query builder awal
        $kelolaTutorialQuery = KelolaTutorial::query();

        // ✅ FIXED: Search dengan field yang benar
        if ($search) {
            $keywords = preg_split('/\s+/', trim($search));
            $kelolaTutorialQuery->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->where(function ($q) use ($word) {
                        $q->where('title', 'like', "%{$word}%")
                          ->orWhere('description', 'like', "%{$word}%")  // ✅ PERBAIKI: gunakan description, bukan content
                          ->orWhere('category', 'like', "%{$word}%");
                    });
                }
            });
        }

        // Filter status
        if ($filter && $filter !== 'all') {
            $kelolaTutorialQuery->where('status', $filter);
        }

        $kelolaTutorialQuery->orderBy('created_at', 'desc');

        $merged = $kelolaTutorialQuery->get();

        // Per-page logic tetap sama
        if ($perPage === 'all') {
            $perPage = max($merged->count(), 1);
        } else {
            $perPage = (int) $perPage;
            if ($perPage < 1) {
                $perPage = 1;
            }
        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $merged->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $kelolaTutorials = new LengthAwarePaginator(
            $currentItems,
            $merged->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        // AJAX Response
        if ($request->ajax()) {
            return view('admin.manage-content.tutorial.partials.table_body', compact('kelolaTutorials'));
        }

        return view('admin.manage-content.tutorial.kelolatutorial', compact('title', 'kelolaTutorials'));
    }

    // ✅ PERBAIKI: Store method untuk tutorial dengan content blocks
    public function store(Request $request)
    {
        // Debug untuk melihat data yang masuk
        \Log::info('Tutorial store request:', $request->all());

        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:kelola_tutorials,slug',
            'category' => 'required|in:web_development,database,server_management,security,technology,academic_services,library_resources',
            'published_at' => 'required|date',
            'status' => 'required|in:draft,published',
            'description' => 'nullable|string',
            'content_blocks' => 'required|array|min:1',
            'content_blocks.*.type' => 'required|in:step,tip',
            'content_blocks.*.title' => 'required_if:content_blocks.*.type,step|string',
            'content_blocks.*.content' => 'required|string',
            'content_blocks.*.tip_type' => 'required_if:content_blocks.*.type,tip|string',
            'content_blocks.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            // ✅ Simpan tutorial utama ke tabel kelola_tutorials
            $kelolaTutorial = KelolaTutorial::create([
                'title' => $request->title,
                'slug' => $request->slug,
                'description' => $request->description,
                'category' => $request->category,
                'published_at' => $request->published_at,
                'status' => $request->status,
                'view_count' => 0,
            ]);

            // ✅ Simpan content blocks (untuk sementara kita simpan sebagai JSON di field terpisah)
            // Nanti bisa dipindah ke tabel terpisah jika dibutuhkan
            $contentBlocks = [];
            
            foreach ($request->content_blocks as $blockId => $block) {
                $contentBlock = [
                    'id' => $blockId,
                    'type' => $block['type'],
                    'order' => $block['order'] ?? count($contentBlocks) + 1,
                    'title' => $block['title'] ?? null,
                    'content' => $block['content'],
                    'tip_type' => $block['tip_type'] ?? null,
                ];

                // Handle image upload jika ada
                if (isset($block['image']) && $request->hasFile("content_blocks.{$blockId}.image")) {
                    $image = $request->file("content_blocks.{$blockId}.image");
                    $imageName = time() . '_' . $blockId . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('uploads/tutorial-images'), $imageName);
                    $contentBlock['image'] = 'uploads/tutorial-images/' . $imageName;
                }

                $contentBlocks[] = $contentBlock;
            }

            // Simpan content blocks sebagai JSON (sementara)
            // Jika Anda ingin tabel terpisah, buat migration tutorial_contents
            $kelolaTutorial->update([
                'content_blocks' => json_encode($contentBlocks)
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Tutorial berhasil disimpan!',
                'redirect' => route('admin.manage-content.tutorial.kelolatutorial')
            ]);

        } catch (\Exception $e) {
            \Log::error('Error storing tutorial:', ['error' => $e->getMessage()]);
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan tutorial: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, KelolaTutorial $kelolaTutorial)
    {
        // ✅ PERBAIKI: Update method sesuai struktur database tutorial
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:kelola_tutorials,slug,' . $kelolaTutorial->id,
            'category' => 'required|in:web_development,database,server_management,security,technology,academic_services,library_resources',
            'published_at' => 'required|date',
            'status' => 'required|in:draft,published',
            'description' => 'nullable|string',
            'content_blocks' => 'required|array|min:1',
        ]);

        try {
            // Update tutorial utama
            $kelolaTutorial->update([
                'title' => $request->title,
                'slug' => $request->slug,
                'description' => $request->description,
                'category' => $request->category,
                'published_at' => $request->published_at,
                'status' => $request->status,
            ]);

            // Update content blocks
            $contentBlocks = [];
            foreach ($request->content_blocks as $blockId => $block) {
                $contentBlock = [
                    'id' => $blockId,
                    'type' => $block['type'],
                    'order' => $block['order'] ?? count($contentBlocks) + 1,
                    'title' => $block['title'] ?? null,
                    'content' => $block['content'],
                    'tip_type' => $block['tip_type'] ?? null,
                ];

                // Handle image upload untuk update
                if (isset($block['image']) && $request->hasFile("content_blocks.{$blockId}.image")) {
                    $image = $request->file("content_blocks.{$blockId}.image");
                    $imageName = time() . '_' . $blockId . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('uploads/tutorial-images'), $imageName);
                    $contentBlock['image'] = 'uploads/tutorial-images/' . $imageName;
                }

                $contentBlocks[] = $contentBlock;
            }

            $kelolaTutorial->update([
                'content_blocks' => json_encode($contentBlocks)
            ]);

            return redirect()
                ->route('admin.manage-content.tutorial.kelolatutorial')
                ->with('success', 'Tutorial berhasil diperbarui!');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui tutorial: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(KelolaTutorial $kelolaTutorial)
    {
        try {
            // Hapus gambar-gambar tutorial jika ada
            if ($kelolaTutorial->content_blocks) {
                $contentBlocks = json_decode($kelolaTutorial->content_blocks, true);
                foreach ($contentBlocks as $block) {
                    if (isset($block['image']) && file_exists(public_path($block['image']))) {
                        unlink(public_path($block['image']));
                    }
                }
            }

            $kelolaTutorial->delete();

            return redirect()
                ->route('admin.manage-content.tutorial.kelolatutorial')
                ->with('success', 'Tutorial berhasil dihapus!');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat menghapus tutorial: ' . $e->getMessage());
        }
    }

    // ✅ PERBAIKI: Bulk action method
    public function bulk(Request $request)
    {
        $request->validate([
            'action' => 'required|in:published,draft,delete',
            'ids' => 'required|array',
            'ids.*' => 'exists:kelola_tutorials,id'
        ]);

        $ids = $request->ids;
        $action = $request->action;

        try {
            switch ($action) {
                case 'published':
                    KelolaTutorial::whereIn('id', $ids)->update(['status' => 'published']);
                    $message = 'Tutorial berhasil dipublish';
                    break;
                case 'draft':
                    KelolaTutorial::whereIn('id', $ids)->update(['status' => 'draft']);
                    $message = 'Tutorial berhasil diubah ke draft';
                    break;
                case 'delete':
                    // Hapus gambar-gambar sebelum hapus tutorial
                    $kelolaTutorials = KelolaTutorial::whereIn('id', $ids)->get();
                    foreach ($kelolaTutorials as $tutorial) {
                        if ($tutorial->content_blocks) {
                            $contentBlocks = json_decode($tutorial->content_blocks, true);
                            foreach ($contentBlocks as $block) {
                                if (isset($block['image']) && file_exists(public_path($block['image']))) {
                                    unlink(public_path($block['image']));
                                }
                            }
                        }
                    }
                    KelolaTutorial::whereIn('id', $ids)->delete();
                    $message = 'Tutorial berhasil dihapus';
                    break;
            }

            return response()->json([
                'success' => true,
                'message' => $message
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}

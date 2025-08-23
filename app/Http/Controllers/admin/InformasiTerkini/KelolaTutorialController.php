<?php

namespace App\Http\Controllers\Admin\InformasiTerkini;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Models\InformasiTerkini\KelolaTutorial;
use Illuminate\Pagination\LengthAwarePaginator;

class KelolaTutorialController extends Controller
{
    public function index(Request $request)
    {
        $title = "Tutorial";
        $search = $request->input('search', '');
        $status = $request->input('status'); // Published / Draft
        $category = $request->input('category'); // dari categoryFilter
        $featured = $request->input('featured', null); // Featured filter
        $perPage = $request->input('perPage', 10);

        $kelolaTutorialQuery = KelolaTutorial::query();

        // Filter status
        if ($status) {
            $kelolaTutorialQuery->where('status', $status);
        }

        // Filter kategori
        if ($category) {
            $kelolaTutorialQuery->where('category', $category);
        }

        // Filter featured
        if (!is_null($featured)) {
            $kelolaTutorialQuery->where('is_featured', (bool) $featured);
        }

        // Search
        if ($search) {
            $kelolaTutorialQuery->search($search);
        }

        // Order by date terbaru
        $kelolaTutorialQuery->orderByDesc('date');

        // Ambil semua data dulu
        $all = $kelolaTutorialQuery->get();

        // Atur perPage
        if ($perPage === 'all') {
            $perPage = max($all->count(), 1);
        } else {
            $perPage = max((int) $perPage, 1);
        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $all->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $kelolaTutorials = new LengthAwarePaginator(
            $currentItems,
            $all->count(),
            $perPage,
            $currentPage,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );

        if ($request->ajax()) {
            return view('admin.InformasiTerkini.Tutorial.partials.table_body', compact('kelolaTutorials'));
        }

        return view('admin.InformasiTerkini.Tutorial.index', compact('title', 'kelolaTutorials'));
    }


    public function store(Request $request)
    {
        // dd($request->all());

        Log::info('Tutorial store request:', $request->all());

        $request->validate([
            'title' => 'required|string|max:400',
            'slug' => 'required|string|unique:kelola_tutorials,slug',
            'category' => 'required|in:sistem_informasi_akademik,e_learning,layanan_digital_mahasiswa,pengelolaan_data_akun,jaringan_konektivitas,software_aplikasi,keamanan_digital,penelitian_akademik,layanan_publik',
            'date' => 'required|date', // Ubah dari published_at ke date
            'status' => 'required|in:draft,published',
            'excerpt' => 'nullable|string', // Ubah dari description ke excerpt
            'tags' => 'nullable|array',
            'is_featured' => 'nullable|boolean',
            'content_blocks' => 'required|array|min:1',
            'content_blocks.*.type' => 'required|in:step,tip',
            'content_blocks.*.title' => 'required_if:content_blocks.*.type,step|string',
            'content_blocks.*.content' => 'required|string',
            'content_blocks.*.tip_type' => 'required_if:content_blocks.*.type,tip|string',
            'content_blocks.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
        ]);

        try {
            // Process content blocks
            $contentBlocks = [];
            
            foreach ($request->content_blocks as $index => $block) {
                $contentBlock = [
                    'id' => $index,
                    'type' => $block['type'],
                    'order' => $block['order'] ?? $index + 1,
                    'title' => $block['title'] ?? null,
                    'content' => $block['content'],
                    'tip_type' => $block['tip_type'] ?? null,
                ];

                // Handle image upload jika ada
                if (isset($block['image']) && $request->hasFile("content_blocks.{$index}.image")) {
                    $image = $request->file("content_blocks.{$index}.image");
                    $imageName = time() . '_' . $index . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('uploads/tutorial-images'), $imageName);
                    $contentBlock['image'] = 'uploads/tutorial-images/' . $imageName;
                }

                $contentBlocks[] = $contentBlock;
            }

            // Create tutorial
            KelolaTutorial::create([
                'title'         => $request->title,
                'slug'          => $request->slug,
                'excerpt'       => $request->excerpt,
                'category'      => $request->category,
                'date'          => $request->date,
                'status'        => $request->status,
                'tags'          => $request->tags,
                'is_featured'   => $request->boolean('is_featured'),
                'is_hidden'     => $request->boolean('is_hidden', false),
                'content_blocks'=> $contentBlocks,
            ]);
            

            return redirect()
                ->back()
                ->with('success', 'Tutorial berhasil dibuat.');

        } catch (\Exception $e) {
            Log::error('Error storing tutorial:', ['error' => $e->getMessage()]);
            
            return redirect()
                ->back()
                ->with('error', 'Gagal membuat Tutorial: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $kelolaTutorials = KelolaTutorial::findOrFail($id);

        // 1. Validasi input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:kelola_tutorials,slug,' . $kelolaTutorials->id,
            'category' => 'required|string|max:255',
            'date' => 'nullable|date',
            'status' => 'required|in:draft,published',
            'excerpt' => 'nullable|string|max:500',
            'tags' => 'nullable|string|max:255',
            'is_featured' => 'nullable|boolean',
            'is_hidden' => 'nullable|boolean',
            'featured_image' => 'nullable|image|max:2048',
            'media_files.*' => 'nullable|file|max:5120', // max 5MB
            'content_blocks' => 'nullable|array',
            'content_blocks.*.title' => 'nullable|string|max:255',
            'content_blocks.*.content' => 'nullable|string',
            'content_blocks.*.image' => 'nullable|image|max:2048',
        ]);

        // 2. Ambil field utama
        $data = $request->only([
            'title',
            'slug',
            'category',
            'status',
            'excerpt',
        ]);

        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_hidden']   = $request->boolean('is_hidden', false);

        // 3. Tags → ubah string jadi array
        $data['tags'] = $request->filled('tags')
            ? array_map('trim', explode(',', $request->tags))
            : [];

        // 4. Handle featured image
        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('tutorials/featured', 'public');
            $data['featured_image'] = 'storage/' . $path;
        }

        // 5. Handle media files (multiple)
        if ($request->hasFile('media_files')) {
            $files = [];
            foreach ($request->file('media_files') as $file) {
                $files[] = 'storage/' . $file->store('tutorials/media', 'public');
            }
            $data['media_files'] = $files;
        }

        // 6. Handle content_blocks
        $blocks = [];
        if ($request->has('content_blocks')) {
            foreach ($request->content_blocks as $blockId => $block) {
                $blockData = [
                    'title'   => $block['title'] ?? null,
                    'content' => $block['content'] ?? null,
                ];

                if (isset($block['image']) && $block['image'] instanceof \Illuminate\Http\UploadedFile) {
                    $path = $block['image']->store('tutorials', 'public');
                    $blockData['image'] = 'storage/' . $path;
                } else {
                    $existingBlocks = $kelolaTutorials->content_blocks ?? [];
                    if (isset($existingBlocks[$blockId]['image'])) {
                        $blockData['image'] = $existingBlocks[$blockId]['image'];
                    }
                }

                $blocks[$blockId] = $blockData; // ✅ jangan numerik, simpan pakai key blockId
            }
        }
        $data['content_blocks'] = $blocks;

        // 7. Update tutorial
        $kelolaTutorials->update($data);

        return redirect()
            ->back()
            ->with('success', 'Tutorial berhasil diperbarui!');
    }

    public function destroy(Request $request, $id)
    {
        // dd($id);
        $kelolaTutorials = KelolaTutorial::findOrFail($id);
        // Hapus gambar-gambar terkait
        foreach ($kelolaTutorials->getContentBlocks() as $block) {
            if (isset($block['image']) && File::exists(public_path($block['image']))) {
                File::delete(public_path($block['image']));
            }
        }
        $kelolaTutorials->delete();
        return redirect()
            ->back()
            ->with('success', 'Tutorial berhasil dihapus.');
    
    }


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
                    $tutorials = KelolaTutorial::whereIn('id', $ids)->get();
                    foreach ($tutorials as $tutorial) {
                        foreach ($tutorial->getContentBlocks() as $block) {
                            if (isset($block['image']) && File::exists(public_path($block['image']))) {
                                File::delete(public_path($block['image']));
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

    public function toggleHide(Request $request, KelolaTutorial $kelolatutorial)
    {
        try {
            $kelolatutorial->is_hidden = !$kelolatutorial->is_hidden;
            $kelolatutorial->save();
    
            return response()->json([
                'success' => true,
                'message' => $kelolatutorial->is_hidden ? 'Tutorial disembunyikan' : 'Tutorial ditampilkan',
                'is_hidden' => $kelolatutorial->is_hidden,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
    

}

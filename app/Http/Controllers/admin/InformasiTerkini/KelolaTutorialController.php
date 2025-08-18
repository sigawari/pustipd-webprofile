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
        $filter = $request->query('filter', 'all');
        $featured = $request->query('featured', null);
        $perPage = $request->input('perPage', 10);
        $status = $request->input('status');

        $kelolaTutorialQuery = KelolaTutorial::query();

        // Filter status
        if ($status) {
            $kelolaTutorialQuery->where('status', $status);
        }

        // Filter is_hidden (tambahkan agar jelas)
        if ($request->has('is_hidden')) {
            $kelolaTutorialQuery->where('is_hidden', $request->boolean('is_hidden'));
        }


        if ($search) {
            $kelolaTutorialQuery->search($search);
        }

        if ($filter && $filter !== 'all') {
            $kelolaTutorialQuery->where('status', $filter);
        }

        if (!is_null($featured)) {
            $kelolaTutorialQuery->where('is_featured', ($featured == 1));
        }

        // Order by created_at desc
        $kelolaTutorialQuery->orderBy('date', 'desc');

        $merged = $kelolaTutorialQuery->get();

        if ($perPage === 'all') {
            $perPage = max($merged->count(), 1);
        } else {
            $perPage = (int) $perPage;
            if ($perPage < 1) $perPage = 1;
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
            'content_blocks.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
                'view_count'    => 0,
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
        $tutorial = KelolaTutorial::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:kelola_tutorials,slug,' . $tutorial->id,
            'category' => 'required|in:sistem_informasi_akademik,e_learning,layanan_digital_mahasiswa,pengelolaan_data_akun,jaringan_konektivitas,software_aplikasi,keamanan_digital,penelitian_akademik,layanan_publik',
            'date' => 'required|date',
            'status' => 'required|in:draft,published',
            'excerpt' => 'nullable|string',
            'tags' => 'nullable|array',
            'is_featured' => 'nullable|boolean',
            'content_blocks' => 'required|array|min:1',
            'content_blocks.*.type' => 'required|in:step,tip',
            'content_blocks.*.title' => 'required_if:content_blocks.*.type,step|string',
            'content_blocks.*.content' => 'required|string',
            'content_blocks.*.tip_type' => 'required_if:content_blocks.*.type,tip|string',
            'content_blocks.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
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

                // Handle image upload
                if (isset($block['image']) && $request->hasFile("content_blocks.{$index}.image")) {
                    // Hapus file lama jika ada
                    $oldBlocks = $tutorial->getContentBlocks();
                    if (isset($oldBlocks[$index]['image']) && File::exists(public_path($oldBlocks[$index]['image']))) {
                        File::delete(public_path($oldBlocks[$index]['image']));
                    }

                    $image = $request->file("content_blocks.{$index}.image");
                    $imageName = time() . '_' . $index . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('uploads/tutorial-images'), $imageName);
                    $contentBlock['image'] = 'uploads/tutorial-images/' . $imageName;
                } else {
                    // Pertahankan gambar lama jika tidak diupload baru
                    $oldBlocks = $tutorial->getContentBlocks();
                    if (isset($oldBlocks[$index]['image'])) {
                        $contentBlock['image'] = $oldBlocks[$index]['image'];
                    }
                }

                $contentBlocks[] = $contentBlock;
            }

            $tutorial->update([
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
                ->with('success', 'Tutorial berhasil diupdate.');

        } catch (\Exception $e) {
            Log::error('Error updating tutorial:', ['error' => $e->getMessage()]);

            return redirect()
                ->back()
                ->with('error', 'Gagal meng-update tutorial: ' . $e->getMessage());
        }
    }

    public function destroy(Request $request, $id)
    {
        // dd($id);
        $kelolaTutorial = KelolaTutorial::findOrFail($id);
        // Hapus gambar-gambar terkait
        foreach ($kelolaTutorial->getContentBlocks() as $block) {
            if (isset($block['image']) && File::exists(public_path($block['image']))) {
                File::delete(public_path($block['image']));
            }
        }
        $kelolaTutorial->delete();
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

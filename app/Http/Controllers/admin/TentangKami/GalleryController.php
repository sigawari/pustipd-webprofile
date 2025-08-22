<?php

namespace App\Http\Controllers\admin\TentangKami;

use Illuminate\Http\Request;
use App\Models\TentangKami\Gallery;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateGalleryRequest;
use Illuminate\Pagination\LengthAwarePaginator;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Gallery';
        $search = $request->input('search', '');
        $filter = $request->query('filter', 'all');
        $perPage = $request->input('perPage', 10);

        // Pisahkan multi keyword
        $keywords = !empty($search) ? preg_split('/\s+/', (string) $search) : [];

        // Query builder awal
        $galleryQuery = Gallery::query();

        // Apply search jika ada
        if ($search) {
            $galleryQuery->where(function ($q) use ($keywords) {
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
            $galleryQuery->where('status', $filter);
        }

        // Merge results
        $merged = $galleryQuery->get();

        // Per-page validation
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

        $galleries = new LengthAwarePaginator(
            $currentItems,
            $merged->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        // AJAX Response
        if ($request->ajax()) {
            return view('admin.TentangKami.Gallery.partials.table_body', compact('title', 'galleries', 'keywords', 'filter'))->render();
        }

        // Render the main view
        return view('admin.TentangKami.Gallery.index', compact('title', 'galleries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'event_date' => 'required|date',
        ]);

        // Handle image upload dengan nama yang unique
        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $imagePath = $file->storeAs('gallery', $filename, 'public');
        }

        Gallery::create([
            'title' => $request->title,
            'image' => $imagePath,
            'event_date' => $request->event_date,
            'status' => 'draft',
        ]);

        return redirect()->back()->with('success', 'Gambar berhasil disimpan sebagai draft!');
    }


    public function update(UpdateGalleryRequest $request, Gallery $gallery)
    {
        // dd($request->all()); // uncomment untuk debug
        $data = $request->validated();
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
                Storage::disk('public')->delete($gallery->image);
            }
            
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('gallery', $imageName, 'public');
            $data['image'] = $imagePath;
        }
    
        
        $gallery->update($data);

        return redirect()
               ->route('admin.tentang-kami.gallery.index')
               ->with('success', 'Gambar berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // dd($id); // uncomment untuk debug
        // Cari gallery berdasarkan ID
        $gallery = Gallery::findOrFail($id);
        // Hapus file gambar jika ada
        if (!$gallery) {
            return redirect()->route('admin.tentang-kami.gallery.index')->with('error', 'Gambar tidak ditemukan.');
        }
        // Hapus gallery
        $gallery->delete();

        return redirect()
               ->route('admin.tentang-kami.gallery.index')
               ->with('success', 'Gambar berhasil dihapus!');
    }

    public function bulk(Request $request)
    {
        $request->validate([
            'action' => 'required|in:published,draft,permanent_delete',
            'ids' => 'required|array|min:1',
            'ids.*' => 'exists:galleries,id'
        ]);
    
        $action = $request->action;
        $ids = $request->ids;
    
        try {
            switch ($action) {
                case 'published':
                case 'draft':                  
                case 'permanent_delete':
                    $galleries = Gallery::whereIn('id', $ids)->get();
                    $deletedCount = 0;
                    
                    foreach ($galleries as $gallery) {
                        // Delete image file
                        if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
                            Storage::disk('public')->delete($gallery->image);
                        }
                        $gallery->delete();
                        $deletedCount++;
                    }
                    $message = "Berhasil menghapus {$deletedCount} gallery secara permanen";
                    break;
            }
    
            // Support both AJAX and regular form submission
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => $message
                ]);
            }
    
            return redirect()
                   ->route('admin.tentang-kami.gallery.index')
                   ->with('success', $message);
                   
        } catch (\Exception $e) {
            // Error handling
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ], 500);
            }
    
            return redirect()
                   ->route('admin.tentang-kami.gallery.index')
                   ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

   public function toggleVisibility(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        if ($gallery->status === 'published') {
            $gallery->status = 'draft';
            $message = 'Gallery disembunyikan';
        } else {
            $gallery->status = 'published';
            $message = 'Gallery ditampilkan';
        }

        $gallery->save();

        return response()->json([
            'success' => true,
            'message' => $message
        ]);
    }

}

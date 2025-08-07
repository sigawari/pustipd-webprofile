<?php

namespace App\Http\Controllers\admin\ManageContent\Tentang;

use App\Models\ManageContent\AboutUs\Gallery;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Gallery';
        $query = Gallery::query();

        // Search
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
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
        $galleries = $query->orderBy('sort_order')
                          ->orderBy('created_at', 'desc')
                          ->paginate($perPage)
                          ->appends($request->all());

        // AJAX Response
        if ($request->ajax()) {
            return response()->json([
                'html' => view('admin.manage-content.tentang.gallery.partials.table_body', compact('galleries'))->render(),
                'pagination' => [
                    'current_page' => $galleries->currentPage(),
                    'last_page' => $galleries->lastPage(),
                    'total' => $galleries->total(),
                    'from' => $galleries->firstItem(),
                    'to' => $galleries->lastItem(),
                    'has_more_pages' => $galleries->hasMorePages(),
                    'on_first_page' => $galleries->onFirstPage(),
                ]
            ]);
        }

        return view('admin.manage-content.tentang.gallery.index', compact('title', 'galleries'));
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
        'status' => 'draft', // Default draft
    ]);

    return redirect()->back()->with('success', 'Gallery berhasil disimpan sebagai draft!');
}


    public function update(UpdateGalleryRequest $request, Gallery $gallery)
    {
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
               ->route('admin.manage-content.tentang.gallery.index')
               ->with('success', 'Gallery berhasil diperbarui!');
    }

    public function destroy(Gallery $gallery)
    {
        $gallery->update(['status' => 'archived']);

        return redirect()
               ->route('admin.manage-content.tentang.gallery.index')
               ->with('success', 'Gallery berhasil diarsipkan!');
    }

    public function bulk(Request $request)
    {
        $request->validate([
            'action' => 'required|in:published,draft,archived,permanent_delete',
            'ids' => 'required|array|min:1', // ← Tambah min:1
            'ids.*' => 'exists:galleries,id'
        ]);
    
        $action = $request->action;
        $ids = $request->ids;
    
        try {
            switch ($action) {
                case 'published':
                case 'draft':
                case 'archived':
                    $affected = Gallery::whereIn('id', $ids)->update(['status' => $action]);
                    $message = "Berhasil mengubah status {$affected} gallery ke {$action}";
                    break;
                    
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
    
            // ✅ PERBAIKAN: Support both AJAX and regular form submission
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => $message
                ]);
            }
    
            return redirect()
                   ->route('admin.manage-content.tentang.gallery.index')
                   ->with('success', $message);
                   
        } catch (\Exception $e) {
            // ✅ PERBAIKAN: Error handling
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ], 500);
            }
    
            return redirect()
                   ->route('admin.manage-content.tentang.gallery.index')
                   ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}

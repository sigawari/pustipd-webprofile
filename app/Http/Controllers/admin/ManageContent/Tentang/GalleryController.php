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

    public function store(StoreGalleryRequest $request)
    {
        $data = $request->validated();
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('gallery', $imageName, 'public');
            $data['image'] = $imagePath;
        }
        
        // Auto sort order
        if (!isset($data['sort_order']) || $data['sort_order'] === null) {
            $data['sort_order'] = (Gallery::max('sort_order') ?? 0) + 1;
        }
        
        Gallery::create($data);

        return redirect()
               ->route('admin.manage-content.tentang.gallery.index')
               ->with('success', 'Gallery berhasil ditambahkan!');
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
        
        if (!isset($data['sort_order']) || $data['sort_order'] === null) {
            $data['sort_order'] = $gallery->sort_order ?: ((Gallery::max('sort_order') ?? 0) + 1);
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
            'ids' => 'required|array',
            'ids.*' => 'exists:galleries,id'
        ]);

        $action = $request->action;
        $ids = $request->ids;

        switch ($action) {
            case 'published':
            case 'draft':
            case 'archived':
                Gallery::whereIn('id', $ids)->update(['status' => $action]);
                $message = 'Gallery berhasil diubah ke status ' . $action;
                break;
                
            case 'permanent_delete':
                $galleries = Gallery::whereIn('id', $ids)->get();
                foreach ($galleries as $gallery) {
                    if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
                        Storage::disk('public')->delete($gallery->image);
                    }
                    $gallery->delete();
                }
                $message = 'Gallery berhasil dihapus permanen';
                break;
        }

        return response()->json([
            'success' => true,
            'message' => $message
        ]);
    }
}

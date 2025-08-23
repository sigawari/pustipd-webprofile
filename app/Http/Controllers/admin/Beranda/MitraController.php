<?php
namespace App\Http\Controllers\admin\Beranda;

use Illuminate\Http\Request;
use App\Models\Beranda\Mitra;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class MitraController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Mitra';
        $search = $request->input('search', '');
        $filter = $request->query('filter', 'all');
        $perPage = $request->input('perPage', 10);

        $keywords = !empty($search) ? preg_split('/\s+/', (string) $search) : [];
        $mitraQuery = Mitra::query();

        if ($search) {
            $mitraQuery->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->where(function ($q) use ($word) {
                        $q->where('name', 'like', "%{$word}%")
                          ->orWhere('image', 'like', "%{$word}%");
                    });
                }
            });
        }

        if ($filter && $filter !== 'all') {
            $mitraQuery->where('status', $filter);
        }

        $mitraQuery->orderBy('created_at', 'desc');
        
        $merged = $mitraQuery->get();

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

        $mitras = new LengthAwarePaginator(
            $currentItems,
            $merged->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        if ($request->ajax()) {
            return view('admin.Beranda.Mitra.partials.table_body', compact('title', 'mitras'))->render();
        }

        return view('admin.Beranda.Mitra.index', compact('title', 'mitras'));
    }

    /** STORE : simpan Mitra baru */
    public function store(Request $request)
    {
        try {
            $status = $request->input('status', 'draft');

            $request->validate([
                'name' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'status' => 'in:draft,published',
            ]);

            // Simpan gambar jika ada
            $imagePath = null;
            if ($request->hasFile('image')) {
                // simpan ke 'public/mitra'
                $imagePath = $request->file('image')->store('mitra', 'public');
            }

            Mitra::create([
                'name' => $request->input('name'),
                'image' => $imagePath, // path gambar
                'status' => $status,
            ]);

            $statusMessage = $status === 'published' ? 'dipublish' : 'disimpan sebagai draft';

            return redirect()
                ->route('admin.beranda.mitra.index')
                ->with('success', "Mitra berhasil {$statusMessage}!");

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /** UPDATE : perbarui Mitra */
    public function update(Request $request, string $id)
    {
        try {
            $mitra = Mitra::findOrFail($id);

            $request->validate([
                'name' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'status' => 'required|in:draft,published',
            ]);

            $data = [
                'name' => $request->input('name'),
                'status' => $request->input('status'),
            ];

            // update gambar jika ada file baru
            if ($request->hasFile('image')) {
                // hapus gambar lama jika ada
                if ($mitra->image) {
                    Storage::disk('public')->delete($mitra->image);
                }
                $data['image'] = $request->file('image')->store('mitra', 'public');
            }

            $mitra->update($data);

            $statusMessage = $request->input('status') === 'published' ? 'dipublish' : 'disimpan sebagai draft';

            return redirect()
                   ->route('admin.beranda.mitra.index')
                   ->with('success', "Mitra berhasil diperbarui dan {$statusMessage}!");

        } catch (\Exception $e) {
            return redirect()
                   ->back()
                   ->withInput()
                   ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /** DESTROY : hapus permanen */
    public function destroy(Mitra $mitra)
    {
        try {
            // hapus file gambar
            if ($mitra->image) {
                Storage::disk('public')->delete($mitra->image);
            }
            $mitra->delete();

            return redirect()
                ->route('admin.beranda.mitra.index')
                ->with('success', 'Mitra berhasil dihapus permanen!');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /** BULK ACTION */
    public function bulk(Request $request)
    {
        try {
            $ids = $request->input('ids', []);
            $action = $request->input('action');

            if (!$ids || !$action) {
                return back()->with('error', 'Data atau aksi tidak valid.');
            }

            $message = '';
            switch ($action) {
                case 'published':
                    $updatedCount = Mitra::whereIn('id', $ids)->update(['status' => 'published']);
                    $message = "{$updatedCount} Mitra berhasil dipublish.";
                    break;
                case 'draft':
                    $updatedCount = Mitra::whereIn('id', $ids)->update(['status' => 'draft']);
                    $message = "{$updatedCount} Mitra berhasil diubah ke draft.";
                    break;
                case 'delete':
                    // hapus gambar juga!
                    $deletedMitras = Mitra::whereIn('id', $ids)->get();
                    foreach ($deletedMitras as $mitra) {
                        if ($mitra->image) {
                            Storage::disk('public')->delete($mitra->image);
                        }
                    }
                    $deletedCount = Mitra::whereIn('id', $ids)->delete();
                    $message = "{$deletedCount} Mitra berhasil dihapus permanen.";
                    break;
                default:
                    return back()->with('error', 'Aksi tidak valid.');
            }

            return back()->with('success', $message);

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}

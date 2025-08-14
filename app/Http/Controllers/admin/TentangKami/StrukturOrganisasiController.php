<?php

namespace App\Http\Controllers\admin\TentangKami;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TentangKami\StrukturOrganisasi;
class StrukturOrganisasiController extends Controller
{
    public function index()
    {
        $title = 'Kelola Struktur Organisasi';
        
        // ✅ Ambil semua data untuk ditampilkan di single page
        $allStruktur = StrukturOrganisasi::getAllForManagement();
        
        // ✅ Group by divisi untuk interface
        $strukturByDivisi = $allStruktur->groupBy('divisi');
        
        return view('admin.TentangKami.Struktur-organisasi.index', compact(
            'title', 'allStruktur', 'strukturByDivisi'
        ));
    }

    public function create()
    {
        $title = 'Tambah Anggota';
        
        // ✅ Dynamic parent options based on level
        $kepalas = StrukturOrganisasi::kepala()->active()->get();
        $divisis = StrukturOrganisasi::divisi()->active()->get();
        
        return view('admin.TentangKami.Struktur-organisasi.create', compact(
            'title', 'kepalas', 'divisis'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'level' => 'required|in:kepala,divisi,staff',
            'parent_id' => 'nullable|exists:struktur_organisasis,id',
            'urutan' => 'required|integer|min:1',
            'foto' => 'nullable|image|max:2048',
            'status' => 'required|in:active,inactive'
        ]);

        $data = $request->only(['nama', 'jabatan', 'level', 'parent_id', 'urutan', 'status']);

        // ✅ Validation logic
        if ($data['level'] === 'kepala' && $data['parent_id']) {
            return back()->withErrors(['parent_id' => 'Kepala tidak boleh memiliki parent']);
        }

        if ($data['level'] === 'staff' && !$data['parent_id']) {
            return back()->withErrors(['parent_id' => 'Staff harus memiliki parent divisi']);
        }

        // Handle foto upload
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('struktur-organisasi', 'public');
        }

        StrukturOrganisasi::create($data);

        return redirect()->route('admin.TentangKami.Struktur-organisasi.index')
                        ->with('success', 'Anggota berhasil ditambahkan');
    }

    // ✅ Method untuk reorganize structure
    public function reorder(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:struktur_organisasis,id',
            'items.*.urutan' => 'required|integer|min:1'
        ]);

        foreach ($request->items as $item) {
            StrukturOrganisasi::where('id', $item['id'])
                             ->update(['urutan' => $item['urutan']]);
        }

        return response()->json(['success' => true]);
    }

    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'members' => 'required|array',
            'members.*.id' => 'nullable|exists:struktur_organisasis,id',
            'members.*.nama' => 'required|string|max:255',
            'members.*.jabatan' => 'required|string|max:255',
            'members.*.divisi' => 'required|string',
            'members.*.urutan_index' => 'required|integer',
            'members.*.status' => 'required|in:active,inactive'
        ]);

        foreach ($request->members as $memberData) {
            if (isset($memberData['id'])) {
                // Update existing
                StrukturOrganisasi::where('id', $memberData['id'])
                                 ->update($memberData);
            } else {
                // Create new
                StrukturOrganisasi::create($memberData);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Struktur organisasi berhasil disimpan'
        ]);
    }
}


<?php

namespace App\Http\Controllers\admin\TentangKami;

use Illuminate\Http\Request;
use App\Models\TentangKami\VisiMisi;
use App\Http\Controllers\Controller;

class VisiMisiController extends Controller
{
    public function index()
    {
        $visiMisi = VisiMisi::firstOrCreate(['id' => 1], [
            'visi' => '',
            'misi' => [],
            'is_active' => true
        ]);

        return view('admin.TentangKami.Visi-misi.index', [
            'title' => 'Kelola Visi & Misi',
            'visiMisi' => $visiMisi
        ]);
    }

    public function create()
    {
        return view('admin.TentangKami.Visi-misi.create', [
            'title' => 'Tambah Misi Baru'
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all()); // Debug - hapus setelah selesai
        $validated = $request->validate([
            'description' => 'required|string|min:10|max:1000'
        ]);

        try {
            $visiMisi = VisiMisi::firstOrCreate(['id' => 1]);
            $visiMisi->addMisi($validated['description']);

            return redirect()
                ->route('admin.tentang-kami.visi-misi.index') // ← PERBAIKI
                ->with('success', 'Misi berhasil ditambahkan!');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal menambahkan misi: ' . $e->getMessage());
        }
    }

    public function edit($index)
    {
        // Debug - hapus setelah selesai
        dd([
            'index_parameter' => $index,
            'type' => gettype($index),
            'is_numeric' => is_numeric($index)
        ]);
    
        $visiMisi = VisiMisi::firstOrCreate(['id' => 1]);
        
        if (!isset($visiMisi->misi[$index])) {
            return redirect()
                ->route('admin.tentang-kami.visi-misi.index')
                ->with('error', 'Misi tidak ditemukan!');
        }
    
        return view('admin.TentangKami.Visi-misi.update', [
            'title' => 'Edit Misi',
            'visiMisi' => $visiMisi,
            'misiIndex' => $index,        // ← Variable ini HARUS ada
            'misiText' => $visiMisi->misi[$index]  // ← Variable ini HARUS ada
        ]);
    }
    

    public function updateVisi(Request $request)
    {
        $validated = $request->validate([
            'visi' => 'required|string|min:50|max:2000'
        ]);

        try {
            $visiMisi = VisiMisi::firstOrCreate(['id' => 1]);
            $visiMisi->update(['visi' => $validated['visi']]);

            return redirect()
                ->route('admin.tentang-kami.visi-misi.index') // ← PERBAIKI
                ->with('success', 'Visi berhasil diperbarui!');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui visi: ' . $e->getMessage());
        }
    }

    public function updateMisi(Request $request, $index)
    {
        $validated = $request->validate([
            'description' => 'required|string|min:10|max:1000'
        ]);

        try {
            $visiMisi = VisiMisi::firstOrCreate(['id' => 1]);
            $visiMisi->updateMisi($index, $validated['description']);

            return redirect()
                ->route('admin.tentang-kami.visi-misi.index') // ← PERBAIKI
                ->with('success', 'Misi berhasil diperbarui!');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui misi: ' . $e->getMessage());
        }
    }

    public function delete($index)
    {
        $visiMisi = VisiMisi::firstOrCreate(['id' => 1]);
        
        if (!isset($visiMisi->misi[$index])) {
            return redirect()
                ->route('admin.tentang-kami.visi-misi.index') 
                ->with('error', 'Misi tidak ditemukan!');
        }

        return view('admin.TentangKami.Visi-misi.delete', [
            'title' => 'Hapus Misi',
            'visiMisi' => $visiMisi,
            'misiIndex' => $index,
            'misiText' => $visiMisi->misi[$index]
        ]);
    }

    public function deleteMisi($index)
    {
        try {
            $visiMisi = VisiMisi::firstOrCreate(['id' => 1]);
            
            if (!isset($visiMisi->misi[$index])) {
                return redirect()
                    ->route('admin.tentang-kami.visi-misi.index') // ← PERBAIKI
                    ->with('error', 'Misi tidak ditemukan!');
            }

            $visiMisi->deleteMisi($index);

            return redirect()
                ->route('admin.tentang-kami.visi-misi.index') // ← PERBAIKI
                ->with('success', 'Misi berhasil dihapus!');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal menghapus misi: ' . $e->getMessage());
        }
    }
}

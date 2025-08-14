<?php

namespace App\Http\Controllers\Admin\ManageContent\Tentang;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\ManageContent\AboutUs\Profil;

class ProfilController extends Controller
{
    public function index()
    {
        $title = 'Profil';
        $profilData = Profil::first(); 

        return view('admin.manage-content.tentang.profil.index', compact('title', 'profilData'));
    }

    public function store(Request $request)
    {
        // Validasi langsung di controller
        $request->validate([
            'organization_name' => 'required|string|max:255',
            'description'       => 'nullable|string',
            'address'           => 'nullable|string',
            'email'             => 'nullable|string|email',
            'instagram_url'     => 'nullable|url',
            'facebook_url'      => 'nullable|url',
            'youtube_url'       => 'nullable|url',
            'applications'      => 'nullable|array',
            'institutions'      => 'nullable|array',
            'universities'      => 'nullable|array',
            'profil_photo'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'organization_name.required' => 'Nama organisasi wajib diisi.',
            'organization_name.max'      => 'Nama organisasi maksimal 255 karakter.',
        ]);

        // Ambil record pertama, kalau nggak ada buat baru
        $profil = Profil::firstOrNew([]);
        $profil->fill($request->except('profil_photo'));

        // Upload foto
        if ($request->hasFile('profil_photo')) {
            if ($profil->profil_photo) {
                Storage::disk('public')->delete($profil->profil_photo);
            }
            $profil->profil_photo = $request->file('profil_photo')->store('profil_photos', 'public');
        }

        $profil->save();

        return redirect()->route('admin.manage-content.tentang.profil')->with('success', 'Profil berhasil disimpan.');
    }

    public function update(Request $request, $id = null)
    {
        // Validasi langsung di controller
        $request->validate([
            'organization_name' => 'required|string|max:255',
            'description'       => 'nullable|string',
            'address'           => 'nullable|string',
            'email'             => 'nullable|string|email',
            'instagram_url'     => 'nullable|url',
            'facebook_url'      => 'nullable|url',
            'youtube_url'       => 'nullable|url',
            'applications'      => 'nullable|array',
            'institutions'      => 'nullable|array',
            'universities'      => 'nullable|array',
            'profil_photo'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'organization_name.required' => 'Nama organisasi wajib diisi.',
            'organization_name.max'      => 'Nama organisasi maksimal 255 karakter.',
        ]);

        // Ambil record, kalau belum ada bikin baru
        $profil = $id ? Profil::findOrFail($id) : Profil::firstOrNew([]);

        // Isi semua kolom kecuali foto
        $profil->fill($request->except('profil_photo'));

        // Upload foto baru jika ada
        if ($request->hasFile('profil_photo')) {
            if ($profil->profil_photo) {
                Storage::disk('public')->delete($profil->profil_photo);
            }
            $profil->profil_photo = $request->file('profil_photo')->store('profil_photos', 'public');
        }

        // Simpan data
        $profil->save();

        return redirect()->route('admin.manage-content.tentang.profil')->with('success', 'Profil berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $profil = Profil::findOrFail($id);

        $profil->delete();

        return redirect()
            ->route('admin.manage-content.tentang.profil')
            ->with('success', 'Profil berhasil dihapus.');
    }
}

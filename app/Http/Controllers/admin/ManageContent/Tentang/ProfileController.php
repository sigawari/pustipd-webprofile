<?php

namespace App\Http\Controllers\Admin\ManageContent\Tentang;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\ManageContent\AboutUs\Profile;

class ProfileController extends Controller
{
    public function index()
    {
        $title = 'Profile';
        $profileData = Profile::first(); 

        return view('admin.manage-content.tentang.profile.profile', compact('title', 'profileData'));
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
            'profile_photo'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'organization_name.required' => 'Nama organisasi wajib diisi.',
            'organization_name.max'      => 'Nama organisasi maksimal 255 karakter.',
        ]);

        // Ambil record pertama, kalau nggak ada buat baru
        $profile = Profile::firstOrNew([]);
        $profile->fill($request->except('profile_photo'));

        // Upload foto
        if ($request->hasFile('profile_photo')) {
            if ($profile->profile_photo) {
                Storage::disk('public')->delete($profile->profile_photo);
            }
            $profile->profile_photo = $request->file('profile_photo')->store('profile_photos', 'public');
        }

        $profile->save();

        return redirect()->route('admin.manage-content.tentang.profile')->with('success', 'Profil berhasil disimpan.');
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
            'profile_photo'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'organization_name.required' => 'Nama organisasi wajib diisi.',
            'organization_name.max'      => 'Nama organisasi maksimal 255 karakter.',
        ]);

        // Ambil record, kalau belum ada bikin baru
        $profile = $id ? Profile::findOrFail($id) : Profile::firstOrNew([]);

        // Isi semua kolom kecuali foto
        $profile->fill($request->except('profile_photo'));

        // Upload foto baru jika ada
        if ($request->hasFile('profile_photo')) {
            if ($profile->profile_photo) {
                Storage::disk('public')->delete($profile->profile_photo);
            }
            $profile->profile_photo = $request->file('profile_photo')->store('profile_photos', 'public');
        }

        // Simpan data
        $profile->save();

        return redirect()->route('admin.manage-content.tentang.profile')->with('success', 'Profil berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $profile = Profile::findOrFail($id);

        $profile->delete();

        return redirect()
            ->route('admin.manage-content.tentang.profile')
            ->with('success', 'Profil berhasil dihapus.');
    }
}

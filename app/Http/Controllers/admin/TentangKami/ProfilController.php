<?php

namespace App\Http\Controllers\admin\TentangKami;

use Illuminate\Http\Request;
use App\Models\TentangKami\Profil;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function index()
    {
        $title = 'Profil';
        $profilData = Profil::first(); 

        return view('admin.TentangKami.Profil.index', compact('title', 'profilData'));
    }

    private function filterArrayData($array)
    {
        if (!is_array($array)) {
            return [];
        }

        return array_values(array_filter($array, function($item) {
            // Hapus item yang tidak memiliki nama atau URL yang valid
            return !empty($item['name']) || !empty($item['url']);
        }));
    }
    
    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'organization_name' => 'required|string|max:255',
            'description'       => 'nullable|string',
            'address'           => 'nullable|string',
            'email'             => 'nullable|string|email',
            'instagram_url'     => 'nullable|url',
            'facebook_url'      => 'nullable|url',
            'youtube_url'       => 'nullable|url',
            'applications'      => 'nullable|array',
            'applications.*.name' => 'nullable|string',
            'applications.*.url' => 'nullable|url',
            'institutions'      => 'nullable|array',
            'institutions.*.name' => 'nullable|string',
            'institutions.*.url' => 'nullable|url',
            'universities'      => 'nullable|array',
            'universities.*.name' => 'nullable|string',
            'universities.*.url' => 'nullable|url',
            'profil_photo'     => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
        ]);
    
        // Cek apakah sudah ada profil
        $existingProfil = Profil::first();
        
        if ($existingProfil) {
            return redirect()
                ->route('admin.tentang-kami.profil.index')
                ->with('error', 'Profil sudah ada. Gunakan fitur update untuk mengubah data.');
        }
    
        // Prepare data
        $data = $request->except(['profil_photo']);
        
        // Filter array data - hapus yang kosong
        $data['applications'] = $this->filterArrayData($request->input('applications', []));
        $data['institutions'] = $this->filterArrayData($request->input('institutions', []));
        $data['universities'] = $this->filterArrayData($request->input('universities', []));
    
        // Buat profil baru
        $profil = new Profil();
        $profil->fill($data);
    
        // Upload foto
        if ($request->hasFile('profil_photo')) {
            $profil->profil_photo = $request->file('profil_photo')->store('profil_photos', 'public');
        }
    
        $profil->save();
    
        return redirect()
            ->route('admin.tentang-kami.profil.index')
            ->with('success', 'Profil berhasil disimpan.');
    }
    

    public function update(Request $request, Profil $profil)
    {
        // Validasi
        $request->validate([
            'organization_name' => 'nullable|string|max:255',
            'description'       => 'nullable|string',
            'address'           => 'nullable|string',
            'email'             => 'nullable|email',
            'instagram_url'     => 'nullable|url|regex:/^https:\/\//',
            'facebook_url'      => 'nullable|url|regex:/^https:\/\//',
            'youtube_url'       => 'nullable|url|regex:/^https:\/\//',
            'applications'      => 'nullable|array',
            'applications.*.name' => 'nullable|string',
            'applications.*.url' => 'nullable|url',
            'institutions'      => 'nullable|array',
            'institutions.*.name' => 'nullable|string',
            'institutions.*.url' => 'nullable|url',
            'universities'      => 'nullable|array',
            'universities.*.name' => 'nullable|string',
            'universities.*.url' => 'nullable|url',
            'profil_photo'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);        
    
        // Prepare data
        $data = $request->except(['profil_photo']);
        
        // Filter array data - hapus yang kosong
        $data['applications'] = $this->filterArrayData($request->input('applications', []));
        $data['institutions'] = $this->filterArrayData($request->input('institutions', []));
        $data['universities'] = $this->filterArrayData($request->input('universities', []));
    
        // Update semua kolom kecuali foto
        $profil->fill($data);
    
        // Upload foto baru jika ada
        if ($request->hasFile('profil_photo')) {
            // Hapus foto lama jika ada
            if ($profil->profil_photo && Storage::disk('public')->exists($profil->profil_photo)) {
                Storage::disk('public')->delete($profil->profil_photo);
            }
            $profil->profil_photo = $request->file('profil_photo')->store('profil_photos', 'public');
        }
    
        $profil->save();
    
        return redirect()
            ->route('admin.tentang-kami.profil.index')
            ->with('success', 'Profil berhasil diperbarui.');
    }
    
    
    public function destroy(Profil $profil) // ✅ Ubah dari $id ke Profil $profil
    {
        try {
            // Hapus foto jika ada
            if ($profil->profil_photo && Storage::disk('public')->exists($profil->profil_photo)) {
                Storage::disk('public')->delete($profil->profil_photo);
            }
    
            $profil->delete();
    
            return redirect()
                ->route('admin.tentang-kami.profil.index')
                ->with('success', 'Profil berhasil dihapus.');
    
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.tentang-kami.profil.index')
                ->with('error', 'Gagal menghapus profil. Error: ' . $e->getMessage());
        }
    }

    // Method tambahan untuk single record system
    public function createOrUpdate(Request $request)
    {
        // Validasi
        $request->validate([
            'organization_name' => 'nullable|string|max:255',
            'description'       => 'nullable|string',
            'address'           => 'nullable|string',
            'email'             => 'nullable|email',
            'instagram_url'     => 'nullable|url|regex:/^https:\/\//',
            'facebook_url'      => 'nullable|url|regex:/^https:\/\//',
            'youtube_url'       => 'nullable|url|regex:/^https:\/\//',
            'applications'      => 'nullable|array',
            'institutions'      => 'nullable|array',
            'universities'      => 'nullable|array',
            'profil_photo'      => 'required|image|mimes:jpg,jpeg,png,webp|max:10240',
        ], [
            'profil_photo.required' => 'Foto profil wajib diupload.',
            'profil_photo.image' => 'File harus berupa gambar.',
            'profil_photo.mimes' => 'Format gambar harus jpg, jpeg, png, atau webp.',
            'profil_photo.max' => 'Ukuran gambar maksimal 2MB.',
            'instagram_url.regex' => 'URL Instagram harus menggunakan HTTPS.',
            'facebook_url.regex' => 'URL Facebook harus menggunakan HTTPS.',
            'youtube_url.regex' => 'URL YouTube harus menggunakan HTTPS.',
        ]);        

        // Ambil atau buat profil baru (single record system)
        $profil = Profil::firstOrNew([]);
        $profil->fill($request->except('profil_photo'));

        // Upload foto
        if ($request->hasFile('profil_photo')) {
            // Hapus foto lama jika ada
            if ($profil->profil_photo && Storage::disk('public')->exists($profil->profil_photo)) {
                Storage::disk('public')->delete($profil->profil_photo);
            }
            $profil->profil_photo = $request->file('profil_photo')->store('profil_photos', 'public');
        }

        $profil->save();

        $message = $profil->wasRecentlyCreated ? 'Profil berhasil dibuat.' : 'Profil berhasil diperbarui.';

        return redirect()
            ->route('admin.tentang-kami.profil.index')
            ->with('success', $message);
    }
}

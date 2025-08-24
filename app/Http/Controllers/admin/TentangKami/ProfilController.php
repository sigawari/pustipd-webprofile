<?php

namespace App\Http\Controllers\admin\TentangKami;

use Illuminate\Http\Request;
use App\Models\TentangKami\Profil;
use App\Models\TentangKami\ProfilApplication;
use App\Models\TentangKami\ProfilInstitution;
use App\Models\TentangKami\ProfilUniversity;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfilController extends Controller
{
    public function index()
    {
        $title = 'Profil';
        $profilData = Profil::with(['applications', 'institutions', 'universities'])->first();

        return view('admin.TentangKami.Profil.index', compact('title', 'profilData'));
    }

    private function filterArrayData(?array $array)
    {
        if (!is_array($array)) {
            return [];
        }
        return array_values(array_filter($array, fn($item) => !empty($item['name']) || !empty($item['url'])));
    }

    public function store(Request $request)
    {
        $request->validate([
            'organization_name' => 'required|string|max:255',
            'description'       => 'nullable|string',
            'address'           => 'nullable|string',
            'email'             => 'nullable|email',
            'instagram_url'     => 'nullable|url',
            'facebook_url'      => 'nullable|url',
            'youtube_url'       => 'nullable|url',
            'applications'      => 'nullable|array',
            'applications.*.name' => 'nullable|string',
            'applications.*.url'  => 'nullable|url',
            'institutions'      => 'nullable|array',
            'institutions.*.name' => 'nullable|string',
            'institutions.*.url'  => 'nullable|url',
            'universities'      => 'nullable|array',
            'universities.*.name' => 'nullable|string',
            'universities.*.url'  => 'nullable|url',
            'profil_photo'      => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'hero_image'        => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
        ]);

        if (Profil::exists()) {
            return redirect()->route('admin.tentang-kami.profil.index')
                ->with('error', 'Profil sudah ada. Gunakan fungsi Update.');
        }

        $data = $request->only([
            'organization_name', 'description', 'address', 'email',
            'instagram_url', 'facebook_url', 'youtube_url',
        ]);

        DB::transaction(function () use ($request, $data) {
            $profil = new Profil();
            $profil->fill($data);

            if ($request->hasFile('profil_photo')) {
                $profil->profil_photo = $request->file('profil_photo')->store('profil_photos', 'public');
            }
            if ($request->hasFile('hero_image')) {
                $profil->hero_image = $request->file('hero_image')->store('hero_photos', 'public');
            }

            $profil->save();

            foreach ($this->filterArrayData($request->applications ?? []) as $i => $item) {
                $profil->applications()->create([
                    'name' => $item['name'] ?? null,
                    'url' => $item['url'] ?? null,
                    'sort_order' => $i,
                ]);
            }
            foreach ($this->filterArrayData($request->institutions ?? []) as $i => $item) {
                $profil->institutions()->create([
                    'name' => $item['name'] ?? null,
                    'url' => $item['url'] ?? null,
                    'sort_order' => $i,
                ]);
            }
            foreach ($this->filterArrayData($request->universities ?? []) as $i => $item) {
                $profil->universities()->create([
                    'name' => $item['name'] ?? null,
                    'url' => $item['url'] ?? null,
                    'sort_order' => $i,
                ]);
            }
        });

        return redirect()->route('admin.tentang-kami.profil.index')->with('success', 'Profil berhasil dibuat.');
    }

    public function update(Request $request, Profil $profil)
    {
        $request->validate([
            'organization_name' => 'nullable|string|max:255',
            'description'       => 'nullable|string',
            'address'           => 'nullable|string',
            'email'             => 'nullable|email',
            'instagram_url'     => 'nullable|url',
            'facebook_url'      => 'nullable|url',
            'youtube_url'       => 'nullable|url',
            'applications'      => 'nullable|array',
            'applications.*.id' => ['nullable', 'integer', Rule::exists('profil_applications', 'id')],
            'applications.*.name' => 'nullable|string',
            'applications.*.url'  => 'nullable|url',
            'institutions'      => 'nullable|array',
            'institutions.*.id' => ['nullable', 'integer', Rule::exists('profil_institutions', 'id')],
            'institutions.*.name' => 'nullable|string',
            'institutions.*.url'  => 'nullable|url',
            'universities'      => 'nullable|array',
            'universities.*.id' => ['nullable', 'integer', Rule::exists('profil_universities', 'id')],
            'universities.*.name' => 'nullable|string',
            'universities.*.url'  => 'nullable|url',
            'profil_photo'      => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'hero_image'        => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
        ]);

        $data = $request->only([
            'organization_name', 'description', 'address', 'email',
            'instagram_url', 'facebook_url', 'youtube_url',
        ]);

        DB::transaction(function () use ($request, $profil, $data) {
            $profil->fill($data);

            // Handle photo update
            if ($request->hasFile('profil_photo')) {
                if ($profil->profil_photo && Storage::disk('public')->exists($profil->profil_photo)) {
                    Storage::disk('public')->delete($profil->profil_photo);
                }
                $profil->profil_photo = $request->file('profil_photo')->store('profil_photos', 'public');
            }
            if ($request->hasFile('hero_image')) {
                if ($profil->hero_image && Storage::disk('public')->exists($profil->hero_image)) {
                    Storage::disk('public')->delete($profil->hero_image);
                }
                $profil->hero_image = $request->file('hero_image')->store('hero_photos', 'public');
            }

            $profil->save();

            $this->syncChildren($profil, 'applications', $this->filterArrayData($request->applications ?? []), ProfilApplication::class);
            $this->syncChildren($profil, 'institutions', $this->filterArrayData($request->institutions ?? []), ProfilInstitution::class);
            $this->syncChildren($profil, 'universities', $this->filterArrayData($request->universities ?? []), ProfilUniversity::class);
        });

        return redirect()->route('admin.tentang-kami.profil.index')->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Sinkronisasi children tanpa hapus semua entry, hanya menghapus yang di-drop oleh user
     */
    private function syncChildren(Profil $profil, string $relation, array $items, string $modelClass): void
    {
        $existingIds = $profil->$relation()->pluck('id')->toArray();
        $keepIds = [];

        foreach ($items as $item) {
            $payload = [
                'name' => $item['name'] ?? null,
                'url' => $item['url'] ?? null,
                'sort_order' => $item['sort_order'] ?? 0,
            ];

            if (!empty($item['id']) && in_array($item['id'], $existingIds)) {
                // Update existing item
                $child = $modelClass::find($item['id']);
                if ($child) {
                    $child->update($payload);
                    $keepIds[] = $child->id;
                }
            } else {
                // Create new item
                $newItem = $profil->$relation()->create($payload);
                $keepIds[] = $newItem->id;
            }
        }

        // Delete removed items
        $toDeleteIds = array_diff($existingIds, $keepIds);
        if (!empty($toDeleteIds)) {
            $modelClass::whereIn('id', $toDeleteIds)->delete();
        }
    }

    public function destroy(Profil $profil)
    {
        try {
            if ($profil->profil_photo && Storage::disk('public')->exists($profil->profil_photo)) {
                Storage::disk('public')->delete($profil->profil_photo);
            }
            if ($profil->hero_image && Storage::disk('public')->exists($profil->hero_image)) {
                Storage::disk('public')->delete($profil->hero_image);
            }

            $profil->delete();

            return redirect()->route('admin.tentang-kami.profil.index')->with('success', 'Profil berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.tentang-kami.profil.index')->with('error', 'Gagal menghapus profil: ' . $e->getMessage());
        }
    }
}

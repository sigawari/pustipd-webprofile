<?php

namespace App\Http\Controllers\admin\TentangKami;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TentangKami\StrukturOrganisasi;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class StrukturOrganisasiController extends Controller
{
    public function index()
    {
        $title = 'Kelola Struktur Organisasi';
        
        // Ambil data organisasi yang sudah disimpan
        $organization = $this->getOrganizationData();
        
        return view('admin.TentangKami.Struktur-organisasi.index', compact(
            'title', 'organization'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            // Deskripsi organisasi
            'orgName' => 'required|string|max:255',
            'orgDescription' => 'required|string',
            
            // Data kepala
            'headName' => 'nullable|string|max:255',
            'headPosition' => 'nullable|string|max:255',
            'headEmail' => 'nullable|email',
            'headPhoto' => 'nullable|image|max:2048',
            
            // Data divisi dan anggota
            'divisions' => 'nullable|array',
            'divisions.*.name' => 'required|string|max:255',
            'divisions.*.order' => 'required|integer',
            'divisions.*.members' => 'nullable|array',
            'divisions.*.members.*.nama' => 'required|string|max:255',
            'divisions.*.members.*.jabatan' => 'required|string|max:255',
            'divisions.*.members.*.email' => 'nullable|email',
            'divisions.*.members.*.photo' => 'nullable|image|max:2048',
            'divisions.*.members.*.order' => 'required|integer',
            
            'status' => 'required|in:draft,published'
        ]);

        DB::beginTransaction();
        
        try {
            // Hapus data lama
            StrukturOrganisasi::truncate();
            
            // Simpan data kepala jika ada
            if ($request->filled('headName')) {
                $headPhotoPath = null;
                if ($request->hasFile('headPhoto')) {
                    $headPhotoPath = $request->file('headPhoto')->store('struktur-organisasi/kepala', 'public');
                }
                
                StrukturOrganisasi::create([
                    'nama' => $request->headName,
                    'jabatan' => $request->headPosition,
                    'email' => $request->headEmail,
                    'foto' => $headPhotoPath,
                    'divisi' => 'Kepala',
                    'level' => 'kepala',
                    'urutan_index' => 0,
                    'status' => $request->status,
                    'org_name' => $request->orgName,
                    'org_description' => $request->orgDescription,
                ]);
            }
            
            // Simpan data divisi dan anggota
            if ($request->has('divisions')) {
                foreach ($request->divisions as $divisionData) {
                    if (!empty($divisionData['members'])) {
                        foreach ($divisionData['members'] as $memberData) {
                            $memberPhotoPath = null;
                            if (isset($memberData['photo']) && $memberData['photo']) {
                                $memberPhotoPath = $memberData['photo']->store('struktur-organisasi/anggota', 'public');
                            }
                            
                            StrukturOrganisasi::create([
                                'nama' => $memberData['nama'],
                                'jabatan' => $memberData['jabatan'],
                                'email' => $memberData['email'] ?? null,
                                'foto' => $memberPhotoPath,
                                'divisi' => $divisionData['name'],
                                'level' => 'anggota',
                                'urutan_index' => $memberData['order'],
                                'division_order' => $divisionData['order'],
                                'status' => $request->status,
                                'org_name' => $request->orgName,
                                'org_description' => $request->orgDescription,
                            ]);
                        }
                    }
                }
            }
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Struktur organisasi berhasil disimpan'
            ]);
            
        } catch (\Exception $e) {
            DB::rollback();
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getOrganizationData()
    {
        $allData = StrukturOrganisasi::where('status', 'published')
                                   ->orderBy('urutan_index')
                                   ->get();
        
        if ($allData->isEmpty()) {
            return null;
        }
        
        // Ambil data organisasi dari record pertama
        $firstRecord = $allData->first();
        $organization = [
            'name' => $firstRecord->org_name ?? 'Struktur Organisasi',
            'description' => $firstRecord->org_description ?? '',
            'subtitle' => 'Berdasarkan surat keputusan yang berlaku',
        ];
        
        // Ambil data kepala
        $kepala = $allData->where('level', 'kepala')->first();
        if ($kepala) {
            $organization['head'] = [
                'nama' => $kepala->nama,
                'jabatan' => $kepala->jabatan,
                'email' => $kepala->email,
                'divisi' => $kepala->divisi,
                'image' => $kepala->foto ? asset('storage/' . $kepala->foto) : asset('assets/img/placeholder/dummy.png'),
            ];
        }
        
        // Ambil data divisi dan anggota
        $anggotaByDivisi = $allData->where('level', 'anggota')
                                  ->groupBy('divisi')
                                  ->map(function ($members) {
                                      return $members->sortBy('urutan_index');
                                  });
        
        $divisions = [];
        $divisionOrder = [];
        
        foreach ($anggotaByDivisi as $divisionName => $members) {
            $divisionOrderIndex = $members->first()->division_order ?? 999;
            
            $divisions[] = [
                'name' => $divisionName,
                'order' => $divisionOrderIndex,
                'members' => $members->map(function ($member) {
                    return [
                        'nama' => $member->nama,
                        'jabatan' => $member->jabatan,
                        'email' => $member->email,
                        'image' => $member->foto ? asset('storage/' . $member->foto) : asset('assets/img/placeholder/dummy.png'),
                    ];
                })->toArray()
            ];
            
            $divisionOrder[] = $divisionName;
        }
        
        // Sort divisions by order
        usort($divisions, function ($a, $b) {
            return $a['order'] <=> $b['order'];
        });
        
        $organization['divisions'] = $divisions;
        $organization['division_order'] = collect($divisions)->pluck('name')->toArray();
        
        return $organization;
    }

    // Method untuk preview di halaman publik
    public function preview()
    {
        $organization = $this->getOrganizationData();
        
        return view('public.structure', [
            'title' => 'Preview Struktur Organisasi',
            'description' => 'Preview struktur organisasi PUSTIPD',
            'keywords' => 'struktur, organisasi, pustipd',
            'organization' => $organization
        ]);
    }

    // Method untuk API preview
    public function getPreviewData()
    {
        $organization = $this->getOrganizationData();
        
        return response()->json([
            'success' => true,
            'data' => $organization
        ]);
    }

    public function destroy($id)
    {
        try {
            $struktur = StrukturOrganisasi::findOrFail($id);
            
            // Hapus foto jika ada
            if ($struktur->foto) {
                Storage::disk('public')->delete($struktur->foto);
            }
            
            $struktur->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    // Method untuk mendapatkan data draft
    public function getDraftData()
    {
        $draftData = StrukturOrganisasi::where('status', 'draft')
                                     ->orderBy('urutan_index')
                                     ->get();
        
        if ($draftData->isEmpty()) {
            return response()->json([
                'success' => true,
                'data' => null
            ]);
        }
        
        $organization = $this->formatOrganizationData($draftData);
        
        return response()->json([
            'success' => true,
            'data' => $organization
        ]);
    }

    private function formatOrganizationData($data)
    {
        if ($data->isEmpty()) {
            return null;
        }
        
        $firstRecord = $data->first();
        $organization = [
            'name' => $firstRecord->org_name ?? '',
            'description' => $firstRecord->org_description ?? '',
        ];
        
        // Format data kepala
        $kepala = $data->where('level', 'kepala')->first();
        if ($kepala) {
            $organization['head'] = [
                'nama' => $kepala->nama,
                'jabatan' => $kepala->jabatan,
                'email' => $kepala->email,
                'image' => $kepala->foto ? asset('storage/' . $kepala->foto) : asset('assets/img/placeholder/dummy.png'),
            ];
        }
        
        // Format data divisi
        $anggotaByDivisi = $data->where('level', 'anggota')
                               ->groupBy('divisi');
        
        $divisions = [];
        foreach ($anggotaByDivisi as $divisionName => $members) {
            $divisions[] = [
                'name' => $divisionName,
                'members' => $members->sortBy('urutan_index')->map(function ($member) {
                    return [
                        'nama' => $member->nama,
                        'jabatan' => $member->jabatan,
                        'email' => $member->email,
                        'image' => $member->foto ? asset('storage/' . $member->foto) : asset('assets/img/placeholder/dummy.png'),
                    ];
                })->values()->toArray()
            ];
        }
        
        $organization['divisions'] = $divisions;
        
        return $organization;
    }
}

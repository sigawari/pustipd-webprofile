<?php

namespace App\Http\Controllers\admin\TentangKami;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TentangKami\StrukturOrganisasi;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        // Debug: Log incoming request data
        Log::info('Store request data:', $request->all());
        
        $request->validate([
            // Deskripsi organisasi
            'orgName' => 'required|string|max:255',
            'orgDescription' => 'required|string',
            
            // Data kepala
            'headName' => 'nullable|string|max:255',
            'headPosition' => 'nullable|string|max:255',
            'headEmail' => 'nullable|email',
            'headPhoto' => 'nullable|image|max:2048',
            
            // Data divisi dan anggota - perbaikan validasi
            'divisions' => 'nullable|array',
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
                    'jabatan' => $request->headPosition ?? 'Kepala PUSTIPD',
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
            
            // Simpan data divisi dan anggota - perbaikan parsing
            if ($request->has('divisions')) {
                Log::info('Processing divisions:', $request->divisions);
                
                foreach ($request->divisions as $divisionKey => $divisionData) {
                    // Skip jika nama divisi kosong
                    if (empty($divisionData['name'])) {
                        continue;
                    }

                    $divisionName = $divisionData['name'];
                    $divisionOrder = $divisionData['order'] ?? $divisionKey;
                    
                    // Process members jika ada
                    if (isset($divisionData['members']) && is_array($divisionData['members'])) {
                        Log::info("Processing members for division: {$divisionName}", $divisionData['members']);
                        
                        foreach ($divisionData['members'] as $memberKey => $memberData) {
                            // Skip jika data member tidak lengkap
                            if (empty($memberData['nama']) || empty($memberData['jabatan'])) {
                                Log::warning("Skipping incomplete member data:", $memberData);
                                continue;
                            }

                            $memberPhotoPath = null;
                            
                            // Handle photo upload dengan key yang benar
                            $photoFieldName = "divisions.{$divisionKey}.members.{$memberKey}.photo";
                            if ($request->hasFile($photoFieldName)) {
                                $memberPhotoPath = $request->file($photoFieldName)->store('struktur-organisasi/anggota', 'public');
                            }
                            
                            $memberRecord = [
                                'nama' => $memberData['nama'],
                                'jabatan' => $memberData['jabatan'],
                                'email' => $memberData['email'] ?? null,
                                'foto' => $memberPhotoPath,
                                'divisi' => $divisionName,
                                'level' => 'anggota',
                                'urutan_index' => $memberData['order'] ?? $memberKey + 1,
                                'division_order' => $divisionOrder,
                                'status' => $request->status,
                                'org_name' => $request->orgName,
                                'org_description' => $request->orgDescription,
                            ];
                            
                            Log::info('Creating member record:', $memberRecord);
                            StrukturOrganisasi::create($memberRecord);
                        }
                    } else {
                        Log::info("No members found for division: {$divisionName}");
                    }
                }
            }
            
            DB::commit();
            
            // Log successful save
            $savedCount = StrukturOrganisasi::count();
            Log::info("Successfully saved {$savedCount} records");
            
            return response()->json([
                'success' => true,
                'message' => 'Struktur organisasi berhasil disimpan',
                'saved_records' => $savedCount
            ]);
            
        } catch (\Exception $e) {
            DB::rollback();
            
            Log::error('Error saving structure organization:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                'debug' => config('app.debug') ? $e->getTraceAsString() : null
            ], 500);
        }
    }

    public function getOrganizationData()
    {
        // Ambil semua data (draft dan published) untuk management
        $allData = StrukturOrganisasi::orderBy('division_order')
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
        }
        
        // Sort divisions by order
        usort($divisions, function ($a, $b) {
            return $a['order'] <=> $b['order'];
        });
        
        $organization['divisions'] = $divisions;
        $organization['division_order'] = collect($divisions)->pluck('name')->toArray();
        
        return $organization;
    }

    // Method untuk mendapatkan data draft dan published
    public function getDraftData()
    {
        $organization = $this->getOrganizationData();
        
        return response()->json([
            'success' => true,
            'data' => $organization
        ]);
    }

    // Method untuk preview di halaman publik - hanya published
    public function preview()
    {
        $allData = StrukturOrganisasi::where('status', 'published')
                                   ->orderBy('division_order')
                                   ->orderBy('urutan_index')
                                   ->get();
        
        if ($allData->isEmpty()) {
            $organization = null;
        } else {
            $organization = $this->formatOrganizationDataFromCollection($allData);
        }
        
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
        $allData = StrukturOrganisasi::where('status', 'published')
                                   ->orderBy('division_order')
                                   ->orderBy('urutan_index')
                                   ->get();
        
        $organization = $allData->isEmpty() ? null : $this->formatOrganizationDataFromCollection($allData);
        
        return response()->json([
            'success' => true,
            'data' => $organization
        ]);
    }

    private function formatOrganizationDataFromCollection($data)
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
}

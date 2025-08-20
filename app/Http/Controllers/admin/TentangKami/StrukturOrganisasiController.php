<?php
namespace App\Http\Controllers\Admin\TentangKami;

use App\Http\Controllers\Controller;
use App\Models\TentangKami\DescHeadStructure;
use App\Models\TentangKami\StrukturOrganisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class StrukturOrganisasiController extends Controller
{
    public function index()
    {
        $title = 'Struktur Organisasi';
        
        try {
            $headData = DescHeadStructure::getActiveHead();
            $description = DescHeadStructure::getDescription();
            $structure = StrukturOrganisasi::getOrganizationStructure();
            $divisions = StrukturOrganisasi::getAllDivisions();
            
        } catch (\Exception $e) {
            $headData = null;
            $description = null;
            $structure = collect();
            $divisions = collect();
        }
        
        return view('admin.TentangKami.struktur-organisasi.index', compact(
            'title',
            'headData', 
            'description', 
            'structure', 
            'divisions'
        ));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // 1. Simpan/Update Data Head
            $headData = [
                'structure_desc' => $request->structure_desc,
                'nama_kepala' => $request->nama_kepala,
                'jabatan_kepala' => $request->jabatan_kepala,
                'email_kepala' => $request->email_kepala,
                'is_active' => $request->has('is_active') ? true : false,
                'sort_order' => 1
            ];

            // Handle upload foto kepala
            if ($request->hasFile('foto_kepala')) {
                $file = $request->file('foto_kepala');
                $filename = time() . '_kepala.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('struktur-organisasi', $filename, 'public');
                $headData['foto_kepala'] = $path;
            }

            // Update atau create head data
            DescHeadStructure::updateOrCreate(
                ['id' => 1], // Asumsi hanya ada 1 record head
                $headData
            );

            // 2. Hapus data struktur lama
            StrukturOrganisasi::truncate();

            // 3. Simpan data divisi dan staff baru
            if ($request->has('divisions')) {
                foreach ($request->divisions as $divisionIndex => $division) {
                    $divisionName = $division['nama_divisi'];
                    $divisionOrder = $division['divisi_order'] ?? ($divisionIndex + 1);

                    if (isset($division['staff']) && is_array($division['staff'])) {
                        foreach ($division['staff'] as $staffIndex => $staff) {
                            $staffData = [
                                'nama_divisi' => $divisionName,
                                'divisi_order' => $divisionOrder,
                                'nama' => $staff['nama'],
                                'jabatan' => $staff['jabatan'],
                                'email' => $staff['email'] ?? null,
                                'staff_order' => $staff['staff_order'] ?? ($staffIndex + 1),
                                'is_active' => true
                            ];

                            // Handle upload foto staff
                            if (isset($staff['foto']) && $staff['foto']->isValid()) {
                                $file = $staff['foto'];
                                $filename = time() . '_' . $divisionIndex . '_' . $staffIndex . '.' . $file->getClientOriginalExtension();
                                $path = $file->storeAs('struktur-organisasi', $filename, 'public');
                                $staffData['foto'] = $path;
                            }

                            StrukturOrganisasi::create($staffData);
                        }
                    }
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan'
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getData()
    {
        try {
            $headData = DescHeadStructure::getActiveHead();
            $structure = StrukturOrganisasi::getOrganizationStructure();

            return response()->json([
                'success' => true,
                'head' => $headData,
                'structure' => $structure
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}

<?php
namespace App\Http\Controllers\Admin\TentangKami;

use App\Http\Controllers\Controller;
use App\Models\TentangKami\DescHeadStructure;
use App\Models\TentangKami\StrukturOrganisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StrukturOrganisasiController extends Controller
{
    public function index()
    {
        $title = 'Struktur Organisasi';
        
        try {
            // PERBAIKAN: Ambil data yang sudah ada di database
            $headData = DescHeadStructure::first(); // Ambil record pertama, bukan hanya yang active
            $description = $headData ? $headData->structure_desc : null;
            $structure = StrukturOrganisasi::orderBy('divisi_order')->orderBy('staff_order')->get()->groupBy('nama_divisi');
            $divisions = StrukturOrganisasi::select('nama_divisi')->distinct()->orderBy('divisi_order')->pluck('nama_divisi');
            
        } catch (\Exception $e) {
            Log::error('Admin index error: ' . $e->getMessage());
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
            // Debug: Log semua data yang masuk
            Log::info('Request Data:', $request->all());
            Log::info('Request Files:', $request->allFiles());

            // Validasi input
            $request->validate([
                'structure_desc' => 'nullable|string',
                'nama_kepala' => 'required|string|max:255',
                'jabatan_kepala' => 'required|string|max:255',
                'email_kepala' => 'nullable|email|max:255',
                'foto_kepala' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
                'is_active' => 'nullable'
            ]);

            // Siapkan data head
            $headData = [
                'structure_desc' => $request->structure_desc,
                'nama_kepala' => $request->nama_kepala,
                'jabatan_kepala' => $request->jabatan_kepala,
                'email_kepala' => $request->email_kepala,
                'is_active' => $request->has('is_active') ? 1 : 0,
                'sort_order' => 1
            ];

            // Handle foto kepala
            if ($request->hasFile('foto_kepala')) {
                Log::info('Foto kepala file detected');
                $file = $request->file('foto_kepala');
                $filename = 'kepala_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('struktur-organisasi', $filename, 'public');
                $headData['foto_kepala'] = $path;
                Log::info('Foto kepala stored at: ' . $path);
            }

            // Simpan data kepala
            $headRecord = DescHeadStructure::first();
            if ($headRecord) {
                $headRecord->update($headData);
            } else {
                $headRecord = DescHeadStructure::create($headData);
            }

            Log::info('Head record saved:', $headRecord->toArray());

            // Hapus data struktur lama
            StrukturOrganisasi::query()->delete();

            // PERBAIKAN: Simpan struktur organisasi dengan foto
            if ($request->has('divisions')) {
                Log::info('Processing divisions...');
                
                foreach ($request->divisions as $divisionIndex => $division) {
                    if (empty($division['nama_divisi'])) continue;

                    $divisionName = $division['nama_divisi'];
                    $divisionOrder = $divisionIndex + 1;

                    Log::info("Processing division: {$divisionName}");

                    if (isset($division['staff']) && is_array($division['staff'])) {
                        foreach ($division['staff'] as $staffIndex => $staff) {
                            if (empty($staff['nama']) || empty($staff['jabatan'])) continue;

                            $staffData = [
                                'nama_divisi' => $divisionName,
                                'divisi_order' => $divisionOrder,
                                'nama' => $staff['nama'],
                                'jabatan' => $staff['jabatan'],
                                'email' => $staff['email'] ?? null,
                                'staff_order' => $staffIndex + 1,
                                'is_active' => 1
                            ];

                            // PERBAIKAN: Handle foto staff dengan benar
                            $fotoFieldName = "divisions.{$divisionIndex}.staff.{$staffIndex}.foto";
                            Log::info("Checking for staff photo: {$fotoFieldName}");
                            
                            if ($request->hasFile($fotoFieldName)) {
                                Log::info("Staff photo found: {$fotoFieldName}");
                                $file = $request->file($fotoFieldName);
                                
                                if ($file && $file->isValid()) {
                                    $filename = "staff_{$divisionIndex}_{$staffIndex}_" . time() . '.' . $file->getClientOriginalExtension();
                                    $path = $file->storeAs('struktur-organisasi', $filename, 'public');
                                    $staffData['foto'] = $path;
                                    Log::info("Staff photo stored at: {$path}");
                                }
                            } else {
                                Log::info("No staff photo for: {$fotoFieldName}");
                            }

                            $staffRecord = StrukturOrganisasi::create($staffData);
                            Log::info('Staff record created:', $staffRecord->toArray());
                        }
                    }
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan'
            ]);

        } catch (\Exception $e) {
            Log::error('Store error: ' . $e->getMessage());
            Log::error('Store trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getData()
    {
        try {
            $headData = DescHeadStructure::first();
            $structure = StrukturOrganisasi::orderBy('divisi_order')
                                        ->orderBy('staff_order')
                                        ->get()
                                        ->groupBy('nama_divisi');

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

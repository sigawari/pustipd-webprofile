<?php
namespace App\Models\TentangKami;

use Illuminate\Database\Eloquent\Model;

class StrukturOrganisasi extends Model
{
    protected $table = 'struktur_organisasis';
    
    protected $fillable = [
        'nama_divisi',
        'divisi_order',
        'nama',
        'jabatan', 
        'email',
        'foto',
        'staff_order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'divisi_order' => 'integer',
        'staff_order' => 'integer',
    ];

    // Scope untuk data aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Method untuk mendapatkan struktur organisasi yang terorganisir
    public static function getOrganizationStructure()
    {
        return static::active()
                    ->orderBy('divisi_order')
                    ->orderBy('staff_order')
                    ->get()
                    ->groupBy('nama_divisi');
    }

    // Method untuk mendapatkan semua divisi yang unik
    public static function getAllDivisions()
    {
        return static::active()
                    ->select('nama_divisi', 'divisi_order')
                    ->distinct()
                    ->orderBy('divisi_order')
                    ->pluck('nama_divisi');
    }

    // Method untuk mendapatkan data per divisi
    public static function getDivisionStaff($divisionName)
    {
        return static::active()
                    ->where('nama_divisi', $divisionName)
                    ->orderBy('staff_order')
                    ->get();
    }
}

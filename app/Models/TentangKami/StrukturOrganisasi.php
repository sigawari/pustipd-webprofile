<?php
namespace App\Models\TentangKami;

use Illuminate\Database\Eloquent\Model;

class StrukturOrganisasi extends Model
{
    protected $table = 'struktur_organisasis';
    
    protected $fillable = [
        'nama',
        'jabatan', 
        'divisi',
        'foto',
        'urutan_index',
        'status'
    ];

    // Scope untuk data published/active
    public function scopePublished($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Method untuk homepage carousel
    public static function getCarouselData()
    {
        return static::where('status', 'active')
                    ->orderBy('urutan_index')
                    ->get();
    }

    // Method untuk tree structure di halaman structure
    public static function getTreeStructure()
    {
        return static::where('status', 'active')
                    ->orderBy('divisi')
                    ->orderBy('urutan_index')
                    ->get()
                    ->groupBy('divisi');
    }

    // Method untuk management admin
    public static function getAllForManagement()
    {
        return static::orderBy('divisi')->orderBy('urutan_index')->get();
    }
}

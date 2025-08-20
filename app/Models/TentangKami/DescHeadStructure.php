<?php
namespace App\Models\TentangKami;

use Illuminate\Database\Eloquent\Model;

class DescHeadStructure extends Model
{
    protected $table = 'desc_head_structure';
    
    protected $fillable = [
        'structure_desc',
        'nama_kepala',
        'jabatan_kepala',
        'email_kepala',
        'foto_kepala',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    // Scope untuk data aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Method untuk mendapatkan data kepala organisasi aktif
    public static function getActiveHead()
    {
        return static::active()->orderBy('sort_order')->first();
    }

    // Method untuk mendapatkan deskripsi struktur
    public static function getDescription()
    {
        $head = static::getActiveHead();
        return $head ? $head->structure_desc : null;
    }
}

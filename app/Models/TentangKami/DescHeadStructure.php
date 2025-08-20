<?php
namespace App\Models\TentangKami;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DescHeadStructure extends Model
{
    use HasFactory;
    
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

    // PERBAIKAN: Gunakan public $timestamps = true (default Laravel)
    public $timestamps = true;

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public static function getActiveHead()
    {
        \Log::info('getActiveHead called');
        $result = self::where('is_active', 1)->first();
        \Log::info('getActiveHead result:', $result ? $result->toArray() : ['null']);
        return $result;
    }
    
    public static function getDescription()
    {
        \Log::info('getDescription called');
        $result = self::where('is_active', 1)->value('structure_desc');
        \Log::info('getDescription result:', ['desc' => $result]);
        return $result;
    }

    // Accessor untuk foto kepala (seperti di model Profil)
    public function getFotoKepalaUrlAttribute()
    {
        return $this->foto_kepala ? asset('storage/' . $this->foto_kepala) : null;
    }

    // PERBAIKAN: Hapus method saveHeadData yang bermasalah
    // Gunakan pattern Laravel standar saja
}

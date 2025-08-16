<?php

namespace App\Models;

use App\Models\Dokumen\Sop;
use App\Models\Dokumen\Panduan;
use App\Models\Dokumen\Regulasi;
use App\Models\Dokumen\Ketetapan;
use Illuminate\Database\Eloquent\Model;
use App\Models\InformasiTerkini\KelolaBerita;
use App\Models\InformasiTerkini\KelolaPengumuman;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dashboard extends Model
{
    /** @use HasFactory<\Database\Factories\DashboardFactory> */
    use HasFactory;
    protected $fillable = [
        'kelola_beritas_id',
        'ketetapans_id',
        'regulasis_id',
        'panduans_id',
        'sops_id', 
        'pengumumans_id',
    ];
    // You can add relationships here if needed

    // Relationships Berita
    public function kelolaBerita()
    {
        return $this->belongsTo(KelolaBerita::class, 'kelola_beritas_id');
    }
    // Add other relationships as needed
    public function ketetapan()
    {
        return $this->belongsTo(Ketetapan::class, 'ketetapans_id');
    }
    public function regulasi()
    {
        return $this->belongsTo(Regulasi::class, 'regulasis_id'); 
    }
    public function panduan()
    {
        return $this->belongsTo(Panduan::class, 'panduans_id');
    }
    public function sop()
    {
        return $this->belongsTo(Sop::class, 'sops_id');
    }
    public function pengumuman()
    {
        return $this->belongsTo(KelolaPengumuman::class, 'pengumumans_id');
    }

}
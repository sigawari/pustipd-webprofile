<?php
namespace App\Models;

use App\Models\Faq;
use App\Models\Dokumen\Sop;
use App\Models\Beranda\Mitra;
use App\Models\Beranda\Layanan;
use App\Models\Dokumen\Panduan;
use App\Models\Dokumen\Regulasi;
use App\Models\Dokumen\Ketetapan;
use App\Models\Beranda\Pencapaian;
use App\Models\TentangKami\Profil;
use App\Models\TentangKami\Gallery;
use App\Models\TentangKami\VisiMisi;
use Illuminate\Database\Eloquent\Model;
use App\Models\InformasiTerkini\KelolaBerita;
use App\Models\TentangKami\StrukturOrganisasi;
use App\Models\InformasiTerkini\KelolaTutorial;
use App\Models\InformasiTerkini\KelolaPengumuman;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Publics extends Model
{
    /** @use HasFactory<\Database\Factories\PublicsFactory> */
    use HasFactory;

    protected $fillable = [
        'profils_id',
        'pencapaians_id',
        'layanans_id',
        'kelola_beritas_id',
        'kelola_pengumumans_id',
        'struktur_organisasis_id',
        'mitras_id',
        'galleris_id',
        'visi_misi_id',
        'kelola_tutorials_id',
        'ketetapans_id',
        'panduans_id',
        'regulasis_id',
        'sops_id',
        'faq_id',
    ];

    // Relationships
    public function profil()
    {
        return $this->belongsTo(Profil::class, 'profils_id');
    }

    public function pencapaian()
    {
        return $this->belongsTo(Pencapaian::class, 'pencapaians_id');
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'layanans_id');
    }

    public function kelolaBerita()
    {
        return $this->belongsTo(KelolaBerita::class, 'kelola_beritas_id');
    }

    public function kelolaPengumuman()
    {
        return $this->belongsTo(KelolaPengumuman::class, 'kelola_pengumumans_id');
    }

    public function strukturOrganisasi()
    {
        return $this->belongsTo(StrukturOrganisasi::class, 'struktur_organisasis_id');
    }

    public function mitra()
    {
        return $this->belongsTo(Mitra::class, 'mitras_id');
    }

    public function galleri()
    {
        return $this->belongsTo(Gallery::class, 'galleris_id');
    }

    public function visi_misi()
    {
        return $this->belongsTo(VisiMisi::class, 'visi_misi_id');
    }

    public function kelolaTutorial()
    {
        return $this->belongsTo(KelolaTutorial::class, 'kelola_tutorials_id');
    }

    public function ketetapan()
    {
        return $this->belongsTo(Ketetapan::class, 'ketetapans_id');
    }

    public function panduan()
    {
        return $this->belongsTo(Panduan::class, 'panduans_id');
    }

    public function regulasi()
    {
        return $this->belongsTo(Regulasi::class, 'regulasis_id');
    }

    public function sop()
    {
        return $this->belongsTo(Sop::class, 'sops_id');
    }

    public function faq()
    {
        return $this->belongsTo(Faq::class, 'faq_id');
    }
}

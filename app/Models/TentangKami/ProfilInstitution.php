<?php

namespace App\Models\TentangKami;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfilInstitution extends Model
{
    use HasFactory;

    protected $table = 'profil_institutions';

    protected $fillable = ['profil_id', 'name', 'url', 'sort_order'];

    public function profil()
    {
        return $this->belongsTo(Profil::class);
    }
}

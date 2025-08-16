<?php

namespace App\Models\TentangKami;

use App\Models\Publics;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profil extends Model
{
    /** @use HasFactory<\Database\Factories\ProfilFactory> */
    use HasFactory;
    protected $fillable = [
        'organization_name',
        'description',
        'address',
        'email',
        'instagram_url',
        'facebook_url',
        'youtube_url',
        'profil_photo',
        'applications',
        'institutions',
        'universities',
    ];

    protected $casts = [
        'applications' => 'array',
        'institutions' => 'array',
        'universities' => 'array',
    ];

    //Relationships
    public function publics () {
        return $this->belongsTo(Publics::class);
    }
}

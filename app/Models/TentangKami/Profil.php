<?php

namespace App\Models\TentangKami;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}

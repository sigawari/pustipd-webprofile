<?php

namespace App\Models\ManageContent\AboutUs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /** @use HasFactory<\Database\Factories\ProfileFactory> */
    use HasFactory;
    protected $fillable = [
        'organization_name',
        'description',
        'address',
        'email',
        'instagram_url',
        'facebook_url',
        'youtube_url',
        'profile_photo',
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

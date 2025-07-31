<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManageContent extends Model
{
    protected $fillable = [
        'type',
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

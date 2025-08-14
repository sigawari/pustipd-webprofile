<?php
// app/Models/ManageContent/AboutUs/Gallery.php

namespace App\Models\TentangKami;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'event_date',
        'status',
    ];

    protected $casts = [
        'event_date' => 'date',
    ];

    /**
     * Get image URL dengan fallback ke placeholder
     */
    public function getImageUrlAttribute()
    {
        if ($this->image && file_exists(storage_path('app/public/' . $this->image))) {
            return asset('storage/' . $this->image);
        }
        return asset('assets/img/placeholder/dummy.png');
    }

    /**
     * Scope untuk filter status published
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}

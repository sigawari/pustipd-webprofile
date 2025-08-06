<?php

namespace App\Models\ManageContent\AboutUs;

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
        'sort_order'
    ];

    protected $casts = [
        'event_date' => 'date',
    ];

    /**
     * Scope untuk filter status
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'publish');
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    public function scopeArchived($query)
    {
        return $query->where('status', 'archived');
    }

    /**
     * Get image URL
     */
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : asset('images/no-image.png');
    }

    /**
     * Get status badge color
     */
    public function getStatusColorAttribute()
    {
        return match ($this->status) {
            'publish' => 'green',
            'draft' => 'yellow',
            'archived' => 'red',
            default => 'gray',
        };
    }

    /**
     * Get status display text
     */
    public function getStatusTextAttribute()
    {
        return match ($this->status) {
            'publish' => 'Dipublikasi',
            'draft' => 'Draft',
            'archived' => 'Diarsipkan',
            default => 'Unknown',
        };
    }
}

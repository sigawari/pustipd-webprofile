<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Ketetapan extends Model
{
    protected $table = 'ketetapans';
    
    protected $fillable = [
        'title',
        'description', 
        'file_path',
        'original_filename',
        'file_size',
        'file_type',
        'year_published',
        'status',
        // ❌ HAPUS: 'sort_order'
    ];

    protected $casts = [
        'file_size' => 'integer',
        'year_published' => 'integer',
    ];

    // Default scope untuk auto sorting
    protected static function boot()
    {
        parent::boot();

        // Auto delete file saat model dihapus
        static::deleting(function ($ketetapan) {
            if ($ketetapan->file_path && Storage::disk('public')->exists($ketetapan->file_path)) {
                Storage::disk('public')->delete($ketetapan->file_path);
            }
        });
    }

    // Accessor untuk format file size
    public function getFormattedFileSizeAttribute()
    {
        if (!$this->file_size) return null;
        
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    // Accessor untuk URL file
    public function getFileUrlAttribute()
    {
        if (!$this->file_path) return null;
        return asset('storage/' . $this->file_path);
    }

    // Accessor untuk cek file exists
    public function getFileExistsAttribute()
    {
        if (!$this->file_path) return false;
        return Storage::disk('public')->exists($this->file_path);
    }

    // Scope untuk published
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    // Scope untuk active (published saja)
    public function scopeActive($query)
    {
        return $query->where('status', 'published');
    }

    // Scope untuk search
    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('title', 'like', '%' . $search . '%')
              ->orWhere('description', 'like', '%' . $search . '%')
              ->orWhere('year_published', 'like', '%' . $search . '%');
        });
    }
}

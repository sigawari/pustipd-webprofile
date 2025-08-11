<?php
// Di Model Ketetapan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Ketetapan extends Model
{
    protected $fillable = [
        'title',
        'description', 
        'file_path',
        'original_filename',
        'file_size',
        'file_type',
        'year_published',
        'status'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getFileExistsAttribute()
    {
        return $this->file_path && Storage::disk('public')->exists($this->file_path);
    }

    // ✅ TAMBAHKAN: Accessor untuk formatted file size
    public function getFormattedFileSizeAttribute()
    {
        if (!$this->file_size) return '-';
        
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    // ✅ TAMBAHKAN: Accessor untuk download URL
    public function getDownloadUrlAttribute()
    {
        if (!$this->file_path || !$this->file_exists) {
            return null;
        }
        
        return route('ketetapan.download', $this->id);
    }

    // ✅ TAMBAHKAN: Scope untuk published only
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    // ✅ TAMBAHKAN: Scope untuk search
    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%");
        });
    }
    public function download(Ketetapan $ketetapan)
    {
        // ✅ PERBAIKAN: Cek status published untuk akses public
        if (!auth()->check()) {
            // Jika user tidak login (akses public), cek status published
            if ($ketetapan->status !== 'published') {
                abort(404, 'Dokumen tidak tersedia untuk publik');
            }
        }

        // Cek file exists
        if (!$ketetapan->file_path || !Storage::disk('public')->exists($ketetapan->file_path)) {
            abort(404, 'File tidak ditemukan');
        }

        $filePath = Storage::disk('public')->path($ketetapan->file_path);
        $downloadName = $ketetapan->original_filename ?? ($ketetapan->title . '.' . $ketetapan->file_type);
        
        // ✅ TAMBAHKAN: Log download activity (optional)
        \Log::info('File downloaded', [
            'ketetapan_id' => $ketetapan->id,
            'title' => $ketetapan->title,
            'user_ip' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);
        
        return response()->download($filePath, $downloadName);
    }
    public function scopeDownloadable($query)
    {
        return $query->where('status', 'published')
                    ->whereNotNull('file_path');
    }

    /**
     * Check if file is downloadable
     */
    public function getIsDownloadableAttribute()
    {
        return $this->status === 'published' && 
            $this->file_path && 
            Storage::disk('public')->exists($this->file_path);
    }

}

<?php
// Di Model regulasi.php

namespace App\Models\Dokumen;

use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Regulasi extends Model
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

    // Accessor untuk formatted file size
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

    // Accessor untuk download URL
    public function getDownloadUrlAttribute()
    {
        if (!$this->file_path || !$this->file_exists) {
            return null;
        }
        
        return route('regulasi.download', $this->id);
    }

    // Scope untuk published only
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    // Scope untuk search
    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%");
        });
    }
    public function download(Regulasi $regulasi)
    {
         // Cek status published untuk akses public
        if (!\Illuminate\Support\Facades\Auth::check()) {
            // Jika user tidak login (akses public), cek status published
            if ($regulasi->status !== 'published') {
                abort(404, 'Dokumen tidak tersedia untuk publik');
            }
        }

        // Cek file exists
        if (!$regulasi->file_path || !Storage::disk('public')->exists($regulasi->file_path)) {
            abort(404, 'File tidak ditemukan');
        }

        $filePath = Storage::disk('public')->path($regulasi->file_path);
        $downloadName = $regulasi->original_filename ?? ($regulasi->title . '.' . $regulasi->file_type);
        
        // Log download activity (optional)
        Log::info('File downloaded', [
            'Regulasi_id' => $regulasi->id,
            'title' => $regulasi->title,
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

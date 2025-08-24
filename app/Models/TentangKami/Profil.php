<?php

namespace App\Models\TentangKami;

use App\Models\Publics;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Profil extends Model
{
    use HasFactory;

    protected $table = 'profils';

    protected $fillable = [
        'organization_name',
        'description',
        'address',
        'email',
        'instagram_url',
        'facebook_url',
        'youtube_url',
        'applications',
        'institutions',
        'universities',
        'profil_photo',
    ];

    protected $casts = [
        'applications' => 'array',
        'institutions' => 'array',
        'universities' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Set default values for array fields
    protected $attributes = [
        'applications' => '[]',
        'institutions' => '[]',
        'universities' => '[]',
    ];

    // Relationships
    public function publics()
    {
        return $this->belongsTo(Publics::class);
    }

    // Accessor untuk mendapatkan URL foto profil dengan fallback
    public function getProfilPhotoUrlAttribute()
    {
        if ($this->profil_photo && Storage::disk('public')->exists($this->profil_photo)) {
            return Storage::url($this->profil_photo);
        }
        
        // Return default image jika tidak ada foto
        return asset('images/default-profile.png'); // Sesuaikan path default image
    }

    // Accessor untuk cek apakah foto profil ada
    public function getHasProfilPhotoAttribute()
    {
        return !empty($this->profil_photo) && Storage::disk('public')->exists($this->profil_photo);
    }

    // Mutator untuk memastikan array fields tidak null
    public function setApplicationsAttribute($value)
    {
        $this->attributes['applications'] = $this->filterArrayData($value);
    }

    public function setInstitutionsAttribute($value)
    {
        $this->attributes['institutions'] = $this->filterArrayData($value);
    }

    public function setUniversitiesAttribute($value)
    {
        $this->attributes['universities'] = $this->filterArrayData($value);
    }

    // Helper method untuk filter array data
    private function filterArrayData($data)
    {
        if (!is_array($data)) {
            return json_encode([]);
        }

        $filtered = array_filter($data, function($item) {
            return is_array($item) && 
                   (!empty($item['name']) || !empty($item['url']));
        });

        return json_encode(array_values($filtered));
    }

    // Accessor untuk mendapatkan array yang sudah difilter
    public function getApplicationsAttribute($value)
    {
        $decoded = json_decode($value, true) ?? [];
        return array_filter($decoded, function($item) {
            return is_array($item) && (!empty($item['name']) || !empty($item['url']));
        });
    }

    public function getInstitutionsAttribute($value)
    {
        $decoded = json_decode($value, true) ?? [];
        return array_filter($decoded, function($item) {
            return is_array($item) && (!empty($item['name']) || !empty($item['url']));
        });
    }

    public function getUniversitiesAttribute($value)
    {
        $decoded = json_decode($value, true) ?? [];
        return array_filter($decoded, function($item) {
            return is_array($item) && (!empty($item['name']) || !empty($item['url']));
        });
    }

    // Method untuk mendapatkan total links
    public function getTotalLinksAttribute()
    {
        return count($this->applications) + count($this->institutions) + count($this->universities);
    }

    // Method untuk validasi URL sosial media
    public function validateSocialUrls()
    {
        $errors = [];

        if ($this->instagram_url && !preg_match('/^https:\/\/(www\.)?instagram\.com\//', $this->instagram_url)) {
            $errors['instagram_url'] = 'URL Instagram tidak valid';
        }

        if ($this->facebook_url && !preg_match('/^https:\/\/(www\.)?facebook\.com\//', $this->facebook_url)) {
            $errors['facebook_url'] = 'URL Facebook tidak valid';
        }

        if ($this->youtube_url && !preg_match('/^https:\/\/(www\.)?youtube\.com\//', $this->youtube_url)) {
            $errors['youtube_url'] = 'URL YouTube tidak valid';
        }

        return $errors;
    }

    // Scope untuk single instance system
    public function scopeProfile($query)
    {
        return $query->first();
    }

    // Boot method untuk ensure single record
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Prevent multiple profiles if needed
            if (static::count() > 0) {
                throw new \Exception('Hanya satu profil yang diizinkan. Gunakan update untuk mengubah data.');
            }
        });

        static::deleting(function ($model) {
            // Delete profile photo when deleting record
            if ($model->profil_photo && Storage::disk('public')->exists($model->profil_photo)) {
                Storage::disk('public')->delete($model->profil_photo);
            }
        });
    }
}

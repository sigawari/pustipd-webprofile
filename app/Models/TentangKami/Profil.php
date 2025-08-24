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
        'profil_photo',
        'hero_image', 
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function applications()
    {
        return $this->hasMany(ProfilApplication::class)->orderBy('sort_order');
    }

    public function institutions()
    {
        return $this->hasMany(ProfilInstitution::class)->orderBy('sort_order');
    }

    public function universities()
    {
        return $this->hasMany(ProfilUniversity::class)->orderBy('sort_order');
    }

    public function publics()
    {
        return $this->belongsTo(Publics::class);
    }

    // Accessor untuk profil_photo dengan fallback
    public function getProfilPhotoUrlAttribute()
    {
        if ($this->profil_photo && Storage::disk('public')->exists($this->profil_photo)) {
            return Storage::url($this->profil_photo);
        }
        return asset('images/default-profile.png'); // sesuaikan default
    }

    // Cek apakah profil_photo ada dan valid
    public function getHasProfilPhotoAttribute()
    {
        return !empty($this->profil_photo) && Storage::disk('public')->exists($this->profil_photo);
    }

    // Accessor untuk hero_image dengan fallback
    public function getHeroImageUrlAttribute()
    {
        if ($this->hero_image && Storage::disk('public')->exists($this->hero_image)) {
            return Storage::url($this->hero_image);
        }
        return asset('images/default-hero.jpg'); // sesuaikan default hero image
    }

    public function getHasHeroImageAttribute()
    {
        return !empty($this->hero_image) && Storage::disk('public')->exists($this->hero_image);
    }

    // Method validasi URL sosial media
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

    // Scope untuk single record system
    public function scopeProfile($query)
    {
        return $query->first();
    }

    // Boot method untuk single record dan hapus file foto
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (static::count() > 0) {
                throw new \Exception('Hanya satu profil yang diizinkan. Gunakan update untuk mengubah data.');
            }
        });

        static::deleting(function ($model) {
            foreach (['profil_photo', 'hero_image'] as $field) {
                if ($model->$field && Storage::disk('public')->exists($model->$field)) {
                    Storage::disk('public')->delete($model->$field);
                }
            }
        });
    }
}

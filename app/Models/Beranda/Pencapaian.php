<?php

namespace App\Models\Beranda;

use App\Models\Publics;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pencapaian extends Model
{
    use HasFactory;

    protected $table = 'pencapaians';

    protected $fillable = [
        'name',
        'description',
        'status',
    ];

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    public function publics()
    {
        return $this->belongsTo(Publics::class);
    }
}
<?php

namespace App\Models\ManageContent\Homepage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database
     */
    protected $table = 'layanans';

    /**
     * Field yang boleh diisi mass assignment
     */
    protected $fillable = [
        'name',
        'description'
    ];

    /**
     * Scope untuk FAQ yang published
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}

<?php

namespace App\Models\ManageContent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppLayanan extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database
     */
    protected $table = 'applayanans';

    /**
     * Field yang boleh diisi mass assignment
     */
    protected $fillable = [
        'question',
        'answer',
        'sort_order',
        'status'
    ];

    /**
     * Cast tipe data
     */
    protected $casts = [
        'sort_order' => 'integer',
    ];

    /**
     * Scope untuk applayanan yang published
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope untuk urutan applayanan
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }
}

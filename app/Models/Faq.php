<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Publics;

class Faq extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database
     */
    protected $table = 'faqs';

    /**
     * Field yang boleh diisi mass assignment
     */
    protected $fillable = [
        'question',
        'answer',
        'status'
    ];

    /**
     * Scope untuk FAQ yang published
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function publics () {
        return $this->hasMany(Publics::class);
    }
}

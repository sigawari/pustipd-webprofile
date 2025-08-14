<?php

namespace App\Models\InformasiTerkini;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KelolaBerita extends Model
{
    /** @use HasFactory<\Database\Factories\KelolaBeritaFactory> */
    use HasFactory;
    protected $fillable = [
        'category',
        'name',
        'slug',
        'tags',
        'publish_date',
        'status',
        'image',
        'content',
    ];

}
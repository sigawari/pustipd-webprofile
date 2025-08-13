<?php

namespace App\Models\ManageContent\KelolaBerita;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
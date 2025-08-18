<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    // Isi fillable, guarded, relasi jika ada
    protected $fillable = ['title', 'excerpt', 'date', 'category', 'slug', 'urgency'];
}

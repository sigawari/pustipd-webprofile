<?php

namespace App\Models\InformasiTerkini;

use App\Models\Dashboard;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\KelolaBeritaFactory;
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

    public function dashboard()
    {
        return $this->belongsTo(Dashboard::class);
    }

    protected static function newFactory()
    {
        return KelolaBeritaFactory::new();
    }
}
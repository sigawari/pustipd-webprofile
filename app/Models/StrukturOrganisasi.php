<?php
// app/Models/StrukturOrganisasi.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StrukturOrganisasi extends Model
{
    protected $table = 'struktur_organisasis'; // Table yang sudah ada
    
    protected $fillable = [
        'nama',
        'jabatan', 
        'divisi',
        'foto',
        'urutan_index',
        'status'
    ];

    // ✅ Method untuk single entry management
    public static function getAllForManagement()
    {
        return static::orderBy('divisi')->orderBy('urutan_index')->get();
    }

    public static function getCarouselData()
    {
        return static::where('status', 'active')
                    ->orderBy('urutan_index')
                    ->get();
    }

    public static function getTreeStructure()
    {
        return static::where('status', 'active')
                    ->orderBy('urutan_index')
                    ->get()
                    ->groupBy('divisi');
    }
}

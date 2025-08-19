<?php
// app/Models/ManageContent/AboutUs/VisiMisi.php

namespace App\Models\TentangKami;

use Illuminate\Database\Eloquent\Model;

class VisiMisi extends Model
{
    protected $table = 'visi_misis';
    
    protected $fillable = [
        'id',
        'visi',
        'misi',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'misi' => 'array' // Otomatis convert JSON ke array
    ];

    public static function getActive()
    {
        return self::where('is_active', true)->first();
    }

    public function getMisiItems()
    {
        return collect($this->misi ?: [])->map(function ($item, $index) {
            return (object) [
                'id' => $index,
                'description' => $item,
                'sort_order' => $index + 1
            ];
        });
    }

    public function addMisi($description)
    {
        $misiArray = $this->misi ?: [];
        $misiArray[] = $description;
        $this->update(['misi' => $misiArray]);
    }

    public function updateMisi($index, $description)
    {
        $misiArray = $this->misi ?: [];
        if (isset($misiArray[$index])) {
            $misiArray[$index] = $description;
            $this->update(['misi' => $misiArray]);
        }
    }

    public function deleteMisi($index)
    {
        $misiArray = $this->misi ?: [];
        if (isset($misiArray[$index])) {
            unset($misiArray[$index]);
            $misiArray = array_values($misiArray); // Re-index array
            $this->update(['misi' => $misiArray]);
        }
    }
}

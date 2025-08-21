<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\InformasiTerkini\KelolaBerita;

class KelolaBeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Mix berbagai jenis berita
        KelolaBerita::factory()->published()->count(15)->create();
        KelolaBerita::factory()->draft()->count(5)->create();
        KelolaBerita::factory()->academic()->published()->count(8)->create();
        KelolaBerita::factory()->library()->published()->count(7)->create();
        KelolaBerita::factory()->recent()->count(10)->create();
    }

}

<?php
// database/migrations/create_struktur_organisasis_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('struktur_organisasis', function (Blueprint $table) {
            $table->id();
            
            // Data divisi
            $table->string('nama_divisi'); // Nama divisi yang bisa diinput bebas
            $table->integer('divisi_order')->default(1); // Urutan tampilan divisi
            
            // Data personal staf dalam divisi
            $table->string('nama'); // Sesuai dengan 'nama_kepala' di tabel head
            $table->string('jabatan'); // Sesuai dengan 'jabatan_kepala' di tabel head
            $table->string('email')->nullable(); // Sesuai dengan 'email_kepala' di tabel head
            $table->string('foto')->nullable(); // Sesuai dengan 'foto_kepala' di tabel head
            
            // Urutan staf dalam divisi
            $table->integer('staff_order')->default(1); // Urutan staf dalam satu divisi
            
            // Status
            $table->boolean('is_active')->default(true); // Konsisten dengan tabel head
            
            $table->timestamps();
            
            // Indexes untuk performa query
            $table->index(['nama_divisi', 'divisi_order']); // Query per divisi
            $table->index(['nama_divisi', 'staff_order']); // Urutan staf dalam divisi
            $table->index('is_active'); // Filter status aktif
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('struktur_organisasis');
    }
};

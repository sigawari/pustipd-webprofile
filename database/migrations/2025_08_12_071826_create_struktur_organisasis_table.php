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
            
            // Data personal anggota
            $table->string('nama');
            $table->string('jabatan');
            $table->string('email')->nullable();
            $table->string('foto')->nullable();
            
            // Data organisasi
            $table->string('divisi'); // Tidak lagi enum, bisa diinput bebas
            $table->enum('level', ['kepala', 'anggota'])->default('anggota'); // Level dalam struktur
            
            // Data urutan dan organisasi
            $table->integer('urutan_index')->default(1); // Urutan dalam divisi
            $table->integer('division_order')->nullable(); // Urutan divisi
            
            // Metadata organisasi (disimpan di setiap record untuk simplicity)
            $table->string('org_name')->nullable(); // Nama organisasi
            $table->text('org_description')->nullable(); // Deskripsi organisasi
            
            // Status publikasi
            $table->enum('status', ['draft', 'published', 'inactive'])->default('draft');
            
            $table->timestamps();
            
            // Indexes untuk performa
            $table->index(['status', 'level']);
            $table->index(['divisi', 'urutan_index']);
            $table->index(['level', 'urutan_index']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('struktur_organisasis');
    }
};

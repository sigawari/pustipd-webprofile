<?php
// database/migrations/create_struktur_organisasis_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Migration: create_struktur_organisasis_table.php
        Schema::create('struktur_organisasis', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('jabatan');
            $table->enum('divisi', [
                'Manajemen',
                'Jaringan', 
                'Pengembangan Aplikasi',
                'Pangkalan Data'
            ]);
            $table->string('foto')->nullable();
            $table->integer('urutan_index')->default(1);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('struktur_organisasis');
    }
};

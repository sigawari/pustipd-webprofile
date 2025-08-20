<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('desc_head_structure', function (Blueprint $table) {
            $table->id(); // Primary key
            
            // Deskripsi halaman struktur organisasi
            $table->text('structure_desc')->nullable();
            
            // Data kepala organisasi
            $table->string('nama_kepala');
            $table->string('jabatan_kepala')->default('Kepala PUSTIPD');
            $table->string('email_kepala')->nullable();
            $table->string('foto_kepala')->nullable(); // Path/nama file foto
            
            // Metadata tambahan
            $table->boolean('is_active')->default(true); // Status aktif/nonaktif
            $table->integer('sort_order')->default(1); // Urutan tampilan jika ada multiple records
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desc_head_structure');
    }
};

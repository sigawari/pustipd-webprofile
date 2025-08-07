<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ketetapans', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Nama ketetapan
            $table->text('description'); // Deskripsi
            $table->string('file_path')->nullable(); // Path file dokumen
            $table->string('original_filename')->nullable(); // Nama file asli
            $table->bigInteger('file_size')->nullable(); // Ukuran file dalam bytes
            $table->string('file_type')->nullable(); // Tipe file (pdf, doc, etc)
            $table->year('year_published')->nullable(); // Tahun terbit
            $table->enum('status', ['published', 'draft', 'archived'])->default('draft');
            // ❌ HAPUS: $table->integer('sort_order')->default(0); 
            $table->timestamps();

            // Indexes untuk performa
            $table->index('status');
            $table->index('year_published');
            $table->index('created_at'); // Index untuk sorting by created_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ketetapans');
    }
};

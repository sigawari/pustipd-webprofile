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
            $table->id();
            $table->text('structure_desc')->nullable();
            $table->string('nama_kepala');
            $table->string('jabatan_kepala');
            $table->string('email_kepala')->nullable();
            $table->string('foto_kepala')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(1);
            $table->timestamps(); // PENTING: Pastikan ada timestamps
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

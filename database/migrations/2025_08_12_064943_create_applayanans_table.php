<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applayanans', function (Blueprint $table) {
            $table->id();
            $table->string('appname');
            $table->text('description');
            $table->enum('category', [
                'akademik', 
                'pegawai', 
                'pembelajaran', 
                'administrasi'
            ]);
            $table->string('applink', 500)->nullable();
            $table->enum('status', [
                'draft', 
                'published', 
                'archived'
            ])->default('draft');
            $table->timestamps();
            
            // ✅ CUKUP: Regular indexes untuk performance
            $table->index('status');
            $table->index('category');
            $table->index(['status', 'category']);
        });
        
        // ✅ HAPUS: Bagian fulltext index tidak diperlukan
    }

    public function down(): void
    {
        Schema::dropIfExists('applayanans');
    }
};

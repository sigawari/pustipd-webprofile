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
        Schema::create('kelola_tutorials', function (Blueprint $table) {
            $table->id();
            
            // ✅ Basic Tutorial Info
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable(); // untuk excerpt di list & meta description
            
            // ✅ Tutorial Category
            $table->enum('category', [
                'web_development',     // Web Development
                'database',           // Database
                'server_management',  // Server Management  
                'security',          // Security
                'technology',        // Teknologi (general)
                'academic_services', // Layanan Akademik
                'library_resources' // Sumber Daya Perpustakaan
            ]);
            
            // ✅ Status & Publishing
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->date('published_at')->nullable(); // untuk display tanggal di halaman publik
            
            // ✅ Simple Analytics
            $table->integer('view_count')->default(0);
            $table->timestamp('last_viewed_at')->nullable();
            
            // ✅ Timestamps
            $table->timestamps();
            
            // ✅ Indexes
            $table->index(['category', 'status']);
            $table->index(['status', 'published_at']);
            $table->index('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelola_tutorials');
    }
};

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
        Schema::create('kelola_pengumumans', function (Blueprint $table) {
            $table->id();
            
            // Core Content Fields
            $table->string('title');
            $table->text('content');
            $table->text('excerpt')->nullable();
            
            // PUSTIPD Kategori - sesuai dengan controller
            $table->enum('category', [
                'maintenance',      // Maintenance & Gangguan Sistem
                'layanan',         // Layanan & Fasilitas IT
                'infrastruktur',   // Infrastruktur & Jaringan
                'administrasi',    // Administrasi PUSTIPD
                'darurat'          // Darurat & Penting
            ]);
            
            // Tingkat Urgency/Prioritas
            $table->enum('urgency', [
                'normal',        
                'penting',   
            ])->default('normal');

            $table->boolean('is_priority')->default(false);

            
            $table->string('slug')->unique();
            
            $table->date('date');                           
            $table->datetime('valid_until')->nullable();   
            
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');

            
            $table->integer('view_count')->default(0);     
            $table->timestamp('last_viewed_at')->nullable(); 
            
            $table->timestamps();
            
            $table->index(['category', 'status']);         
            $table->index(['urgency', 'date']);           
            $table->index('valid_until');                 
            $table->index(['status', 'date']);            
            $table->index('view_count');                  
            $table->index('slug');  
            $table->index('is_priority');                   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelola_pengumumans');  
    }
};

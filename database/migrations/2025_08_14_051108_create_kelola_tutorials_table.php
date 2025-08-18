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

            // Basic Info
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content')->nullable();
            $table->text('excerpt')->nullable();
            $table->json('content_blocks')->nullable();
            $table->boolean('is_hidden')->default(false);


            // Category - sesuai dengan analisis PUSTIPD
            $table->enum('category', [
                'sistem_informasi_akademik',
                'e_learning',
                'layanan_digital_mahasiswa', 
                'pengelolaan_data_akun',
                'jaringan_konektivitas',
                'software_aplikasi',
                'keamanan_digital',
                'penelitian_akademik',
                'layanan_publik',
                'mobile_responsive'
            ]);

            // Tags untuk flexible categorization
            $table->json('tags')->nullable();

            // Publishing
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->date('date')->nullable(); // Tanggal tutorial

            // Analytics
            $table->integer('view_count')->default(0);

            // Featured flag
            $table->boolean('is_featured')->default(false);

            $table->timestamps();

            // Indexes untuk performance
            $table->index(['category', 'status']);
            $table->index(['status', 'date']);
            $table->index('slug');
            $table->index('view_count');
            $table->index('is_featured');
            $table->index(['status', 'is_featured']);
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

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
        Schema::create('publics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profils_id')->constrained()->onDelete('cascade');
            $table->foreignId('pencapaians_id')->constrained()->onDelete('cascade');
            $table->foreignId('layanans_id')->constrained()->onDelete('cascade');
            $table->foreignId('kelola_beritas_id')->constrained()->onDelete('cascade');
            $table->foreignId('kelola_pengumumans_id')->constrained()->onDelete('cascade');
            $table->foreignId('struktur_organisasis_id')->constrained()->onDelete('cascade');
            $table->foreignId('mitras_id')->constrained()->onDelete('cascade');
            $table->foreignId('galleris_id')->constrained()->onDelete('cascade');
            $table->foreignId('visi_misi_id')->constrained()->onDelete('cascade');
            $table->foreignId('kelola_tutorials_id')->constrained()->onDelete('cascade');
            $table->foreignId('ketetapans_id')->constrained()->onDelete('cascade');
            $table->foreignId('panduans_id')->constrained()->onDelete('cascade');
            $table->foreignId('regulasis_id')->constrained()->onDelete('cascade');
            $table->foreignId('sops_id')->constrained()->onDelete('cascade');
            $table->foreignId('faq_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publics');
    }
};

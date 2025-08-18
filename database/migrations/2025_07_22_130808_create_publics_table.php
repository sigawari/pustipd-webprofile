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
            $table->foreignId('profil_id')->constrained('profils')->onDelete('cascade');
            $table->foreignId('pencapaian_id')->constrained('pencapaians')->onDelete('cascade');
            $table->foreignId('layanan_id')->constrained('layanans')->onDelete('cascade');
            $table->foreignId('kelola_berita_id')->constrained('kelola_beritas')->onDelete('cascade');
            $table->foreignId('kelola_pengumuman_id')->constrained('kelola_pengumumans')->onDelete('cascade');
            $table->foreignId('struktur_organisasi_id')->constrained('struktur_organisasis')->onDelete('cascade');
            $table->foreignId('mitra_id')->constrained('mitras')->onDelete('cascade');
            $table->foreignId('galleri_id')->constrained('galleries')->onDelete('cascade');
            $table->foreignId('visi_misi_id')->constrained('visi_misis')->onDelete('cascade');
            $table->foreignId('kelola_tutorial_id')->constrained('kelola_tutorials')->onDelete('cascade');
            $table->foreignId('ketetapan_id')->constrained('ketetapans')->onDelete('cascade');
            $table->foreignId('panduan_id')->constrained('panduans')->onDelete('cascade');
            $table->foreignId('regulasi_id')->constrained('regulasis')->onDelete('cascade');
            $table->foreignId('sop_id')->constrained('sops')->onDelete('cascade');
            $table->foreignId('faq_id')->constrained('faqs')->onDelete('cascade');
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

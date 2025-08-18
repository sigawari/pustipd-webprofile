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
        Schema::create('dashboards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelola_berita_id')->constrained('kelola_beritas')->onDelete('cascade');
            $table->foreignId('ketetapan_id')->constrained('ketetapans')->onDelete('cascade');
            $table->foreignId('regulasi_id')->constrained('regulasis')->onDelete('cascade');
            $table->foreignId('panduan_id')->constrained('panduans')->onDelete('cascade');
            $table->foreignId('sop_id')->constrained('sops')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dashboards');
    }
};

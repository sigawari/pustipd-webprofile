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
            $table->foreignId('kelola_beritas_id')->constrained()->onDelete('cascade');
            $table->foreignId('ketetapans_id')->constrained()->onDelete('cascade');
            $table->foreignId('regulasis_id')->constrained()->onDelete('cascade');
            $table->foreignId('panduans_id')->constrained()->onDelete('cascade');
            $table->foreignId('sops_id')->constrained()->onDelete('cascade');
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

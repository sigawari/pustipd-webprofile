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
        Schema::create('profil_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profil_id')->constrained('profils')->cascadeOnDelete();
            $table->string('name')->nullable();
            $table->string('url')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('profil_institutions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profil_id')->constrained('profils')->cascadeOnDelete();
            $table->string('name')->nullable();
            $table->string('url')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('profil_universities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profil_id')->constrained('profils')->cascadeOnDelete();
            $table->string('name')->nullable();
            $table->string('url')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_universities');
        Schema::dropIfExists('profil_institutions');
        Schema::dropIfExists('profil_applications');
    }
};


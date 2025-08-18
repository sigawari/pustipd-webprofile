<?php
// database/migrations/xxxx_create_visi_misi_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('visi_misi', function (Blueprint $table) {
            $table->id();
            $table->text('visi')->nullable();
            $table->json('misi')->nullable(); // Menyimpan array misi dalam JSON
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('visi_misi');
    }
};

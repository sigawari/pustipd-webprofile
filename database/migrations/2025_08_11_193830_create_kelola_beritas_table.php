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
        Schema::create('kelola_beritas', function (Blueprint $table) {
            $table->id();
            $table->enum('category', [
                'academic_services',
                'library_resources',
                'student_information_system',
                'administration',
                'communication',
                'research_development',
                'other'
            ]);
            $table->string('name');
            $table->text('description');
            $table->string('link');
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelola_beritas');
    }
};

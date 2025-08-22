<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('slug')->unique();
            $table->string('tags')->nullable();
            $table->dateTime('publish_date')->nullable();
            $table->string('image')->nullable(); 
            $table->longText('content');
            $table->enum('status', ['draft', 'published'])->default('draft');
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
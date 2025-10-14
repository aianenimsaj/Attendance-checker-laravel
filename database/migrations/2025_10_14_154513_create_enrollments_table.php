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
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id('enrollment_id');
            
            // Foreign keys
            $table->foreignId('student_id')->constrained('users', 'id')->onDelete('cascade');
            $table->foreignId('class_id')->constrained('classes', 'class_id')->onDelete('cascade');
            
            $table->timestamps();

            // Prevent duplicate enrollment
            $table->unique(['student_id', 'class_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};

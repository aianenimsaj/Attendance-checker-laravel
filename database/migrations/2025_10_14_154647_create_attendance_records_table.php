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
        Schema::create('attendance_records', function (Blueprint $table) {
            $table->id('record_id');
            
            // Foreign keys
            $table->foreignId('student_id')->constrained('users', 'id')->onDelete('cascade');
            $table->foreignId('class_id')->constrained('classes', 'class_id')->onDelete('cascade');
            $table->foreignId('marked_by_teacher_id')->constrained('users', 'id')->onDelete('cascade');
            
            $table->date('attendance_date');
            $table->enum('status', ['Present', 'Late', 'Absent']);
            $table->timestamps();

            // Prevent duplicate attendance
            $table->unique(['student_id', 'class_id', 'attendance_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_records');
    }
};

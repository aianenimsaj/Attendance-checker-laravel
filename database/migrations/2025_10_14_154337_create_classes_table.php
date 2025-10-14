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
        Schema::create('classes', function (Blueprint $table) {
            $table->id('class_id');
            $table->string('class_code', 20)->unique()->nullable();
            $table->string('class_name', 100);
            
            // Only one line for teacher_id with foreign key
            $table->foreignId('teacher_id')->nullable()->constrained('users', 'id')->onDelete('set null');

            $table->timestamps();
        });
    }    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};

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
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('id_number', 20)->unique();
            $table->string('full_name', 50);
            $table->string('password_hash', 225);
            $table->unsignedBigInteger('role_id');
            $table->boolean('is_first_login')->default(true);
            $table->timestamps();
    
            $table->foreign('role_id')->references('role_id')->on('roles')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

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
            $table->id(); // Auto-incrementing primary key
            $table->string('name'); // Full Name
            $table->string('email')->unique(); // Email Address (Unique)
            $table->string('phone')->unique(); // Phone Number
            $table->string('password'); // Password Hash
            $table->string('image'); // Profile Picture (required)
            $table->string('role')->default('user'); // Role (default is 'user') 
            $table->timestamps(); // Created at and Updated at
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

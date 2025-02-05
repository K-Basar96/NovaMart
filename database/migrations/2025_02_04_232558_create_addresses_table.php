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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('recipient');
            $table->integer('recipient_number');
            $table->string('street');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('zip_code');
            $table->string('exact_locale');
            $table->string('address_type')->nullable();
            $table->boolean('is_default')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};

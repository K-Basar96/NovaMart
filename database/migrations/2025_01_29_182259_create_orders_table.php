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
        Schema::create('orders', function (Blueprint $table) {
    $table->id(); 
    $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // Foreign key to users table
    $table->string('tracking_id')->unique(); // Unique tracking ID
    $table->decimal('total_amount', 10, 2); 
    $table->enum('order_status', ['Pending', 'Processing', 'Shipped', 'Delivered', 'Cancelled'])->default('Pending'); // Order status
    $table->foreignId('payment_id')->nullable()->constrained('payments')->onDelete('set null'); // Foreign key to payments table
    $table->json('items'); // JSON column for items
    $table->timestamps(); 
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

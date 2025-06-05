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
            $table->foreignId('user_id')->constrained('users');
            $table->json('receiver');
            $table->json('delivery_address');
            $table->text('note')->nullable();
            $table->json('delivery_method_snapshot');
            $table->json('payment_method_snapshot');
            $table->json('products');
            $table->json('products_snapshot');
            $table->json('payment_info');
            $table->enum('status', ['pending', 'processing', 'completed', 'courier', 'delivered', 'cancelled'])->default('pending');
            $table->json('timeline')->nullable();
            $table->softDeletes();
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

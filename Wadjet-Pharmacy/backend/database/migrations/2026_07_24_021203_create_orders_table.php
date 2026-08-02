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
            $table->id('order_id');

            $table->foreignId('customer_id')->nullable()->constrained('customers', 'customer_id');

            $table->string('customer_name');
            $table->string('phone');
            $table->text('address');
            $table->text('notes')->nullable();

            $table->enum('status', ['pending', 'delivered', 'cancelled'])->default('pending');
            $table->boolean('pending')->default(true);
            $table->boolean('cancelled')->default(false);

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
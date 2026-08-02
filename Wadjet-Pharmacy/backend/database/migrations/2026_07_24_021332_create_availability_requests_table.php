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
        Schema::create('availability_requests', function (Blueprint $table) {
            $table->id('request_id');

            $table->foreignId('product_id')->nullable()->constrained('products', 'product_id');
            $table->foreignId('admin_id')->nullable()->constrained('admins', 'id');

            $table->string('product_name');
            $table->string('customer_name');
            $table->string('phone');
            $table->text('address')->nullable();
            $table->text('notes')->nullable();

            $table->enum('status', ['pending', 'fulfilled'])->default('pending');
            $table->boolean('pending')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('availability_requests');
    }
};
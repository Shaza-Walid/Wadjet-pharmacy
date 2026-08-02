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
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');

            $table->foreignId('category_id')->constrained('categories', 'id');
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers', 'id');
            $table->foreignId('admin_id')->constrained('admins', 'id');

            $table->string('name');
            $table->text('description')->nullable();
            $table->string('image')->nullable()->default('img/placeholder.jpg');
            $table->string('barcode')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('quantity');
            $table->enum('status', ['available', 'out_of_stock'])->default('available');
            $table->boolean('has_offer')->default(false);
            $table->decimal('offer_value', 10, 2)->default(0.00);
            $table->date('start_offer')->nullable();
            $table->date('end_offer')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
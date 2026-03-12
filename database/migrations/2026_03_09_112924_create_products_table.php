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
            $table->id();

            $table->string('external_id')->nullable();
            $table->string('sku')->unique();

            $table->string('name');
            $table->text('description')->nullable();

            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('special_price', 10, 2)->nullable();

            $table->foreignId('category_id')->nullable()->constrained()->cascadeOnDelete();

            $table->integer('stock_qty')->default(0);

            $table->boolean('status')->default(1);

            $table->string('image')->nullable();

            $table->timestamp('synced_at')->nullable();

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

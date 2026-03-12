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
        Schema::create('product_sync_logs', function (Blueprint $table) {
            $table->id();

            $table->integer('total_products')->default(0);
            $table->integer('created')->default(0);
            $table->integer('updated')->default(0);
            $table->integer('failed')->default(0);

            $table->text('message')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_sync_logs');
    }
};

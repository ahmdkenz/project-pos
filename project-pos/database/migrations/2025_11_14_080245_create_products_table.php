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
                $table->string('name');
                $table->string('sku', 100)->nullable()->unique();
                $table->integer('current_stock')->default(0);
                $table->decimal('cost_price', 15, 2)->default(0.00)->comment('Harga Beli / Modal');
                $table->decimal('sale_price', 15, 2)->default(0.00)->comment('Harga Jual');
                $table->integer('min_stock_level')->default(0)->comment('Batas minimum stok untuk notifikasi');
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

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
        Schema::table('services', function (Blueprint $table) {
            $table->text('items_included')->nullable()->after('complaint')->comment('Kelengkapan barang yang disertakan');
            $table->string('technician')->nullable()->after('cost')->comment('Nama teknisi yang ditugaskan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['items_included', 'technician']);
        });
    }
};

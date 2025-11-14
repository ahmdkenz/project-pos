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
        Schema::create('sync_operations', function (Blueprint $table) {
            $table->id();
            $table->string('client_operation_uuid', 36)->unique()->comment('UUID unik dari PWA client');
            $table->string('status', 20)->default('pending')->comment('pending, success, failed');
            $table->json('payload')->nullable()->comment('Data JSON dari PWA');
            $table->text('error_message')->nullable();
            $table->timestamps();
            $table->index('status', 'sync_operations_status_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sync_operations');
    }
};

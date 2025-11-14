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
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('actor')->nullable()->comment('Nama user yang melakukan aksi');
            $table->string('type', 50)->comment('sales, product, stock, security, danger, etc');
            $table->string('action')->comment('CREATE, UPDATE, DELETE, LOGIN, LOGOUT, etc');
            $table->text('message')->comment('Detail aktivitas yang dilakukan');
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent')->nullable();
            $table->json('metadata')->nullable()->comment('Data tambahan dalam format JSON');
            $table->timestamps();
            
            $table->index(['type', 'created_at']);
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};

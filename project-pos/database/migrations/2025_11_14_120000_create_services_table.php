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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('service_code')->unique()->comment('Contoh: SVC-001');
            $table->string('customer_name');
            $table->string('customer_phone')->nullable();
            $table->string('device_type')->comment('Laptop, PC, Printer, dll');
            $table->string('device_brand')->nullable()->comment('Asus, Lenovo, HP, dll');
            $table->text('complaint')->comment('Keluhan pelanggan');
            $table->text('diagnosis')->nullable()->comment('Hasil pengecekan teknisi');
            $table->text('action_taken')->nullable()->comment('Tindakan yang dilakukan');
            $table->enum('status', ['pending', 'progress', 'done', 'picked-up'])->default('pending');
            $table->decimal('cost', 15, 2)->default(0)->comment('Biaya servis');
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('picked_up_at')->nullable();
            $table->timestamps();
            
            $table->index('status');
            $table->index('service_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};

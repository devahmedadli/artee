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
            $table->id();
            $table->string('order_number')->default('ORD' . rand(100000, 99999));
            $table->foreignId('customer_id')->constrained('users');
            $table->foreignId('freelancer_id')->nullable()->constrained('users');
            $table->foreignId('service_id')->constrained('services');
            $table->decimal('subtotal', 10, 2)->nullable();
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('total', 10, 2)->nullable();
            $table->text('description');
            $table->timestamp('deadline')->nullable();
            $table->boolean('freelancer_archived')->default(false);
            $table->boolean('admin_archived')->default(false);
            $table->enum('status', ['pending', 'accepted', 'in_progress', 'completed', 'canceled', 'rejected', 'needs_approval'])->default('pending');
            $table->boolean('customer_accepted')->default(false);
            $table->boolean('is_paid')->default(false);
            $table->string('payment_id')->nullable();
            $table->timestamp('assigned_at')->nullable();
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

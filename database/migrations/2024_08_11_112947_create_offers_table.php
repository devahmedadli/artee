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
        Schema::create('offers', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('order_id')->constrained('orders');
            $table->foreignId('freelancer_id')->constrained('users');
            $table->decimal('admin_price', 10, 2);
            $table->decimal('freelancer_price', 10, 2)->nullable();
            $table->boolean('freelancer_archived')->default(false);
            $table->boolean('admin_archived')->default(false);
            $table->enum('status', ['pending', 'rejected', 'accepted', 'canceled', 'negotiating'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};

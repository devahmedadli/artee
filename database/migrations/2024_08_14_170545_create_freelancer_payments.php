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
        Schema::create('freelancer_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('freelancer_id')->constrained('users');
            $table->decimal('amount', 10, 2);
            $table->string('method')->nullable();
            $table->text('details')->nullable();
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('freelancer_payments');
    }
};

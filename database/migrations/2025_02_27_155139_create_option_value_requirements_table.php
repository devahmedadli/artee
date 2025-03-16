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
        Schema::create('option_value_requirements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('option_value_id')->constrained('option_values')->cascadeOnDelete();
            $table->string('ar_name');
            $table->string('en_name');
            $table->enum('type', ['text', 'number', 'boolean', 'file', 'image', 'custom_design']);
            $table->boolean('required')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('option_value_requirements');
    }
};

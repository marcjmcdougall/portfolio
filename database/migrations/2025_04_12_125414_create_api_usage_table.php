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
        Schema::create('api_usage', function (Blueprint $table) {
            $table->id();
            $table->date('usage_date')->unique(); // Unique constraint ensures one record per day
            $table->unsignedBigInteger('input_tokens'); // For token inputs
            $table->unsignedBigInteger('output_tokens'); // For token outputs
            $table->unsignedBigInteger( 'thought_tokens'); // For thought tokens
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_usage');
    }
};

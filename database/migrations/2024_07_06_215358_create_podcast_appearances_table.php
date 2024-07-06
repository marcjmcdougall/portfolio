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
        Schema::create('podcast_appearances', function (Blueprint $table) {
            $table->id();
            $table->string('podcast_name');
            $table->string('featured_image')->nullable();
            $table->json('topic')->nullable();
            $table->string('episode_title');
            $table->text('excerpt');
            $table->string('link');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('podcast_appearances');
    }
};

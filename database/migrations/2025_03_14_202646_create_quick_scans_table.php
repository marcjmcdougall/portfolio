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
        Schema::create('quick_scans', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->string('domain');
            $table->string('email');
            $table->string('status')->default('queued');
            $table->integer('progress')->default(0);
            $table->string('title')->nullable();
            $table->text('meta_description')->nullable();
            $table->json('issues')->nullable();

            // API fields - all using ApiResult as JSON
            $table->json('html_content')->nullable();
            $table->json('image_count')->nullable();
            $table->json('html_size')->nullable();
            $table->json('screenshot_path')->nullable();
            $table->json('openai_messaging_audit')->nullable();
            $table->json('performance_metrics')->nullable();
            // === End API fields

            $table->integer('score')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quick_scans');
    }
};

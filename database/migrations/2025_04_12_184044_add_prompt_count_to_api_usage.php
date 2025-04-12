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
        Schema::table('api_usage', function (Blueprint $table) {
            if ( ! Schema::hasColumn('api_usage', 'prompt_count')) {
                $table->unsignedInteger('prompt_count')->default(0)->after('thought_tokens');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('api_usage', function (Blueprint $table) {
            if (Schema::hasColumn('api_usage', 'prompt_count')) {
                $table->dropColumn('prompt_count');
            }
        });
    }
};

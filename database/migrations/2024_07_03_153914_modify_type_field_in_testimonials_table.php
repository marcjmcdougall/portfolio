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
        // Step 1: Add a temporary column
        Schema::table('testimonials', function (Blueprint $table) {
            $table->json('temp_type')->nullable();
        });

        // Step 2: Convert existing 'type' values to JSON format in 'temp_type' column
        DB::table('testimonials')->get()->each(function ($testimonial) {
            $type = $testimonial->type;
            if (!is_array(json_decode($type))) {
                DB::table('testimonials')
                    ->where('id', $testimonial->id)
                    ->update(['temp_type' => json_encode([$type])]);
            }
        });

        // Step 3: Drop the original 'type' column
        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropColumn('type');
        });

        // Step 4: Recreate the 'type' column as JSON
        Schema::table('testimonials', function (Blueprint $table) {
            $table->json('type')->nullable()->after('content');
        });

        // Step 5: Move data from 'temp_type' to 'type' column
        DB::table('testimonials')->get()->each(function ($testimonial) {
            DB::table('testimonials')
                ->where('id', $testimonial->id)
                ->update(['type' => $testimonial->temp_type]);
        });

        // Step 6: Drop the 'temp_type' column
        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropColumn('temp_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Step 1: Add a temporary column
        Schema::table('testimonials', function (Blueprint $table) {
            $table->string('temp_type')->nullable();
        });

        // Step 2: Convert JSON values back to a single string in 'temp_type'
        DB::table('testimonials')->get()->each(function ($testimonial) {
            $typeArray = json_decode($testimonial->type, true);
            if (is_array($typeArray) && count($typeArray) > 0) {
                $validTypes = [
                    'consulting',
                    'newsletter',
                    'conversion-rate-optimization',
                    'ui-design',
                    'landing-page-design',
                    'software-development',
                    'wordpress-development',
                    'personal-character'
                ];
                $typeValue = collect($typeArray)->first(fn($type) => in_array($type, $validTypes));
                DB::table('testimonials')
                    ->where('id', $testimonial->id)
                    ->update(['temp_type' => $typeValue]);
            }
        });

        // Step 3: Drop the 'type' column
        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropColumn('type');
        });

        // Step 4: Recreate the 'type' column as enum
        Schema::table('testimonials', function (Blueprint $table) {
            $table->enum('type', [
                'consulting',
                'newsletter',
                'conversion-rate-optimization',
                'ui-design',
                'landing-page-design',
                'software-development',
                'wordpress-development',
                'personal-character'
            ])->nullable();
        });

        // Step 5: Move data from 'temp_type' to 'type' column
        DB::table('testimonials')->get()->each(function ($testimonial) {
            DB::table('testimonials')
                ->where('id', $testimonial->id)
                ->update(['type' => $testimonial->temp_type]);
        });

        // Step 6: Drop the 'temp_type' column
        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropColumn('temp_type');
        });
    }
};

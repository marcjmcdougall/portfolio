<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiUsage extends Model
{
    protected $table = 'api_usage'; // Tell Laravel to use the singular table name
    protected $fillable = [
        'usage_date', 
        'input_tokens', 
        'output_tokens',
        'thought_tokens',
        'prompt_count',
    ];

    protected $casts = [
        'usage_date' => 'date',
    ];

    // Get the total tokens (input + output)
    public function getTotalTokensAttribute()
    {
        return $this->input_tokens + $this->output_tokens + $this->thought_tokens;
    }

    // Calculate the cost based on Gemini's pricing model
    public function getCostAttribute()
    {
        // Calculate average tokens per prompt
        $avgInputTokensPerPrompt = $this->input_tokens / $this->prompt_count;
        $avgOutputTokensPerPrompt = $this->output_tokens / $this->prompt_count;
        $avgThoughtTokensPerPrompt = $this->thought_tokens / $this->prompt_count;
        
        // Convert to millions for pricing calculation
        $avgInputMillionsPerPrompt = $avgInputTokensPerPrompt / 1000000;
        $avgOutputMillionsPerPrompt = $avgOutputTokensPerPrompt / 1000000;
        $avgThoughtMillionsPerPrompt = $avgThoughtTokensPerPrompt / 1000000;
        
        // Determine rate for each prompt based on its input token count
        $inputRate = ($avgInputTokensPerPrompt <= 200000) ? 1.25 : 2.50;
        $outputRate = ($avgInputTokensPerPrompt <= 200000) ? 10.00 : 15.00;
        
        // Calculate cost per prompt
        $costPerPrompt = ($avgInputMillionsPerPrompt * $inputRate) + 
                        ($avgOutputMillionsPerPrompt * $outputRate) + 
                        ($avgThoughtMillionsPerPrompt * $outputRate);
        
        // Calculate total cost by multiplying by prompt count
        $totalCost = $costPerPrompt * $this->prompt_count;
        
        return $totalCost;
    }
}

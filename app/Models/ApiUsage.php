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
    ];

    protected $casts = [
        'usage_date' => 'date',
    ];

    // Get the total tokens (input + output)
    public function getTotalTokensAttribute()
    {
        return $this->input_tokens + $this->output_tokens;
    }

    // Calculate the cost based on Gemini's pricing model
    public function getCostAttribute()
    {
        $inputMillions = $this->input_tokens / 1000000;
        $outputMillions = $this->output_tokens / 1000000;
        $thoughtMillions = $this->thought_tokens / 1000000;
        
        // Determine the rate based on prompt size
        $totalPromptTokens = $this->input_tokens;
        $inputRate = ($totalPromptTokens <= 200000) ? 1.25 : 2.50;
        $outputRate = ($totalPromptTokens <= 200000) ? 10.00 : 15.00;
        
        // Calculate the costs
        $inputCost = $inputMillions * $inputRate;
        $outputCost = $outputMillions * $outputRate;
        $thoughtCost = $thoughtMillions * $outputRate; // Assume thoughts are charged at output rate
        
        return $inputCost + $outputCost + $thoughtCost;
    }
}

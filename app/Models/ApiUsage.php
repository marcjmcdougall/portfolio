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
}

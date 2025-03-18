<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuickScan extends Model
{
    protected $fillable = [
        'url',
        'email',
        'status',
        'progress',
        'html_content',
        'title',
        'screenshot_path',
        'meta_description',
        'issues',
        'info',
        'score',
        'completed_at'
    ];

    protected $casts = [
        'issues' => 'array',
        'info' => 'array',
        'completed_at' => 'datetime',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuickScan extends Model
{
    protected $fillable = [
        'url',
        'name',
        'email',
        'status',
        'progress',
        'html_content',
        'title',
        'meta_description',
        'issues',
        'score',
        'completed_at'
    ];

    protected $casts = [
        'issues' => 'array',
        'completed_at' => 'datetime',
    ];
}

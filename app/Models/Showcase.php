<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Showcase extends Model
{
    protected $fillable = ['title', 'image', 'row'];

    // Scope that selects by row
    public function scopeFromRow($query, $rowNumber)
    {
        return $query->where('row', $rowNumber);
    }
}

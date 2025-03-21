<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lc extends Model
{
    // Explicitly set table name if not following plural naming conventions
    protected $table = 'lc';

    protected $fillable = [
        'phone_number',
        'customer_ids',
        'percentage',
    ];

    // Cast user_ids to array so that JSON is automatically converted
    protected $casts = [
        'customer_ids' => 'array',
    ];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExternalPanel extends Model
{
    // If you used a custom table name:
    protected $table = 'external_panels';

    // If you used a custom primary key column:
    protected $primaryKey = 'extPanelId';

    // If the primary key is not auto-incrementing, set this to false:
    // public $incrementing = false;

    // If the primary key is not an integer, set the key type:
    // protected $keyType = 'string';

    // Fillable columns for mass assignment
    protected $fillable = [
        'panelName',
        'panelAddrs',
        'credits',
        'remainingCredits',

        // 'createdDate' // if you decided to have a separate date column
    ];
}

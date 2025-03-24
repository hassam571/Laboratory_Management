<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffPanel extends Model
{
    // Custom table name
    protected $table = 'staff_panels';

    // Custom primary key
    protected $primaryKey = 'staffPanelId';

    // If you do NOT want to use Laravel's created_at/updated_at columns, set this to false:
    // public $timestamps = false;

    // Fillable columns for mass assignment
    protected $fillable = [
        'userId',
        'credits',
        'remainingCredits',
        'createdDate',
    ];

    // Example relationship to User
    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
}

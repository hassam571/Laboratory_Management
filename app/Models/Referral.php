<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    protected $table = 'referrals'; // If you keep the default name, you can omit this
    protected $primaryKey = 'id';   // Default is 'id'

    protected $fillable = [
        'referrerName',
        'referrerDetails',
        'commissionPercentage',
    ];
}

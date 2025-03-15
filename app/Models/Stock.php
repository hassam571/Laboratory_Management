<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'stocks'; // Specify the table name
    protected $primaryKey = 'itmId'; // Set the correct primary key

    public $timestamps = false; // If you don't have created_at and updated_at columns
    use HasFactory;

    protected $fillable = [
        'userId', 'itemName', 'itemDetail', 'expDate', 'itmQnt', 'itmPrice', 'createdDate'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'customerId';
    public $incrementing = true;
    protected $keyType = 'int';

    // If you do NOT want to use Eloquent's default timestamps:
    public $timestamps = false; // because we have createdDate

    protected $fillable = [
        'userId',
        'relation',
        'title',
        'name',
        'email',
        'phone',
        'gender',
        'age',
        'lcStatus',
        'extPanelId',
        'addRefrealId',
        'staffPanelId',
        'comment',
        'testDiscount',
        'createdDate',
    ];

    // Example relationships
    public function tests()
    {
        return $this->hasMany(CustomerTest::class, 'customerId', 'customerId');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'customerId', 'customerId');
    }
    public function customerTests()
    {
        return $this->hasMany(CustomerTest::class, 'customerId');
    }
 
}

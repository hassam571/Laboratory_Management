<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerTest extends Model
{
    protected $table = 'customer_tests';
    protected $primaryKey = 'ctId';
    public $incrementing = true;
    protected $keyType = 'int';

    // Disable Laravel's automatic timestamps
    public $timestamps = false;

    protected $fillable = [
        'addTestId',
        'customerId',
        'createdDate',
        'testStatus',
        'reportDate',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customerId', 'customerId');
    }


    public function test()
    {
        return $this->belongsTo(Test::class, 'addTestId');
    }
   
    public function testRange()
    {
        return $this->belongsTo(TestRange::class, 'testRangesId', 'testRangesId');
    }
    
}

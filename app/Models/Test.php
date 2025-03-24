<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    // Table name (if different from 'tests')
    protected $table = 'tests';

    // Custom primary key
    protected $primaryKey = 'addTestId';
    public $incrementing = true;
    protected $keyType = 'int';
    // Fillable fields for mass assignment
    protected $fillable = [
        'testName',
        'testCatId',
        'testCost',
        'howSample',
        'typeSample',
    ];

    // If referencing test_categories
 
    public function category()
{
    return $this->belongsTo(\App\Models\TestCategory::class, 'testCatId', 'testCatId');
}


public function customerTests()
{
    return $this->hasMany(CustomerTest::class, 'addTestId');
}
public function testRanges()
{
    return $this->hasMany(TestRange::class, 'addTestId', 'addTestId');
}
public function test()
{
    return $this->belongsTo(Test::class, 'addTestId', 'addTestId');
}
public function customerTest()
{
    return $this->hasOne(CustomerTest::class, 'addTestId', 'addTestId');
}


}

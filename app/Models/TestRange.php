<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestRange extends Model
{
    protected $table = 'test_ranges';
    protected $primaryKey = 'testRangeId';
    // protected $primaryKey = 'testRangesId'; 
    protected $fillable = [
        'addTestId',
        'gender',
        'testTypeName',
        'minRange',
        'maxRange',
        'unit',
    ];

    // Each TestRange belongs to one Test
    public function test()
    {
        return $this->belongsTo(Test::class, 'addTestId', 'addTestId');
    }
    public function testRanges()                                                                                 
{
    return $this->hasMany(TestRange::class, 'addTestId', 'addTestId');
}
}

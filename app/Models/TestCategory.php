<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestCategory extends Model
{
    // Custom table name (if different from 'test_categories')
    protected $table = 'test_categories';

    // Custom primary key
    protected $primaryKey = 'testCatId';

    // If you don't want the default 'id' to be used as the primary key
    public $incrementing = true;
    protected $keyType = 'int';

    // Fillable attributes
    protected $fillable = [
        'adminId',
        'testCat',
        'catDetail',
    ];

    // If referencing an Admin or User model:
    // public function admin()
    // {
    //     return $this->belongsTo(User::class, 'adminId');
    // }
}

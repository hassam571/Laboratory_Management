<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    use HasFactory;

    protected $table = 'credit';

    protected $primaryKey = 'creditAi';

    protected $fillable = [
        'userId', 'creditAmount', 'creditDetail', 'createdDate'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
}

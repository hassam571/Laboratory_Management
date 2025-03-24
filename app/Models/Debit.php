<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debit extends Model
{
    use HasFactory;

    protected $table = 'debit'; // Your table name

    protected $primaryKey = 'debitAi'; // Custom primary key

    protected $fillable = [
        'userId', 'debitAmount', 'debitDetail', 'createdDate'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
}

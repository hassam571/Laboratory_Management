<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestReportChild extends Model
{
    use HasFactory;

    protected $table = 'testreportchild';
    protected $primaryKey = 'reportChildId';
    protected $fillable = ['reportId', 'testRangeId', 'reportValue'];

    public function testReport()
    {
        return $this->belongsTo(TestReport::class, 'reportId', 'reportId');
    }

    public function testRange()
    {
        return $this->belongsTo(TestRange::class, 'testRangeId', 'id');
    }public function reportChildren()
    {
        return $this->hasMany(TestReportChild::class, 'reportId', 'reportId'); // Ensure 'reportId' matches database column
    }
    
}

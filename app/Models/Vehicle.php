<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Model
{
    use HasFactory;
    protected $fillable = ['plate_number','owner_name','make','model','year','vehicle_type'];

    public function testResults()
    {
        return $this->hasMany(TestResult::class);
    }
}

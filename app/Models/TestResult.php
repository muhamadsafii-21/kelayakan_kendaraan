<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    use HasFactory;

  protected $fillable = [
    'vehicle_id',
    'user_id',
    'test_date',
    'criteria_scores',
    'score',
    'status',
    'notes',
    // 'details', // 🔹 tambahkan ini
];


    protected $casts = [
    'criteria_scores' => 'array',
    // 'details' => 'array', // 🔹 tambahkan ini
];


    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

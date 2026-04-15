<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    protected $fillable = [
        'vehicle_id',
        'time_in',
        'time_out',
        'parking_rate_id',
        'duration_hour',
        'total_cost',
        'status',
        'user_id',
        'parking_areas_id',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function parkingRate()
    {
        return $this->belongsTo(ParkingRate::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parkingArea()
    {
        return $this->belongsTo(ParkingArea::class);
    }
}

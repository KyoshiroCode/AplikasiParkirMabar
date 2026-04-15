<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParkingRate extends Model
{
    protected $fillable = [
        'parking_area_id',
        'vehicle_type',
        'rate_hour',
            
    ];

    public function parkingArea()
    {
        return $this->belongsTo(ParkingArea::class);
    }
}

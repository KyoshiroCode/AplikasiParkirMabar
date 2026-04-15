<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParkingArea extends Model
{
    protected $fillable = [
        'code',
        'name',
        'vehicle_type',
        'capacity',
        'used_slots',
        'is_active'
    ];

    public function parkingRate()
    {
        return $this->hasMany(ParkingRate::class);
    }
}

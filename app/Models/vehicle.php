<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class vehicle extends Model
{
    protected $fillable = [
        'number_plate',
        'vehicle_type',
        'color',
        'owner',
    ];

    public function Vehicle()
    {
        return $this->hasMany(Vehicle::class);
    }
}

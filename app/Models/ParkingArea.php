<?php

namespace App\Models;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;

class ParkingArea extends Model
{
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logAll()
        ->logOnlyDirty();
    }
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

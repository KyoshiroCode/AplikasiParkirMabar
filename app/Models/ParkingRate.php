<?php

namespace App\Models;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;

class ParkingRate extends Model
{
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logAll()
        ->logOnlyDirty();
    }

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

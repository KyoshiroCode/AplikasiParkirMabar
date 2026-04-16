<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class transaction extends Model
{
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logAll()
        ->logOnlyDirty();
    }
    protected $fillable = [
        'vehicle_id',
        'time_in',
        'time_out',
        'parking_rates_id',
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
        return $this->belongsTo(ParkingRate::class, 'parking_rates_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parkingArea()
    {
        return $this->belongsTo(ParkingArea::class, 'parking_areas_id');
    }
}

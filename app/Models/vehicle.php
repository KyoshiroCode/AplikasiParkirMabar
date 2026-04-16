<?php

namespace App\Models;

use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;

class vehicle extends Model
{
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logAll()
        ->logOnlyDirty();
    }
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

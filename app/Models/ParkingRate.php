<?php

namespace App\Models;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ParkingRate extends Model
{
    use LogsActivity, HasFactory;

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

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function transactionIns()
    {
        return $this->hasMany(TransactionIn::class);
    }
}

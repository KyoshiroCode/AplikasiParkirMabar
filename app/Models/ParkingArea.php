<?php

namespace App\Models;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ParkingArea extends Model
{
    use LogsActivity, HasFactory;

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

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function transactionIns()
    {
        return $this->hasMany(TransactionIn::class);
    }
}

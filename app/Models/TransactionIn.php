<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionIn extends Model
{
    protected $fillable = [
        'vehicle_id',
        'entry_time',
        'owner',
        'parking_rate_id',
        'parking_area_id',
        'user_id',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function parkingRate()
    {
        return $this->belongsTo(ParkingRate::class);
    }

    public function parkingArea()
    {
        return $this->belongsTo(ParkingArea::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::created(function ($transaction) {

            $area = $transaction->parkingArea;

            if ($area) {
                $area->decrement('capacity'); // -1
                $area->increment('used_slots'); // +1
            }
        });
    }

}

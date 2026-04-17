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
        'transaction_ins_id',
        'time_out',
        'duration_hour',
        'total_cost',
        'status',
        'user_id',
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

    public function transactionIn()
    {
        return $this->belongsTo(TransactionIn::class, 'transaction_ins_id');
    }
    protected static function booted()
    {
        static::created(function ($transaction) {

            $area = $transaction->transactionIn->parkingArea;

            if ($area) {
                $area->increment('capacity'); // +1
                $area->decrement('used_slots'); // -1
            }
        });
    }

}

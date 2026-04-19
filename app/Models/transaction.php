<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Str;


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
        'transaction_code',
        'tickets_id',
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

    public function ticket()
    {
        return $this->belongsTo(Tickets::class, 'tickets_id');
    }

    public function Transactions()
    {
        return $this->hasMany(Transactions::class);
    }
    protected static function booted()
    {
        static::created(function ($transaction) {

            $area = $transaction->ticket->parkingArea;

            if ($area) {
                $area->increment('capacity'); // +1
                $area->decrement('used_slots'); // -1
            }
        });

        static::creating(function ($model) {

            do {
                $date = now()->format('dmY'); // 17042026
                $random = strtoupper(Str::random(4));

                $code = "TR-". $date ."-". $random;

            } while (self::where('transaction_code', $code)->exists());

            $model->transaction_code = $code;
        });
        static::creating(function ($model){
            $model->user_id = auth()->id();
        });
    }

}

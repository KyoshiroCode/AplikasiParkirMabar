<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tickets extends Model
{
    use SoftDeletes;
    use LogsActivity, HasFactory;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logAll()
        ->logOnlyDirty();
    }

    protected $fillable = [
        'code',
        'vehicle_id',
        'entry_time',
        'owner',
        'parking_rate_id',
        'parking_area_id',
        'status',
        'user_id',
    ];

    public function ticket()
    {
        return $this->hasMany(Ticket::class);
    }

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
                $area->increment('used_slots'); // +1
            }
        });

        static::creating(function ($model) {

            do {
                $date = now()->format('dmY'); // 17042026
                $random = strtoupper(Str::random(2));
                $random2 = strtoupper(Str::random(4)); // AB

                $code = $random2 . "-" . $date ."-". $random;

            } while (self::where('code', $code)->exists());

            $model->code = $code;
        });

        static::creating(function ($model){
            $model->user_id = auth()->id();
        });
            
    }

}

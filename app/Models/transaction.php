<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Services\FinancialReportService;


class transaction extends Model
{
    use LogsActivity, HasFactory;

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
        return $this->belongsTo(Tickets::class, 'tickets_id', 'id');
    }

    public function Transactions()
    {
        return $this->hasMany(Transactions::class);
    }
    protected static function booted()
    {
        // 🔥 setelah transaksi dibuat
        static::created(function ($transaction) {

            $ticket = $transaction->ticket;

            if (!$ticket) return;

            $ticket->update([
                'status' => 'out'
            ]);

            $area = $ticket->parkingArea;

            if ($area && $area->used_slots > 0) {
                $area->decrement('used_slots');
            }
        });

        // 🔥 generate code
        static::creating(function ($model) {

            do {
                $code = "TR-" . now()->format('dmY') . "-" . strtoupper(Str::random(4));
            } while (self::where('transaction_code', $code)->exists());

            $model->transaction_code = $code;
        });

        // 🔥 auto user
        static::creating(function ($model) {
            $model->user_id = auth()->id();
        });

        static::created(function ($transaction) {

            $date = now()->toDateString();
            $year = now()->year;
            $month = now()->month;

            FinancialReportService::generateDaily($date);
            FinancialReportService::generateMonthly($year, $month);
        });

    }

}

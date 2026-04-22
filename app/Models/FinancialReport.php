<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;
use App\Services\FinancialReportService;

class FinancialReport extends Model
{
    protected $fillable = [
        'type',
        'date',
        'month',
        'total_transactions',
        'total_income',
    ];


    public function transactions()
    {
        if ($this->type === 'daily') {
            return \App\Models\Transaction::whereDate('time_out', $this->date);
        }

        if ($this->type === 'monthly') {
            $year = substr($this->month, 0, 4);
            $month = substr($this->month, 5, 2);

            return \App\Models\Transaction::whereYear('time_out', $year)
                ->whereMonth('time_out', $month);
        }

        return \App\Models\Transaction::query();
    }


}

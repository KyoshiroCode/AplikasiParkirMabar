<?php
namespace App\Services;

use App\Models\Transaction;
use App\Models\FinancialReport;

class FinancialReportService
{
    public static function generateDaily($date)
{
    $transactions = \App\Models\Transaction::whereDate('time_out', $date);

        \App\Models\FinancialReport::create([
            'type' => 'daily',
            'date' => $date,
            'month' => null,
            'total_transactions' => $transactions->count(),
            'total_income' => $transactions->sum('total_cost'),
        ]);
    }


    public static function generateMonthly($year, $month)
    {
        $transactions = \App\Models\Transaction::whereYear('time_out', $year)
            ->whereMonth('time_out', $month);

        \App\Models\FinancialReport::create([
            'type' => 'monthly',
            'date' => null,
            'month' => "$year-$month",
            'total_transactions' => $transactions->count(),
            'total_income' => $transactions->sum('total_cost'),
        ]);
    }

}

<?php
namespace App\Services;

use App\Models\Transaction;
use App\Models\FinancialReport;

class FinancialReportService
{
    public static function generateDaily($date)
    {
        $transactions = Transaction::whereDate('time_out', $date);

        $totalIncome = $transactions->sum('total_cost');
        $totalTransactions = $transactions->count();

        FinancialReport::updateOrCreate(
            [
                'type' => 'daily',
                'date' => $date,
            ],
            [
                'total_income' => $totalIncome,
                'total_transactions' => $totalTransactions,
            ]
        );
    }

    public static function generateMonthly($year, $month)
    {
        $transactions = Transaction::whereYear('time_out', $year)
            ->whereMonth('time_out', $month);

        $totalIncome = $transactions->sum('total_cost');
        $totalTransactions = $transactions->count();

        FinancialReport::updateOrCreate(
            [
                'type' => 'monthly',
                'month' => "$year-$month",
            ],
            [
                'total_income' => $totalIncome,
                'total_transactions' => $totalTransactions,
            ]
        );
    }
}

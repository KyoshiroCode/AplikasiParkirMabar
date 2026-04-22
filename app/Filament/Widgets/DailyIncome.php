<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Transaction;
use App\Models\Tickets;
use Illuminate\Support\Facades\DB;

class DailyIncome extends StatsOverviewWidget
{
    protected int | string | array $columnSpan = 3;
    protected function getStats(): array
    {
        $today = now()->toDateString();

        $total = Transaction::whereDate('time_out', $today)
            ->sum('total_cost');

        $now = now();

        $total2 = Transaction::whereYear('time_out', $now->year)
            ->whereMonth('time_out', $now->month)
            ->sum('total_cost');

        $top = Tickets::select('parking_area_id', DB::raw('count(*) as total'))
            ->groupBy('parking_area_id')
            ->orderByDesc('total')
            ->with('parkingArea')
            ->first();

        if (!$top || !$top->parkingArea) {
            return [
                Stat::make('Top Area', 'No Data'),
            ];
        }


        return [
            Stat::make('Today Income', 'Rp ' . number_format($total, 0, ',', '.'))
                ->description('Pendapatan hari ini')
                ->color('success')
                ->icon('heroicon-o-banknotes'),

            Stat::make('Monthly Income', 'Rp ' . number_format($total, 0, ',', '.'))
                ->description('Pendapatan bulan ini')
                ->color('primary')
                ->icon('heroicon-o-chart-bar'),

            Stat::make(
                'Top Parking Area',
                $top->parkingArea->name
            )
            ->description('Dipakai ' . $top->total . 'x')
            ->icon('heroicon-o-map')
            ->color('success'),
        ];

    }
    protected static bool $isLazy = false;
}

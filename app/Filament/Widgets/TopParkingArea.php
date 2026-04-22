<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Transaction;
use App\Models\Tickets;
use Illuminate\Support\Facades\DB;

class TopParkingArea extends StatsOverviewWidget
{
    protected int | string | array $columnSpan = 4;
    protected function getStats(): array 
    {
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
            
        ];
    }
    protected static bool $isLazy = false;
}

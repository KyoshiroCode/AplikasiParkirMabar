<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use App\Models\Tickets;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsDashboard extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $countTicket = Tickets::count();
        $countTransaction = Transaction::count();
        return [
            Stat::make('Entry', $countTicket)
                ->color('success')
                ->description('Parking Entry'),
            Stat::make('Out', $countTransaction)
                ->color('danger')
                ->description('Parking Out'),

        ];
    }
    protected static bool $isLazy = false;
    protected ?string $heading = 'Ticket & Transaction';
    protected ?string $description = 'Balalalla';
}

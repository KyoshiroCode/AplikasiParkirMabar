<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use App\Models\Tickets;
use App\Models\ParkingArea;
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
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'wire:click' => "\$dispatch('setStatusFilter', { filter: 'pending' })",
                ])
                ->description('Parking Entry'),
            Stat::make('Out', $countTransaction)
                ->color('danger')
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'wire:click' => "\$dispatch('setStatusFilter', { filter: 'processed' })",
                ])
                ->description('Parking Out'),
            Stat::make('Parking Area Used', ParkingArea::sum('used_slots'))
                ->color('primary')
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                    'wire:click' => "\$dispatch('setStatusFilter', { filter: 'processed' })",
                ])
                ->description('Used Parking Slots'),

        ];
    }
    protected static bool $isLazy = false;
    protected ?string $heading = 'E-Parking';
    protected ?string $description = 'Dashboard E-Parking, show the total of parking entry, parking out, and used parking slots.';
}

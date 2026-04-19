<?php

namespace App\Filament\Resources\Tickets\Schemas;

use App\Models\Tickets;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TicketsInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('code'),
                TextEntry::make('vehicle.number_plate')
                    ->label('Plate Number'),
                TextEntry::make('entry_time')
                    ->dateTime(),
                TextEntry::make('status'),
                TextEntry::make('owner')
                    ->placeholder('-'),
                TextEntry::make('ParkingRate.rate_hour')
                    ->numeric(),
                TextEntry::make('ParkingArea.name')
                    ->numeric(),
                TextEntry::make('user.name')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Tickets $record): bool => $record->trashed()),
            ]);
    }
}

<?php

namespace App\Filament\Resources\Transactions\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TransactionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('transaction_code')
                    ->label('Transactions Code')
                    ->placeholder('-'),
                TextEntry::make('ticket.code')
                    ->label('Ticket Code')
                    ->placeholder('-'),
                TextEntry::make('time_out')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('duration_hour')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('total_cost')
                    ->money()
                    ->placeholder('-'),
                TextEntry::make('status'),
                TextEntry::make('user.name')
                    ->label('Staff Ticket'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('ticket.entry_time')
                    ->dateTime()
                    ->label('Time Entry')
                    ->placeholder('-'),
                TextEntry::make('ticket.owner')
                    ->label('Owner')
                    ->placeholder('-'),
                TextEntry::make('ticket.parkingRate.rate_hour')
                    ->money()
                    ->label('Parking Rate')
                    ->placeholder('-'),
                TextEntry::make('ticket.parkingArea.name')
                    ->label('Parking Area')
                    ->placeholder('-'),
                TextEntry::make('ticket.user.name')
                    ->label('Staff Out')
                    ->placeholder('-'), 
            ]);
    }
}

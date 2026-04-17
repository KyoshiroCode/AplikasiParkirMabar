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
                TextEntry::make('transaction_ins_id')
                    ->numeric(),
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
                TextEntry::make('user_id')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('transactionIn.entry_time')
                    ->dateTime()
                    ->label('Time Entry')
                    ->placeholder('-'),
                TextEntry::make('transactionIn.owner')
                    ->label('Owner')
                    ->placeholder('-'),
                TextEntry::make('transactionIn.parkingRate.rate_hour')
                    ->money()
                    ->label('Parking Rate')
                    ->placeholder('-'),
                TextEntry::make('transactionIn.parkingArea.name')
                    ->label('Parking Area')
                    ->placeholder('-'),
                TextEntry::make('transactionIn.user.name')
                    ->label('Staff')
                    ->placeholder('-'), 
            ]);
    }
}

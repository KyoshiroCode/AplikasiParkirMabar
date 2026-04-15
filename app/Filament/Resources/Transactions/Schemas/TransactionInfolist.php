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
                TextEntry::make('vehicle_id')
                    ->numeric(),
                TextEntry::make('time_in')
                    ->dateTime(),
                TextEntry::make('time_out')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('parking_rates_id')
                    ->numeric(),
                TextEntry::make('duration_hour')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('total_cost')
                    ->money()
                    ->placeholder('-'),
                TextEntry::make('status')
                    ->badge(),
                TextEntry::make('user_id')
                    ->numeric(),
                TextEntry::make('parking_areas_id')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}

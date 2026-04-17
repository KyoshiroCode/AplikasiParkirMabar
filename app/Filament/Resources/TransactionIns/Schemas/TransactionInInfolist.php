<?php

namespace App\Filament\Resources\TransactionIns\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TransactionInInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('vehicle_id')
                    ->numeric(),
                TextEntry::make('entry_time')
                    ->dateTime(),
                TextEntry::make('status'),
                TextEntry::make('owner')
                    ->placeholder('-'),
                TextEntry::make('parking_rate_id')
                    ->numeric(),
                TextEntry::make('parking_area_id')
                    ->numeric(),
                TextEntry::make('user_id')
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

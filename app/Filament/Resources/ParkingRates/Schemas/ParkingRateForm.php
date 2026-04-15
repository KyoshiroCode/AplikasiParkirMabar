<?php

namespace App\Filament\Resources\ParkingRates\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ParkingRateForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('vehicle_type')
                    ->options(['Car' => 'Car', 'Motorcycle' => 'Motorcycle'])
                    ->required(),
                TextInput::make('rate_hour')
                    ->numeric()
                    ->default(5000),
            ]);
    }
}

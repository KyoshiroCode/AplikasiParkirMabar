<?php

namespace App\Filament\Resources\Transactions\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class TransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('vehicle_id')
                    ->relationship('Vehicle','number_plate')
                    ->label('Number Plate')
                    ->required(),
                DateTimePicker::make('time_in')
                    ->required(),
                DateTimePicker::make('time_out'),
                Select::make('parking_rates_id')
                    ->required()
                    ->relationship('ParkingRate', 'rate_hour')
                    ->label('Parking Rate Per Hour'),
                TextInput::make('duration_hour')
                    ->numeric()
                    ->default(null),
                Select::make('status')
                    ->options(['in' => 'In', 'out' => 'Out'])
                    ->default('in')
                    ->required(),
                Placeholder::make('user_id')
                    ->label('Staff')
                    ->content(fn () => Auth::id() -> name ?? 'Not logged in'),
                Select::make('parking_areas_id')
                    ->required()
                    ->relationship('ParkingArea', 'name')
                    ->label('Area Parking'),
            ]);
    }
}

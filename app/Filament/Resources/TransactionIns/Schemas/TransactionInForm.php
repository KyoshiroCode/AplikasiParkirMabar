<?php

namespace App\Filament\Resources\TransactionIns\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Hidden;
use Filament\Schemas\Components\Utilities\Set;
use App\Models\Vehicle;
use App\Models\ParkingRate;



class TransactionInForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('vehicle_id')
                    ->relationship('vehicle', 'number_plate')
                    ->live()
                    ->afterStateUpdated(function ($state, Set $set) {
                        if (!$state) {
                            $set('owner', null);
                            $set('parking_rate_id', null);
                            return;
                        }

                        $vehicle = Vehicle::find($state);

                        // isi owner
                        $set('owner', $vehicle?->owner);

                        // ambil rate berdasarkan vehicle_type
                        $rate = ParkingRate::where('vehicle_type', $vehicle?->vehicle_type)->first();

                        $set('parking_rate_id', $rate?->id);
                    }),

                DateTimePicker::make('entry_time')
                    ->required(),
                Hidden::make('status')
                    ->required()
                    ->default('in'),
                TextInput::make('owner')
                    ->default(null),
                Select::make('parking_rate_id')
                    ->required()
                    ->relationship('parkingRate', 'rate_hour')
                    ->label('Parking Rate'),
                Select::make('parking_area_id')
                    ->required()
                    ->relationship('parkingArea', 'name')
                    ->label('Parking Area'),
                Select::make('user_id')
                    ->required()
                    ->relationship('user', 'name')
                    ->label('Staff'),
            ]);
    }
}

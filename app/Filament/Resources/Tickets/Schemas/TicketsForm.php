<?php

namespace App\Filament\Resources\Tickets\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Utilities\Get;
use App\Models\Vehicle;
use App\Models\ParkingRate;
use App\Models\ParkingArea;


class TicketsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('vehicle_id')
                    ->required()
                    ->relationship('vehicle','number_plate')
                    ->reactive()
                    ->searchable()
                    ->afterStateUpdated(function ($state, Set $set) {

                        if (!$state) {
                            $set('owner', null);
                            $set('parking_rate_id', null);
                            $set('parking_area_id', null);
                            return;
                        }

                        $vehicle = Vehicle::find($state);

                        $set('owner', $vehicle?->owner);

                        $rate = ParkingRate::where('vehicle_type', $vehicle?->vehicle_type)->first();

                        $set('parking_rate_id', $rate?->id);

                        $set('parking_area_id', null); // reset biar ke-filter ulang
                    })

                    ->label('Vehicle'),
                DateTimePicker::make('entry_time')
                    ->required(),
                TextInput::make('status')
                    ->required()
                    ->default('in'),
                TextInput::make('owner')
                    ->default(null),
                Select::make('parking_rate_id')
                    ->required()
                    ->relationship('ParkingRate', 'rate_hour'),
                Select::make('parking_area_id')
                    ->required()
                    ->label('Parking Area')
                    ->options(function (Get $get) {

                        $vehicleId = $get('vehicle_id');

                        if (!$vehicleId) return [];

                        $vehicle = Vehicle::find($vehicleId);

                        if (!$vehicle) return [];

                        return ParkingArea::where('vehicle_type', $vehicle->vehicle_type)
                            ->whereColumn('used_slots', '<', 'capacity') 
                            ->pluck('name', 'id');
                        return $areas->isEmpty()
                            ? ['' => '=All Slots Are Full=']
                            : $areas;

                    })

                    ->reactive(),

            ]);
    }
}

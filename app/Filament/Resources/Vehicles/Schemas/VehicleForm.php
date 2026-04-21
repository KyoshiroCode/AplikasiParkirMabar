<?php

namespace App\Filament\Resources\Vehicles\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select\Concerns\BelongsToSelect;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Validation\Rule;
use Filament\Notifications\Notification;
use App\Models\Vehicles;


class VehicleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('number_plate')
                    ->required()
                    ->unique(
                        table: 'vehicles',
                        column: 'number_plate',
                        ignoreRecord: true,
                    )
                    ->validationMessages([
                        'unique' => 'Plate Number Has Taken!!',
                    ]),

                Select::make('vehicle_type')
                    ->label('Vehicle Type')
                    ->options([
                        'car' => 'Car',
                        'motorcycle' => 'Motorcycle',
                        'other' => 'Other(+)',
                    ])
                    ->reactive()
                    ->afterStateUpdated(function ($state, Set $set) {
                        if ($state !== 'other') {
                            $set('vehicle_type_custom', null);
                        }
                    })
                    ->dehydrateStateUsing(function ($state, Get $get) {
                        if ($state === 'other') {
                            return strtolower($get('vehicle_type_custom'));
                        }

                        return strtolower($state);
                    }),

                TextInput::make('vehicle_type_custom')
                    ->label('Input Vehicle Type')
                    ->placeholder('Example: Truck, Bus, etc...')
                    ->visible(fn (Get $get) => $get('vehicle_type') === 'other')
                    ->required(fn (Get $get) => $get('vehicle_type') === 'other')
                    ->dehydrated(false),


                TextInput::make('color')
                    ->required(),
                TextInput::make('owner')
                    ->required(),
            ]);
    }
}

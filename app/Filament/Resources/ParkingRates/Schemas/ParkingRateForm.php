<?php

namespace App\Filament\Resources\ParkingRates\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Validation\Rule;


class ParkingRateForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('vehicle_type')
                    ->label('Vehicle Type')
                    ->options([
                        'car' => 'Car',
                        'motorcycle' => 'Motorcycle',
                        'other' => 'Other(+)',
                    ])
                    ->required()
                    ->rule(function ($record, Get $get) {
                        $value = $get('vehicle_type') === 'other'
                            ? strtolower($get('vehicle_type_custom'))
                            : strtolower($get('vehicle_type'));

                        return Rule::unique('parking_rates', 'vehicle_type')
                            ->ignore($record?->id)
                            ->where(fn ($query) => $query->where('vehicle_type', $value));
                    })
                    ->validationMessages([
                        'vehicle_type.unique' => 'Rate untuk tipe kendaraan ini sudah ada!',
                    ])

                    ->reactive()
                    ->afterStateUpdated(function ($state, Set $set) {
                        if ($state !== 'other') {
                            $set('vehicle_type_custom', null);
                        }
                    })
                    ->dehydrateStateUsing(function ($state, Get $get) {
                        if ($state === 'other') {
                            return strtolower ($get('vehicle_type_custom'));
                        }

                        return strtolower($state);
                    }),

                TextInput::make('vehicle_type_custom')
                    ->label('Input Vehicle Type')
                    ->placeholder('Example: Truck, Bus, etc...')
                    ->visible(fn (Get $get) => $get('vehicle_type') === 'other')
                    ->required(fn (Get $get) => $get('vehicle_type') === 'other')
                    ->dehydrated(false),

                TextInput::make('rate_hour')
                    ->numeric()
                    ->prefix('Rp')
                    ->minValue(500)
                    ->default(5000),

                    ]);
    }
}

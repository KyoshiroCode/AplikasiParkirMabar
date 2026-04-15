<?php

namespace App\Filament\Resources\Vehicles\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class VehicleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('number_plate')
                    ->required(),
                Select::make('vehicle_type')
                    ->required()
                    ->options([
                        "car"=>"Car",
                        "motorcycle"=>"Motorcycle",
                    ]),
                TextInput::make('color')
                    ->required(),
                TextInput::make('owner')
                    ->required(),
            ]);
    }
}

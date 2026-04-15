<?php

namespace App\Filament\Resources\ParkingAreas\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ParkingAreaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                Select::make('vehicle_type')
                    ->required()
                    ->options([
                        "car" => "Car",
                        "motorcycle" => "Motorcycle"
                    ]),
                TextInput::make('capacity')
                    ->required()
                    ->numeric(),
                TextInput::make('used_slots')
                    ->required()
                    ->numeric(),
            ]);
    }
}

<?php

namespace App\Filament\Resources\ParkingAreas\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Utilities\Get;
use Illuminate\Validation\Rule;
use Filament\Notifications\Notification;
use App\Models\ParkingArea;




class ParkingAreaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')
                    ->required()
                    ->live()
                    ->afterStateUpdated(function (Set $set, Get $get) {

                        $code = $get('code');
                        $type = $get('vehicle_type');

                        if ($code && $type) {
                            $set('name', strtoupper($code) . '-' . ucfirst($type));
                        }
                    }),

                Select::make('vehicle_type')
                    ->required()
                    ->options([
                        "car" => "Car",
                        "motorcycle" => "Motorcycle"
                    ])
                    ->live()
                    ->unique(
                        table: 'parking_areas',
                        column: 'vehicle_type',
                        ignoreRecord: true,
                        modifyRuleUsing: function ($rule, Get $get) {
                            return $rule->where('code', $get('code'));
                        }
                    )
                    // ->validationMessages([
                    //     'unique' => 'Area ini sudah ada untuk jenis kendaraan tersebut!',
                    // ])
                    ->afterStateUpdated(function ($state, Set $set, Get $get) {

                        $code = $get('code');

                        if ($code && $state) {
                            $set('name', strtoupper($code) . '-' . ucfirst($state));
                        }

                        $exists = ParkingArea::where('code', $code)
                            ->where('vehicle_type', $state)
                            ->exists();

                        if ($exists) {
                            Notification::make()
                                ->title('Area sudah ada!')
                                ->body('Code dan jenis kendaraan ini sudah dipakai.')
                                ->danger()
                                ->send();
                        }
                    }),


                TextInput::make('name')
                    ->required()
                    ->disabled()
                    ->dehydrated(),
                TextInput::make('capacity')
                    ->required()
                    ->minValue('1')
                    ->numeric(),
                TextInput::make('used_slots')
                    ->default(0)
                    ->disabled()
                    ->required()
                    ->numeric(),
            ]);
    }
}

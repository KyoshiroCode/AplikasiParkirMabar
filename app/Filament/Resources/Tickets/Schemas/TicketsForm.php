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
use Filament\Notifications\Notification;
use App\Models\Tickets;



class TicketsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('vehicle_id')
                    ->required()
                    ->relationship('vehicle', 'number_plate')
                    ->getOptionLabelFromRecordUsing(function ($record) {
                        return $record->number_plate . ' - ' . ucfirst($record->vehicle_type);
                    })
                    ->reactive()
                    ->preload()
                    ->searchable()
                    ->afterStateUpdated(function ($state, Set $set) {

                        if (!$state) return;

                        $exists = Tickets::where('vehicle_id', $state)
                            ->where('status', 'in')
                            ->exists();

                        if ($exists) {
                            Notification::make()
                                ->title('Kendaraan masih parkir!')
                                ->body('Kendaraan ini belum keluar.')
                                ->danger()
                                ->send();

                            $set('vehicle_id', null);
                            return;
                        }

                        $vehicle = \App\Models\Vehicle::find($state);

                        $set('owner', $vehicle?->owner);

                        $rate = \App\Models\ParkingRate::where('vehicle_type', $vehicle?->vehicle_type)->first();

                        $set('parking_rate_id', $rate?->id);

                        $set('parking_area_id', null);
                    })
                    ->label('Vehicle'),

                DateTimePicker::make('entry_time')
                    ->default(now())
                    ->disabled()
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
                    ->options(function () {
                        return \App\Models\ParkingArea::pluck('name', 'id');
                    })
                    ->searchable()
                    ->preload()
                    ->reactive()
                    ->afterStateUpdated(function ($state) {

                        $area = \App\Models\ParkingArea::find($state);

                        if ($area && $area->used_slots >= $area->capacity) {

                            \Filament\Notifications\Notification::make()
                                ->title('Parkir penuh!')
                                ->body('Area ini sudah tidak tersedia slot.')
                                ->danger()
                                ->send();
                        }
                    })



            ]);
    }
}

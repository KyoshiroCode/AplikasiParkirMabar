<?php

namespace App\Filament\Resources\ParkingRates\Pages;

use App\Filament\Resources\ParkingRates\ParkingRateResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListParkingRates extends ListRecords
{
    protected static string $resource = ParkingRateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

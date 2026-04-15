<?php

namespace App\Filament\Resources\ParkingRates\Pages;

use App\Filament\Resources\ParkingRates\ParkingRateResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewParkingRate extends ViewRecord
{
    protected static string $resource = ParkingRateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

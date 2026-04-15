<?php

namespace App\Filament\Resources\ParkingRates\Pages;

use App\Filament\Resources\ParkingRates\ParkingRateResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditParkingRate extends EditRecord
{
    protected static string $resource = ParkingRateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}

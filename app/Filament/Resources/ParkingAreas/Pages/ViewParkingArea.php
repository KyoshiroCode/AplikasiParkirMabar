<?php

namespace App\Filament\Resources\ParkingAreas\Pages;

use App\Filament\Resources\ParkingAreas\ParkingAreaResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewParkingArea extends ViewRecord
{
    protected static string $resource = ParkingAreaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

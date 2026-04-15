<?php

namespace App\Filament\Resources\ParkingAreas\Pages;

use App\Filament\Resources\ParkingAreas\ParkingAreaResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditParkingArea extends EditRecord
{
    protected static string $resource = ParkingAreaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}

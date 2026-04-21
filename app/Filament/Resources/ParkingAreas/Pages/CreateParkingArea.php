<?php

namespace App\Filament\Resources\ParkingAreas\Pages;

use App\Filament\Resources\ParkingAreas\ParkingAreaResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;
use App\Models\ParkingArea;

class CreateParkingArea extends CreateRecord
{
    protected static string $resource = ParkingAreaResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $exists = ParkingArea::where('code', $data['code'])
            ->where('vehicle_type', $data['vehicle_type'])
            ->exists();

        if ($exists) {
            Notification::make()
                ->title('Gagal!')
                ->body('Area ini sudah ada!')
                ->danger()
                ->send();

            $this->halt(); // ❗ stop proses save
        }

        return $data;
    }

}

<?php

namespace App\Filament\Resources\ActivityLogs\Pages;

use App\Filament\Resources\ActivityLogs\ActivityLogResource;
use Filament\Resources\Pages\ListRecords;
use Spatie\Activitylog\Models\Activity;

class ListActivityLogs extends ListRecords
{
    protected static string $resource = ActivityLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
             
        ];
    }
}

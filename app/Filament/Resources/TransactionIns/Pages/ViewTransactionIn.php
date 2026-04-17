<?php

namespace App\Filament\Resources\TransactionIns\Pages;

use App\Filament\Resources\TransactionIns\TransactionInResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewTransactionIn extends ViewRecord
{
    protected static string $resource = TransactionInResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

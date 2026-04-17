<?php

namespace App\Filament\Resources\TransactionIns\Pages;

use App\Filament\Resources\TransactionIns\TransactionInResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTransactionIns extends ListRecords
{
    protected static string $resource = TransactionInResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

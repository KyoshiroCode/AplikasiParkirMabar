<?php

namespace App\Filament\Resources\TransactionIns\Pages;

use App\Filament\Resources\TransactionIns\TransactionInResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditTransactionIn extends EditRecord
{
    protected static string $resource = TransactionInResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\Tickets\Pages;

use App\Filament\Resources\Tickets\TicketsResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions\Action;

class ViewTickets extends ViewRecord
{
    protected static string $resource = TicketsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
            Action::make('print')
            ->label('Print Ticket')
            ->icon('heroicon-o-printer')
            ->url(fn () => url('/ticket/print/' . $this->record->id))
            ->openUrlInNewTab(),

        ];
    }
}

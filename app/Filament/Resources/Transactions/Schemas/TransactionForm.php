<?php

namespace App\Filament\Resources\Transactions\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Utilities\Get;
use App\Models\Tickets;
use Illuminate\Support\Str;

use Carbon\Carbon;

class TransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('tickets_id')
                    ->required()
                    ->relationship(
                        'ticket',
                        'code',
                        fn ($query) => $query->where('status', 'in') // 🔥 cuma yang masih parkir
                    )
                    ->label('Ticket Code')
                    ->searchable()
                    ->preload()
                    ->live()
                    ->afterStateUpdated(function ($state, Set $set) {

                        if (!$state) return;

                        $ticket = \App\Models\Tickets::with('parkingRate')->find($state);
                        if (!$ticket || !$ticket->entry_time) return;

                        $entry = \Carbon\Carbon::parse($ticket->entry_time);
                        $exit = now();

                        $hours = ceil($entry->diffInMinutes($exit) / 60);

                        $rate = $ticket->parkingRate?->rate_hour ?? 0;

                        $set('duration_hour', $hours);
                        $set('total_cost', $hours * $rate);
                    }),


                DateTimePicker::make('time_out')
                    ->default(now())
                    ->readOnly()
                    ->required()
                    ->reactive(),

                TextInput::make('duration_hour')
                    ->numeric()
                    ->disabled()
                    ->dehydrated(),

                TextInput::make('total_cost')
                    ->numeric()
                    ->disabled()
                    ->dehydrated()
                    ->prefix('Rp'),

                TextInput::make('ticket.status')
                    ->required()
                    ->disabled()
                    ->dehydrated()
                    ->default('out'),

            ]);
    }
}

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
                    ->relationship('ticket', 'code')
                    ->label('Ticket Code')
                    ->searchable()
                    ->reactive()
                    ->afterStateUpdated(fn ($state, Set $set) => $set('duration_hour', null)),

                DateTimePicker::make('time_out')
                    ->default(now())
                    ->disabled()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function (Get $get, Set $set) {

                        $id = $get('tickets_id');
                        $exit = $get('time_out');

                        if (!$id || !$exit) {
                            $set('duration_hour', null);
                            $set('total_cost', null);
                            return;
                        }

                        $ticket = Tickets::find($id);

                        if (!$ticket || !$ticket->entry_time) {
                            $set('duration_hour', null);
                            $set('total_cost', null);
                            return;
                        }

                        $entryTime = Carbon::parse($ticket->entry_time);
                        $exitTime = Carbon::parse($exit);

                        $minutes = $entryTime->diffInMinutes($exitTime);
                        $hours = ceil($minutes / 60);

                        $set('duration_hour', $hours);

                        $rate = $ticket->parkingRate->rate_hour ?? 0;

                        $set('total_cost', $hours * $rate);
                    }),

                TextInput::make('duration_hour')
                    ->numeric()
                    ->disabled()
                    ->dehydrated(),

                TextInput::make('total_cost')
                    ->numeric()
                    ->disabled()
                    ->dehydrated()
                    ->prefix('Rp'),

                TextInput::make('status')
                    ->required()
                    ->default('out'),

            ]);
    }
}

<?php

namespace App\Filament\Resources\Transactions\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Utilities\Get;
use App\Models\TransactionIn;
use Carbon\Carbon;

class TransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('transaction_ins_id')
                    ->required()
                    ->relationship('transactionIn', 'entry_time')
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->entry_time)
                    ->label('Time Entry')
                    ->live()
                    ->afterStateUpdated(function ($state, Set $set) {
                        $set('duration_hour', null);
                    })
                    ->dehydrated(),

                DateTimePicker::make('time_out')
                    ->required()
                    ->live()
                    ->afterStateUpdated(function (Get $get, Set $set) {

                        $id = $get('transaction_ins_id');
                        $exit = $get('time_out');

                        if (!$id || !$exit) {
                            $set('duration_hour', null);
                            $set('total_cost', null);
                            return;
                        }

                        $data = TransactionIn::find($id);

                        if (!$data || !$data->entry_time) {
                            $set('duration_hour', null);
                            $set('total_cost', null);
                            return;
                        }

                        $entryTime = Carbon::parse($data->entry_time);
                        $exitTime = Carbon::parse($exit);

                        // 🔥 hitung durasi
                        $minutes = $entryTime->diffInMinutes($exitTime);
                        $hours = ceil($minutes / 60);

                        $set('duration_hour', $hours);

                        // 🔥 ambil rate dari relasi
                        $rate = $data->parkingRate->rate_hour ?? 0;

                        // 🔥 hitung total
                        $total = $hours * $rate;

                        $set('total_cost', $total);
                    }),


                TextInput::make('duration_hour')
                    ->numeric()
                    ->disabled()
                    ->dehydrated(),

                TextInput::make('total_cost')
                    ->numeric()
                    ->default(null)
                    ->prefix('$'),

                TextInput::make('status')
                    ->required()
                    ->default('out'),

                Select::make('user_id')
                    ->required()
                    ->relationship('user', 'name')
                    ->label('Staff'),
            ]);
    }
}

<?php

namespace App\Filament\Resources\Transactions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TransactionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
        ->columns([
                TextColumn::make('transaction_code')
                    ->label('Transaction Code')
                    ->sortable(),
                TextColumn::make('ticket.code')
                    ->label('Ticket Code')
                    ->sortable(),
                TextColumn::make('ticket.entry_time')
                    ->dateTime()
                    ->label('Time Entry')
                    ->sortable(),
                TextColumn::make('time_out')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('duration_hour')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('total_cost')
                    ->money()
                    ->sortable(),
                TextColumn::make('status')
                    ->searchable(),
                TextColumn::make('user.name')
                    ->label('Staff Exit')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('ticket.owner') 
                    ->label('Owner')
                    ->searchable(),
                TextColumn::make('ticket.parkingRate.rate_hour')
                    ->money()
                    ->label('Parking Rate')
                    ->sortable(),
                TextColumn::make('ticket.parkingArea.name')
                    ->label('Parking Area')
                    ->sortable(),
                TextColumn::make('ticket.user.name')
                    ->label('Staff Entry')
                    ->sortable(), 
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

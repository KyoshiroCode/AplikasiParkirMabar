<?php

namespace App\Filament\Resources\TransactionIns\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TransactionInsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('Vehicle.number_plate')
                    ->label('Plate Number')
                    ->sortable(),
                TextColumn::make('entry_time')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('status')
                    ->searchable(),
                TextColumn::make('owner')
                    ->searchable(),
                TextColumn::make('parkingRate.rate_hour')
                    ->label('Parking Rate')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('parkingArea.name')
                    ->label('Parking Area')
                    ->sortable(),
                TextColumn::make('user.name')
                    ->label('Staff')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

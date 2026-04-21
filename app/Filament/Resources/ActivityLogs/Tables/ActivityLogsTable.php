<?php

namespace App\Filament\Resources\ActivityLogs\Tables;

use Filament\Actions\BulkActionGroup;

use Filament\Tables\Columns\TextColumn;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;

class ActivityLogsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('causer.name')
                    ->label('User')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('description')
                    ->label('Action')
                    ->badge()
                    ->color(fn($state) => match ($state) {
                        'created' => 'success',
                        'updated' => 'primary',
                        'deleted' => 'danger',
                        default => 'secondary',
                    }),
                TextColumn::make('subject_type')
                    ->label('Model')
                    ->formatStateUsing(fn ($state) => ucfirst($state))
                    ->badge(),
                TextColumn::make('subject_id')
                    ->label('ID'),
                TextColumn::make('created_at')
                    ->datetime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                ViewAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                ]),
            ]);
    }
}

<?php

namespace App\Filament\Resources\FinancialReports\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\Action;
use Filament\Tables\Filters\SelectFilter;


class FinancialReportsTable
{
    public static function configure(Table $table): Table
    {
        return $table->columns([

            TextColumn::make('type')->badge(),

            TextColumn::make('date')
                ->label('Date')
                ->date(),

            TextColumn::make('month'),

            TextColumn::make('total_transactions'),

            TextColumn::make('total_income')
                ->money('IDR'),


        ])
        ->recordActions([ 
            Action::make('print')
                ->label('Print')
                ->url(fn ($record) => url('/report/print/' . $record->id))
                ->openUrlInNewTab(),
        ])
        ->filters([
            SelectFilter::make('type')
                ->options([
                    'daily' => 'Daily',
                    'monthly' => 'Monthly',
                ]),
        ]);

    }
}

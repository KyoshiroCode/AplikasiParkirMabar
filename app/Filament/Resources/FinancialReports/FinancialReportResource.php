<?php

namespace App\Filament\Resources\FinancialReports;

use App\Filament\Resources\FinancialReports\Pages\CreateFinancialReport;
use App\Filament\Resources\FinancialReports\Pages\EditFinancialReport;
use App\Filament\Resources\FinancialReports\Pages\ListFinancialReports;
use App\Filament\Resources\FinancialReports\Schemas\FinancialReportForm;
use App\Filament\Resources\FinancialReports\Tables\FinancialReportsTable;
use App\Models\FinancialReport;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;

class FinancialReportResource extends Resource
{
    protected static ?string $model = FinancialReport::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([

            Select::make('type')
                ->options([
                    'daily' => 'Daily',
                    'monthly' => 'Monthly',
                ])
                ->required()
                ->live(),

            DatePicker::make('date')
                ->visible(fn (Get $get) => $get('type') === 'daily')
                ->required(fn (Get $get) => $get('type') === 'daily'),

            TextInput::make('month')
                ->placeholder('2026-04')
                ->visible(fn (Get $get) => $get('type') === 'monthly')
                ->required(fn (Get $get) => $get('type') === 'monthly'),

            TextInput::make('total_transactions')
                ->disabled()
                ->dehydrated(),

            TextInput::make('total_income')
                ->disabled()
                ->prefix('Rp')
                ->dehydrated(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return FinancialReportsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFinancialReports::route('/'),
            'create' => CreateFinancialReport::route('/create'),
            'edit' => EditFinancialReport::route('/{record}/edit'),
        ];
    }

}

<?php

namespace App\Filament\Resources\TransactionIns;

use App\Filament\Resources\TransactionIns\Pages\CreateTransactionIn;
use App\Filament\Resources\TransactionIns\Pages\EditTransactionIn;
use App\Filament\Resources\TransactionIns\Pages\ListTransactionIns;
use App\Filament\Resources\TransactionIns\Pages\ViewTransactionIn;
use App\Filament\Resources\TransactionIns\Schemas\TransactionInForm;
use App\Filament\Resources\TransactionIns\Schemas\TransactionInInfolist;
use App\Filament\Resources\TransactionIns\Tables\TransactionInsTable;
use App\Models\TransactionIn;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TransactionInResource extends Resource
{
    protected static ?string $model = TransactionIn::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return TransactionInForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TransactionInInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TransactionInsTable::configure($table);
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
            'index' => ListTransactionIns::route('/'),
            'create' => CreateTransactionIn::route('/create'),
            'view' => ViewTransactionIn::route('/{record}'),
            'edit' => EditTransactionIn::route('/{record}/edit'),
        ];
    }
}

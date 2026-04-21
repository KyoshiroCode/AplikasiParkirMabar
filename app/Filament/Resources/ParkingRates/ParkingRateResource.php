<?php

namespace App\Filament\Resources\ParkingRates;

use App\Filament\Resources\ParkingRates\Pages\CreateParkingRate;
use App\Filament\Resources\ParkingRates\Pages\EditParkingRate;
use App\Filament\Resources\ParkingRates\Pages\ListParkingRates;
use App\Filament\Resources\ParkingRates\Pages\ViewParkingRate;
use App\Filament\Resources\ParkingRates\Schemas\ParkingRateForm;
use App\Filament\Resources\ParkingRates\Schemas\ParkingRateInfolist;
use App\Filament\Resources\ParkingRates\Tables\ParkingRatesTable;
use App\Models\ParkingRate;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ParkingRateResource extends Resource
{
    protected static ?string $model = ParkingRate::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return ParkingRateForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ParkingRateInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ParkingRatesTable::configure($table);
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
            'index' => ListParkingRates::route('/'),
            'create' => CreateParkingRate::route('/create'),
            'view' => ViewParkingRate::route('/{record}'),
            'edit' => EditParkingRate::route('/{record}/edit'),
        ];
    }
}
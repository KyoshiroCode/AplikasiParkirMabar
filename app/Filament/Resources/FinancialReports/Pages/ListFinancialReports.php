<?php

namespace App\Filament\Resources\FinancialReports\Pages;

use App\Filament\Resources\FinancialReports\FinancialReportResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Action;
use App\Services\FinancialReportService;
use Filament\Schemas\Components\Tabs\Tab;

use Illuminate\Database\Eloquent\Builder;



class ListFinancialReports extends ListRecords
{
    protected static string $resource = FinancialReportResource::class;

    protected function getHeaderActions(): array
    {
        return [

            Action::make('Generate Today')
                ->action(function () {

                    FinancialReportService::generateDaily(now()->toDateString());

                })
                ->color('success'),

            Action::make('Generate Monthly')
                ->action(function () {

                    FinancialReportService::generateMonthly(
                        now()->year,
                        now()->month
                    );

                })
                ->color('primary'),

        ];
    }
    public function getTabs(): array
    {
        return [
            'all' => Tab::make(),

            'daily' => Tab::make()
                ->label('Daily')
                ->modifyQueryUsing(fn (Builder $query) => 
                    $query->where('type', 'daily')
                ),

            'monthly' => Tab::make()
                ->label('Monthly')
                ->modifyQueryUsing(fn (Builder $query) => 
                    $query->where('type', 'monthly')
                ),
        ];
    }


    
}

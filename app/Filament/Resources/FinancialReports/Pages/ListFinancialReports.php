<?php

namespace App\Filament\Resources\FinancialReports\Pages;

use App\Filament\Resources\FinancialReports\FinancialReportResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Action;
use App\Services\FinancialReportService;


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

    
}

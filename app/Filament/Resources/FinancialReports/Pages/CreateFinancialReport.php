<?php

namespace App\Filament\Resources\FinancialReports\Pages;

use App\Filament\Resources\FinancialReports\FinancialReportResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Transaction;

class CreateFinancialReport extends CreateRecord
{
    protected static string $resource = FinancialReportResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if ($data['type'] === 'daily') {

            $query = \App\Models\Transaction::whereDate('time_out', $data['date']);

        } else {

            $year = substr($data['month'], 0, 4);
            $month = substr($data['month'], 5, 2);

            $query = \App\Models\Transaction::whereYear('time_out', $year)
                ->whereMonth('time_out', $month);
        }

        $data['total_transactions'] = $query->count();
        $data['total_income'] = $query->sum('total_cost');

        return $data;
    }


}

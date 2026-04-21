<?php

use App\Models\Tickets;
use App\Models\transaction;
use App\Models\FinancialReport;
use Barryvdh\DomPDF\Facade\Pdf;

Route::get('/ticket/print/{id}', function ($id) {

    $ticket = Tickets::findOrFail($id);

    $pdf = Pdf::loadView('pdf.ticket', compact('ticket'));

    return $pdf->stream('ticket.pdf'); // atau download()
});

Route::get('/struck/print/{id}', function ($id){

    $transaction = Transaction::with('ticket.vehicle', 'ticket.parkingRate')->findOrFail($id);


    $pdf = Pdf::loadView('pdf.struck', compact('transaction'));

    return $pdf->stream('struck.pdf');
});



Route::get('/report/print/{id}', function ($id) {

    $report = FinancialReport::findOrFail($id);
    $transactions = $report->transactions()->get();

    $pdf = Pdf::loadView('pdf.report', compact('report', 'transactions'));

    return $pdf->stream('report.pdf');
});

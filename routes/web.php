<?php

use App\Models\Tickets;
use App\Models\transaction;
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

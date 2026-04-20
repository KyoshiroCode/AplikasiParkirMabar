<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: monospace; }
        .box { border: 1px dashed #000; padding: 20px; width: 300px; margin:auto; }
        h3 { text-align: center; }
    </style>
</head>
<body>

<div class="box">
    <h3>STRUK PARKIR</h3>
    <p>================================</p>

    <p>Transaction Code: {{ $transaction->transaction_code }}</p>
    <p>Ticket Code: {{ $transaction->ticket->code }}</p>
    <p>Plate: {{ $transaction->ticket->vehicle->number_plate }}</p>
    <p>Entry: {{ $transaction->ticket->entry_time }}</p>
    <p>Exit: {{ $transaction->time_out }}</p>

    <p>Rate: {{ $transaction->ticket->parkingRate->rate_hour }}</p>
    <p>Duration: {{ $transaction->duration_hour }} Hour</p>

    <p>================================</p>
    <h4>Total: Rp {{ $transaction->total_cost }}</h4>

</div>

</body>
</html>

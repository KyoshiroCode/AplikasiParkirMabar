<!DOCTYPE html>
<html>
<head>
    <style>
        body { 
            font-family: monospace; 
        }
        .box { 
            border: 1px dashed #000; 
            padding: 20px; 
            width: 300px;
            margin:auto; 
        }
        h3 {
            text-align: center;
            font-size: bold;
        }
    </style>
</head>
<body>

<div class="box">
    <h3>TIKET PARKIR</h3>

    <p>Kode: {{ $ticket->code }}</p>
    <p>Plat: {{ $ticket->vehicle->number_plate }}</p>
    <p>Masuk: {{ $ticket->entry_time }}</p>

    <br>

</div>

</body>
</html>

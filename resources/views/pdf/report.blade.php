<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Report</title>
</head>
<body>
	<h2>LAPORAN KEUANGAN</h2>

	<p>Type: {{ $report->type }}</p>

	@if($report->type === 'daily')
		<p>Tanggal: {{ $report->date }}</p>
	@else
	<	p>Bulan: {{ $report->month }}</p>
	@endif

	<hr>

	<p>Total Transaksi: {{ $report->total_transactions }}</p>
	<p>Total Income: Rp {{ number_format($report->total_income) }}</p>

	<h3>Detail</h3>

	<table border="1" width="100%">
	    <tr>
	        <th>Kode</th>
	        <th>Waktu Keluar</th>
	        <th>Total</th>
	    </tr>

	    @foreach($transactions as $trx)
	    <tr>
	        <td>{{ $trx->transaction_code }}</td>
	        <td>{{ $trx->time_out }}</td>
	        <td>Rp {{ number_format($trx->total_cost) }}</td>
	    </tr>
	    @endforeach
	</table>

</body>
</html>
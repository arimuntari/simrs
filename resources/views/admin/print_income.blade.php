<!DOCTYPE html>
<html>
<head>
	<title>{{ $title }}</title>
</head>
<body>
	<table style="width:100%" border="1" cellspacing="0" cellpadding="0">
		<thead>
			<tr>
				<td colspan="5">{{ $title }} Tanggal : {{ Helper::formatIndo($date_start) }} -  {{ Helper::formatIndo($date_end) }}</td>
			</tr>
			<tr class="bg-table">
				<th  width="50px">No. </th>
				<th width="150px">Kode Penjualan</th>
				<th width="150px">Tanggal &  Jam </th>
				<th width="150px">Total Harga</th>
				<th width="150px">Admin</th>
			</tr>
		</thead>
		<tbody>
			<?php  $no = 1;$totalincome = 0; ?>


			@foreach($incomes as $income)


			<?php  $totalincome +=$income->price_total; ?>
			<tr>
				<td>{{ $no }}. </td>
				<td>{!! $income->code !!}</td>
				<td>{{ Helper::formatIndo($income->income_date) }}</td>
				<td align="right"> @rupiah($income->price_total)</td>
				<td>{{ $income->User->name }}</td>
			</tr>
			<?php  $no++ ;?>
			@endforeach
			<tr>
				<td colspan="3" align="right">Total: </td>
				<td align="right"> @rupiah($totalincome)</td>
				<td></td>
			</tr>
		</tbody>
	</table>
</body>
</html>
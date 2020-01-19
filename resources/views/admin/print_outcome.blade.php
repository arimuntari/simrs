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
				<th width="150px">Kode Pembelian</th>
				<th width="150px">Tanggal &  Jam </th>
				<th width="150px">Total Harga</th>
				<th width="150px">Admin</th>
			</tr>
		</thead>
		<tbody>
			<?php  $no = 1;$totaloutcome = 0; ?>
			@foreach($outcomes as $outcome)
			<?php  $totaloutcome +=$outcome->price_total; ?>
			<tr>
				<td>{{ $no }}. </td>
				<td>{!! $outcome->code !!}</td>
				<td>{{ Helper::formatIndo($outcome->outcome_date) }}</td>
				<td align="right"> @rupiah($outcome->price_total)</td>
				<td>{{ $outcome->User->name }}</td>
			</tr>
			<?php  $no++ ;?>
			@endforeach
			<tr>
				<td colspan="3" align="right">Total: </td>
				<td align="right"> @rupiah($totaloutcome)</td>
				<td></td>
			</tr>
		</tbody>
	</table>
</body>
</html>
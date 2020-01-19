<!DOCTYPE html>
<html>
<head>
	<title>{{ $title }}</title>
</head>
<body>
	<table style="width:100%" border="1" cellspacing="0" cellpadding="0">
		<thead>
			<tr>
				<td colspan="5">{{ $title }}</td>
			</tr>
			
			<tr class="bg-table">
				<th  width="50px">No. </th>
				<th width="150px">Kode Obat</th>
				<th width="150px">Nama Obat</th>
				<th width="150px">Stok Awal</th>
				<th width="150px">Stok Beli</th>
				<th width="150px">Stok Jual</th>
				<th width="150px">Stok Sisa</th>
			</tr>
		</thead>
		<tbody>
			<?php  $no= 1; ?>
			@foreach($items as $item)
			<tr>
				<td>{{ $no }}</td>
				<td>{!! $item['code'] !!}</td>
				<td>{!! $item['name'] !!}</td>
				<td>{{ $item['stock']-$item['stock_plus']+$item['stock_minus'] }}</td>
				<td>{{ $item['stock_plus'] }}</td>
				<td>{{ $item['stock_minus'] }}</td>
				<td>{{ $item['stock'] }}</td>
			</tr>
			<?php  $no++ ;?>
			@endforeach
		</tbody>
	</table>
</body>
</html>
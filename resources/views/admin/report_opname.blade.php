
@extends('admin/layout')

@section('title', $title)

@section('content')
<div class="container">
	<section class="content">
		<fieldset>
			<legend><h4> {!! $icon." ".$title !!}</h4></legend>
			<div class="row ">
				<div class="col-md-4">
					<div class="row">
						<div class="col-xs-6">
							<a target="_blank" href="{{ route('print.opname')  }}" class="btn btn-success btn-block"> <i class="fa fa-print"></i> Print 
							</a>
						</div>
						<div class="col-xs-6">
							<a href="{{ route('report.opname')  }}" class="btn btn-default btn-block"> <i class="fa fa-sync"></i> Refresh 
							</a>
						</div> 
					</div> 
				</div>
			</div>
			<div class="table table-responsive mt-3">
				<table class="table table-bordered">
					<thead>
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
			</div>
		</fieldset>
	</section>
	<!-- /.content -->
</div>
@endsection('content')
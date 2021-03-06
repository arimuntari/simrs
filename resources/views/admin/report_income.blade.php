
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
							<a target="_blank" href="{{ route('print.income')  }}?date_start={{ $date_start }}&date_end={{ $date_end}}" class="btn btn-success btn-block"> <i class="fa fa-print"></i> Print 
							</a>
						</div>
						<div class="col-xs-6">
							<a href="{{ route('report.income')  }}" class="btn btn-default btn-block"> <i class="fa fa-sync"></i> Refresh 
							</a>
						</div> 
					</div> 
				</div>
				<div class="col-md-1">
				</div>
				<div class="col-md-7">
					<div class="row">
						<form method="get" class="form-horizontal" action="{{  route('report.income')  }}">
							<div class="col-xs-12 col-md-2  col-lg-2">
								<p class="form-control-static"><b>Pencarian:</b></p>
							</div>
							<div class="col-xs-9 col-md-8 col-lg-4">
								<div class="input-group input-group-md">
									<input type="text" name="date_start" value="{{ $date_start ?? '' }}" class="form-control datepicker">
								</div>
							</div>
							<div class="col-xs-9 col-md-8 col-lg-4">
								<div class="input-group input-group-md">
									<input type="text" name="date_end" value="{{ $date_end ?? '' }}" class="form-control datepicker">
									<span class="input-group-btn">
										<button type="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i> Tampil</button>
									</span>
								</div>
							</div>
							<div class="col-xs-3 col-md-3  col-lg-2" style="font-size:13px;">
								<p class="form-control-static pull-right"><b>Total Data :  {{ $incomes->total() }}</b></p>
							</div>
						</form>
					</div>
				</div>
			</div>
			@if(Session::has('success'))<br>
			<span class="label label-success">
				{{ Session::get('success') }}
			</span>
			@endif
			@if(Session::has('fail'))<br>
			<span class="label label-danger">
				{{ Session::get('fail') }}
			</span>
			@endif
			<div class="table table-responsive mt-3">
				<table class="table table-bordered">
					<thead>
						<tr class="bg-table">
							<th  width="50px">No. </th>
							<th width="150px">Kode Penjualan</th>
							<th width="150px">Tanggal &  Jam </th>
							<th width="150px">Total Harga</th>
							<th width="150px">Admin</th>
						</tr>
					</thead>
					<tbody>
						<?php  $no = 1*$incomes->currentPage() ;$totalincome = 0; ?>
						@foreach($incomes as $income)
						<?php  $totalincome +=$income->price_total; ?>
						<tr>
							<td>{{ $no }}. </td>
							<td>{!! $income->code !!}</td>
							<td>{{ Helper::formatIndo($income->sale_date) }}</td>
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
			</div>

			{{ $incomes->links() }}
		</fieldset>
	</section>
	<!-- /.content -->
</div>
@endsection('content')
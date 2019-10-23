
@extends('admin/layout')

@section('title', $title)

@section('content')
<div class="container">
  <!-- Main content -->
  <section class="content">
	<h4><i class="fa fa-chart"></i> Home</h4>
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-warning">
			  <div class="panel-heading">Chart Laporan Pengeluaran</div>
			  <div class="panel-body">Panel Content</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-success">
			  <div class="panel-heading">Chart Laporan Pemasukan</div>
			  <div class="panel-body">Panel Content</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
			  <div class="panel-heading">Chart Laporan Stok</div>
			  <div class="panel-body">Panel Content</div>
			</div>
		</div>
	</div>
  </section>
  <!-- /.content -->
</div>
@endsection('content')
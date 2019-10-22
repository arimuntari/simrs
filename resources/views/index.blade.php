<html>
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Sistem Informasi Manajemen Rumah Sakit</title>

  <!-- Template CSS -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/bootstrap/dist/css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/font-awesome/css/all.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">

</head>
<body>
<header class="menu">
	<nav class="top-menu">
	  <div class="container">
		<div class="navbar-header">
		 <img src="{{ asset('img/logo.png') }}" align="left" >
		  <a class="navbar-brand" href="#"> Sistem Informasi Manajemen <br> Rumah Sakit</a>
		</div>
	  </div>
	</nav>
	<nav class="bottom-menu">
	  <div class="container">
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			<i class="fa fa-bars"></i>
		  </button>
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
		  <ul class="nav navbar-nav">
			<li class="active"><a href="#">Home</a></li>
			<li><a href="pendaftaran.html"><i class="fa fa-user"></i> Pendaftaran Pasien</a></li>
			<li><a href="#"><i class="fa fa-stethoscope"></i> Pemeriksaan</a></li> 
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-shopping-cart"></i> Transaksi
				<span class="caret"></span></a>
				<ul class="dropdown-menu">
				  <li><a href="#">Penjualan</a></li>
				  <li><a href="#">Pembelian</a></li>
				</ul>
			</li>
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-database"></i> Data Master
				<span class="caret"></span></a>
				<ul class="dropdown-menu">
				  <li><a href="#">Obat</a></li>
				  <li><a href="#">Pasien</a></li>
				  <li><a href="#">Supplier</a></li>
				</ul>
			</li>
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-file"></i> Laporan
				<span class="caret"></span></a>
				<ul class="dropdown-menu">
				  <li><a href="#">Laporan Pendapatan</a></li>
				  <li><a href="#">Laporan Pengeluaran</a></li>
				  <li><a href="#">Laporan Stok Obat</a></li>
				</ul>
			</li>
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#"> <i class="fa fa-cog"></i> Setting
				<span class="caret"></span></a>
				<ul class="dropdown-menu">
				  <li><a href="#">User</a></li>
				</ul>
			</li>
		  </ul>
		</div>
	  </div>
	</nav>
</header>
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
  <script src="{{ asset('assets/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/bootstrap/dist/js/bootstrap.min.js') }}"></script>
</body>
</html>
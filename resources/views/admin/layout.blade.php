<html>
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>@yield('title') Sistem Informasi Manajemen Rumah Sakit</title>

  <!-- Template CSS -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/bootstrap/dist/css/bootstrap.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/select2/dist/css/select2.css') }}">
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
			<li><a href="{{ route('dashboard') }}">Home</a></li>
			<li><a href="{{ route('register.index') }}"><i class="fa fa-user"></i> Pendaftaran Pasien</a></li>
			<li><a href="{{ route('exam.index') }}"><i class="fa fa-stethoscope"></i> Pemeriksaan</a></li> 
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-shopping-cart"></i> Transaksi
				<span class="caret"></span></a>
				<ul class="dropdown-menu">
				  <li><a href="{{ route('sale.index') }}">Penjualan</a></li>
				  <li><a href="{{ route('purchase.index') }}">Pembelian</a></li>
				</ul>
			</li>
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-database"></i> Data Master
				<span class="caret"></span></a>
				<ul class="dropdown-menu">
				  <li><a href="{{ route('medicine.index') }}">Obat</a></li>
				  <li><a href="{{ route('patient.index') }}">Pasien</a></li>
				  <li><a href="{{ route('diagnosis.index') }}">Diagnosa</a></li>
				  <li><a href="{{ route('action.index') }}">Tindakan</a></li>
				</ul>
			</li>
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-file"></i> Laporan
				<span class="caret"></span></a>
				<ul class="dropdown-menu">
				  <li><a href="{{ route('report.income') }}">Laporan Pendapatan</a></li>
				  <li><a href="{{ route('report.outcome') }}">Laporan Pengeluaran</a></li>
				  <li><a href="{{ route('report.opname') }}">Laporan Stok Obat</a></li>
				</ul>
			</li>
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#"> <i class="fa fa-cog"></i> Setting
				<span class="caret"></span></a>
				<ul class="dropdown-menu">
				  <li><a href="#">User</a></li>
				  <li><a href="{{ route('logout') }}">Logout</a></li>
				</ul>
			</li>
		  </ul>
		</div>
	  </div>
	</nav>
</header>

@yield('content')


  <script src="{{ asset('assets/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('assets/select2/dist/js/select2.min.js') }}"></script>
  <script src="{{ asset('assets/highcharts/highcharts.js') }}"></script>
  <script>
	  $(".datepicker").datepicker({
	  	format: 'yyyy-mm-dd',
	  	autoclose: true
	  });	
  </script>
  @yield('script')
</body>
</html>
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
           <!-- <i class="fa fa-bars"></i>-->
          </button>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <div style="height:35px;"></div>
        </div>
      </div>
    </nav>
</header>
<div class="container">
  <section class="login content">
    <div class="form-login">
        <form name="login_form" class="login-form" action="{{ route('proses_login') }}" method="post">
            @csrf
        <div class="header">
            <h1>Login Form</h1>
            <span>Masukkan Username &amp; Password Anda dengan Benar</span>
        </div>
    
        <div class="content">
            <input name="username" type="text" id="username" class="input username" placeholder="Username" value="">
            <div class="user-icon"></div>
            <input name="password" type="password" id="txtPassword" class="input password" placeholder="Password" value="">
            <div class="pass-icon"></div>       
        </div>

        <div class="footer">
        <input type="submit" value="Login" class="button">
        </div>
    
        </form>
    </div>
  </section>
  <!-- /.content -->
</div>
  <script src="{{ asset('assets/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/bootstrap/dist/js/bootstrap.min.js') }}"></script>
</body>
</html>
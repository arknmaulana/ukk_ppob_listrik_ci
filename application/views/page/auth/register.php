<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PPOB Listrik | Register</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?=base_url('assets')?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url('assets')?>/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?=base_url('assets')?>/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url('assets')?>/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?=base_url('assets')?>/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font -->
<!--   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="<?=base_url('assets')?>/index2.html"><b>PPOB</b> Listrik</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Pendaftaran User</p>

      <?=form_open(base_url('auth/validate'),array('id'=>'form'))?>
      <div class="box-body">
        <div class="form-group">
          <label>Nama</label>
          <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
          <span class="help-block"></span>
        </div>
        <div class="form-group">
          <label>Username</label>
          <input type="text" class="form-control" id="username" name="username" placeholder="Username">
          <span class="help-block"></span>
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Password">
          <span class="help-block"></span>
        </div> 
        <div class="form-group">
          <label>Nomor meter</label>
          <input type="text" class="form-control" id="nomor_kwh" name="nomor_kwh" placeholder="No Meter">
          <span class="help-block"></span>
        </div> 
        <div class="form-group">
          <label>Alamat</label>
          <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat"></textarea>
          <span class="help-block"></span>
        </div> 
        <div class="form-group">
          <label>Daya</label>
          <select class="form-control" name="id_tarif" id="id_tarif">
            <option value="" style="display:none">Pilih Level</option>
            <?php foreach ($dataTarif as $data): ?>
              <option value="<?=$data->id_tarif?>"><?=$data->daya?></option>
            <?php endforeach ?>
          </select>                 
          <span class="help-block"></span>
        </div>              
      </div>
      <!-- /.box-body -->
      <input type="hidden" name="register" value="1">
     <div class="row">      
        <!-- /.col -->
        <div class="col-md-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Daftar</button>
          <a href="<?=base_url('auth')?>" class="btn btn-info btn-block btn-flat">Login</a>
        </div>      
        <!-- /.col -->
      </div>
      <?=form_close()?>


    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery 3 -->
  <script src="<?=base_url('assets')?>/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?=base_url('assets')?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- iCheck -->
  <script src="<?=base_url('assets')?>/plugins/iCheck/icheck.min.js"></script>
  <?php
  $this->load->view('layout/validation');
  ?>
</body>
</html>

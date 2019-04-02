
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PPOB Listrik | Home</title>
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
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?=base_url('assets')?>/dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-yellow layout-top-nav" >
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container" style="width: 100%">
        <div class="navbar-header">
          <a href="<?=base_url()?>" class="navbar-brand"><b>PPOB</b> Listrik</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="<?=base_url()?>">Home <span class="sr-only">(current)</span></a></li>
            <!-- <li><a href="#">Link</a></li>   -->          
          </ul>         
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">                
                <span class="hidden-xs"><?=ucfirst($this->session->userdata('user_nama'))?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="#" class="btn btn-default btn-flat">Change Password</a>
                  </div>
                  <div class="pull-right">
                    <a href="<?=base_url('index.php/auth/logout')?>" class="btn btn-default btn-flat">Logout</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container" style="width: 100%">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          <small></small>
        </h1>
        <!-- <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Layout</a></li>
          <li class="active">Top Navigation</li>
        </ol> -->
      </section>

      <!-- Main content -->
      <section class="content">
       <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-info"></i> Welcome !</h4>
                Selamat datang <?=ucfirst($this->session->userdata('user_nama'))?> di PPOB Listrik
        </div>      
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Daftar Tagihan</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-3">
                <div class="box-header with-border bg-light-blue-active color-palette">
                  Unpaid
                </div>
                <?php foreach ($dataUnpaid as $data): ?>
                  <div class="box-body">
                    <table class="table table-bordered" style="border:2px solid #999; width: 100%">
                      <tr>
                        <td colspan="2"><h4><b>Tagihan Bulan <?=$dataBulan[$data->bulan]?> <?=$dataTahun[$data->tahun]?></b></h4></td>
                      </tr>
                      <tr>
                        <td>Jumlah Meter</td><td><?=$data->meteran_akhir-$data->meteran_awal?> kwh</td>
                      </tr>
                      <tr>
                        <td>Biaya</td><td><?=$data->total_bayar-$data->biaya_admin?> kwh</td>
                      </tr>
                      <tr>
                        <td>Biaya Admin</td><td>+Rp <?=$data->biaya_admin?></td>
                      </tr>
                      <tr style="font-weight: bold;">
                        <td>Total Bayar</td><td>Rp <?=$data->total_bayar?></td>
                      </tr>
                      <tr>
                        <td colspan="2"><button data-toggle="modal" data-target="#modal-upload" onclick="upload('<?=$data->id_penggunaan?>')" class="btn btn-primary" >Upload Bukti</button></td>
                      </tr>                   
                    </table>
                  </div>
                <?php endforeach ?>
              </div>
               <div class="col-md-3">
                <div class="box-header with-border bg-yellow-active color-palette">
                  Pending
                </div>
                <?php foreach ($dataPending as $data): ?>
                  <?php 
                    $aa = $this->db->where('id_penggunaan', $data->id_penggunaan)->order_by('id_pembayaran','desc')->get('pembayaran')->row();
                   ?>
                  <div class="box-body">
                    <table class="table table-bordered" style="border:2px solid #999; width: 100%">
                      <tr>
                        <td colspan="2"><h4><b>Tagihan Bulan <?=$dataBulan[$data->bulan]?> <?=$dataTahun[$data->tahun]?></b></h4></td>
                      </tr>
                      <tr>
                        <td>Jumlah Meter</td><td><?=$data->meteran_akhir-$data->meteran_awal?> kwh</td>
                      </tr>
                      <tr>
                        <td>Biaya</td><td><?=$data->total_bayar-$data->biaya_admin?> kwh</td>
                      </tr>
                      <tr>
                        <td>Biaya Admin</td><td>+Rp <?=$data->biaya_admin?></td>
                      </tr>
                      <tr style="font-weight: bold;">
                        <td>Total Bayar</td><td>Rp <?=$data->total_bayar?></td>
                      </tr>    
                      <tr style="">
                        <td>Tangggal Bayar</td><td><?=$aa->tgl_bayar?></td>
                      </tr>           
                      <tr>
                        <td>Bukti Bayar</td><td>
                          <button data-toggle='modal' data-target="#modal-bukti" class="btn btn-success" onclick="bukti('<?=$aa->bukti_pembayaran?>')"><span class="fa fa-eye"></span></button>
                        </td>
                      </tr>                    
                    </table>
                  </div>
                <?php endforeach ?>
              </div>
              <div class="col-md-3">
                <div class="box-header with-border bg-green-active color-palette">
                  Lunas
                </div>
                <?php foreach ($dataLunas as $data): ?>
                  <div class="box-body">
                     <?php 
                    $aa = $this->db->where('id_penggunaan', $data->id_penggunaan)->where('status_pembayaran',1)->get('pembayaran')->row();
                   ?> 
                    <table class="table table-bordered" style="border:2px solid #999; width: 100%">
                      <tr>
                        <td colspan="2"><h4><b>Tagihan Bulan <?=$dataBulan[$data->bulan]?> <?=$dataTahun[$data->tahun]?></b></h4></td>
                      </tr>
                      <tr>
                        <td>Jumlah Meter</td><td><?=$data->meteran_akhir-$data->meteran_awal?> kwh</td>
                      </tr>
                      <tr>
                        <td>Biaya</td><td><?=$data->total_bayar-$data->biaya_admin?> kwh</td>
                      </tr>
                      <tr>
                        <td>Biaya Admin</td><td>+Rp <?=$data->biaya_admin?></td>
                      </tr>
                      <tr style="font-weight: bold;">
                        <td>Total Bayar</td><td>Rp <?=$data->total_bayar?></td>
                      </tr>    
                      <tr style="">
                        <td>Tangggal Bayar</td><td><?=$aa->tgl_bayar?></td>
                      </tr>      
                      <tr style="">
                        <td>Bukti Bayar</td><td>
                          <button data-toggle='modal' data-target="#modal-bukti" class="btn btn-success" onclick="bukti('<?=$aa->bukti_pembayaran?>')"><span class="fa fa-eye"></span></button>
                        </td>
                      </tr>                            
                    </table>
                  </div>
                <?php endforeach ?>
              </div>
              <div class="col-md-3">
                <div class="box-header with-border bg-red-active color-palette">
                  Ditolak
                </div>
                <?php foreach ($dataDitolak as $data): ?>
                  <?php 
                    $aa = $this->db->where('id_penggunaan', $data->id_penggunaan)->order_by('id_pembayaran','desc')->get('pembayaran')->row();
                   ?>
                  <div class="box-body">
                    <table class="table table-bordered" style="border:2px solid #999; width: 100%">
                      <tr>
                        <td colspan="2"><h4><b>Tagihan Bulan <?=$dataBulan[$data->bulan]?> <?=$dataTahun[$data->tahun]?></b></h4></td>
                      </tr>
                      <tr>
                        <td>Jumlah Meter</td><td><?=$data->meteran_akhir-$data->meteran_awal?> kwh</td>
                      </tr>
                      <tr>
                        <td>Biaya</td><td><?=$data->total_bayar-$data->biaya_admin?> kwh</td>
                      </tr>
                      <tr>
                        <td>Biaya Admin</td><td>+Rp <?=$data->biaya_admin?></td>
                      </tr>
                      <tr style="font-weight: bold;">
                        <td>Total Bayar</td><td>Rp <?=$data->total_bayar?></td>
                      </tr>
                      <tr style="">
                        <td>Tangggal Bayar</td><td><?=$aa->tgl_bayar?></td>
                      </tr>    
                      <tr>
                        <td colspan="2"><button data-toggle="modal" data-target="#modal-upload" onclick="upload('<?=$data->id_penggunaan?>')" class="btn btn-primary" >Upload Bukti</button></td>
                      </tr>                   
                    </table>
                  </div>
                <?php endforeach ?>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
        </div>        
        <!-- /.box -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Version</b> 2.4.0
      </div>
      <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
      reserved.
    </div>
    <!-- /.container -->
  </footer>
</div>
<div class="modal fade" id="modal-upload" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Modal Upload</h4>
            </div>
            <div class="modal-body">
              <?=form_open(base_url('index.php/home/validate'),array('id'=>'form-upload'))?>
              <div class="box-body">
                <div class="form-group">
                  <label>Tanggal Bayar</label>
                  <input type="date" class="form-control" id="tgl_bayar" name="tgl_bayar" required="">
                  <span class="help-block"></span>
                </div>
              </div>    
              <div class="box-body">
                <div class="form-group">
                  <label>Bukti Bayar</label>
                  <input type="file" class="form-control" id="file" name="file">
                  <span class="help-block"></span>
                </div>
              </div>          
              <!-- /.box-body -->
              <input type="hidden" name="id_penggunaan" id="id_penggunaan">
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            <?=form_close()?>
            </div>          
        </div>
         <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal-bukti" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Bukti Bayar</h4>
            </div>
            <div class="modal-body">
              <center>
                <img src="" id="img-bukti">
              </center>
            </div>          
        </div>
         <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?=base_url('assets')?>/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url('assets')?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?=base_url('assets')?>/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?=base_url('assets')?>/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url('assets')?>/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url('assets')?>/dist/js/demo.js"></script>

<?php 
$this->load->view('layout/validation'); ?>

<script type="text/javascript">
    var base_url = "<?=base_url('assets/upload/')?>"
    function upload(id) {
      $('#id_penggunaan').val(id);
    }
    function bukti(gambar) {
      $('#img-bukti').attr('src',base_url+gambar);
    }
</script>
</body>
</html>

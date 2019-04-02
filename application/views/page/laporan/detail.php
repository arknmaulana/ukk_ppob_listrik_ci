<?php 
	$this->load->view('layout/header');
?>
<link href="<?=base_url('assets')?>/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<style type="text/css">
	/* Jquery DataTable ============================ */
.dataTables_wrapper {
  position: relative; }
  .dataTables_wrapper select {
    border: none;
    border-bottom: 1px solid #ddd;
    -webkit-border-radius: 0;
    -moz-border-radius: 0;
    -ms-border-radius: 0;
    border-radius: 0;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    -ms-box-shadow: none;
    box-shadow: none; }
    .dataTables_wrapper select:active, .dataTables_wrapper select:focus {
      -webkit-box-shadow: none;
      -moz-box-shadow: none;
      -ms-box-shadow: none;
      box-shadow: none; }
  .dataTables_wrapper input[type="search"] {
    -webkit-border-radius: 0;
    -moz-border-radius: 0;
    -ms-border-radius: 0;
    border-radius: 0;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    -ms-box-shadow: none;
    box-shadow: none;
    border: none;
    font-size: 12px;
    border-bottom: 1px solid #ddd; }
    .dataTables_wrapper input[type="search"]:focus, .dataTables_wrapper input[type="search"]:active {
      border-bottom: 2px solid #1f91f3; }
  .dataTables_wrapper .dt-buttons {
    float: left; }
    .dataTables_wrapper .dt-buttons a.dt-button {
      background-color: #607D8B;
      color: #fff;
      padding: 7px 12px;
      margin-right: 5px;
      text-decoration: none;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.16), 0 2px 10px rgba(0, 0, 0, 0.12);
      -webkit-border-radius: 2px;
      -moz-border-radius: 2px;
      -ms-border-radius: 2px;
      border-radius: 2px;
      border: none;
      font-size: 13px;
      outline: none; }
      .dataTables_wrapper .dt-buttons a.dt-button:active {
        opacity: 0.8; }

.dt-button-info {
  position: fixed;
  top: 50%;
  left: 50%;
  min-width: 400px;
  text-align: center;
  background-color: #fff;
  border: 2px solid #999;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  -ms-border-radius: 3px;
  border-radius: 3px;
  margin-top: -100px;
  margin-left: -200px;
  z-index: 21; }
  .dt-button-info h2 {
    color: #777; }
  .dt-button-info div {
    color: #777;
    margin-bottom: 20px; }
</style>
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<h4 class="box-tittle">Laporan di generate <?=date('d-m-y-h:i:s')?></h4>
			</div>
			<div class="box-body">
				<table class="table table-bordered" id="table-laporan">
					<thead>
						<th>No</th><th>Nama Pelanggan</th><th>No Meter</th><th>Total Meter</th><th>Total Bayar</th><th>Tanggal Bayar</th><th>Validator</th>
					</thead>
					<tbody>
					<?php $i=0; foreach ($dataLaporan as $data): ?>
						<?php 
							$data_user = $this->db->join('tarif','tarif.id_tarif=user.id_tarif')->where('id_user', $data->id_pelanggan)->get('user')->row();
						 ?>
						<tr>
							<td><?=++$i?></td>
							<td><?=$data_user->nama?></td>
							<td><?=$data_user->nomor_kwh?></td>
							<td><?=$data->meteran_akhir-$data->meteran_awal?> kwh</td>
							<td>Rp <?=$data->total_bayar?></td>
							<td><?=date($data->tgl_bayar)?></td>
							<td><?=$data->nama?></td>
						</tr>
					<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<?php 
	$this->load->view('layout/footer');
	$this->load->view('layout/validation');
?>
 <!-- Jquery DataTable Plugin Js -->
    <script src="<?=base_url('assets')?>/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="<?=base_url('assets')?>/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="<?=base_url('assets')?>/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="<?=base_url('assets')?>/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="<?=base_url('assets')?>/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="<?=base_url('assets')?>/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="<?=base_url('assets')?>/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="<?=base_url('assets')?>/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="<?=base_url('assets')?>/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
    <script type="text/javascript">
    	$('#table-laporan').DataTable({
	        dom: 'Bfrtip',
	        responsive: true,
	        buttons: [
	            'excel', 'pdf'
	        ]
	    });
    </script>
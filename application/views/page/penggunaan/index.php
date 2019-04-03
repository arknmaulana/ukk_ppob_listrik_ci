<?php
	$this->load->view('layout/header');
?>
<div class="row">	
	<div class="col-md-12">		
        <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Daftar User</h3>
            </div>
            <div class="box-body">
	         	<table class="table table-bordered">
	         		<thead>
	         			<tr>
	         				<td>No</td><td>Nama</td><td>Daya / No Meter</td><td>Alamat</td><td>Aksi</td>
	         			</tr>
	         			<?php foreach ($dataAll as $data): ?>         			         		
	         			<tr>
	         				<td><?=++$start?></td>
	         				<td><?=$data->nama?></td>
	         				<td><?=$data->daya?>w / <?=$data->nomor_kwh?></td>	  
                  			<td><?=$data->alamat?></td>        					         				
	         				<td>                    
	         					<button style="float: left;margin-right: 1%" data-toggle="modal" data-target="#modal-add" class="btn btn-info" onclick="add_penggunaan('<?=$data->id_user?>')"><span class="fa fa-plus"></span></button>
	         					<form action="<?=base_url('penggunaan/detail')?>" method="get">
	         						<input type="hidden" name="id_user" value="<?=$data->id_user?>">
	         						<button type="submit" class="btn btn-primary"><span class="fa fa-eye"></span></button>
	         					<?=form_close()?>
	         				</td>
	         			</tr>         			
	         			<?php endforeach ?>
	         		</thead>
	         	</table>
	         	<?=$pagination?>
            </div>
          </div>
	</div>
</div>
<div class="modal fade" id="modal-add" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Modal Tambah Penggunaan</h4>
            </div>
            <div class="modal-body">
                <?=form_open(base_url('penggunaan/validate'),array('id'=>'form'))?>
              <div class="box-body">
                <div class="form-group">
                  <label>Meteran Awal</label>
                  <input type="number" class="form-control" id="meteran_awal" name="meteran_awal" placeholder="Meteran Awal">
                  <span class="help-block"></span>
                </div>     
                <div class="form-group">
                  <label>Meteran Akhir</label>
                  <input type="number" class="form-control" id="meteran_akhir" name="meteran_akhir" placeholder="Meteran Akhir">
                  <span class="help-block"></span>
                </div>             
                <div class="form-group">
                	<label>Bulan</label>
                	<select class="form-control" name="bulan" id="bulan">
                		<option value="" style="display: none;">Pilih Bulan</option>
                		<?php foreach ($dataBulan as $data): ?>
                		<option value="<?=$data['id']?>"><?=$data['bulan']?></option>
                		<?php endforeach ?>
                	</select>
                	<span class="help-block"></span>
                </div>
                <div class="form-group">
                  <label>Tahun</label>
                  <select class="form-control" name="tahun" id="tahun">
                    <option value="" style="display:none">Pilih Tahun</option>
                   	<?php 
	                	for($i=0;$i<count($dataTahun);$i++){
	                		echo "<option value='".$dataTahun[$i]."'>".$dataTahun[$i]."</option>";
	                  	}
                   	 ?>
                  </select>                 
                  <span class="help-block"></span>
                </div>              
              </div>
              <!-- /.box-body -->
              <input type="hidden" name="id_user" id="id_user">
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
<?php
	$this->load->view('layout/footer');
	$this->load->view('layout/validation');
?>
<script type="text/javascript">
	function add_penggunaan(id) {
    	$('#id_user').val(id);
  	}
</script>
<?php
	$this->load->view('layout/header');
?>
<div class="row">
	<div class="col-md-4">		
        <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Form <?=$header_small?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?=form_open(base_url('pelanggan/validate'),array('id'=>'form'))?>
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
                  <input type="number" class="form-control" id="nomor_kwh" name="nomor_kwh" placeholder="No Meter">
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

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            <?=form_close()?>
        </div>
	</div>
	<div class="col-md-8">		
        <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Tabel <?=$header_small?></h3>
            </div>
            <div class="box-body">
	         	<table class="table table-bordered">
	         		<thead>
	         			<tr>
	         				<td>No</td><td>Nama</td><td>Daya / No Meter</td><td>Alamat</td><td>Status</td><td>Aksi</td>
	         			</tr>
	         			<?php foreach ($dataAll as $data): ?>         			         		
	         			<tr>
	         				<td><?=++$start?></td>
	         				<td><?=$data->nama?></td>
	         				<td><?=$data->daya?>w / <?=$data->nomor_kwh?></td>	  
                  <td><?=$data->alamat?></td>        				
	         				<td>
                    <?=$status[$data->status]?>&nbsp;                    
                      <button data-toggle="modal" data-target="#modal-status" class="btn btn-primary" onclick="
                    status('<?=$data->id_user?>')"><span class="fa fa-edit"></span></button>                   
                  </td>
	         				<td>                    
	         					<button style="float: left;margin-right: 1%" data-toggle="modal" data-target="#modal-edit" class="btn btn-primary" onclick="
	         					edit('<?=$data->id_user?>','<?=$data->nama?>','<?=$data->username?>','<?=$data->password?>','<?=$data->alamat?>','<?=$data->id_tarif?>','<?=$data->nomor_kwh?>')"><span class="fa fa-edit"></span></button>
	         					<?=form_open(base_url('pelanggan/delete'),'')?>
	         					<input type="hidden" name="id_user" value="<?=$data->id_user?>">
	         					<button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ?')"><span class="fa fa-trash"></span></button>
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
<div class="modal fade" id="modal-edit" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Modal Edit</h4>
            </div>
            <div class="modal-body">
                <?=form_open(base_url('pelanggan/validate'),array('id'=>'form-edit'))?>
              <div class="box-body">
              	<div class="form-group">
                  <label>Nama</label>
                  <input type="text" class="form-control" id="edit-nama" name="nama" placeholder="Nama">
                  <span class="help-block"></span>
                </div>
                <div class="form-group">
                  <label>Username</label>
                  <input type="text" class="form-control" id="edit-username" name="username" placeholder="Username">
                  <span class="help-block"></span>
                </div>              
                <div class="form-group">
                  <label>Nomor meter</label>
                  <input type="text" class="form-control" id="edit-nomor_kwh" name="nomor_kwh" placeholder="No Meter">
                  <span class="help-block"></span>
                </div> 
                 <div class="form-group">
                  <label>Alamat</label>
                  <textarea class="form-control" id="edit-alamat" name="alamat" placeholder="Alamat"></textarea>
                  <span class="help-block"></span>
                </div> 
                <div class="form-group">
                  <label>Daya</label>
                  <select class="form-control" name="id_tarif" id="edit-id_tarif">
                    <option value="" style="display:none">Pilih Level</option>
                    <?php foreach ($dataTarif as $data): ?>
                      <option value="<?=$data->id_tarif?>"><?=$data->daya?></option>
                    <?php endforeach ?>
                  </select>                 
                  <span class="help-block"></span>
                </div>              
              </div>
              <!-- /.box-body -->
              <input type="hidden" name="id_user" id="edit-id_user">
              <input type="hidden" name="password" id="edit-password">
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
<div class="modal fade" id="modal-status" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Modal Edit Status</h4>
            </div>
            <div class="modal-body">
              <?=form_open(base_url('pelanggan/validate'))?>
              <div class="box-body">              
                <div class="form-group">
                  <label>Status</label>
                  <select class="form-control" name="ganti_status" required="">
                    <option value="" style="display:none">Pilih Status</option>
                    <option value="0">Tidak Aktif</option>
                    <option value="1">Aktif</option>
                  </select>                 
                  <span class="help-block"></span>
                </div>              
              </div>
              <!-- /.box-body -->
              <input type="hidden" name="id_user" id="status-id_user">
              <input type="hidden" name="ganti_status_submit" value="mmm">
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
	function edit(id,nama,username,password,alamat,id_tarif, nomor_kwh) {		
		$('#edit-id_user').val(id);
		$('#edit-nama').val(nama);
		$('#edit-username').val(username);
		$('#edit-password').val(password);
    $('#edit-alamat').val(alamat);
		$('#edit-id_tarif').val(id_tarif);
    $('#edit-nomor_kwh').val(nomor_kwh);
	}
  function status(id) {
    $('#status-id_user').val(id);
  }
</script>
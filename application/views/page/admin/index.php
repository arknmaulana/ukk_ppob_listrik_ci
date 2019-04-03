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
            <?=form_open(base_url('admin/validate'),array('id'=>'form'))?>
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
                  <label>Level</label>
                  <select class="form-control" name="level" id="level">
                  	<option value="" style="display:none">Pilih Level</option>
                  	<option value="1">Admin</option>
                  	<option value="2">Pimpinan</option>
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
	         				<td>No</td><td>Nama</td><td>Username</td><td>Level</td><td>Status</td><td>Aksi</td>
	         			</tr>
	         			<?php foreach ($dataAll as $data): ?>         			         		
	         			<tr>
	         				<td><?=++$start?></td>
	         				<td><?=$data->nama?></td>
	         				<td><?=$data->username?></td>
	         				<td><?=$level[$data->level]?></td>
	         				<td><?=$status[$data->status]?>&nbsp;                    
                      <button data-toggle="modal" data-target="#modal-status" class="btn btn-primary" onclick="
                    status('<?=$data->id_user?>')"><span class="fa fa-edit"></span></button>  
                  </td>
	         				<td>
	         					<button style="float: left;margin-right: 1%" data-toggle="modal" data-target="#modal-edit" class="btn btn-primary" onclick="
	         					edit('<?=$data->id_user?>','<?=$data->nama?>','<?=$data->username?>','<?=$data->password?>','<?=$data->level?>')"><span class="fa fa-edit"></span></button>
	         					<?=form_open(base_url('admin/delete'),'')?>
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
                <?=form_open(base_url('admin/validate'),array('id'=>'form-edit'))?>
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
                  <input type="hidden" class="form-control" id="edit-password" name="password" placeholder="Password">                 
                <div class="form-group">
                  <label>Level</label>
                  <select class="form-control" name="level" id="edit-level">
                  	<option value="" style="display: none">Pilih Level</option>
                  	<option value="1">Admin</option>
                  	<option value="2">Pimpinan</option>
                  </select>                 
                  <span class="help-block"></span>
                </div>              
              </div>
              <!-- /.box-body -->
              <input type="hidden" name="id_user" id="edit-id_user">
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
              <?=form_open(base_url('admin/validate'))?>
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
	function edit(id, nama, username, password, level) {		
		$('#edit-id_user').val(id);
		$('#edit-nama').val(nama);
		$('#edit-username').val(username);
		$('#edit-password').val(password);
		$('#edit-level').val(level);
	}
   function status(id) {
    $('#status-id_user').val(id);
  }
</script>
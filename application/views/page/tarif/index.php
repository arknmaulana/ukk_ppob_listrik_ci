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
            <?=form_open(base_url('tarif/validate'),array('id'=>'form'))?>
              <div class="box-body">
                <div class="form-group">
                  <label>Daya</label>
                  <input type="text" class="form-control" id="daya" name="daya" placeholder="Daya">
                  <span class="help-block"></span>
                </div>
                 <div class="form-group">
                  <label>Per / KWH</label>
                  <input type="number" class="form-control" id="perkwh" name="perkwh" placeholder="Per / KWH">
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
	         				<td>No</td><td>Daya</td><td>Per/KWH</td><td>Aksi</td>
	         			</tr>
	         			<?php foreach ($dataAll as $data): ?>         			         		
	         			<tr>
	         				<td><?=++$start?></td>
	         				<td><?=$data->daya?></td>
	         				<td>Rp <?=$data->perkwh?></td>
	         				<td>
	         					<button style="float: left;margin-right: 1%" data-toggle="modal" data-target="#modal-edit" class="btn btn-primary" onclick="
	         					edit('<?=$data->id_tarif?>','<?=$data->daya?>','<?=$data->perkwh?>')"><span class="fa fa-edit"></span></button>
	         					<?=form_open(base_url('tarif/delete'),'')?>
	         					<input type="hidden" name="id_tarif" value="<?=$data->id_tarif?>">
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
                <?=form_open(base_url('tarif/validate'),array('id'=>'form-edit'))?>
	              <div class="box-body">
	                <div class="form-group">
	                  <label>Daya</label>
	                  <input type="text" class="form-control" id="edit-daya" name="daya" placeholder="Daya">
	                  <span class="help-block"></span>
	                </div>
	                 <div class="form-group">
	                  <label>Per / KWH</label>
	                  <input type="number" class="form-control" id="edit-perkwh" name="perkwh" placeholder="Per / KWH">
	                  <span class="help-block"></span>
	                </div>               
	              </div>
	              <!-- /.box-body -->
	              <input type="hidden" name="id_tarif" id="edit-id_tarif">
	              <div class="box-footer">
	                <button type="submit" style="float: left;" class="btn btn-primary">Submit</button>&nbsp;
	                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
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
	function edit(id, daya, perkwh) {		
		$('#edit-id_tarif').val(id);
		$('#edit-daya').val(daya);
		$('#edit-perkwh').val(perkwh);
	}
</script>
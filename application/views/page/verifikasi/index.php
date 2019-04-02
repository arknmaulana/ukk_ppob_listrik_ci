<?php
	$this->load->view('layout/header');
?>
<div class="box box-warning">	
	<div class="box-body">
		<?php if (!$dataAll): ?>
			<center>
				Tidak ada data
			</center>
		<?php else: ?>
		<table class="table table-bordered">
			<thead>
				<tr>
					<td>No</td><td>Nama Pelanggan</td><td>No Meter</td><td>Tanggal Bayar</td><td>Jumlah Tagihan</td><td>Aksi</td>
				</tr>
				<?php foreach ($dataAll as $data): ?>
				<?php 
					$data_pembayaran = $this->db->where('id_penggunaan', $data->id_penggunaan)
												->order_by('id_pembayaran','desc')->get('pembayaran')->row();
				?>		         		
					<tr>
						<td><?=++$start?></td>
						<td><?=$data->nama?></td>
						<td><?=$data->nomor_kwh?></td>	
						<td>Rp <?=$data->total_bayar?></td>  
						<td><?=$data_pembayaran->tgl_bayar?></td>
						<td>
							<button data-toggle="modal" data-target="#modal-ubah" onclick="ubah('<?=$data->id_penggunaan?>','<?=$data_pembayaran->bukti_pembayaran?>')" class="fa fa-edit btn btn-primary"></button>
						</td>
					</tr>         			
				<?php endforeach ?>
			</thead>
		</table>
		<?=$pagination?>
		<?php endif ?>
	</div>
</div>
<div class="modal fade" id="modal-ubah" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Validasi</h4>
            </div>
            <div class="modal-body">
            	<img src="" id="gambar">
               	<?=form_open(base_url('index.php/verifikasi/validate'),array('id'=>'form'))?>
	              <div class="box-body">
	                <div class="form-group">
	                  <label>Status</label>
	                  <select class="form-control" name="status" id="status">
	                  	<option value="" style="display: none;">Pilih Status</option>
	                  	<option value="2">Lunas</option>
	                  	<option value="3">Ditolak</option>
	                  </select>
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
<?php
	$this->load->view('layout/footer');
	$this->load->view('layout/validation');
?>
<script type="text/javascript">
	var base_url = '<?=base_url('assets/upload/')?>'
	function ubah(id,gambar) {
		$('#id_penggunaan').val(id);
		$('#gambar').attr('src',base_url+gambar)
	}
</script>
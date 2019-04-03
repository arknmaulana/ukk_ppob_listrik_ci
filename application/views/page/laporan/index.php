<?php 
	$this->load->view('layout/header');
?>
<div class="row">
	<div class="col-md-6">
		<div class="box">
			<div class="box-body">
				<!-- <?=form_open(base_url('laporan/detail'))?> -->
				<div class="form-group">
					<label>Jenis Laporan</label>
					<select name="jenis_laporan" class="form-control" id="jenis_laporan"> 
						<option style="display: none;" value="">Pilih Jenis Laporan</option>
						<option value="1">Lunas</option>
						<option value="2">Semua</option>
					</select>
				</div>
				<div class="form-group">
					<a href="<?=base_url('laporan/detail')?>" type="submit" class="btn btn-primary">Submit</a>
				</div>
				<!-- <?=form_close()?> -->
			</div>
		</div>
	</div>
</div>

<?php 
	$this->load->view('layout/footer');
	$this->load->view('layout/validation');
?>
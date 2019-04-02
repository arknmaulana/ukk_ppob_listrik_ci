<div class="modal modal-success fade in" id="modal-success" style="display: none; padding-right: 17px;">
	<div class="modal-dialog" style="top: 30%">
		<div class="modal-content">
			<div class="modal-header">				
			</div>
			<div class="modal-body">
				<center>
					<span class="fa fa-check-circle" style="font-size: 80px"></span>				
					<h3 class="modal-tittle">Berhasil</h3>
					<h4 class="modal-tittle" id="modal-success-message"></h4>
				</center>
			</div>		
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<div class="modal modal-danger fade in" id="modal-error" style="display: none; padding-right: 17px;">
	<div class="modal-dialog" style="top: 30%">
		<div class="modal-content">
			<div class="modal-header">				
			</div>
			<div class="modal-body">
				<center>
					<span class="fa fa-warning" style="font-size: 80px"></span>				
					<h3 class="modal-tittle">Gagal</h3>
					<h4 class="modal-tittle" id="modal-error-message"></h4>
				</center>
			</div>		
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<div class="modal modal-success fade in" id="modal-login" style="display: none; padding-right: 17px;">
	<div class="modal-dialog" style="top: 30%">
		<div class="modal-content">
			<div class="modal-header">				
			</div>
			<div class="modal-body">
				<center>
					<span class="fa fa-check-circle" style="font-size: 80px"></span>				
					<h3 class="modal-tittle">Berhasil</h3>
					<h4 class="modal-tittle" id="modal-login-message"></h4>
				</center>
			</div>		
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<?php if ($this->session->flashdata()>0): ?>
	<?php if ($this->session->flashdata('success')): ?>
		<script type="text/javascript">
			$('#modal-success').show(400).delay(2500).hide(400);
			$('#modal-success-message').html('<?=$this->session->flashdata("success")?>')
		</script>
	<?php endif ?>
	<?php if ($this->session->flashdata('error')): ?>
		<script type="text/javascript">
			$('#modal-error').show(400).delay(2500).hide(400);
			$('#modal-error-message').html('<?=$this->session->flashdata("error")?>')
		</script>
	<?php endif ?>
<?php endif ?>
<script type="text/javascript">
	var base_url = "<?=base_url()?>";
</script>
<script type="text/javascript" src="<?=base_url('assets')?>/irfanValidation.js"></script>
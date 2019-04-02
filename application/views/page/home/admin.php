<?php 
	$this->load->view('layout/header');
?>
<div class="row">
	<div class="col-md-5">
		<div class="box">
			<div class="box-body">
				<table class="table table-bordered" style="    border: 2px solid #999;">
					<tr>
						<th>Fitur</th><th>Admin</th><th>Pimpinan</th><th>Pelanggan</th>
					</tr>
					<tr>
						<td>Register</td><td>O</td><td>O</td><td>X</td>
					</tr>
					<tr>
						<td>Login & Logout</td><td>X</td><td>X</td><td>X</td>
					</tr>					
					<tr>
						<td>Ubah status user</td><td>X</td><td>-</td><td>-</td>
					</tr>
					<tr>
						<td>CRUD Pelanggan</td><td>X</td><td>-</td><td>-</td>
					</tr>
					<tr>
						<td>CRUD Admin</td><td>X</td><td>-</td><td>-</td>
					</tr>
					<tr>
						<td>CRUD Tarif</td><td>X</td><td>-</td><td>-</td>
					</tr>
					<tr>
						<td>Tambah Penggunaan</td><td>X</td><td>-</td><td>-</td>
					</tr>
					<tr>
						<td>Verifikasi Pembayaran</td><td>X</td><td>-</td><td>-</td>
					</tr>
					<tr>
						<td>Upload Bukti Pembayaran</td><td>-</td><td>X</td><td>-</td>
					</tr>
					<tr>
						<td>Generate Laporan</td><td>X</td><td>-</td><td>X</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
<?php 
	$this->load->view('layout/footer');
?>
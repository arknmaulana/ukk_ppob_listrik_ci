<?php
	$this->load->view('layout/header');
?>
<div class="row">	
	<div class="col-md-12">		
        <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Daftar</h3>
            </div>
            <div class="box-body">
	         	<table class="table table-bordered">
	         		<thead>
	         			<tr>
	         				<td>No</td><td>Bulan</td><td>Tahun</td><td>Meteran Awal /Meteran Akhir</td><td>Total Meteran</td><td>Total Bayar</td><td>Biaya Admin</td>
	         			</tr>
	         			<?php $start = 0;foreach ($dataAll as $data): ?>  		         		
	         			<tr>
	         				<td><?=++$start?></td>
	         				<td><?=$dataBulan[$data->bulan]?></td>
	         				<td><?=$dataTahun[$data->tahun]?></td>
	         				<td><?=$data->meteran_awal?> kwh /<?=$data->meteran_akhir?> kwh</td>	  
                  			<td><?=$data->meteran_akhir-$data->meteran_awal?> kwh</td>
                  			<td>Rp <?=$data->biaya_admin?></td>      					         					
                  			<td>Rp <?=$data->total_bayar?></td>                  			         				
	         			</tr>         			
	         			<?php endforeach ?>
	         		</thead>
	         	</table>
            </div>
          </div>
	</div>
</div>
<?php
	$this->load->view('layout/footer');
	$this->load->view('layout/validation');
?>
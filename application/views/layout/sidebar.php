 <!-- sidebar menu: : style can be found in sidebar.less -->
 <ul class="sidebar-menu" data-widget="tree">
 	<?php 
 		$hal = $this->uri->segment(1);
 	?>
 	<!-- <li class="header">DASHBOARD</li>    
 	<li class="<?php if($hal=='home') echo'active'?>"><a href="<?=base_url('home')?>"><i class="fa fa-dashboard"></i> <span>Home</span></a></li> -->
 	<?php if ($this->session->userdata('user_level')==1): ?>
 		<li class="header">CRUD</li>        
	 	<li class="<?php if($hal=='pelanggan') echo'active'?>">
	 		<a href="<?=base_url('pelanggan')?>"><i class="fa fa-users"></i> <span>Pelanggan</span></a>
	 	</li>
	 	<li class="<?php if($hal=='admin') echo'active'?>">
	 		<a href="<?=base_url('admin')?>"><i class="fa fa-user"></i> <span>Admin</span></a>
	 	</li>
	 	<li class="<?php if($hal=='tarif') echo'active'?>">
	 		<a href="<?=base_url('tarif')?>"><i class="fa fa-money"></i> <span>Tarif</span></a>
	 	</li>
	 	<li class="header">MENU</li>  
	 	<li class="<?php if($hal=='penggunaan') echo'active'?>">
	 		<a href="<?=base_url('penggunaan')?>"><i class="fa fa-money"></i> <span>Penggunaan</span></a>
	 	</li>
	 	<li class="<?php if($hal=='verifikasi') echo'active'?>">
	 		<a href="<?=base_url('verifikasi')?>"><i class="fa fa-check"></i> <span>Verifikasi</span></a>
	 	</li>
 	<?php endif ?>
 	<li class="<?php if($hal=='laporan') echo'active'?>">
 		<a href="<?=base_url('laporan')?>"><i class="fa fa-print"></i> <span>Laporan</span></a>
 	</li>
 </ul>
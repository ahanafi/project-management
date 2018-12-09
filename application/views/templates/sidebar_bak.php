<?php
$devisi = $this->session->userdata('devisi');
$array_dev = array("Engineering", "PPIC", "Produksi", "QC");
?>
<div class="col-md-2">
	<div class="row">
		<div class="col-xs-6 col-md-12">
			<a class="thumbnail" style="border:1px solid #158cba;">
				<img class="img-responsive" src="<?php echo base_url('images/logos.png'); ?>">
			</a>
		</div>
	</div>
	<div class="row"></div>
	<ul class="nav nav-pills nav-stacked">
		<li class="active" role="presentation">
			<a href="<?php echo base_url('dashboard'); ?>"><i class="glyphicon glyphicon-home"></i>  Dashboard</a>
		</li>
		<li role="presentation">
			<a href="<?php echo base_url('dashboard/master'); ?>"><i class="fa fa-briefcase"></i>  Data Master</a>
		</li>
		<?php if(in_array($devisi, $array_dev)) : ?>
			<li role="presentation" class="dropdown">
		    	<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
		    	<i class="fa fa-list"></i>
		      Data Project <span class="caret"></span>
		    	</a>
		    	<ul class="dropdown-menu">
		    		<li><a href="<?php echo base_url('material/devisi/ppic'); ?>">PPIC</a></li>
		    		<li><a href="<?php echo base_url('material/devisi/engineering'); ?>">Engineering</a></li>
		    		<li><a href="<?php echo base_url('material/devisi/produksi'); ?>">Produksi</a></li>
		    		<li><a href="<?php echo base_url('material/devisi/qc'); ?>">QC</a></li>
		    		<li><a href="<?php echo base_url('material/devisi/gudang'); ?>">Gudang</a></li>
		    	</ul>
		  	</li>
		<?php else : ?>
		<li role="presentation">
			<a href="<?php echo base_url('dashboard/project'); ?>"><i class="fa fa-list"></i>  Data Project</a>
		</li>
		<?php endif;?>
		<?php
			if ($devisi == "Marketing") :
		?>
		<li role="presentation">
			<a href="<?php echo base_url('dashboard/graphic_sale'); ?>"><i class="fa fa-bar-chart"></i>  Grafik Penjualan</a>
		</li>
		<?php
			elseif (in_array($devisi, $array_dev)) :
		?>
		<li role="presentation">
			<a href="<?php echo base_url('design'); ?>"><i class="fa fa-picture-o"></i>  Data Desain</a>
		</li>
		<li role="presentation">
			<a href="<?php echo base_url('dashboard/revise'); ?>"><i class="fa fa-refresh"></i>  Data Revisi</a>
		</li>
		<li role="presentation">
			<a href="<?php echo base_url('dashboard/request_material'); ?>"><i class="fa fa-exchange"></i>  Pesan Material</a>
		</li>
		<?php
			elseif($devisi == "Gudang") :
		?>
		<li role="presentation">
			<a href="<?php echo base_url('dashboard/rack'); ?>"><i class="fa fa-list"></i>  Data Rak</a>
		</li>
		<li role="presentation">
			<a href="<?php echo base_url('dashboard/requests'); ?>"><i class="fa fa-refresh"></i>  Permintaan</a>
		</li>
		<?php
			endif;
		?>
		<li role="presentation">
			<a href="<?php echo base_url('customer'); ?>"><i class="fa fa-users"></i>  Data Customer</a>
		</li>
		<li role="presentation">
			<a href="<?php echo base_url('material'); ?>"><i class="fa fa-bookmark"></i>  Data Material</a>
		</li>
		<li role="presentation">
			<a href="#" class="btn-logout"><i class="fa fa-power-off"></i>  Logout</a>
		</li>
	</ul>
</div>
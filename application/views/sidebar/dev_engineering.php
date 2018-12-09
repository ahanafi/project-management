<li class="active" role="presentation">
	<a href="<?php echo base_url('dashboard'); ?>"><i class="glyphicon glyphicon-home"></i>  Dashboard</a>
</li>
<li role="presentation">
	<a href="<?php echo base_url('dashboard/master'); ?>"><i class="fa fa-briefcase"></i>  Data Master</a>
</li>
<li role="presentation" class="dropdown">
	<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
	<i class="fa fa-list"></i>
  Data Project || Devisi <span class="caret"></span>
	</a>
	<ul class="dropdown-menu">
		<li><a href="<?php echo base_url('project/devisi/produksi'); ?>">Produksi</a></li>
		<li><a href="<?php echo base_url('project/devisi/ppic'); ?>">PPIC</a></li>
		<li><a href="<?php echo base_url('project/devisi/qc'); ?>">QC</a></li>		
	</ul>
</li>
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
<li role="presentation">
	<a href="<?php echo base_url('design'); ?>"><i class="fa fa-picture-o"></i>  Data Desain</a>
</li>
<li role="presentation">
	<a href="<?php echo base_url('dashboard/revise'); ?>"><i class="fa fa-refresh"></i>  Data Revisi</a>
</li>
<li role="presentation">
	<a href="<?php echo base_url('dashboard/request_material'); ?>"><i class="fa fa-exchange"></i>  Pesan Material</a>
</li>
<li role="presentation">
	<a href="<?php echo base_url('customer'); ?>"><i class="fa fa-users"></i>  Data Customer</a>
</li>
<li role="presentation">
	<a href="<?php echo base_url('material'); ?>"><i class="fa fa-bookmark"></i>  Data Material</a>
</li>
<li role="presentation">
	<a href="#" class="btn-logout"><i class="fa fa-power-off"></i>  Logout</a>
</li>
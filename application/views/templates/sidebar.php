<?php
$devisi = $this->session->userdata('devisi');
$array_dev = array("Marketing", "Engineering", "Gudang", "PPIC", "Produksi", "QC");
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
	<?php
		if (in_array($devisi, $array_dev)) {
			$dev = strtolower($devisi);
			$this->load->view('sidebar/dev_'.$dev);
		} else {
			echo "MENU ERROR!";
		}
	?>
	</ul>
</div>
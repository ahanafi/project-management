<div class="col-md-10">
	<h3>EDIT DATA RAK</h3>
	<div class="panel panel-primary">
		<div class="panel-heading">
			Form Edit Rak
		</div>
		<div class="panel-body">
			<form action="<?php echo base_url('rack/update/'.$rack->id); ?>" method="post" class="form-group">
				<label for="nama_rak">Nama Rak</label>
				<input type="text" name="nama_rak" class="form-control" required autofocus placeholder="Nama Rak" autocomplete="off" value="<?php echo $rack->nama_rak; ?>">
				<?php echo form_error('nama_rak'); ?>
				<br>

				<input type="submit" name="update" class="btn btn-primary" value="Simpan">
				<input type="reset" name="reset" class="btn btn-default" value="Reset">
			</form>
		</div>
	</div>
</div>
<div class="col-md-10">
	<h3>DATA MATERIAL</h3>
	<div class="panel panel-primary">
		<div class="panel-heading">
			Edit Data Material
		</div>
		<div class="panel-body" id="main-content">
			<form action="<?php echo base_url('Material/update/'.$mat->id); ?>" class="form-group" method="post">
				<label for="nama">Nama Material</label>
				<input type="text" name="nama" class="form-control" placeholder="Nama Material" value="<?php echo $mat->nama; ?>">
				<?php echo form_error('nama'); ?>
				<br>

				<label for="spesifikasi">Spesifikasi Material</label>
				<textarea name="spesifikasi" rows="3" class="form-control" placeholder="Spesifikasi"><?php echo $mat->spesifikasi; ?></textarea>
				<?php echo form_error('spesifikasi'); ?>
				<br>
				<input type="hidden" name="devisi" class="form-control" value="<?php echo $mat->devisi; ?>">
				<br>

				<input type="submit" name="save" class="btn btn-primary" value="Simpan">
				<input type="reset" name="reset" class="btn btn-default" value="Reset">
			</form>
		</div>
	</div>
</div>
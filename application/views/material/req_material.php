<div class="col-md-10">
	<h3>PESAN MATERIAL</h3>
	<div class="panel panel-primary">
		<div class="panel-heading">
			Form pemesanan material
		</div>
		<div class="panel-body">
			<form action="<?php echo base_url('material/send_request'); ?>" method="post" class="form-group">
				<label for="nama">Nama Material</label>
				<input type="text" name="nama" class="form-control" placeholder="Nama Material" required>
				<?php echo form_error('nama'); ?>
				<br>

				<label for="type">Tipe Material</label>
				<input type="text" name="type" class="form-control" placeholder="Type material" required>
				<?php echo form_error('type'); ?>
				<br>

				<label for="keterangan">Keterangan</label>
				<textarea name="keterangan" rows="4" class="form-control" placeholder="Keterangan"></textarea>
				<?php echo form_error('keterangan'); ?>
				<br>
				
				<input type="submit" name="submit" class="btn btn-primary" value="Pesan Sekarang">
				<input type="reset" name="reset" class="btn btn-deafult" value="Reset">
			</form>
		</div>
	</div>
</div>
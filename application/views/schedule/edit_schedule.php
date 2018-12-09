<div class="col-md-10">
	<h3>EDIT DATA SCHEDULE</h3>
	<div class="panel panel-primary">
		<div class="panel-heading">
			Form Edit Schedule
		</div>
		<div class="panel-body">
			<form action="<?php echo base_url('schedule/edit/'.$sc->id); ?>" method="post" class="form-group">
				<div class="row">
					<div class="col-md-6">
						<label for="no">No. Project</label>
						<input type="text" name="no" class="form-control" placeholder="No. Project" value="<?php echo $sc->no; ?>">
						<?php echo form_error('no'); ?>
						<br>

						<label for="spesifikasi">Spesifikasi</label>
						<textarea name="spesifikasi" rows="3" class="form-control" placeholder="Spesifikasi"><?php echo $sc->spesifikasi; ?></textarea>
						<?php echo form_error('spesifikasi'); ?>
						<br>

						<label for="tanggal_mulai">Tanggal mulai</label>
						<input type="text" name="tanggal_mulai" class="form-control datepicker" placeholder="Tanggal mulai" value="<?php echo str_replace("-", "/", $sc->tanggal_mulai); ?>">
						<?php echo form_error('tanggal_mulai'); ?>
						<br>
					</div>
					<div class="col-md-6">
						<label for="tanggal_selesai">Tanggal selesai</label>
						<input type="text" name="tanggal_selesai" class="form-control datepicker" placeholder="Tanggal Selesai" value="<?php echo str_replace("-", "/", $sc->tanggal_selesai); ?>">
						<?php echo form_error('tanggal_selesai'); ?>
						<br>

						<label for="deltime">Deltime</label>
						<input type="text" name="deltime" class="form-control datepicker" placeholder="Deltime" value="<?php echo str_replace("-", "/", $sc->deltime); ?>">
						<?php echo form_error('deltime'); ?>
						<br>

						<input type="submit" name="update" class="btn btn-primary" value="Simpan">
						<input type="reset" name="reset" class="btn btn-default" value="Reset">
					</div>
				</div>

			</form>
		</div>
	</div>
</div>
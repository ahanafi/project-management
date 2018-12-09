<?php $uri = $this->uri->segment(3); ?>
<div class="col-md-10">
	<h3>DATA PROJECT</h3>
	<div class="panel panel-primary">
		<div class="panel-heading">
			Edit Data Project
		</div>
		<div class="panel-body">
			<form action="<?php echo base_url('project/dev_update/'.$uri.'/'.$p->id); ?>" method="post" class="form-group">
				<div class="col-md-6">
					<label for="no">No. Project</label>
					<input type="text" name="no" class="form-control" placeholder="Nomor Project" required value="<?php echo $p->no; ?>">
					<?php echo form_error('no'); ?>
					<br>

					<label for="spesifikasi">Spesifikasi</label>
					<textarea name="spesifikasi" class="form-control" rows="3" placeholder="Spesifikasi Project" style="resize: none;" required><?php echo $p->spesifikasi; ?></textarea>
					<?php echo form_error('spesifikasi'); ?>
					<br>

					<label for="tanggal_terima">Tangal terima</label>
					<input type="text" name="tanggal_terima" class="form-control datepicker" placeholder="Tangal terima" required value="<?php echo str_replace("-", "/", $p->tanggal_terima); ?>">
					<?php echo form_error('tanggal_terima'); ?>
					<br>
				</div>
				<div class="col-md-6">
					<label for="deltime">Deltime</label>
					<input type="text" name="deltime" class="form-control datepicker" placeholder="Deltime" required value="<?php echo str_replace("-", "/", $p->deltime); ?>">
					<?php echo form_error('deltime'); ?>
					<br>

					<label for="keterangan">Keterangan</label>
					<textarea name="keterangan" rows="3" class="form-control"><?php echo $p->keterangan; ?></textarea>
					<br>

					<input type="submit" name="update" value="Simpan" class="btn btn-primary"> 
					<a href="<?php echo base_url('project/devisi'); ?>" class="btn btn-default">Kembali</a>
				</div>
			</form>
		</div>
	</div>
</div>
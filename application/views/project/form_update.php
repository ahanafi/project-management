<div class="col-md-10">
	<h3>DATA PROJECT</h3>
	<div class="panel panel-primary">
		<div class="panel-heading">
			Edit Data Project
		</div>
		<div class="panel-body">
			<form action="<?php echo base_url('project/update/'.$p->id); ?>" method="post" class="form-group">
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

					<label for="deltime">Deltime</label>
					<input type="text" name="deltime" class="form-control datepicker" placeholder="Deltime" required value="<?php echo str_replace("-", "/", $p->deltime); ?>">
					<?php echo form_error('deltime'); ?>
					<br>
				</div>
				<div class="col-md-6">
					<label for="qty">Quantity</label>
					<input type="number" name="qty" class="form-control" placeholder="Quantity" required value="<?php echo $p->qty; ?>">
					<?php echo form_error('qty'); ?>
					<br>

					<label for="cutomer">Customer</label>
					<input type="text" name="customer" class="form-control" placeholder="Nama customer" required value="<?php echo $p->customer; ?>">
					<?php echo form_error('customer'); ?>
					<br>

					<label for="status">Status</label>
					<select name="status" class="form-control" required>
						<option value="">-- Pilih Status --</option>
						<?php if($p->status == "OK"): ?>
						<option value="Proses">Proses</option>
						<option value="OK" selected>OK</option>
						<?php else :  ?>
						<option value="Proses" selected>Proses</option>
						<option value="OK">OK</option>
						<?php endif; ?>
					</select>
					<?php echo form_error('status'); ?>
					<br>
					<input type="submit" name="update" value="Simpan" class="btn btn-primary"> 
					<a href="<?php echo base_url('dashboard'); ?>" class="btn btn-default">Kembali</a>
				</div>
			</form>
		</div>
	</div>
</div>
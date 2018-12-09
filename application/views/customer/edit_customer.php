<div class="col-md-10">
	<h3>DATA CUSTOMER</h3>
	<div class="panel panel-primary">
		<div class="panel-heading">
			Edit Data Customer
		</div>
		<div class="panel-body" id="main-content">
			<form action="<?php echo base_url('customer/update/'.$cust->id); ?>" class="form-group" method="post">
				<label for="nama">Nama Customer</label>
				<input type="text" name="nama" class="form-control" placeholder="Nama Customer" value="<?php echo $cust->nama; ?>">
				<?php echo form_error('nama'); ?>
				<br>

				<label for="telp">No. Telp</label>
				<input type="number" name="telp" class="form-control" placeholder="No. Telp" value="<?php echo $cust->telp; ?>">
				<?php echo form_error('telp'); ?>
				<br>

				<label for="alamat">Alamat</label>
				<textarea name="alamat" rows="3" class="form-control"><?php echo $cust->alamat; ?></textarea>
				<?php echo form_error('alamat'); ?>
				<br>

				<input type="submit" name="save" class="btn btn-primary" value="Simpan">
				<input type="reset" name="reset" class="btn btn-default" value="Reset">
			</form>
		</div>
	</div>
</div>
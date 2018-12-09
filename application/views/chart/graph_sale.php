<div class="col-md-10">
	<h3>GRAFIK PENJUALAN</h3>
	<div class="panel panel-primary">
		<div class="panel-heading">
			Data Penjualan
		</div>
		<div class="panel-body" style="min-height: 300px;">
			<form action="<?php echo base_url('dashboard/show_chart'); ?>" method="post" class="form-group">
				<fieldset>
					<legend>Grafik Laporan Penjualan</legend>
					<div class="row">
						<div class="col-md-5">
							<label for="tanggal_awal">Tanggal Awal</label>
							<input type="text" name="tanggal_awal" class="form-control date" placeholder="Tanggal Awal">
							<?php echo form_error('tanggal_awal'); ?>
						</div>
						<div class="col-md-5">
							<label for="tanggal_akhir">Tanggal Akhir</label>
							<input type="text" name="tanggal_akhir" class="form-control date" placeholder="Tanggal Akhir">
							<?php echo form_error('tanggal_akhir'); ?>
						</div>
						<div class="col-md-2">
							<label for="submit">&nbsp;</label>
							<input type="submit" name="submit" class="btn btn-primary btn-block" value="Tampilkan">
						</div>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</div>
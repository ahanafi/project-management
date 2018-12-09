<div class="col-md-10">
	<h3>POSISI PROJECT</h3>
	<div class="panel panel-primary">
		<div class="panel-heading">
			Form setting posisi project
		</div>
		<div class="panel-body">
			<form action="<?php echo base_url('project/set_position'); ?>" method="post" class="form-group">
				<div class="row">
					<div class="col-md-10">
						<label for="no">No. Project</label>
						<input type="text" name="no" class="form-control" value="<?php echo $p->no; ?>" disabled>
					</div>
					<div class="col-md-2">
					<label for="deails"></label>
						<button type="button" class="btn btn-primary" style="width: 100%;" data-toggle="modal" data-target="#projectDetail">
							<i class="fa fa-eye"></i> Detail Project
						</button>
					</div>
				</div>
				<br>

				<label for="customer">Customer</label>
				<input type="text" name="customer" class="form-control" value="<?php echo $p->customer; ?>" disabled>
				<br>

				<label for="posisi">Posisi</label>
				<select name="posisi" class="form-control" required>
					<option value="">-- Pilih Posisi --</option>
					<?php foreach($racks as $r): ?>
						<option value="<?php echo $r->id; ?>"><?php echo $r->nama_rak; ?></option>
					<?php endforeach; ?>
				</select>
				<?php echo form_error('posisi'); ?>
				<br>

				<input type="hidden" name="id_project" class="form-control" value="<?php echo $p->id; ?>">

				<input type="submit" name="submit" class="btn btn-primary" value="Simpan">
				<a href="<?php echo base_url('dashboard/project'); ?>" class="btn btn-default">Kembali</a>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="projectDetail" tabindex="-1" role="dialog" aria-labelledby="projectDetailLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="projectDetaillabel">Detail Project</h4>
			</div>
			<div class="modal-body">
				<table class="table">
					<tr>
						<td>No. Project</td>
						<td>:</td>
						<td><?php echo $p->no; ?></td>
					</tr>
					<tr>
						<td>Spesifikasi</td>
						<td>:</td>
						<td><?php echo $p->spesifikasi; ?></td>
					</tr>
					<tr>
						<td>Tanggal terima</td>
						<td>:</td>
						<td><?php echo $p->tanggal_terima; ?></td>
					</tr>
					<tr>
						<td>Deltime</td>
						<td>:</td>
						<td><?php echo $p->deltime; ?></td>
					</tr>
					<tr>
						<td>Quantity</td>
						<td>:</td>
						<td><?php echo $p->qty; ?></td>
					</tr>
					<tr>
						<td>Customer</td>
						<td>:</td>
						<td><?php echo $p->customer; ?></td>
					</tr>
					<tr>
						<td>Status</td>
						<td>:</td>
						<td><?php echo $p->status; ?></td>
					</tr>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>
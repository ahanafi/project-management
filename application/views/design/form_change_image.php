<div class="col-md-10">
	<h3>UBAH DESAIN PROJECT</h3>
	<div class="panel panel-primary">
		<div class="panel-heading">
			Form Upload Desain Project
		</div>
		<div class="panel-body">
			<form action="<?php echo base_url('design/change_proccess/'.$p->id); ?>" method="post" class="form-group" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-10">
					<label for="no">No. Project</label>
						<input type="text" name="no" class="form-control" value="<?php echo $p->no; ?>" placeholder="Nomor Project" disabled>
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

				<label for="design">Gambar</label>
				<input type="file" name="userfile" class="form-control" placeholder="Images">
				<?php echo form_error('keterangan'); ?>
				<br>

				<input type="hidden" name="id" class="form-control" value="<?php echo $p->id; ?>">
				<br>

				<input type="submit" name="send_revisi" class="btn btn-primary" value="Kirim">
				<a href="<?php echo base_url('design'); ?>" class="btn btn-default">Kembali</a>
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
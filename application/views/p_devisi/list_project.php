<?php
$dev = strtolower($this->session->devisi);
$uri = strtolower($this->uri->segment(3));
?>
<div class="col-md-10">
	<h3>DATA PROJECT <?php echo strtoupper($uri); ?> </h3>
	<div class="panel panel-primary">
		<div class="panel-heading">
			Daftar Data Project
		</div>
		<div class="panel-body" id="main-content">
			<div id="data-content">
				<table class="table table-bordered table-responsive table-hover" id="data">
					<thead>
						<tr>
							<th class="ctr">#</th>
							<th>No. Project</th>
							<th style="width: 200px;">Spesifikasi</th>
							<th class="ctr">Tgl. Terima</th>
							<th class="ctr">Deltime</th>
							<th class="ctr">Keterangan</th>
							<th class="ctr">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php if ($project > 0): ?>
							<?php foreach ($project as $pj): ?>
								<tr>
									<td class="ctr"><?php echo $no++; ?></td>
									<td><?php echo $pj->no; ?></td>
									<td><?php echo $pj->spesifikasi; ?></td>
									<td class="ctr"><?php echo $pj->tanggal_terima; ?></td>
									<td class="ctr"><?php echo $pj->deltime; ?></td>
									<td class="ctr"><?php echo $pj->keterangan; ?></td>
									<td class="ctr">
										<?php if ($dev == $uri): ?>
											<a href="<?php echo base_url('project/dev_edit/'.$uri.'/'.$pj->id); ?>" class="btn btn-default"><i class="fa fa-pencil"></i></a>
											<a onclick="return konfirmasi('menghapus data ini');" href="<?php echo base_url('project/dev_delete/'.$uri.'/'.$pj->id); ?>" class="btn btn-default"><i class="fa fa-trash"></i></a>
										<?php else: ?>
											<a href="#" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Anda tidak dapat mengedit data ini!" disabled><i class="fa fa-pencil"></i></a>
											<a href="#" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Anda tidak dapat menghapus data ini!" disabled><i class="fa fa-trash"></i></a>
										<?php endif ?>
									</td>
								</tr>
							<?php endforeach ?>
						<?php endif ?>
					</tbody>
				</table>
				<div class="row">
					<div class="col-md-6">
						<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addProject">New Project</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="addProject" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="addProjectlabel">Add New Project</h4>
			</div>
			<form action="<?php echo base_url('project/dev_insert'); ?>" method="post" class="form-group">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<label for="no">No. Project</label>
						<input type="text" name="no" class="form-control" placeholder="Nomor Project" autofocus required>
						<?php echo form_error('no'); ?>
						<br>

						<label for="spesifikasi">Spesifikasi</label>
						<textarea name="spesifikasi" class="form-control" rows="4" placeholder="Spesifikasi Project" style="resize: none;" required></textarea>
						<?php echo form_error('spesifikasi'); ?>
						<br>

						<label for="tanggal_terima">Tangal terima</label>
						<input type="text" name="tanggal_terima" class="form-control datepicker" placeholder="Tangal terima" required>
						<?php echo form_error('tanggal_terima'); ?>
					</div>
					<div class="col-md-6">
						<label for="deltime">Deltime</label>
						<input type="text" name="deltime" class="form-control datepicker" placeholder="Deltime" required>
						<?php echo form_error('deltime'); ?>
						<br>
						<label for="keterangan">Keterangan</label>
						<textarea name="keterangan" rows="3" placeholder="Keterangan" class="form-control"></textarea>
						<?php echo form_error('keterangan'); ?>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<input type="submit" name="submit" class="btn btn-primary" value="Simpan">
			</div>
			</form>
		</div>
	</div>
</div>
<?php if (isset($modal)) { ?>
<script src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
<script type='text/javascript'>
	$(document).ready(function(){
		$('#addProject').modal('show');
	});
</script>";
<?php } ?>
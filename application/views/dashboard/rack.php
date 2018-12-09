<div class="col-md-10">
	<h3>DATA RAK</h3>
	<div class="panel panel-primary">
		<div class="panel-heading">
			Daftar Rak
		</div>
		<div class="panel-body" id="main-content">
			<table class="table table-bordered table-hover table-responsive" id="data">
				<thead>
					<tr>
						<th class="ctr" style="width: 30px;">No.</th>
						<th class="ctr">Nama Rak</th>
						<th class="ctr">Opsi</th>
						<th class="ctr">Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($racks as $r): ?>
					<tr class="data_<?php echo $r->id; ?>">
						<td class="ctr" style="width: 30px;"><?php echo $no++; ?></td>
						<td class="ctr"><?php echo $r->nama_rak; ?></td>
						<td class="ctr">
							<a href="<?php echo base_url('rack/show_projects/'.$r->id); ?>" class="btn btn-primary">Lihat Project</a>
						</td>
						<td class="ctr">
							<a href="<?php echo base_url('rack/edit/'.$r->id); ?>" class="btn btn-default"><i class="fa fa-pencil"></i></a>
							<a href="<?php echo base_url('rack/delete/'.$r->id); ?>" class="btn btn-default" onclick="return konfirmasi('menghapus data ini');"><i class="fa fa-trash"></i></a>
						</td>
					</tr>
				<?php endforeach ?>
				</tbody>
			</table>
			<div class="row">
				<div class="col-md-12">
					<button type="button" data-toggle="modal" data-target="#addRack" class="btn btn-primary">Tambah Rak</button>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="addRack" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="addRacklabel">Tambah Rak Baru</h4>
			</div>
			<form action="<?php echo base_url('rack/add'); ?>" method="post" class="form-group">
			<div class="modal-body">
				<label for="nama_rak">Nama Rak</label>
				<input type="text" name="nama_rak" class="form-control" required autofocus placeholder="Nama Rak" autocomplete="off">
				<?php echo form_error('nama_rak'); ?>
				<br>
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
		$('#addRack').modal('show');
	});
</script>";
<?php } ?>
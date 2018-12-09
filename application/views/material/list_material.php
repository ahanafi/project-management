<?php
$dev = $this->session->devisi;
?>
<div class="col-md-10">
	<h3>DATA MATERIAL</h3>
	<div class="panel panel-primary">
		<div class="panel-heading">
			Daftar Material
		</div>
		<div class="panel-body" id="main-content">
			<table class="table table-bordered table-responsive table-hover" id="data">
				<thead>
					<tr>
						<th class="ctr">No.</th>
						<th>Nama Material</th>
						<th>Spesifikasi</th>
						<th>Devisi</th>
						<th class="ctr">Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php if($material > 0): ?>
					<?php foreach ($material as $m): ?>
						<tr>
							<td class="ctr"><?php echo $no++; ?></td>
							<td><?php echo $m->nama; ?></td>
							<td><?php echo $m->spesifikasi; ?></td>
							<td><?php echo $m->devisi; ?></td>
							<td class="ctr">
								<?php if ($m->devisi == $dev): ?>
									<a href="<?php echo base_url('material/edit/'.strtolower($m->devisi).'/'.$m->id); ?>" class="btn btn-default"><i class="fa fa-pencil"></i></a>
									<a onclick="return konfirmasi('menghapus data ini')" href="<?php echo base_url('material/delete/'.strtolower($m->devisi).'/'.$m->id); ?>" class="btn btn-default"><i class="fa fa-trash"></i></a>
								<?php else: ?>
									<a href="#" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Anda tidak dapat mengedit data ini!" disabled><i class="fa fa-pencil"></i></a>
									<a href="#" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Anda tidak dapat menghapus data ini!" disabled><i class="fa fa-trash"></i></a>
								<?php endif ?>
							</td>
						</tr>
					<?php endforeach ?>
				<?php endif; ?>
				</tbody>
			</table>
			<div class="row"></div>
			<button type="button" data-toggle="modal" data-target="#addMaterial" class="btn btn-primary">New Material</button>
		</div>
	</div>
</div>
<div class="modal fade" id="addMaterial" tabindex="-1" role="dialog" aria-labelledby="addMaterialLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="addMaterialLabel">New Material</h4>
			</div>
			<form action="<?php echo base_url('material/add'); ?>" method="post" class="form-group">
			<div class="modal-body">
				<label for="nama">Nama Material</label>
				<input type="text" name="nama" class="form-control" placeholder="Nama Material">
				<?php echo form_error('nama'); ?>
				<br>

				<label for="spesifikasi">Spesifikasi Material</label>
				<textarea name="spesifikasi" rows="3" class="form-control" placeholder="Spesifikasi"></textarea>
				<?php echo form_error('spesifikasi'); ?>
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
		$('#addMaterial').modal('show');
	});
</script>
<?php } ?>
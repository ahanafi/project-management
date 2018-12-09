<?php $dev = $this->session->devisi; ?>
<div class="col-md-10">
	<h3>DATA SCHEDULE</h3>
	<div class="panel panel-primary">
		<div class="panel-heading">
			Daftar Data Schedule
		</div>
		<div class="panel-body">
			<table class="table table-bordered table-hover table-responsive" id="data">
				<thead>
					<tr>
						<th class="ctr">No.</th>
						<th>No. Project</th>
						<th>Spesfikasi</th>
						<th>Tanggal mulai</th>
						<th>Tanggal selesai</th>
						<th>Deltime</th>
						<?php if ($dev == "PPIC") : ?>
						<th class="ctr">Aksi</th>
						<?php endif; ?>
					</tr>
				</thead>
				<tbody>
					<?php if ($schedule > 0): ?>
						<?php foreach ($schedule as $sc): ?>
							<tr>
								<td class="ctr"><?php echo $no++; ?></td>
								<td><?php echo $sc->no; ?></td>
								<td><?php echo $sc->spesifikasi; ?></td>
								<td class="ctr"><?php echo $sc->tanggal_mulai; ?></td>
								<td class="ctr"><?php echo $sc->tanggal_selesai; ?></td>
								<td class="ctr"><?php echo $sc->deltime; ?></td>
								<?php if ($dev == "PPIC") : ?>
								<td class="ctr">
									<a href="<?php echo base_url('schedule/edit/'.$sc->id); ?>" class="btn btn-default"><i class="fa fa-pencil"></i></a>
									<a onclick="return konfirmasi('menghapus data ini')" href="<?php echo base_url('schedule/delete/'.$sc->id); ?>" class="btn btn-default"><i class="fa fa-trash"></i></a>
								</td>
								<?php endif; ?>
							</tr>
						<?php endforeach ?>
					<?php endif ?>
				</tbody>
			</table>
			<?php if ($dev == "PPIC") : ?>
				<div class="row"></div>
				<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addSchedule">New Schedule</button>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php if($dev == "PPIC"): ?>
<div class="modal fade" id="addSchedule" tabindex="-1" role="dialog" aria-labelledby="addScheduleLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="addScheduleLabel">New Schedule</h4>
			</div>
			<form action="<?php echo base_url('schedule'); ?>" method="post" class="form-group">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<label for="no">No. Project</label>
						<input type="text" name="no" class="form-control" placeholder="Nomor Project">
						<?php echo form_error('no'); ?>
						<br>

						<label for="spesifikasi">Spesifikasi</label>
						<textarea name="spesifikasi" rows="3" class="form-control" placeholder="Spesifikasi"></textarea>
						<?php echo form_error('spesifikasi'); ?>
						<br>
						
						<label for="tanggal_mulai">Tangal mulai</label>
						<input type="text" class="form-control datepicker" name="tanggal_mulai" placeholder="Tanggal mulai">
						<?php echo form_error('tanggal_mulai'); ?>
						<br>	
					</div>
					<div class="col-md-6">
						<label for="tanggal_selesai">Tanggal selesai</label>
						<input type="text" class="form-control datepicker" name="tanggal_selesai" placeholder="Tanggal selesai">
						<?php echo form_error('tanggal_selesai'); ?>
						<br>

						<label for="deltime">Deltime</label>
						<input type="text" name="deltime" class="form-control datepicker" placeholder="Deltime">
						<?php echo form_error('deltime'); ?>
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
<?php endif; ?>
<?php if (isset($modal)) { ?>
<script src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
<script type='text/javascript'>
	$(document).ready(function(){
		$('#addSchedule').modal('show');
	});
</script>
<?php } ?>
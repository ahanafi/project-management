<div class="col-md-10">
	<h3>DATA MASTER</h3>
	<div class="panel panel-primary">
		<div class="panel-heading">
			Daftar Project
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
							<th class="ctr">QTY</th>
							<th>Customer</th>
							<th>Status</th>
							<th class="ctr">Aksi</th>
						</tr>
					</thead>
					<tbody>
					<?php if($projects > 0): ?>
					<?php foreach($projects as $pro): ?>
						<tr class="data_rows">
							<td class="ctr" ><?php echo $no++; ?></td>
							<td><?php echo $pro->no; ?></td>
							<td><?php echo $pro->spesifikasi; ?></td>
							<td class="ctr"><?php echo $pro->tanggal_terima; ?></td>
							<td class="ctr"><?php echo $pro->deltime; ?></td>
							<td class="ctr"><?php echo $pro->qty; ?></td>
							<td><?php echo $pro->customer; ?></td>
							<td><?php echo $pro->status; ?></td>
							<td class="ctr">
							<?php if($pro->revisi == 1): ?>
								<a href="#" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Revisi Project" disabled><i class="fa fa-retweet"></i></a>
							<?php else : ?>
								<a href="<?php echo base_url('project/revisi/'.$pro->id); ?>" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Revisi Project"><i class="fa fa-retweet"></i></a>
							<?php endif; ?>
							<?php if($pro->terkirim == 1) : ?>
								<a href="<?php echo base_url('project/send_end/'.$pro->id); ?>" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Kirim Project"><i class="fa fa-send"></i></a>
							<?php elseif ($pro->terkirim == 2) : ?>
								<button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Project Jadi"><i class="fa fa-check"></i></button>
							<?php else : ?>
								<a href="<?php echo base_url('project/send/'.$pro->id); ?>" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Kirim Project"><i class="fa fa-send"></i></a>
							<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; ?>
					<?php endif; ?>
					</tbody>
				</table>
				<div class="row">
					<div class="col-md-6">
						<a href="" class="btn btn-primary" data-toggle="modal" data-target="#addProject">New Project</a>
						<a href="" class="btn btn-success">Export Ms. Excel</a>
						<a target="_blank" href="<?php echo base_url('project/export/pdf'); ?>" class="btn btn-default">Cetak PDF</a>
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
			<form action="<?php echo base_url('project/add'); ?>" method="post" class="form-group">
			<div class="modal-body" style="height: 420px;overflow: scroll;width: 100%;">
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
					<label for="qty">Quantity</label>
					<input type="number" name="qty" class="form-control" placeholder="Quantity" required>
					<?php echo form_error('qty'); ?>
					<br>

					<label for="cutomer">Customer</label>
					<input type="text" name="customer" class="form-control" placeholder="Nama customer" required>
					<?php echo form_error('customer'); ?>
					<br>

					<label for="status">Status</label>
					<select name="status" class="form-control" required>
						<option value="">-- Pilih Status --</option>
						<option value="Proses">Proses</option>
						<option value="OK">OK</option>
					</select>
					<?php echo form_error('status'); ?>
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
<div class="modal fade" id="errProject" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="errProjectlabel">Peringatan</h4>
			</div>
			<div class="modal-body text-modal">
				Oops! Silahkan pilih project terlebih dahulu!
			</div>
			<div class="modal-footer">
				<button type="button" class="btn confirm btn-default" data-dismiss="modal" onclick="window.location='<?php echo base_url('dashboard/project'); ?>'">OK</button>
			</div>
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
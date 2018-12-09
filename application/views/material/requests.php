<div class="col-md-10">
	<h3>PERMINTAAN MATERIAL</h3>
	<div class="panel panel-primary">
		<div class="panel-heading">
			Daftar Permintaaan Material
		</div>
		<div class="panel-body">
			<table class="table table-bordered table-hover table-responsive" id="data">
				<thead>
					<tr>
						<th class="ctr">No.</th>
						<th>Nama Material</th>
						<th>Type</th>
						<th>Keterangan</th>
						<th class="ctr">Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($materials as $m): ?>
					<tr>
						<td class="ctr"><?php echo $no++; ?></td>
						<td><?php echo $m->nama_material; ?></td>
						<td><?php echo $m->type; ?></td>
						<td><?php echo $m->keterangan; ?></td>
						<td class="ctr">
							<a onclick="return konfirmasi('menghapus data ini ')" href="<?php echo base_url('dashboard/delete_request/'.$m->id); ?>" class="btn btn-default"><i class="fa fa-trash"></i></a>
						</td>
					</tr>
				<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
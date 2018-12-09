<div class="col-md-10">
	<h3>DATA REVISI</h3>
	<div class="panel panel-primary">
		<div class="panel-heading">
			Daftar Revisi Project
		</div>
		<div class="panel-body">
			<table class="table table-bordered table-responsive" id="data">
				<thead>
					<tr>
						<th class="ctr">No.</th>
						<th>No. Project</th>
						<th>Keterangan</th>
						<th class="ctr">Customer</th>
						<th class="ctr">Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php if ($projects != 0) : ?>
				<?php foreach ($projects as $p) : ?>
					<tr>
						<td class="ctr"><?php echo $no++; ?></td>
						<td><?php echo $p->no; ?></td>
						<td><?php echo $p->keterangan; ?></td>
						<td class="ctr"><?php echo $p->customer; ?></td>
						<td class="ctr">
							<a href="<?php echo base_url('project/detail/'.$p->id); ?>" class="btn btn-default" data-toggle="tooltip" title="Detail Project"><i class="fa fa-eye"></i></a>
							<a onclick="return konfirmasi('menghapus data ini')" href="<?php echo base_url('project/delete/'.$p->id); ?>" class="btn btn-default"><i class="fa fa-trash"></i></a>
						</td>
					</tr>
				<?php endforeach; ?>
				<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
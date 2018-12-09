<div class="col-md-10">
	<h3>DATA PROJECT</h3>
	<div class="panel panel-primary">
		<div class="panel-heading">
			Project yang terkirim ke Devisi Gudang
		</div>
		<div class="panel-body">
			<table class="table table-responsive table-striped table-bordered" id="data">
				<thead>
					<tr>
						<th class="ctr">No.</th>
						<th>No. Project</th>
						<th>Spesifikasi</th>
						<th class="ctr">Tanggal terima</th>
						<th class="ctr">Deltime</th>
						<th class="ctr">QTY</th>
						<th>Customer</th>
						<th class="ctr">Status</th>
					</tr>
				</thead>
				<tbody>
				<?php if ($projects > 0): ?>
					<?php foreach ($projects as $p): ?>
						<tr>
							<td class="ctr"><?php echo $no++; ?></td>
							<td><?php echo $p->no; ?></td>
							<td><?php echo $p->spesifikasi; ?></td>
							<td class="ctr"><?php echo $p->tanggal_terima; ?></td>
							<td class="ctr"><?php echo $p->deltime; ?></td>
							<td><?php echo $p->qty; ?></td>
							<td><?php echo $p->customer; ?></td>
							<td class="ctr"><?php echo $p->status; ?></td>
						</tr>
					<?php endforeach ?>
				<?php endif ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
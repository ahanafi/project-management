<div class="col-md-10">
	<h3>DATA PROJECT</h3>
	<div class="panel panel-primary">
		<div class="panel-heading">
			Daftar Project di <?php echo $rack->nama_rak; ?>
		</div>
		<div class="panel-body">
			<table class="table table-bordered table-responsive table-stripped" id="data">
				<thead>
					<tr>
						<th class="ctr">No.</th>
						<th>No. Project</th>
						<th>Spesifikasi</th>
						<th class="ctr">Tgl. terima</th>
						<th class="ctr">Deltime</th>
						<th class="ctr">QTY</th>
						<th class="ctr">Customer</th>
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
							<td class="ctr"><?php echo $p->qty; ?></td>
							<td class="ctr"><?php echo $p->customer; ?></td>
						</tr>
					<?php endforeach ?>
				<?php endif ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
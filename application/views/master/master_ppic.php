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
						</tr>
					</thead>
					<tbody>
						<?php if($projects> 0): ?>
							<?php foreach($projects as $pro): ?>
								<tr class="data_rows">
									<td class="ctr"><?php echo $no++; ?></td>
									<td><?php echo $pro->no; ?></td>
									<td><?php echo $pro->spesifikasi; ?></td>
									<td class="ctr"><?php echo id_date($pro->tanggal_terima); ?></td>
									<td class="ctr"><?php echo id_date($pro->deltime); ?></td>
									<td class="ctr"><?php echo $pro->qty; ?></td>
									<td><?php echo $pro->customer; ?></td>
									<td><?php echo $pro->status; ?></td>
								</tr>
							<?php endforeach; ?>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
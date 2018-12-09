<style>
	.table tbody, .table tbody tr, .table tbody tr td{
		vertical-align: middle;
	}
</style>
<div class="col-md-10">
	<h3>DATA DESAIN</h3>
	<div class="panel panel-primary">
		<div class="panel-heading">
			Daftar Project
		</div>
		<div class="panel-body" id="main-content">
			<table class="table table-bordered table-responsive table-hover" id="data">
				<thead>
					<tr>
						<th class="ctr">No.</th>
						<th>No. Project</th>
						<th>Spesifikasi</th>
						<th class="ctr">Tgl. Terima</th>
						<th class="ctr">Deltime</th>
						<th class="ctr">Gambar</th>
					</tr>
				</thead>
				<tbody>
					<?php if($design > 0) { ?>
						<?php foreach ($design as $des) { ?>
							<tr">
								<td class="ctr"><?php echo $no++; ?></td>
								<td><?php echo $des->no; ?></td>
								<td><?php echo $des->spesifikasi; ?></td>
								<td class="ctr"><?php echo id_date($des->tanggal_terima); ?></td>
								<td class="ctr"><?php echo id_date($des->deltime); ?></td>
								<td class="ctr">
									<?php if ($des->design !=  "none"): ?>
										<?php if (file_exists('./././images/project_images/'.$des->design)): ?>
											<a href="<?php echo base_url('images/project_images/'.$des->design); ?>" target="_blank"><img src="<?php echo base_url('/images/project_images/'.$des->design); ?>" alt="" width="100px;"></a>
										<?php else: ?>
											<a href="<?php echo base_url('/images/no_pict.png'); ?>" target="_blank"><img src="<?php echo base_url('/images/no_pict.png'); ?>" alt="" width="100px;"></a>
										<?php endif ?>
									<?php else : ?>
										<a href="<?php echo base_url('/images/no_pict.png'); ?>" target="_blank"><img src="<?php echo base_url('/images/no_pict.png'); ?>" alt="" width="100px;"></a>
									<?php endif; ?>
								</td>
							</tr>
						<?php } ?> <!-- asli -->
					<?php } ?>
				</tbody>
			</table>
			<div class="row">
				<div class="col-md-6">
					<a href="<?php echo base_url('export/design_excel'); ?>" class="btn btn-success">Export Ms. Excel</a>
					<a target="_blank" href="<?php echo base_url('export/design_pdf'); ?>" class="btn btn-default">Cetak PDF</a>
				</div>
			</div>
		</div>
	</div>
</div>
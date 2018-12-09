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
						<th class="ctr" rowspan="2">No.</th>
						<th rowspan="2">No. Project</th>
						<th rowspan="2">Spesifikasi</th>
						<th class="ctr" rowspan="2">Tgl. Terima</th>
						<th class="ctr" rowspan="2">Deltime</th>
						<th class="ctr" rowspan="2">Gambar</th>
						<th class="ctr" colspan="2">Aksi</th>
					</tr>
					<tr>
						<th class="ctr">#</th>
						<th class="ctr">#</th>
					</tr>
				</thead>
				<tbody>
					<?php if($design > 0) { ?>
						<?php foreach ($design as $des) { ?>
							<tr">
								<td class="ctr"><?php echo $no++; ?></td>
								<td><?php echo $des->no; ?></td>
								<td><?php echo $des->spesifikasi; ?></td>
								<td class="ctr"><?php echo $des->tanggal_terima; ?></td>
								<td class="ctr"><?php echo $des->deltime; ?></td>
								<td class="ctr">
									<?php if ($des->design !=  "none"): ?>
										<?php if (file_exists('./././images/project_images/'.$des->design)): ?>
											<a href="<?php echo base_url('images/project_images/'.$des->design); ?>" target="_blank"><img src="<?php echo base_url('/images/project_images/'.$des->design); ?>" alt="" width="100px;"></a>
										<?php else: ?>
											<a href="<?php echo base_url('/images/no_pict.png'); ?>" target="_blank"><img src="<?php echo base_url('/images/no_pict.png'); ?>" alt="" width="100px;"></a>
										<?php endif ?>
									<?php else : ?>
										<a href="<?php echo base_url('design/upload/'.$des->id); ?>" class="btn btn-default">Upload</a>
									<?php endif; ?>
								</td>
								<?php if ($des->design != "none"): ?>
									<td class="ctr">
										<a href="<?php echo base_url('design/upload/'.$des->id); ?>" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Ubah Gambar"><i class="fa fa-pencil"></i></a>
									</td>
										<?php if ($des->terkirim == 2): ?>
											<td class="ctr">
												<i style="font-size: 2em;margin-top: 10%;" class="fa fa-check" data-toggle="tooltip" data-placement="top" title="Terkirim ke Gudang"></i>
											</td>
										<?php else: ?>
											<td class="ctr">
												<a href="<?php echo base_url('project/send_end/'.$des->id); ?>" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Kirim project ke Gudang"><i class="fa fa-send"></i></a>
											</td>
										<?php endif; ?>
									<?php else: ?>
										<td class="ctr">
											<a href="<?php echo base_url('design/upload/'.$des->id); ?>" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Ubah Gambar"><i class="fa fa-pencil"></i></a>
										</td>
										<td class="ctr">
											<a href="#" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Project tidak dapat dikirim ke Gudang" disabled><i class="fa fa-send"></i></a>
										</td>
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
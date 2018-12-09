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
							<th class="ctr" rowspan="2">#</th>
							<th rowspan="2">No. Project</th>
							<th style="width: 200px;" rowspan="2">Spesifikasi</th>
							<th class="ctr" rowspan="2">Tgl. Terima</th>
							<th rowspan="2">Status</th>
							<th class="ctr" rowspan="2">Gambar</th>
							<th class="ctr" colspan="2">
								Aksi
							</th>
						</tr>
						<tr>
							<th>Detail</th>
							<th>Upload</th>
						</tr>
					</thead>
					<tbody>
						<?php if($projects > 0): ?>
							<?php foreach($projects as $pro): ?>
								<tr class="data_rows">
									<td class="ctr" ><?php echo $no++; ?></td>
									<td><?php echo $pro->no; ?></td>
									<td><?php echo $pro->spesifikasi; ?></td>
									<td class="ctr"><?php echo id_date($pro->tanggal_terima); ?></td>
									<td class="ctr"><?php echo $pro->status; ?></td>
									<td class="ctr">
										<?php if ($pro->design !=  "none"): ?>
											<?php if (file_exists('./././images/project_images/'.$pro->design)): ?>
												<img src="<?php echo base_url('/images/project_images/'.$pro->design); ?>" alt="" width="100px;">
											<?php else: ?>
												<img src="<?php echo base_url('/images/no_pict.png'); ?>" alt="" width="100px;">
											<?php endif ?>
										<?php else : ?>
											<img src="<?php echo base_url('/images/no_pict.png'); ?>" alt="" width="100px;">
										<?php endif; ?>
									</td>
									<td class="ctr">
										<a href="<?php echo base_url('project/detail/'.$pro->id); ?>" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Detail Project">
											<i class="fa fa-eye"></i>
										</a>
									</td>
									<td class="ctr">
										<?php if ($pro->design == "none") : ?>
											<a href="<?php echo base_url('design/upload/'.$pro->id); ?>" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Upload Gambar">
												UPLOAD
											</a>
										<?php else : ?>
											<a href="#" class="btn btn-default" disabled="disabled" data-toggle="tooltip" data-placement="top" title="Gambar project telah terupload!">
												<i class="fa fa-check"></i>
											</a>
										<?php endif; ?>
									</td>
								</tr>
							<?php endforeach; ?>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
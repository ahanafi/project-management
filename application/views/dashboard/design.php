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
						<th class="ctr">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($design as $des) : ?>
					<tr>
						<td class="ctr"><?php echo $no++; ?></td>
						<td><?php echo $des->no; ?></td>
						<td><?php echo $des->spesifikasi; ?></td>
						<td class="ctr"><?php echo $des->tanggal_terima; ?></td>
						<td class="ctr"><?php echo $des->deltime; ?></td>
						<td class="ctr">
							<?php if ($des->design !=  NULL): ?>
								<img src="<?php echo base_url('images/project_images/'.$des->design); ?>" alt="" width="100px;">
							<?php else : ?>
								<a href="<?php echo base_url('project/upload_design/'.$des->id); ?>" class="btn btn-default">Upload</a>
							<?php endif ?>
						</td>
						<td class="ctr">
							<a href="" class="btn btn-default"><i class="fa fa-pencil"></i></a>
							<button type="button" data-id="<?php echo $des->id; ?>" class="btn btn-rmv btn-default"><i class="fa fa-trash"></i></button>
						</td>
					</tr>
					<?php endforeach; ?> <!-- asli -->
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
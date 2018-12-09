<div class="col-md-10">
	<h3>DATA BARANG JADI</h3>
	<div class="panel panel-primary">
		<div class="panel-heading">
			Daftar Barang Jadi
		</div>
		<div class="panel-body">
			<table class="table table-bordered table-responsive table-hover table-striped" id="data">
				<thead>
					<tr>
						<th class="ctr">No</th>
						<th>No. Project</th>
						<th>Spesifikasi</th>
						<th class="ctr">Tgl. terima</th>
						<th class="ctr">Deltime</th>
						<th>Customer</th>
						<th>Posisi</th>
					</tr>
				</thead>
				<tbody>
				<?php if($projects > 0): ?>
					<?php foreach($projects as $p): ?>
					<tr>
						<td class="ctr"><?php echo $no++; ?></td>
						<td><?php echo $p->no; ?></td>
						<td><?php echo $p->spesifikasi; ?></td>
						<td class="ctr"><?php echo $p->tanggal_terima; ?></td>
						<td class="ctr"><?php echo $p->deltime; ?></td>
						<td class="ctr"><?php echo $p->customer; ?></td>
						<td class="ctr"><a href="<?php echo base_url('rack/show_projects/'.$p->id_rack); ?>" class="btn-link"><?php echo $p->nama_rak; ?></a></td>
					</tr>
				<?php endforeach; ?>
				<?php endif; ?>
				</tbody>
			</table>
			<div class="row">
				<div class="col-md-6">
					<a href="<?php echo base_url('export/barang_jadi_excel'); ?>" class="btn btn-success">Export Ms. Excel</a> 
					<a href="<?php echo base_url('export/barang_jadi_pdf'); ?>" class="btn btn-default" target="_blank">Export PDF</a>
				</div>
			</div>
		</div>
	</div>
</div>
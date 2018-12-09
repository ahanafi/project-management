<div class="col-md-10">
	<h3>DATA CUSTOMER</h3>
	<div class="panel panel-primary">
		<div class="panel-heading">
			Daftar Customer
		</div>
		<div class="panel-body" id="main-content">
			<table class="table table-bordered table-responsive table-hover" id="data">
				<thead>
					<tr>
						<th class="ctr">No.</th>
						<th>Nama Customer</th>
						<th class="ctr">No. Telp</th>
						<th>Alamat</th>
						<th class="ctr">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($customer as $cust) : ?>
					<tr>
						<td class="ctr"><?php echo $no++; ?></td>
						<td><?php echo $cust->nama; ?></td>
						<td class="ctr"><?php echo $cust->telp; ?></td>
						<td><?php echo $cust->alamat; ?></td>
						<td class="ctr">
							<a href="<?php echo base_url('customer/edit/'.$cust->id); ?>" class="btn btn-default"><i class="fa fa-pencil"></i></a>
							<a onclick="return konfirmasi('menghapus data ini')" href="<?php echo base_url('customer/delete/'.$cust->id); ?>" class="btn btn-default"><i class="fa fa-trash"></i></a>
						</td>
					</tr>
					<?php endforeach; ?> <!-- asli -->
				</tbody>
			</table>
			<div class="row"></div>
			<a href="<?php echo base_url('customer/add'); ?>" class="btn btn-primary">Tambah Customer</a>
		</div>
	</div>
</div>
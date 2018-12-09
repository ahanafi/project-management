<div class="col-md-10">
	<h3>DETAIL PROJECT</h3>
	<div class="panel panel-primary">
		<div class="panel-heading">
			Detail Data Project
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-6">
					<table class="table">
						<tr>
							<td>No. Project</td>
							<td>:</td>
							<td><?php echo $p->no; ?></td>
						</tr>
						<tr>
							<td>Spesifikasi</td>
							<td>:</td>
							<td><?php echo $p->spesifikasi; ?></td>
						</tr>
						<tr>
							<td>Tanggal terima</td>
							<td>:</td>
							<td><?php echo $p->tanggal_terima; ?></td>
						</tr>
						<tr>
							<td>Deltime</td>
							<td>:</td>
							<td><?php echo $p->deltime; ?></td>
						</tr>
						<tr>
							<td>Quantity</td>
							<td>:</td>
							<td><?php echo $p->qty; ?></td>
						</tr>
						<tr>
							<td>Customer</td>
							<td>:</td>
							<td><?php echo $p->customer; ?></td>
						</tr>
						<tr>
							<td>Status</td>
							<td>:</td>
							<td><?php echo $p->status; ?></td>
						</tr>
					</table>
					<a href="#" onclick="window.history.go(-1);" class="btn btn-default">Kembali</a>
				</div>
			</div>
		</div>
	</div>
</div>
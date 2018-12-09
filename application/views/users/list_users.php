<div class="col-md-10">
	<h3>Manajement User</h3>
	<div class="panel panel-default">
		<div class="panel-heading">
			<strong>Daftar Users</strong>
		</div>
		<div class="panel-body">
			<table class="table table-bordered table-responsive" id="data">
				<thead>
					<tr>
						<th class="ctr">No</th>
						<th>Username</th>
						<th>Password</th>
						<th class="ctr">Role</th>
						<th class="ctr">Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($users as $usr){ ?>
					<tr>
						<td class="ctr"><?php echo $no++; ?></td>
						<td><?php echo $usr->username; ?></td>
						<td>*****</td>
						<td class="ctr">
							<?php echo ($usr->role == 1) ? "Administrator" : "Operartor"; ?>
						</td>
						<td class="ctr">
							<a href="" class="btn btn-default"></a><a href="" class="btn btn-default"></a>
						</td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
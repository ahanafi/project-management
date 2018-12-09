<?php $root = $_SERVER['DOCUMENT_ROOT']; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Report Data Design Project</title>
</head>
<style>
	body{
		font-family: Arial, Sans-serif, Helvetica;		
	}
	header{
		font-size: 20px;
		text-align: center;
	}
	h3{
		margin-bottom: -6px;
	}
	.ctr{
		text-align: center;
	}
	.table{
		border:1px solid red;
		font-size: 13px;
		border-color: #dedede;
		width: 100%;
		border-collapse: collapse;
	}
	.table thead{
		background-color: #2196f3;
		border-color: #2196f3;
		color: #fff;
	}
	.table tbody tr td{
		border-collapse: collapse;
	}
	tbody tr:nth-child(even){
		/* background: #F6F5FA; */
		background: #e5e3ea;
	}

	.on{		
		float: right;
		font-size: 13px;
		font-style: italic;
	}
</style>
<body>
	<div id="main-content">
		<header>
			PROJECT MANAGEMENT APP
		</header>
		<p class="on">
			Export on : <?php echo date('Y-m-d H:i:s'); ?> <br>
			by <?php echo ucwords($this->session->username); ?> (<strong><?php echo $this->session->devisi; ?></strong>)
		</p>
		<h3><?php echo $title; ?></h3>
		<br>
		<table class="table" border="" cellspacing="0" cellpadding="10">
			<thead>
				<tr>
					<th class="ctr">No.</th>
					<th>No. Project</th>
					<th>Spesifikasi</th>
					<th class="ctr">Tanggal terima</th>
					<th class="ctr">Deltime</th>
					<th class="ctr">QTY</th>
					<th class="ctr">Customer</th>
					<th class="ctr">Status</th>
					<th class="ctr">Gambar Design</th>
				</tr>
			</thead>
			<tbody>
			<?php if ($design > 0): ?>
				<?php foreach ($design as $m): ?>
					<tr>
						<td class="ctr"><?php echo $no++; ?></td>
						<td><?php echo $m->no; ?></td>
						<td><?php echo $m->spesifikasi; ?></td>
						<td class="ctr"><?php echo id_date($m->tanggal_terima); ?></td>
						<td class="ctr"><?php echo id_date($m->deltime); ?></td>
						<td class="ctr"><?php echo $m->qty; ?></td>
						<td class="ctr"><?php echo $m->customer; ?></td>
						<td class="ctr"><?php echo $m->status; ?></td>
						<td class="ctr">
							<img src="<?php echo $root."/appman/images/project_images/".$m->design; ?>" alt="" width="100px">
						</td>
					</tr>
				<?php endforeach ?>
			<?php endif ?>
			</tbody>
		</table>
	</div>
</body>
</html>
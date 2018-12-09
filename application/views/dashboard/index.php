<?php if ($this->session->devisi == "Engineering"): ?>
<div class="col-md-10">
	<h3>DASHBOARD</h3>
	<div class="panel panel-primary">
		<div class="panel-heading">
			Main Menu
		</div>
		<div class="panel-body" style="min-height: 100px;">
			<h4>Welcome <?php echo ucfirst($this->session->username); ?>! </h4>
			<p style="font-size: 14px;">
				How are you today ? Do you fine now ?
			</p>
		</div>
	</div>
	<div class="panel panel-primary">
		<div class="panel-heading">
			Pemberitahuan
		</div>
		<div class="panel-body">
			<ul class="list-group">
				<li class="list-group-item">
					<span class="label label-info">Info</span>
					Anda memiliki <?php echo $by_marketing; ?> project yang dikirim dari Devisi Marketing.
					<a href="<?php echo base_url('notif/send_by_marketing'); ?>" class="btn-link">Lihat Sekarang!</a>
				</li>
				<li class="list-group-item">
					<span class="label label-info">Info</span>
					Anda telah mengirim <?php echo $to_gudang; ?> project ke Devisi Gudang.
					<a href="<?php echo base_url('notif/sent_to_gudang'); ?>" class="btn-link">Lihat Sekarang!</a>
				</li>
				<li class="list-group-item">
					<span class="label label-info">Info</span>
					Anda memiliki <?php echo $no_design; ?> project yang belum ada desainnya.
					<a href="<?php echo base_url('notif/no_design'); ?>" class="btn-link">Lihat Sekarang!</a>
				</li>
			</ul>
		</div>
	</div>
</div>
<?php else: ?>
<div class="col-md-10">
	<h3>DASHBOARD</h3>
	<div class="panel panel-primary">
		<div class="panel-heading">
			Main Menu
		</div>
		<div class="panel-body" style="min-height: 400px;">
			<h4>Welcome <?php echo ucfirst($this->session->username); ?>! </h4>
			<p style="font-size: 14px;">
				How are you today ? Do you fine now ?
			</p>
		</div>
	</div>
</div>
<?php endif ?>
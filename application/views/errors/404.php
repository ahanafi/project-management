<div class="col-md-10">
	<div class="error">
	<h1><?php echo $code; ?></h1>
	<p>
		<?php echo $text; ?>
	</p>
	Klik <a href="#" onclick="window.history.go(-1);" class="btn-link">disini</a> untuk kembali ke halaman sebelumnya.
	</div>
</div>
<div class="modal fade" id="ConfirmLogout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="ConfirmLogoutlabel">Konfirmasi Keluar</h4>
			</div>
			<div class="modal-body">
				<strong>Apakah Anda yakin akan keluar dari Aplikasi ini ?</strong>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
				<a href="<?php echo base_url('auth/logout') ?>" class="btn btn-danger">Ya, Keluar</a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$(".col-md-10").addClass('content-app');
		$(".btn-logout").on("click", function(){
			$("#ConfirmLogout").modal('show');
		});
		$("title").text('Oops! Page Not Found');
	});
</script>
</body>
</html>
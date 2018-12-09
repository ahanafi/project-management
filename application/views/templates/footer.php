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
<div class="modal fade" id="ConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="ConfirmDeletelabel">Konfirmasi Hapus Data</h4>
			</div>
			<div class="modal-body">
				<strong>Apakah Anda yakin akan menghapus data ini ?</strong>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
				<a href="#" class="btn btn-true btn-danger">Ya, Hapus</a>
			</div>
		</div>
	</div>
</div>
<div class="page">
	<input type="hidden" name="seg-first" value="<?php echo $this->uri->segment(1); ?>">
	<input type="hidden" name="seg-second" value="<?php echo $this->uri->segment(2); ?>">
</div>
<footer>
	Copyright &copy; <?php echo date('Y'); ?> :: Develop by Yukcoding
</footer>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/datepicker/js/bootstrap-datepicker.min.js'); ?>"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("table#data").addClass('table-striped');
		$("#data").DataTable({
			pageLength : 5,
			lengthMenu: [[5, 10, 25, -1], [5, 10, 25, 'All']]
		});
		$(".datepicker").datepicker({format : 'yyyy/mm/dd'});
		$(".date").datepicker({format : 'yyyy/mm/dd', orientation : 'bottom'});
		$(".col-md-10").addClass('content-app');
		$(".btn-logout").on("click", function(){
			$("#ConfirmLogout").modal('show');
		});
		$("select[name=data_length]").css({
			'text-align':'center'
		});
		$("select[name=data_length] > option").css({
			'text-align':'center'
		});
		$("body").tooltip({
			'selector':['data-toggle=tooltip']
		});
	});


	function base_url(file = NULL){
		var url = "<?php echo base_url(); ?>"+file;
		return url;
	}

	function konfirmasi(text)
	{
		var tanya = confirm("Apakah Anda yakin akan "+text+" ?");
		if (tanya == true) {
			return true;
		} else {
			return false;
		}
	}
</script>
<script type="text/javascript" src="<?php echo base_url('assets/js/script.js'); ?>"></script>
</body>
</html>
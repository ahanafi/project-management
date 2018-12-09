<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login Administrator | Project Management</title>
</head>
<link rel="stylesheet" href="<?php echo base_url('assets/css/paper.bootstrap.min.css'); ?>">
<style>
	body{
		background: #ddd;
	}
	#login-app{
		text-align: center;
		width: 33%;
		margin: 10% auto 0% auto;
		box-sizing: border-box;
	}
	input[type=submit]{
		width: 100%;
	}
	form input{
		text-align: center;
	}
	select{
		text-align: center !important;
		text-align-last:center !important;
	}
	option{
		text-align: center;
		float:none !important;
		margin: 0 auto !important;
	}
	.panel-body{
		padding:35px 35px 10px 35px;
	}
</style>
<body>
	<div class="container">
		<div class="row">
			<div id="login-app">
				<div class="panel panel-primary">
					<div class="panel-heading">
						Login Administrator
					</div>
					<div class="panel-body">
						<form action="<?php echo base_url('auth/login'); ?>" method="post" class="form-group">
							<!-- <label for="username">Username</label> -->
							<div class="username">
								<input type="text" name="username" class="form-control" placeholder="Username..."  autofocus autocomplete="off" required>
								<?php echo form_error('username'); ?>
								</div>
							<br>

							<!-- <label for="password">Password</label> -->
							<div class="password">
								<input type="password" name="password" class="form-control" placeholder="Password..."  autocomplete="off" required>
								<?php echo form_error('password'); ?>
							</div>
							<br>

							<select name="devisi" class="form-control" required>
								<option value=""> -- Pilih Hak Akses --</option>
								<option value="Marketing">Marketing</option>
								<option value="Engineering">Engineering</option>
								<option value="Gudang">Gudang</option>
								<option value="PPIC">PPIC</option>
								<option value="Produksi">Produksi</option>
								<option value="QC">QC</option>
							</select>
							<?php echo form_error('devisi'); ?>
							<br>

							<input type="submit" name="login" class="btn btn-primary" value="Login">
						</form>
					</div>
					<div class="panel-footer">
						Copyright &copy; <?php echo date('Y'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="errLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="errLoginlabel">Peringatan</h4>
				</div>
				<div class="modal-body">
					<strong>Oops! Login gagal silahkan ulangi!</strong>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
				</div>
				</form>
			</div>
		</div>
	</div>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/script.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
<?php if (isset($modal)) { ?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#errLogin").modal('show');
	});
</script>
<?php } ?>
</body>
</html>
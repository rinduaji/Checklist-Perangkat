<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	
	<?php $this->load->view('templates/css'); ?>
</head>
<body>
	<?= form_open('login'); ?>
		<div class="container-fluid login">
			<div class="judul">
				<div class="" id="pesan">
					<?php if ($pesan = $this->session->flashdata('pesan')): ?>
						<p class="alert <?= ($this->session->flashdata('status')) ? 'alert-success' : 'alert-danger'; ?>"><?= $pesan ?></p>
					<?php endif ?>
				</div>
				<h4 class="text-center">LOGIN</h4>
			</div>
			<div class="kiri text-center">
				<img src="<?= base_url('assets/gambar/logo-telkom.png') ?>" alt="Logo Telkom">
			</div>
			<div class="tengah">
				<div class="text-center">
					<h10>Username</h10>
					<input type="text" name="username" class="form-control" required>
					<br>
					<h10>Password</h10>
					<input type="password" name="password" class="form-control" required>
				</div>
				<div class="button">
					<input class="btn btn-primary" name="login" type="submit" value="Login">
					<input class="btn btn-danger" name="reset" type="reset" value="Batal">
				</div>
			</div>
			<div class="kanan text-center">
				<img src="<?= base_url('assets/gambar/Infomedia.png') ?>" alt="Logo ISH">
			</div>
		</div>
	<?= form_close(); ?>
	<script type="text/javascript" src="<?= base_url('assets/jquery-3.6.1.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/datatables.min.js') ?>"></script>
	<script type="text/javascript">
		setTimeout(function(){
			document.getElementById('pesan').style.display = 'none';
		}, 5000);
	</script>
</body>
</html>
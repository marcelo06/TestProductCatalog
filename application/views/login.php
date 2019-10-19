<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Product Catalog</title>
		<link rel="SHORTCUT ICON" href="">
		<!-- font -->
		<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
		<!-- CSS Boostrap -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<!-- Custom styles for this template -->
		<link href="css/custom.css" rel="stylesheet">

		<!-- SweetAlert -->
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
	</head>
	<body>
		<nav class="navbar navbar-light bg-light">
			<a class="navbar-brand" href="#">
				<img src="<?= base_url().'images/cash-register.png'; ?>" width="30" height="30" class="d-inline-block align-top" alt="">
				Product Catalog
			</a><?
			if($login)
			{ ?>
				<ul class="nav justify-content-end">
					<li class="nav-item">
						<a class="nav-link" href="<?= base_url(); ?>">Store</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">About</a>
					</li>
					<li class="nav-item">
						<a class="nav-link btn btn-outline-primary" href="<?= base_url('login/out'); ?>">Log Out</a>
					</li>
				</ul><?
			}
			else
			{ ?>
				<nav class="nav">
					<li class="nav-item">
						<a class="nav-link" href="<?= base_url(); ?>">Store</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">About</a>
					</li>
					<ul class="nav justify-content-end">
						<li class="nav-item">
							<a class="nav-link btn btn-outline-primary" href="<?= base_url('login'); ?>">Sign In</a>
						</li>
					</ul>
				  </nav><?
			} ?>
		</nav>
		<div class="container py-5">
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6 mx-auto my-5">
							<div class="card">
								<div class="card-header">
									<h3 class="mb-0">Login to admin</h3>
								</div>
								<div class="card-body">
									<form class="form" id="form">
										<div class="form-group">
											<label for="usernamr">Username</label>
											<input type="text" class="form-control form-control-lg rounded-0" name="username" id="username" required="">
										</div>
										<div class="form-group">
											<label>Password</label>
											<input type="password" class="form-control form-control-lg rounded-0" id="password" required="" autocomplete="new-password" name="password">
										</div>
										<button type="submit" id="submit" class="btn btn-success btn-lg float-right" id="btnLogin">Login</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Footer -->
		<footer class="footerLogin bg-dark">
		  <div class="container">
			<p class="m-0 text-center text-white">Copyright &copy; Product Catalog 2019</p>
		  </div>
		</footer>
		<!-- JS Boostrap -->
		<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#form").validate({
					submitHandler: function() {
						$.ajax({
							method: 'POST',
							url: '<?= base_url('login/authentication'); ?>',
							data: $('#form').serialize(),
							dataType: 'json'
						})
						.done(function(data){
							console.log(data);
							if(data.response === 'success')
							{
								window.location.href = '<?= base_url('dashboard'); ?>';
							}
							else
							{
								Swal.fire({
									type: 'error',
									title: 'Oops...',
									html: data.message,
								});
							}
						});
					}
				});
			});
		</script>
	</body>
</html>
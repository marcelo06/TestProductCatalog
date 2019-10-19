<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

	<!-- Page Content -->
	<div id="page-content-wrapper">

	  <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
		<button class="btn btn-primary" id="menu-toggle">Toggle Menu</button>

		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		  <span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
		  <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
			<li class="nav-item active">
			  <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" href="#">Link</a>
			</li>
			<li class="nav-item dropdown">
			  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Dropdown
			  </a>
			  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
				<a class="dropdown-item" href="#">Action</a>
				<a class="dropdown-item" href="#">Another action</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="#">Something else here</a>
			  </div>
			</li>
		  </ul>
		</div>
	  </nav>

	  <div class="container-fluid">
		<div class="jumbotron my-2">
			<h1 class="display-4">Welcome to the admin dashboard</h1>
			<p class="lead">In this section you can manage Categories, products and system users.</p>
			<hr class="my-4">
		</div>
	  </div>
	</div>
	<!-- /#page-content-wrapper -->

</div>
<!-- Menu Toggle Script -->
<script>
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});
</script>
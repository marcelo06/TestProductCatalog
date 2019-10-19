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
					<li class="nav-item">
					  <a class="nav-link" href="#">Dashboard</a>
					</li>
					<li class="nav-item active">
					  <a class="nav-link" href="#">Users <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						  Dropdown
						</a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
							<a class="dropdown-item">Actions</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="<?= base_url('users/userForm'); ?>">Create new user</a>
						</div>
					</li>
			  </ul>
			</div>
		</nav>

		<div class="container-fluid">
			<table class="table">
				<thead class="thead">
					<tr>
						<th scope="col">Username</th>
						<th scope="col">Is Admin?</th>
						<th scope="col">Last login</th>
						<th scope="col">Options</th>
					</tr>
				</thead>
				<tbody><?
					if(count($users) >0)
					{
						foreach($users as $user)
						{ ?>
							<tr>
								<td><?= $user->username; ?></td>
								<td><?= ($user->admin == 0) ? 'No' : 'Yes'; ?></td>
								<td><?= $user->last_login; ?></td>
								<td>
									<a href="<?= base_url('users/editForm/').$user->id; ?>">Editar</a>
								</td>
							</tr><?
						}
					}
					else
					{ ?>
						<tr>
							<td colspan="3"></td>
						</tr><?
					} ?>
				</tbody>
			</table>
			<nav aria-label="Page navigation example">
				<?= $pagination; ?>
			</nav>
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
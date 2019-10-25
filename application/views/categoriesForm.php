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
					  <a class="nav-link" href="#">Categories <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						  Dropdown
						</a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
							<a class="dropdown-item">Actions</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="<?= base_url('categories/createForm'); ?>">Create new category</a>
						</div>
					</li>
			  </ul>
			</div>
		</nav>

		<div class="container-fluid my-5">
			<form id="form" enctype="multipart/form-data"><?
				if(isset($category->id))
				{ ?>
					<input type="hidden" name="id" value="<?= $category->id; ?>"><?
				} ?>
				<div class="form-group row">
					<label for="name" class="col-sm-2 col-form-label">Name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="name" name="name" required="" value="<? if(isset($category->name)) echo $category->name; ?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="parent" class="col-sm-2 col-form-label">Parent</label>
					<div class="col-sm-10">
						<select id="group" class="form-control" name="parent">
							<option value="0">Choose...</option><?
							foreach ($categories as $cat)
							{ ?>
							<option value="<?= $cat->id; ?>" <? if(isset($category->parent_id) && $cat->id == $category->parent_id) echo 'selected'; ?>><?= $cat->name; ?></option><?
							} ?>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="photo" class="col-sm-2 col-form-label">Photo</label>
					<div class="col-sm-10">
						<div class="form-group">
							<label for="exampleFormControlFile1">Example file input</label>
							<input name="photo" type="file" class="form-control-file" id="exampleFormControlFile1" <? if(!isset($category)) echo 'required'; ?>>
						 </div>
					</div>
				</div>

				<div class="form-group row">
					<div class="col-sm-10">
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
				</div>
			</form>
		</div>

	</div>
	<!-- /#page-content-wrapper -->

</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#customFile').change(function(e){
			Swal.fire({
				type: 'error',
				title: 'Oops...',
				html: 'data.message',
			});
		});
		$("#form").validate({
			submitHandler: function() {
				url = '<?= (isset($category)) ? base_url('categories/edit') : base_url('categories/create'); ?>';
				$.ajax({
					method: 'POST',
					url: url,
					data: new FormData($('#form')[0]),
					dataType: 'json',
					cache: false,
					contentType: false,
					processData: false
				})
				.done(function(data){
					console.log(data);
					if(data.response === 'success')
					{
						Swal.fire({
							type: 'success',
							title: data.title,
							html: data.message,
						}).then(function(){
							window.location.href = '<?= base_url('categories'); ?>';
						})
						.catch(swal.noop);
					}
					else
					{
						Swal.fire({
							type: 'error',
							title: 'Oops...',
							html: data.message
						});
					}
				});
			}
		});
	});
</script>
<!-- Menu Toggle Script -->
<script>

	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});
</script>
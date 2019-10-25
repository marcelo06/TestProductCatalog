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

		<div class="container-fluid">
			<table class="table">
				<thead class="thead">
					<tr>
						<th scope="col">Name</th>
						<th scope="col">Options</th>
					</tr>
				</thead>
				<tbody><?
					if(count($categories) >0)
					{
						foreach($categories as $category)
						{ ?>
							<tr>
								<td <?= $category->lvl; ?>><?= $category->name; ?></td>
								<td>
									<a href="<?= base_url('categories/editForm/').$category->id; ?>">Edit</a>
									<a class="openModal"data-toggle="modal" href="" data-id="<?= $category->id; ?>">View</a>
									<a class="deleteCategory" href="" data-id="<?= $category->id; ?>">Delete</a>
								</td>
							</tr><?
						}
					}
					else
					{ ?>
						<tr>
							<td colspan="6">No categories found</td>
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
	<!-- Modal -->
	<div class="modal fade" id="categorysModal" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body">
					<img class="categoryImage" src="" width="200" height="200"/>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>

</div>
<script type="text/javascript">
	$('.deleteCategory').click(function(e){
		e.preventDefault();
		var id = $(this).attr('data-id');
		Swal.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!',
			allowOutsideClick: false,
			allowEscapeKey: false
		}).then(function(){

			console.log(id);
			$.ajax({
				method: 'GET',
				url: '<?= base_url('categories/delete/'); ?>' + id,
				dataType: 'json'
			})
			.done(function(data){
				if(data.response == 'success')
				{
					Swal.fire(
						'Deleted!',
						'The category was deleted.',
						'success'
					).then(function(){
						window.location.href = '<?= base_url('categories'); ?>';
					}).catch(swal.noop);
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

		}).catch(swal.noop);
	});
	$('.openModal').click(function(){
		var id = $(this).attr('data-id');
		$.ajax({
			method: 'GET',
			url: '<?= base_url('categories/view/'); ?>' + id,
			dataType: 'json'
		})
		.done(function(data){
			if(data.response === 'success')
			{
				console.log(data.result.name);
				$('.modal-title').html(data.result.name);
				$('.categoryImage').attr('src', data.result.photo);
			}
			else
			{
				Swal.fire({
					type: 'error',
					title: 'Oops...',
					html: data.message
				}).catch(swal.noop);
			}

			});
		$('#categorysModal').modal('show');
	});

</script>
<!-- Menu Toggle Script -->
<script>
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});
</script>
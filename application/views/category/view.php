<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="<?php echo base_url() ?>admin">Dashboard</a></li>
		<li class="breadcrumb-item active">Category</li>
</ol>

<!-- Example Tables Card -->
<div class="card mb-3">
	<div class="card-header">
			<i class="fa fa-table"></i> Categories <a href="<?=base_url()?>categories/add"><button class="btn btn-primary">+</button></a>
	</div>
	<div class="card-block">
			<div class="table-responsive">
					<table class="table table-bordered" width="100%" id="dataTable" cellspacing="0">
							<thead>
									<tr>
											<th>No</th>
											<th>Name</th>
											<th>Image</th>
											<th>Action</th> 
									</tr>
							</thead>
							<tfoot>
									<tr>
											<th>No</th>
											<th>Name</th>
											<th>Image</th>
											<th>Action</th> 
									</tr>
							</tfoot>
							<tbody>
									<?php foreach($categories as $k => $v):?>
										<tr>
											<td><?php echo $k+1 ?></td>
											<td><?php echo $v->category ?></td>
											<td><img src="<?php echo $v->imageUrl ?>" width="100" class="img-responsive"></td>
											<td>
												<a href="<?php echo base_url() ?>categories/edit/<?php echo $v->id ?>" class="btn btn-sm btn-primary">Edit</a>
												<a href="<?php echo base_url() ?>categories/remove/<?php echo $v->id ?>" class="btn btn-sm btn-danger">Remove</a>
											</td>
										</tr>
									<?php endforeach;?>
							</tbody>
					</table>
			</div>
	</div> 
</div>

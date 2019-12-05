<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="<?php echo base_url() ?>admin">Dashboard</a></li>
		<li class="breadcrumb-item active">Users</li>
</ol>

<!-- Example Tables Card -->
<div class="card mb-3">
	<div class="card-header">
			<i class="fa fa-table"></i> Users
			<!-- <a href="<?=base_url()?>categories/add"><button class="btn btn-primary">+</button></a> -->
	</div>
	<div class="card-block">
			<div class="table-responsive">
					<table class="table table-bordered" width="100%" id="dataTable" cellspacing="0">
							<thead>
									<tr>
											<th>No</th>
											<th>Image</th>
											<th>Name</th>
											<th>Email</th>
											<th>Last Login</th>
											<th>Action</th>
									</tr>
							</thead>
							<tfoot>
									<tr>
											<th>No</th>
											<th>Image</th>
											<th>Name</th>
											<th>Email</th>
											<th>Last Login</th>
											<th>Action</th>
									</tr>
							</tfoot>
							<tbody>
									<?php foreach($users as $k => $v):?>
										<tr>
											<td><?php echo $k+1 ?></td>
											<td><img src="<?php echo $v->imageUrl ?>" alt="" width="100" class="img-responsive"></td>
											<td><?php echo $v->name ?></td>
											<td><?php echo $v->email ?></td>
											<td><?php echo getDateFormatFull($v->last_login) ?></td>
											<td>
												<?php $url = ($v->removeAt == 0) ? 'users/banned/' : 'users/unbanned/' ?>
												<a href="<?php echo base_url().$url.$v->id ?>" class="btn btn-sm btn-<?php echo ($v->removeAt == 0) ? 'warning' : 'success' ?>">
													<?php if($v->removeAt == 0): ?>
														<i class="fa fa-ban"></i>
													<?php else: ?>
															<i class="fa fa-check"></i>
													<?php endif; ?>
												</a>
												<a href="<?php echo base_url().'users/remove/'.$v->id ?>" class="btn btn-sm btn-danger">
													<i class="fa fa-trash"></i>
												</a>
											</td>
										</tr>
									<?php endforeach;?>
							</tbody>
					</table>
			</div>
	</div> 
</div>

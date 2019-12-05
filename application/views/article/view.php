<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="<?php echo base_url() ?>admin">Dashboard</a></li>
		<li class="breadcrumb-item active">Articles</li>
</ol>

<!-- Example Tables Card -->
<div class="card mb-3">
	<div class="card-header">
			<i class="fa fa-table"></i> Articles <a href="<?=base_url()?>articles/add"><button class="btn btn-primary">+</button></a>
	</div>
	<div class="card-block">
			<div class="table-responsive">
					<table class="table table-bordered" width="100%" id="dataTable" cellspacing="0">
							<thead>
									<tr>
											<th>No</th>
											<th>Title</th>
											<th>Contents</th>
											<th>Image</th>
											<th>Video</th>
											<th>Create At</th>
											<th>Type</th>
											<th>Category</th>
											<th>Action</th>
									</tr>
							</thead>
							<tfoot>
									<tr>
											<th>No</th>
											<th>Title</th>
											<th>Contents</th>
											<th>Image</th>
											<th>Video</th>
											<th>Create At</th>
											<th>Type</th>
											<th>Category</th>
											<th>Action</th>
									</tr>
							</tfoot>
							<tbody>
									<?php foreach($articles as $k=>$v): ?>
										<tr>
											<td><?php echo $k+1 ?></td>
											<td><?php echo $v->title ?></td>
											<td><?php echo substr($v->contents, 0, 100).'...' ?></td>
											<td><img src="<?php echo $v->imageUrl ?>" width="100" class="img-responsive"></td>
											<td><a href="<?php echo $v->videoUrl ?>"><?php echo $v->videoUrl ?></a></td>
											<td><?php echo getDateFormatFull($v->createAt) ?></td>
											<td><?php echo ($v->type == 0) ? 'Standart' : 'Video' ?></td>
											<td><?php echo $v->category ?></td>
											<td>
												<a href="<?php echo base_url().'articles/edit/'.$v->id ?>" class="btn btn-sm btn-primary">
													<i class="fa fa-pencil"></i>
												</a>
												<a href="<?php echo base_url().'articles/remove/'.$v->id ?>" class="btn btn-sm btn-danger">
													<i class="fa fa-trash"></i>
												</a>
											</td>
										</tr>
									<?php endforeach; ?>
							</tbody>
					</table>
			</div>
	</div> 
</div>

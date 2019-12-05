<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
		<li class="breadcrumb-item active">My Dashboard</li>
</ol>

<!-- Icon Cards -->
<div class="row">
	<div class="col-xl-3 col-sm-6 mb-3">
			<div class="card card-inverse card-primary o-hidden h-100">
					<div class="card-block">
							<div class="card-block-icon">
									<i class="fa fa-fw fa-comments"></i>
							</div>
							<div class="mr-5">
									<?php echo $data['articleCount'] ?> Articles
							</div>
					</div>
					<a href="<?php echo base_url() ?>articles" class="card-footer clearfix small z-1">
							<span class="float-left">View Details</span>
							<span class="float-right"><i class="fa fa-angle-right"></i></span>
					</a>
			</div>
	</div>
	<div class="col-xl-3 col-sm-6 mb-3">
			<div class="card card-inverse card-success o-hidden h-100">
					<div class="card-block">
							<div class="card-block-icon">
									<i class="fa fa-fw fa-list"></i>
							</div>
							<div class="mr-5">
									<?php echo $data['categoryCount'] ?> Category
							</div>
					</div>
					<a href="<?php echo base_url() ?>categories" class="card-footer clearfix small z-1">
							<span class="float-left">View Details</span>
							<span class="float-right"><i class="fa fa-angle-right"></i></span>
					</a>
			</div>
	</div>
	<div class="col-xl-3 col-sm-6 mb-3">
			<div class="card card-inverse card-warning o-hidden h-100">
					<div class="card-block">
							<div class="card-block-icon">
									<i class="fa fa-fw fa-user"></i>
							</div>
							<div class="mr-5">
									<?php echo $data['usersCount']?> Users
							</div>
					</div>
					<a href="<?php echo base_url() ?>users" class="card-footer clearfix small z-1">
							<span class="float-left">View Details</span>
							<span class="float-right"><i class="fa fa-angle-right"></i></span>
					</a>
			</div>
	</div>
</div>

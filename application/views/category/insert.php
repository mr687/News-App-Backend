<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="<?=base_url()?>admin">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="<?=base_url()?>categories">Categories</a></li>
		<li class="breadcrumb-item active">Add Category</li>
</ol>


<?php if(isset($category)): ?>
	<?php echo form_open_multipart(base_url().'categories/update'); ?>
	<input type="hidden" name="id" value="<?php echo $category->id ?>">
<?php else: ?>
	<?php echo form_open_multipart(base_url().'categories/insert'); ?>
<?php endif; ?>
		<div class="form-group row">
			<label for="example-text-input" class="col-2 col-form-label">Category Name</label>
			<div class="col-10">
				<input class="form-control" type="text" required="" name="category" value="<?php echo (isset($category)) ? $category->category : "" ?>">
			</div>
		</div>
		<div class="form-group row">
			<label for="example-text-input" class="col-2 col-form-label">Image (max : 1 MB)</label>
			<div class="col-10">
				<input class="form-control" type="file" value="" placeholder="" name="image">
			</div>
		</div> 
		<div class="form-group row"> 
			<div class="col-10">
				<input type="submit" class="btn btn-primary">
			</div>
		</div> 
		

</form>

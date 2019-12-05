<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="<?=base_url()?>admin">Dashboard</a></li>
		<li class="breadcrumb-item"><a href="<?=base_url()?>articles">Articles</a></li>
		<li class="breadcrumb-item active">Add Article</li>
</ol>


	<?php echo form_open_multipart(base_url().'articles/update'); ?>
		<input type="hidden" name="id" value="<?php echo $article->id ?>">
		<div class="form-group row">
			<label for="example-text-input" class="col-2 col-form-label">Title</label>
			<div class="col-10">
				<input class="form-control" type="text" required="" name="title" value="<?php echo $article->title ?>">
			</div>
		</div>
		<div class="form-group row">
			<label for="example-text-input" class="col-2 col-form-label">Category</label>
			<div class="col-10">
				<select class="form-control" required="" name="category_id">
					<option value="">--Select Category--</option>
					<?php foreach($categories as $k => $v): ?>
						<option value="<?php echo $v->id ?>" <?php echo ($article->category_id == $v->id) ? 'selected=""' : '' ?> ><?php echo $v->category ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
		<div class="form-group row">
			<label for="example-text-input" class="col-2 col-form-label">Article type</label>
			<div class="col-10">
				<select id="type" class="form-control" name="type">
					<option value="0" <?php echo ($article->type == 0) ? 'selected=""' : '' ?> >Standart</option>
					<option value="1" <?php echo ($article->type == 1) ? 'selected=""' : '' ?> >Video Youtube</option>
					<option value="2" <?php echo ($article->type == 2) ? 'selected=""' : '' ?> >Video Upload</option>
				</select>
			</div>
		</div>
		<div id="standart" class="form-group row">
			<label for="example-text-input" class="col-2 col-form-label">Image</label>
			<div class="col-10">
				<input class="form-control" type="file" name="image" accept="image/jpg, image/png">
			</div>
		</div>
		<div id="youtube" class="form-group row">
			<label for="example-text-input" class="col-2 col-form-label">Video</label>
			<div class="col-10">
				<input class="form-control" type="text" placeholder="https://www.youtube.com/watch?v=xxxx" name="videoUrl">
			</div>
		</div>
		<div id="videoUpload" class="form-group row">
			<label for="example-text-input" class="col-2 col-form-label">Video</label>
			<div class="col-10">
				<input class="form-control" type="file" name="video" accept="video/*">
			</div>
		</div>
		<div class="form-group row">
			<label for="example-text-input" class="col-2 col-form-label">Contents</label>
			<div class="col-10">
				<textarea name="contents" class="form-control"><?php echo $article->contents ?></textarea>
			</div>
		</div>
		<div class="form-group row"> 
			<div class="col-10">
				<button type="submit" class="btn btn-primary">Change</button>
			</div>
		</div> 
</form>

<script>
	CKEDITOR.replace("contents");

	$(document).ready(function(){
		$("#standart").show();
		$("#youtube").hide();
		$("#videoUpload").hide();
		$('#type').on('change', function(){
			var type = $(this).val();
			if(type == 0){
				$("#standart").show();
				$("#youtube").hide();
				$("#videoUpload").hide();
			}
			else if(type == 1){
				$("#standart").hide();
				$("#youtube").show();
				$("#videoUpload").hide();
			}
			else if(type == 2){
				$("#standart").hide();
				$("#youtube").hide();
				$("#videoUpload").show();
			}
		});
	});
</script>

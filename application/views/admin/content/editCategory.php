

<div class="content-wrapper">
	<div class="row">
		<div class="col-md-6 col-md-offset-1" style="margin-top: 100px;">
			<h1>Edit your category</h1>
			<?php echo checkFlash();?>
			<?php echo form_open_multipart('admin/updateCategory');
			?>
				<div class="form-group">
					<?php
						$input = array(
								'name'=>'catName',
								'class'=>'form-control',
								'id'=>'catName',
								'placeholder'=>'Enter your Category Name',
								'value'=>$category[0]['catName']
							 );
						echo form_input($input);
					?>
				</div>
				<div class="form-group">
					<input type="file" name="catgoryImage" class="">
					<input type="hidden" name="oldimg" value="<?php echo $this->encrypt->encode($category[0]['catImage']); ?>">
					<input type="hidden" name="oldid" value="<?php echo $this->encrypt->encode($category[0]['cat_id']); ?>">
				</div>
				<?php?>
				<div class="form-group">
					<?php
						echo form_submit('Addcategory','Edit Category',array('class'=>'btn btn-primary'));
					?>
				</div>

			<?php echo form_close();?>
		</div>
		<div class="col-md-4" style="margin-top: 100px;">
			<img src="<?php echo base_url('assets/images/categories/'.$category[0]['catImage']); ?>" class="img-responsive">
		</div>		
	</div>
</div>
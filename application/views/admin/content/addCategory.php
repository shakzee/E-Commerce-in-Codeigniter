

<div class="content-wrapper">
	<div class="row">
		<div class="col-md-8 col-md-offset-1">
			<h1>Please Add your category</h1>
			<?php echo checkFlash();?>
			<?php echo form_open_multipart('admin/addCategory');
			?>
				<div class="form-group">
					<?php
						$input = array(
								'name'=>'catName',
								'class'=>'form-control',
								'id'=>'catName',
								'placeholder'=>'Enter your Category Name'
							 );
						echo form_input($input);
					?>
				</div>
				<div class="form-group">
					<input type="file" name="catgoryImage" class="">
				</div>
				<?php?>
				<div class="form-group">
					<?php
						echo form_submit('Addcategory','Add Category',array('class'=>'btn btn-primary'));
					?>
				</div>

			<?php echo form_close();?>
		</div>		
	</div>
</div>
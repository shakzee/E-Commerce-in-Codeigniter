<div class="content-wrapper">
		<div class="row" >
			<div class="col-md-6 col-md-offset-1" style="margin-top: 100px;">
			<?php echo checkFlash();?>
			<?php echo form_open_multipart('admin/addProduct'); ?>
				<div class="form-group">
					<?php 
						$options = array();
						foreach ($categories->result() as $category) {
							$options[$category->cat_id] = $category->catName; 
						}
						echo form_dropdown('category',$options,'',array('class'=>"form-control"));
						?>
				</div>

				<div class="form-group">
					<?php
						$productName = array(
								'name'=>'productName',
								'class'=>'form-control',
								'id'=>'catName',
								'placeholder'=>'Enter your product Name'
							 );
						echo form_input($productName);
					?>
				</div>
				<div class="form-group">
					<?php
						$company = array(
								'name'=>'company',
								'class'=>'form-control',
								'id'=>'catName',
								'placeholder'=>'Enter Company Name'
							 );
						echo form_input($company);
					?>
				</div>
				<div class="form-group">
					<input type="file" name="productImage" class="">
				</div>
				<?php?>
				<div class="form-group">
					<?php
						echo form_submit('AddProduct','Add Product',array('class'=>'btn btn-primary'));
					?>
				</div>

			<?php echo form_close();?>
			</div>
		</div>
</div>
<div class="content-wrapper">
		<div class="row" >
			<div class="col-md-6 col-md-offset-1" style="margin-top: 100px;">
			<?php echo checkFlash();?>
			<?php echo form_open_multipart('admin/updateProduct'); ?>
				<div class="form-group">
					<?php 
						$options = array();
						foreach ($categories->result() as $category) {
							$options[$category->cat_id] = $category->catName; 
						}
						echo form_dropdown('category',$options,$products[0]['catId'],array('class'=>"form-control"));
						?>
				</div>
				<input type="hidden" name="oldimg" value="<?php echo $this->encrypt->encode($products[0]['productImage']);?>">
				<input type="hidden" name="oldid" value="<?php echo $this->encrypt->encode($products[0]['pId']);?>">

				<div class="form-group">
					<?php
						$productName = array(
								'name'=>'productName',
								'class'=>'form-control',
								'id'=>'catName',
								'placeholder'=>'Enter your product Name',
								'value'=>$products[0]['productName']
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
								'placeholder'=>'Enter Company Name',
								'value'=>$products[0]['ProductCompany']
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
						echo form_submit('updateProduct','Update Product',array('class'=>'btn btn-primary'));
					?>
				</div>

			<?php echo form_close();?>
			</div>
			<div class="col-md-4" style="margin-top: 100px;">
				<img src="<?php echo base_url('assets/images/products/'.$products[0]['productImage'])?>" alt="" class="img-responsive">
			</div>
		</div>
</div>
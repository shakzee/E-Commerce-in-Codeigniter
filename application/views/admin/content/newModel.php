<div class="content-wrapper">
		<div class="row" >
			<div class="col-md-6 col-md-offset-1" style="margin-top: 100px;">
			<?php echo checkFlash();?>
			<?php echo form_open_multipart('admin/addModel'); ?>
				<div class="form-group">
					<input type="text" name="" id="q_3_t">
					<div class="show_tags"></div>
				</div>
				<div class="form-group">
					<div class="tag_fed" id="tag_fed"></div>
				</div>
				<div class="form-group">
					<?php
						echo form_submit('AddModel','Add Model',array('class'=>'btn btn-primary'));
					?>
				</div>

			<?php echo form_close();?>
			</div>
		</div>
</div>
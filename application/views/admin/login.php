

<div class="container" style="margin-top: 100px;">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<?php echo checkFlash()?>
			<form action="<?php echo site_url('admin/checkAdmin')?>" method="post">
				<div class="form-group">
					<input type="text" name="email" placeholder="Enter Your Email" class="form-control">
				</div>
				<div class="form-group">
					<input type="password" name="password" placeholder="Enter Your Password" class="form-control">
				</div>
				<div class="form-group">
					<button class="btn btn-primary" type="submit">Sigin</button>
				</div>
			</form>
		</div>
	</div>
</div>
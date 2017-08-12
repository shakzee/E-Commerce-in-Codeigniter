

<div class="content-wrapper">
	<div class="row">
		<div class="col-md-8 col-md-offset-1">
			<h1>all Categories</h1>
			<?php checkFlash()?>
			<?php if($allCategories): ?>
				<table class="table table-bordered">
					<th>ID</th>
					<th>name</th>
					<th>date</th>
					<?php
						foreach($allCategories as $category): 
					?>
						<tr>
							<td>
								<?php echo $category->cat_id?>
							</td>
							<td>
								<?php echo $category->catName?>
							</td>
							<td>
								<?php echo $category->catDate?>
							</td>
							<td>
								<a href="" class="btn btn-primary">
									View
								</a>
							</td>
							<td>
								<a href="<?php echo site_url('admin/editCategory/'.$category->cat_id)?>" class="btn btn-primary">
									Edit
								</a>
							</td>
							<td>
								<a href="" class="btn btn-primary">
									Delete
								</a>
							</td>

						</tr>
					<?php endforeach; ?>
				</table>
				<?php echo $links;?>
			<?php else: ?>
				not found.
			<?php endif; ?>
		</div>		
	</div>
</div>

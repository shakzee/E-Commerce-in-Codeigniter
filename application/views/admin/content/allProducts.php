

<div class="content-wrapper">
	<div class="row">
		<div class="col-md-8 col-md-offset-1">
			<h1>All products</h1>
			<?php checkFlash()?>
			<?php if($allProducts): ?>
				<table class="table table-bordered">
					<th>ID</th>
					<th>product Name</th>
					<th>Company</th>
					<th>date</th>
					<?php
						foreach($allProducts as $product): 
					?>
						<tr>
							<td>
								<?php echo $product->pId?>
							</td>
							<td>
								<?php echo $product->productName?>
							</td>
							<td>
								<?php echo $product->ProductCompany?>
							</td>
							<td>
								<?php echo $product->productDate?>
							</td>
							<td>
								<a href="" class="btn btn-primary">
									View
								</a>
							</td>
							<td>
								<a href="<?php echo site_url('admin/editProduct/'.$product->pId)?>" class="btn btn-primary">
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

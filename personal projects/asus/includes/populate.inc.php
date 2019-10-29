<?php
if ($result):
	if (mysqli_num_rows($result) > 0):
		while ($product = mysqli_fetch_assoc($result)):
		?>
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 categories"> 
				<form method="POST" action="product.php?id=<?php echo $product['product_id']; ?>" class="form-border">
					<button type="submit" name="submit" class="img-button">
						<img src="<?php echo "products/" . $product['product_category'] . "/" . $product['product_image']; ?>" class="img-responsive" />
						<p class="text-info"><?php echo $product['product_name']; ?></p>
					</button>
					<p class="price">£<?php echo $product['product_price']; ?></p>
				</form>					
			</div>				
		<?php
		endwhile;
	endif;
endif;
?>
<?php
	session_start();
	
	// Prevent resubmission on page return (back button)
	header("Cache-Control: no cache");
	session_cache_limiter("private_no_expire");

	include "header.php";	
	include "includes/dbh.inc.php";
			
	$id = $_GET['id'];
	$query = "SELECT * FROM products WHERE product_id='$id'";
	$result = mysqli_query($conn, $query);
	if ($result){
		if (mysqli_num_rows($result) > 0){ /* If the data actually exists */
			if ($product = mysqli_fetch_assoc($result)){
				$name = $product['product_name'];
				$description = $product['product_description']; 
				$category = $product['product_category']; 
				$type = $product['product_type'];
				$image = $product['product_image'];
				$price = $product['product_price'];
			}
		} else{
			header("Location: index.php?product=error");
			exit();
		}
	} else{
		header("Location: index.php?product=error");
		exit();
	}		
	 
?>

<div class="products">
	<div class="path"> 
		<div class="path-location">
			<a href="index.php">Home</a> / <a href="<?php echo $category; ?>.php"><?php echo ucfirst($category); ?></a> / <?php echo $name; ?>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<!-- Product Image -->
				<img src="<?php echo "products/" . $category . "/" . $image; ?>" class="img-responsive" />		
			</div>
			
			<div class="col-sm-6 product-info">
				<form name="frm-product" method="POST" action="basket.php?action=add&id=<?php echo $id; ?>" onsubmit="return submitForm();">
					<h1 class="product-title"><?php echo $name; ?></h1>
					<p class="text-elements product-type">Product Category: <?php echo ucfirst($category); ?> </p>
					<p class="text-elements product-type">Product Series: <?php echo ucfirst($type); ?> </p>
					<p class="product-dsc text-elements"><?php echo $description; ?> </p>	
					<p class="product-price price">£<?php echo $price; ?> </p>			
					
					<input id="frm-quantity" type="text" name="quantity" class="product-input form-control" value="1" onkeydown="return removeStyle();"/>
					<span class="product-remove product-hidden">The maximum quantity is 10</span>
					
					<input type="hidden" name="name" value="<?php echo $name; ?>" />
					<input type="hidden" name="price" value="<?php echo $price; ?>" />
					<input type="hidden" name="category" value="<?php echo $category; ?>" />
					<input type="hidden" name="image" value="<?php echo $image; ?>" />
					<input type="submit" name="submit" class="product-btn product-input" value="Add to Cart" />
				</form>
			</div>
		
		</div>
	</div>

	<?php
		include "footer.php"
	?>
</div>
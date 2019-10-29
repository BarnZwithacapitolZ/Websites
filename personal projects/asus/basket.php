<?php	
	session_start();

	$all_product_ids = array();
	//session_destroy();
	
	// Check if add to cart button has been submitted
	if (filter_input(INPUT_POST, 'submit')){
		if (isset($_SESSION['shopping-cart'])){
			// Keep track of No. products in shopping cart
			$count = count($_SESSION['shopping-cart']);
			
			//Create sequencial array for matching array keys to products id's
			$all_product_ids = array_column($_SESSION['shopping-cart'], 'id');		
			
			if (!in_array(filter_input(INPUT_GET, 'id'), $all_product_ids)){
				$_SESSION['shopping-cart'][$count] = array(
					'id' => filter_input(INPUT_GET, 'id'),
					'name' => filter_input(INPUT_POST, 'name'),
					'price' => filter_input(INPUT_POST, 'price'),
					'quantity' => filter_input(INPUT_POST, 'quantity'),
					'category' => filter_input(INPUT_POST, 'category'),
					'image' => filter_input(INPUT_POST, 'image')	
				);				
			} else{ // Product already exists, increase quanitity
				// Match array key to id of the product being added to the cart
				for ($i = 0; $i < count($all_product_ids); $i++){
					if ($all_product_ids[$i] == filter_input(INPUT_GET, 'id')){
						// Add item quanitity to the existing product in the array
						$_SESSION['shopping-cart'][$i]['quantity'] += filter_input(INPUT_POST, 'quantity');			
					}
				}
			}
		} else{ // If cart doesnt exists, create one with array key 0
			// Create array using submitted form data
			$_SESSION['shopping-cart'][0] = array(
				'id' => filter_input(INPUT_GET, 'id'),
				'name' => filter_input(INPUT_POST, 'name'),
				'price' => filter_input(INPUT_POST, 'price'),
				'quantity' => filter_input(INPUT_POST, 'quantity'),
				'category' => filter_input(INPUT_POST, 'category'),
				'image' => filter_input(INPUT_POST, 'image')	
			);
		}
	}
	
	if (filter_input(INPUT_GET, 'action') == 'delete'){
		// Loop through all products in session shopping cart until matches with get id\
		foreach ($_SESSION['shopping-cart'] as $key => $product){
			if ($product['id'] == filter_input(INPUT_GET, 'id')){
				unset($_SESSION['shopping-cart'][$key]); // Remove product
			}
		}
		// Reset session array keys so they match product id's numeric array
		$_SESSION['shopping-cart'] = array_values($_SESSION['shopping-cart']);
	}
	
	//pre_r($_SESSION);
	
	function pre_r($array){
		echo '<pre>';
		print_r($array);
		echo '</pre>';
	}
	
	include "header.php";
?>

<div class="products">
	<div class="path"> 
		<div class="path-location">
			<a href="index.php">Home</a> / Basket
		</div>
	</div>
	<div class="container">
		<?php
			if(!empty($_SESSION['shopping-cart'])):  
			$total = 0;  
		?>
		<h1 class="product-title product-info">Order Summary</h1>
		<div class="table-responsive">					
			<table class="table">
				<tr>  
					<th width="20%">Product Image</th>  
					<th width="35%">Product Name</th>  
					<th width="10%">Quantity</th>  
					<th width="20%">Price</th>  
					<th width="15%">Total</th>   
				</tr> 
				<?php			
					foreach($_SESSION['shopping-cart'] as $key => $product): 		
				?>
				<tr>  
					<td><img src="<?php echo "products/" . $product['category'] . "/" . $product['image']; ?>" width="125px" height="auto" /></td>  
					<td>
						<?php echo $product['name']; ?>
						<a href="product.php?id=<?php echo $product['id']; ?>">
							<div class="text-elements signup"><img src="img/plus.png" width="12.5px" height="12.5px" /> Buy Again</div>
						</a>
					</td>  
					<td>
						<?php echo $product['quantity']; ?>
						<a href="basket.php?action=delete&id=<?php echo $product['id']; ?>">
							<div class="text-elements product-remove"><img src="img/bin.png" width="12.5px" height="12.5px" /> Remove</div>
						</a>
					</td>  
					<td class="signup">£<?php echo $product['price']; ?></td>  
					<td class="signup">£<?php echo number_format($product['quantity'] * $product['price'], 2); ?></td>  
				</tr> 
				<?php  
						$total = $total + ($product['quantity'] * $product['price']);  
					endforeach;  
				?>
				<tr>  
					<td colspan="4" align="right">Products</td>  
					<td colspan="1"><?php echo count($_SESSION['shopping-cart']); ?></td>  
				</tr>
				
				<tr>  
					<td colspan="4" align="right">Total</td>  
					<td colspan="1" class="signup">£<?php echo number_format($total, 2); ?></td>  
			
				</tr>
	
			</table> 			
		</div>
		
		<?php 
			if (isset($_SESSION['shopping-cart'])):
				if (count($_SESSION['shopping-cart']) > 0):
					if (isset($_SESSION['u_id'])):
					?>
						<a href="#" class="button">Checkout</a>
					<?php 	
					else:
					?>
						<a href="signin.php" class="button">Sign In to checkout</a>
					<?php
					endif;
				endif; 
			endif; 
		?>
		<?php  
			else:
		?>
		<div class="basket-left">
			<h1 class="product-title product-info">Your shopping cart is empty</h1>
			<p class="text-elements left">You currently have no items in your shopping cart.</p>
			<p class="text-elements left">Use the navbar above to select a category.</p>
			<a href="index.php" class="button left">Start Shopping</a>
		</div>
		<?php
			endif;
		?>
	</div>

	<?php
		include "footer.php";
	?>
</div>
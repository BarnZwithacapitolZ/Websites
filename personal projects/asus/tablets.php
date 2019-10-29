<?php
	session_start();
	include "header.php";
?>
<div class="products">
	<div class="path"> 
		<div class="path-location"><a href="index.php">Home</a> / <a href="tablets.php">Tablets</a></div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 filter">
				<ul>
					<li class="first">Tablets</li>
					<a href="notebooks.php"><li>+ Notebooks</li></a>
					<a href="components.php"><li>+ Components</li></a>
					<a href="peripherals.php"><li>+ Peripherals</li></a>
					<a href="phones.php"><li>+ Phones</li></a>
				</ul>
				
				<ul>
					<li class="first">Filter</li>
					<a href="tablets.php?type=zenpad"><li>+ ZenPad</li></a>
					<a href="tablets.php"><li>Reset Filter</li></a>
				</ul>
			</div>
		
			<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 equal">
			<?php
				include "includes/dbh.inc.php";	
				
				if (isset($_GET['type'])){
					$sortType = $_GET['type'];
					$query = "SELECT * FROM products WHERE product_category='tablets' AND product_type='$sortType' ORDER by product_id ASC";
				} else{
					$query = "SELECT * FROM products WHERE product_category='tablets' ORDER by product_id ASC";
				}
				
				$result = mysqli_query($conn, $query);	
				
				include "includes/populate.inc.php";
			?>
			</div>
		</div>
	</div>

	<?php
		include "footer.php";
	?>
</div>
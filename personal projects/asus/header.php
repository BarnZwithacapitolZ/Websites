<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Asus</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="scripts/style.css?version=14" />
		
	</head>
	
	<body>
		<header>
			<nav>
				<div class="inner-header">
					<div class="nav-main">
						<a href="index.php" class="logo"></a>
						<ul>	
							<li class="hide-small"><a href="notebooks.php">Notebooks</a></li>
							<li class="hide-small"><a href="tablets.php">Tablets</a></li>
							<li class="hide-small"><a href="components.php">Components</a></li>
							<li class="hide-small"><a href="peripherals.php">Peripherals</a></li>
							<li class="hide-small"><a href="phones.php">Phones</a></li>
						</ul>
					</div>
					
					<div class="nav-sub">
						<ul>		
							<li class="hide-small">		
								<?php
									if (isset($_SESSION['u_id'])){
										echo '<a href="includes/signout.inc.php"><img src="img/sign_in.png" width="12.5px" height="12.5px" /> Sign out</a>';
									} else{
										echo '<a href="signin.php"><img src="img/sign_in.png" width="12.5px" height="12.5px" /> Sign In</a>';
									}
								?>	
							</li>

							<li>
								<?php
									if (isset($_SESSION['shopping-cart'])):
								?>	
									<a href="basket.php"><img src="img/cart.png" width="10px" height="10px" /> (<?php echo count($_SESSION['shopping-cart']); ?>)</a>
								<?php
									else:	
								?>
									<a href="basket.php"><img src="img/cart.png" width="10px" height="10px" /> (0)</a>
								<?php
									endif;
								?>
								
							</li>
							
							<li class="show-small open-nav">
								<div class="line"></div>
								<div class="line"></div>
								<div class="line"></div>
							</li>
						</ul>
					</div>
				</div>
			</nav>	
		</header>
		
		<div class="header-spacer"> </div>
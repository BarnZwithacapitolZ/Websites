

<div class="top-nav">
	<div class="container">
		<ul class="fade-nav">
			<a href="notebooks.php"><li>Notebooks</li></a>
			<a href="tablets.php"><li>Tablets</li></a>
			<a href="components.php"><li>Components</li></a>
			<a href="peripherals.php"><li>Peripherals</li></a>
			<a href="phones.php"><li>Phones</li></a>
			<?php
				if (isset($_SESSION['u_id'])){
					echo '<a href="includes/signout.inc.php"><li><img src="img/sign_in.png" width="12.5px" height="12.5px" /> Sign Out</li></a>';
				} else{
					echo '<a href="signin.php"><li><img src="img/sign_in.png" width="12.5px" height="12.5px" /> Sign In</li></a>';
				}
			?>
		</ul>
		
		<!--<div class="social">		
			<a href="https://www.facebook.com/mustbenice2/" target="_blank"><img src="img/icons/facebook.png" /></a>
			<a href="https://www.instagram.com/ripndip/?hl=en" target="_blank"><img src="img/icons/instagram.png" /></a>
			<a href="https://twitter.com/RIPNDIP" target="_blank"><img src="img/icons/twitter.png" /></a>
			<div class="titles">Show product Titles</div>
		</div>-->
	</div>
</div>

<div class="scrollToTop"><span>TOP</span></div>


<footer>
	<nav>
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
					<ul>
						<li class="first">Shop Catagories</li>
						<a href="notebooks.php"><li>Notebooks</li></a>
						<a href="tablets.php"><li>Tablets</li></a>
						<a href="components.php"><li>Components</li></a>
						<a href="peripherals.php"><li>Peripherals</li></a>
						<a href="phones.php"><li>Phones</li></a>
					</ul>
				</div>
				<div class="col-sm-4">
					<ul>
						<li class="first">Customer Service</li>
						<a href="####"><li>Delivery and returns</li></a>
						<a href="####"><li>FAQs</li></a>
						<a href="####"><li>Contact Us</li></a>
					</ul>
				</div>
				
				<div class="col-sm-4">
					<ul>
						<li class="first">Stay Connected</li>
						<a href="https://www.facebook.com/asus.uk/" target="_blank"><li><img src="img/facebook.png" width="10px" height="10px" /> Facebook</li></a>
						<a href="https://twitter.com/asusuk" target="_blank"><li><img src="img/twitter.png" width="10px" height="10px" /> Twitter</li></a>
						<a href="#https://www.instagram.com/asusuk/" target="_blank"><li><img src="img/instagram.png" width="10px" height="10px" /> Instagram</li></a>
						<a href="https://www.youtube.com/user/asusuk" target="_blank"><li><img src="img/youtube.png" width="10px" height="10px" /> Youtube</li></a>
					</ul>
				</div>
			</div>	
		</div>	
		<div class="footer-message">
			<p>© 2018 ASUSTeK Computer Inc. All rights reserved. Powered by Laptop Outlet Ltd, an ASUS - Authorised Independent Reseller1.<br />
Laptop Outlet Ltd acts as a broker and offers credit from PayPal Credit. PayPal Credit is a trading name of PayPal (Europe) S.à.r.l. et Cie, S.C.A., 22-24 Boulevard Royal L-2449, Luxembourg.</p>
		</div>
	</nav>
</footer>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="scripts/javascript.js?version=4"></script>
</body>
</html>
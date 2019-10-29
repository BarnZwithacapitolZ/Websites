<?php 
	session_start();
	include "header.php";
?>

<div class="container">
	<div class="row">
		<div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4">
			<h4 class="text-elements">Forgotten password</h4>
			<p class="text-elements">Enter your email and a new password, so we can reset it for you.</p>
			
			<?php
				if (isset($_GET['reset']) && $_GET['reset'] == 'empty'){
						echo '<p class="text-elements failed">Please fill out all the fields.</p>';
					} elseif (isset($_GET['reset']) && $_GET['reset'] == 'nouser'){
						echo '<p class="text-elements failed">No user exists under that Email.</p>';
					} elseif (isset($_GET['reset']) && $_GET['reset'] == 'unequal'){
						echo '<p class="text-elements failed">Ensure you re-type the password correctly.</p>';
					}
			?>
		
		
			<form class="sign-in-form" action="includes/reset.inc.php" method="POST">
				<input type="text" name="email" placeholder="Email">
				<input type="password" name="pwd" placeholder="New password">
				<input type="password" name="confirmPwd" placeholder="Confirm new password">
				<button type="submit" name="submit">Reset</button>
			</form>
			
			<p class="text-elements">or</p>
			<p class="text-elements"><a href="signin.php" class="signup">Cancel</a></p>
		</div>	
	</div>
</div>

<?php
	include "footer.php";
?>
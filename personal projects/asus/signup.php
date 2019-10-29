<?php
	session_start();
	include "header.php"
?>

<div class="container">
	<div class="row">
		<div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4">

			<h4 class="text-elements">Create Asus account</h4>
			<p class="text-elements">Fill out the following fields.</p>
			
			<?php 
				if (isset($_GET['signup']) && $_GET['signup'] == 'empty'){
					echo '<p class="text-elements failed">Please fill out all the fields.</p>';
				} elseif (isset($_GET['signup']) && $_GET['signup'] == 'usertaken'){
					echo '<p class="text-elements failed">This user account is already taken.</p>';
				} elseif (isset($_GET['signup']) && $_GET['signup'] == 'email'){
					echo '<p class="text-elements failed">Please enter a valid Email.</p>';
				} elseif (isset($_GET['signup']) && $_GET['signup'] == 'invalid'){
					echo '<p class="text-elements failed">Please enter a valid Firstname & Lastname.</p>';
				} elseif (isset($_GET['signup']) && $_GET['signup'] == 'unequal'){
					echo '<p class="text-elements failed">Ensure you re-type the password correctly.</p>';
				}
			?>
			
			<form class="sign-in-form" action="includes/signup.inc.php" method="POST">
				<input type="text" name="email" placeholder="Email">
				<input type="text" name="first" placeholder="Firstname">
				<input type="text" name="last" placeholder="Lastname">
				<input type="password" name="pwd" placeholder="Password">
				<input type="password" name="confirmPwd" placeholder="Confirm password">
				<button type="submit" name="submit">Create your account</button>
			</form>
			
			<p class="text-elements">or</p>
			<p class="text-elements"><a href="signin.php" class="signup">Cancel</a></p>
		</div>
	</div>
</div>

<?php
	include "footer.php"
?>
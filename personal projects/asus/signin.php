<?php
	session_start();
	include "header.php"
?>

<div class="container">
	<div class="row">
		<div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4">

			<h4 class="text-elements">Sign into Asus</h4>
			<p class="text-elements">You directly enter your ASUS Member account and password to log in.</p>
			
			<?php
				if (isset($_GET['signin']) && $_GET['signin'] == 'empty'){
					echo '<p class="text-elements failed">Please fill out all the fields.</p>';
				} elseif (isset($_GET['signin']) && $_GET['signin'] == 'nouser'){
					echo '<p class="text-elements failed">No user exists under that Email.</p>';
				} elseif (isset($_GET['signin']) && $_GET['signin'] == 'error'){
					echo '<p class="text-elements failed">Please enter a correct Email and Password.</p>';
				}
			?>
		
			<form class="sign-in-form" action="includes/signin.inc.php" method="POST">
				<input type="text" name="email" placeholder="Email">
				<input type="password" name="pwd" placeholder="Password">
				<button type="submit" name="submit">Sign In</button>
			</form>
			
			<p class="text-elements"><a href="reset.php" class="signup">Forgetten password?</a></p>
			<p class="text-elements">or</p>
			<p class="text-elements"><a href="signup.php" class="signup">Sign up for an account</a></p>
		</div>
	</div>
</div>

<?php
	include "footer.php"
?>
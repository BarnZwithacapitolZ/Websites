<?php

session_start();

if (isset($_POST['submit'])){
	include 'dbh.inc.php';
	
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
	
	// Error handlers
	if (empty($email) || empty($pwd)){ //Check if empty
		header("Location: ../signin.php?signin=empty");
		exit();
	} else{
		$sql = "SELECT * FROM users WHERE user_email='$email'";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		if ($resultCheck < 1){ // No results in database
			header("Location: ../signin.php?signin=nouser");
			exit(); 
		} else{
			if ($row = mysqli_fetch_assoc($result)){ // Take all data from database and insert into array called row
				// De-hashing the password
				$hashedPwdCheck = password_verify($pwd, $row['user_pwd']); // if they meet (password and database password) it will return true, else false
				if ($hashedPwdCheck == false){
					header("Location: ../signin.php?signin=error");
					exit(); 
				} elseif ($hashedPwdCheck == true){
					// Login the user
					$_SESSION['u_id'] = $row['user_id'];
					$_SESSION['u_first'] = $row['user_first'];
					$_SESSION['u_last'] = $row['user_last'];
					$_SESSION['u_email'] = $row['user_email'];
					header("Location: ../index.php?signin=success");
					exit(); 
				}
			}
		}
	}
} else{
	header("Location: ../signin.php?signin=error");
	exit(); // Close of the script
}
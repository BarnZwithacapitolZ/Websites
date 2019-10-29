<?php

if (isset($_POST['submit'])){
	include "dbh.inc.php";
	
	// Put POST values into variables
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$first = mysqli_real_escape_string($conn, $_POST['first']); 
	$last = mysqli_real_escape_string($conn, $_POST['last']); 
	$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
	$confirmPwd = mysqli_real_escape_string($conn, $_POST['confirmPwd']);
	
	// Check if empty
	if (empty($email) || empty($first) || empty($last) || empty($pwd) || empty($confirmPwd)){ 
		header("Location: ../signup.php?signup=empty");
		exit(); // stop else from running if error
	} else{
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)){ 
			header("Location: ../signup.php?signup=email");
			exit(); 
		} else{
			if (!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)){ // Check includes right letters
				header("Location: ../signup.php?signup=invalid");
				exit(); 
			} else{
				if ($pwd !== $confirmPwd){
					header("Location: ../signup.php?signup=unequal");
					exit(); 
				} else{
				
					$sql = "SELECT * FROM users WHERE user_email='$email'"; 
					$result = mysqli_query($conn, $sql); 
					$resultCheck = mysqli_num_rows($result); 
					
					if ($resultCheck > 0){ // User already exists
						header("Location: ../signup.php?signup=usertaken");
						exit();
					} else{
						$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT); // Encrypt
						// Insert the user into the databse
						$sql = "INSERT INTO users (user_first, user_last,
							user_email, user_pwd) VALUES ('$first', 
							'$last', '$email', '$hashedPwd');";
						mysqli_query($conn, $sql);
						header("Location: ../signin.php?signup=success");
						exit();
					}	
				}
			}
		}
	}
} else{
	header("Location: ../signup.php?signup=error");
	exit();
}
<?php

if (isset($_POST['submit'])){
	include "dbh.inc.php";
	
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
	$confirmPwd = mysqli_real_escape_string($conn, $_POST['confirmPwd']);	
		
	if (empty($email) || empty($pwd) || empty($confirmPwd)){
		header("Location: ../reset.php?reset=empty");
		exit();
	} else{
		if ($pwd !== $confirmPwd){
			header("Location: ../reset.php?reset=unequal");
			exit();
		} else{
			$sql = "SELECT * FROM users WHERE user_email='$email'";
			$result = mysqli_query($conn, $sql);
			$resultCheck = mysqli_num_rows($result);
			if ($resultCheck < 1){ // No results in database
				header("Location: ../reset.php?reset=nouser");
				exit();
			} else{
				$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT); 
				$sql = "UPDATE users SET user_pwd='$hashedPwd' WHERE user_email='$email'";
				mysqli_query($conn, $sql);
				header("Location: ../signin.php?reset=success");
				exit();
			}
		}
	}		
} else{
	header("Location: ../reset.php?reset=error");
	exit();
}
	